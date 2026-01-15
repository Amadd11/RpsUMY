<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\Rps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RpsExportController extends Controller
{
    public function pdf(Rps $rps)
    {
        $rps->load([
            'course.prodi.fakultas',
            'dosen',
            'cpls' => fn($q) => $q->withPivot('bobot'),
            'cpmks.subCpmks',
            'evaluasis.subCpmk',
            'evaluasis.cpmk.cpl',
            'rencanas.subCpmk',
            'tugas',
            'referensi'
        ]);

        $groupedEvaluasi = $rps?->evaluasis
            ?->groupBy('cpmk_id')
            ->map(function ($items) {
                $cpmk = $items->first()->cpmk;
                return [
                    'cpl' => $cpmk?->cpl,
                    'cpmk' => $cpmk,
                    'items' => $items,
                    'total_bobot_cpmk' => $items->sum('bobot_sub_cpmk'),
                    'week_counts' => $items->countBy('week'),
                ];
            }) ?? collect();

        $data = [
            'rps'       => $rps,
            'course'    => $rps->course,
            'groupedEvaluasi' => $groupedEvaluasi,
            'daftarTugas'     => $rps?->tugas ?? collect(),
            'logo_path' => public_path('assets/images/logo/logo.png'),
            'print_date' => now()->translatedFormat('d F Y'),
            'referensiUtama'    => $rps?->referensi->where('tipe', 'utama') ?? collect(),
            'referensiTambahan' => $rps?->referensi->where('tipe', 'tambahan') ?? collect(),
        ];

        try {
            $mpdf = new Mpdf([
                'mode'              => 'utf-8',
                'format'            => 'A4',
                'orientation'       => 'P',
                'margin_left'       => 15,
                'margin_right'      => 15,
                'margin_top'        => 20,
                'margin_bottom'     => 20,
                'margin_header'     => 10,
                'margin_footer'     => 10,
                'tempDir'           => storage_path('app/mpdf'),
                'default_font'      => 'helvetica',
            ]);

            // Footer (global, applies to all pages)
            $mpdf->SetHTMLFooter('
                <table width="100%" style="font-size:8pt; color:#666; border-top:1px solid #ccc; padding-top:5px;">
                    <tr>
                        <td>RPS - ' . ($rps->course->code ?? '-') . '</td>
                        <td align="right">Halaman {PAGENO} dari {nbpg}</td>
                    </tr>
                </table>
            ');

            // PART 1: Portrait - Identitas, Deskripsi, CPL, CPMK
            $htmlPart1 = view('exports.export-pdf-part1', $data)->render();
            $mpdf->WriteHTML($htmlPart1);

            // Switch to Landscape + new page
            $mpdf->AddPage(
                'L',               // Landscape
                '',
                '',
                '',
                '',
                15,
                15,
                20,
                20,
                10,
                10
            );

            // PART 2: Landscape - Matriks + Rencana Mingguan
            $htmlPart2 = view('exports.export-pdf-part2', $data)->render();
            $mpdf->WriteHTML($htmlPart2);

            // Switch back to Portrait + new page
            $mpdf->AddPage('P');

            // PART 3: Portrait - Referensi + Tanda Tangan
            $htmlPart3 = view('exports.export-pdf-part3', $data)->render();
            $mpdf->WriteHTML($htmlPart3);

            $filename = 'RPS_' . str_replace(' ', '_', $rps->course->name ?? 'Dokumen') . '.pdf';

            return response()->streamDownload(function () use ($mpdf) {
                echo $mpdf->Output('', 'S');
            }, $filename, ['Content-Type' => 'application/pdf']);
        } catch (\Mpdf\MpdfException $e) {
            Log::error('mPDF Error: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal generate PDF: ' . $e->getMessage()], 500);
        }
    }
}
