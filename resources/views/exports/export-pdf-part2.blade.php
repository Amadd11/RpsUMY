<div class="part-2-container">
    <style>
        .part-2-container {
            font-family: sans-serif;
            font-size: 9.5pt;
            color: #111827;
        }

        .part-2-container .section-header {
            font-weight: bold;
            font-size: 11pt;
            margin: 18px 0 8px;
            text-transform: uppercase;
            color: #111827;
        }

        .part-2-container table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
            page-break-inside: avoid;
        }

        .part-2-container th,
        .part-2-container td {
            border: 0.8px solid #6b7280;
            padding: 6px 8px;
            vertical-align: top;
        }

        .part-2-container th {
            background-color: #e5e7eb;
            font-weight: bold;
            font-size: 9pt;
            text-align: center;
        }

        .part-2-container tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .part-2-container .center {
            text-align: center;
        }

        .part-2-container .bold {
            font-weight: bold;
        }

        .part-2-container .italic {
            font-style: italic;
            color: #6b7280;
        }

        .part-2-container .rich-content {
            text-align: justify;
            line-height: 1.4;
        }

        .part-2-container .week-cell {
            text-align: center;
            font-weight: bold;
            width: 4%;
            background-color: #eff6ff;
        }

        .part-2-container .code-box {
            display: inline-block;
            padding: 2px 6px;
            font-size: 8.5pt;
            font-weight: bold;
            border: 0.8px solid #4b5563;
            margin-bottom: 4px;
        }

        .part-2-container .cpmk-box {
            background-color: #f3e8ff;
            border-color: #7c3aed;
        }

        .part-2-container .cpl-box {
            background-color: #ecfeff;
            border-color: #0284c7;
        }

        .part-2-container .bobot-cell {
            text-align: center;
            font-weight: bold;
            background-color: #ecfdf5;
            width: 6%;
        }

        .part-2-container .total-cpmk {
            text-align: center;
            font-weight: bold;
            font-size: 11pt;
            background-color: #d1fae5;
        }

        .part-2-container .empty-state {
            text-align: center;
            font-style: italic;
            color: #6b7280;
            padding: 20px 0;
        }
    </style>

    <div class="section-header">VI. Rencana Kegiatan Pembelajaran Mingguan</div>
    <table>
        <thead>
            <tr>
                <th width="4%">Week</th>
                <th width="20%">Sub-CPMK</th>
                <th width="18%">Indikator</th>
                <th width="18%">Kriteria & Teknik</th>
                <th width="8%">Luring</th>
                <th width="8%">Daring</th>
                <th width="18%">Materi</th>
                <th width="6%">Bobot</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rps->rencanas->sortBy('week') as $rencana)
                <tr>
                    <td class="week-cell">{{ $rencana->week }}</td>
                    <td>
                        <div class="code-box">{{ $rencana->subCpmk->code ?? '-' }}</div>
                        <div class="rich-content">{!! $rencana->subCpmk->description ?? '-' !!}</div>
                    </td>
                    <td class="rich-content">{!! $rencana->indikator ?? '-' !!}</td>
                    <td class="rich-content">{!! $rencana->kriteria_teknik ?? '-' !!}</td>
                    <td class="center">{!! $rencana->luring ?? '-' !!}</td>
                    <td class="center">{!! $rencana->daring ?? '-' !!}</td>
                    <td class="rich-content">{!! $rencana->materi_pembelajaran ?? '-' !!}</td>
                    <td class="bobot-cell">{{ $rencana->bobot ? $rencana->bobot . '%' : '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="empty-state">Rencana pembelajaran belum tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-header">VII. Matriks Penilaian (Evaluasi)</div>
    <table>
        <thead>
            <tr>
                <th width="4%">Week</th>
                <th width="8%">CPL</th>
                <th width="18%">CPMK</th>
                <th width="18%">Sub-CPMK</th>
                <th width="6%">Bobot</th>
                <th width="20%">Indikator</th>
                <th width="16%">Bentuk Penilaian</th>
                <th width="6%">Total CPMK</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($groupedEvaluasi as $data)
                @php $items = $data['items']; @endphp
                @foreach ($items as $i => $item)
                    <tr>
                        @if ($i === 0 || $item->week !== $items[$i - 1]->week)
                            <td rowspan="{{ $data['week_counts'][$item->week] ?? 1 }}" class="week-cell">
                                {{ $item->week }}
                            </td>
                        @endif

                        @if ($i === 0)
                            <td rowspan="{{ $items->count() }}">
                                <div class="code-box cpl-box">{{ $data['cpl']->code ?? '-' }}</div>
                            </td>
                            <td rowspan="{{ $items->count() }}">
                                <div class="code-box cpmk-box">{{ $data['cpmk']->code ?? '-' }}</div>
                                <div class="rich-content">{!! $data['cpmk']->description !!}</div>
                            </td>
                        @endif

                        <td>
                            <div class="code-box">{{ $item->subCpmk->code ?? '-' }}</div>
                            <div class="rich-content">{!! $item->subCpmk->description ?? '-' !!}</div>
                        </td>
                        <td class="bobot-cell">{{ $item->bobot_sub_cpmk ?? 0 }}%</td>
                        <td class="rich-content">{!! $item->indikator ?? '-' !!}</td>
                        <td class="rich-content">{!! $item->bentuk_penilaian ?? '-' !!}</td>

                        @if ($i === 0)
                            <td rowspan="{{ $items->count() }}" class="total-cpmk">
                                {{ $data['total_bobot_cpmk'] }}%
                            </td>
                        @endif
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="8" class="empty-state">Matriks evaluasi belum tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
