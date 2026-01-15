
<div class="part-container">
    <style>
        /* GLOBAL STYLE UNTUK PART 3 */
        .part-container {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10pt;
            color: #1f2937;
            line-height: 1.5;
        }

        /* Header Seksi dengan Aksen Biru */
        .section-header {
            background-color: #f8fafc;
            border-left: 4px solid #1e40af;
            padding: 6px 12px;
            font-size: 11pt;
            font-weight: 700;
            text-transform: uppercase;
            color: #1e40af;
            margin: 25px 0 15px 0;
            page-break-after: avoid;
        }

        /* --- STYLE BAGIAN TUGAS --- */
        .task-block {
            margin-bottom: 25px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            overflow: hidden;
            page-break-inside: avoid;
            /* Menjaga satu blok tugas tidak terpotong halaman */
        }

        .task-header {
            background-color: #1e40af;
            color: white;
            padding: 8px 12px;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 9.5pt;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #f8fafc;
            border-bottom: 1px solid #cbd5e1;
        }

        .info-table td {
            padding: 6px 12px;
            border: 1px solid #cbd5e1;
            font-size: 8.5pt;
        }

        .info-label {
            font-size: 7pt;
            font-weight: 800;
            color: #64748b;
            text-transform: uppercase;
            display: block;
            margin-bottom: 2px;
        }

        .content-area {
            padding: 12px;
        }

        .content-title {
            font-weight: 800;
            font-size: 8.5pt;
            color: #1e40af;
            border-bottom: 1px solid #e2e8f0;
            margin: 10px 0 5px;
            text-transform: uppercase;
        }

        /* --- STYLE BAGIAN REFERENSI --- */
        .ref-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .ref-table td {
            padding: 8px 12px;
            border: 1px solid #cbd5e1;
            vertical-align: top;
            font-size: 9pt;
        }

        .ref-no {
            width: 25px;
            text-align: center;
            font-weight: 700;
            background-color: #f1f5f9;
            color: #1e40af;
        }

        .ref-label-small {
            font-size: 7.5pt;
            font-weight: 800;
            color: #64748b;
            text-transform: uppercase;
            margin: 15px 0 8px 2px;
            display: block;
        }

        /* Reusable Components */
        .rich-text {
            font-size: 9pt;
            text-align: justify;
        }

        .code-badge {
            display: inline-block;
            padding: 1px 5px;
            background: #e0e7ff;
            color: #3730a3;
            font-weight: 700;
            border-radius: 3px;
            font-size: 8pt;
            border: 0.5px solid #c7d2fe;
        }

        .note-footer {
            margin-top: 25px;
            padding: 12px 15px;
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 6px;
            font-size: 8.5pt;
            color: #1e40af;
            font-style: italic;
            line-height: 1.4;
        }
    </style>

    <div class="section-header">VII. Rencana Tugas dan Penilaian</div>

    @forelse ($daftarTugas as $index => $tugas)
        <div class="task-block">
            <div class="task-header">{{ $tugas->judul_penilaian ?? 'Tugas ' . ($index + 1) }}</div>

            <table class="info-table">
                <tr>
                    <td width="15%">
                        <span class="info-label">Minggu</span>
                        <strong>{{ $tugas->jadwal_pelaksanaan ?? '-' }}</strong>
                    </td>
                    <td width="35%">
                        <span class="info-label">Bentuk Penilaian</span>
                        <strong>{!! $tugas->bentuk_penilaian ?? '-' !!}</strong>
                    </td>
                    <td>
                        <span class="info-label">Kaitan Sub-CPMK</span>
                        <span class="code-badge">{!! $tugas->sub_cpmk ?? '-' !!}</span>
                    </td>
                </tr>
            </table>

            <div class="content-area">
                <div class="content-title">Deskripsi & Metode Pengerjaan</div>
                <div class="rich-text">{!! $tugas->deskripsi_penilaian !!}</div>

                <div class="content-title">Indikator, Kriteria & Luaran</div>
                <div class="rich-text">{!! $tugas->indikator_kriteria_bobot !!}</div>
                <div class="rich-text" style="margin-top:5px; font-style:italic; font-size: 8.5pt; color: #475569;">
                    Luaran: {!! $tugas->bentuk_dan_format_luaran !!}
                </div>
            </div>
        </div>
    @empty
        <div class="rich-text"
            style="color: #94a3b8; text-align: center; padding: 20px; border: 1px dashed #cbd5e1; border-radius: 6px;">
            - Belum ada data tugas dan penilaian -
        </div>
    @endforelse


    <div class="section-header">VIII. Referensi / Daftar Pustaka</div>

    <span class="ref-label-small">Pustaka Wajib (Utama)</span>
    @if ($referensiUtama->isNotEmpty())
        <table class="ref-table">
            @foreach ($referensiUtama as $index => $ref)
                <tr>
                    <td class="ref-no">{{ $index + 1 }}</td>
                    <td class="rich-text">
                        <span class="code-badge" style="margin-bottom: 4px; font-size: 7pt;">UTAMA</span><br>
                        {!! $ref->referensi !!}
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <div class="rich-text" style="color: #94a3b8; padding: 5px 10px;">- Belum ada pustaka utama yang terdaftar -
        </div>
    @endif

    <span class="ref-label-small" style="margin-top: 15px;">Pustaka Pendukung (Tambahan)</span>
    @if ($referensiTambahan->isNotEmpty())
        <table class="ref-table">
            @foreach ($referensiTambahan as $index => $ref)
                <tr>
                    <td class="ref-no" style="color: #64748b; background: #f8fafc;">{{ $index + 1 }}</td>
                    <td class="rich-text">
                        <span class="code-badge"
                            style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; margin-bottom: 4px; font-size: 7pt;">PENDUKUNG</span><br>
                        <span style="color: #4b5563;">{!! $ref->referensi !!}</span>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <div class="rich-text" style="color: #94a3b8; padding: 5px 10px;">- Tidak ada pustaka tambahan -</div>
    @endif

    <div class="note-footer">
        <strong>Penting:</strong> Referensi di atas merupakan acuan utama dalam proses pembelajaran mata kuliah ini.
        Mahasiswa disarankan mengeksplorasi literatur lebih lanjut melalui portal <strong>E-Library</strong>
        atau koleksi fisik Perpustakaan Universitas Muhammadiyah Yogyakarta.
    </div>
</div>
