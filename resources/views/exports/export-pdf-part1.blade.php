<div class="part-1-container">
    <style>
        /* Base Setup */
        .part-1-container {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10pt;
            color: #1f2937;
            line-height: 1.5;
            padding: 0;
            margin: 0;
        }

        /* Typography & Spacing */
        .part-1-container h1,
        .part-1-container h2 {
            margin: 0;
            padding: 0;
        }

        /* Header Style (Kop Surat) */
        .part-1-container .header-table {
            width: 100%;
            border: none;
            border-bottom: 3px double #111827;
            margin-bottom: 25px;
        }

        .part-1-container .header-table td {
            border: none !important;
            padding: 0 0 10px 0;
        }

        .part-1-container .univ-name {
            font-size: 14pt;
            font-weight: 800;
            text-transform: uppercase;
            color: #111827;
        }

        .part-1-container .dept-info {
            font-size: 10pt;
            color: #4b5563;
            font-weight: 400;
        }

        /* Document Title */
        .part-1-container .doc-title-wrapper {
            text-align: center;
            margin-bottom: 30px;
        }

        .part-1-container .doc-title-wrapper h1 {
            font-size: 16pt;
            font-weight: 800;
            color: #111827;
            letter-spacing: 0.5px;
        }

        .part-1-container .doc-title-wrapper h2 {
            font-size: 12pt;
            font-weight: 600;
            color: #374151;
            margin-top: 5px;
        }

        /* Section Styling */
        .part-1-container .section-header {
            background-color: #f8fafc;
            border-left: 4px solid #1e40af;
            padding: 6px 12px;
            font-size: 11pt;
            font-weight: 700;
            text-transform: uppercase;
            color: #1e40af;
            margin: 25px 0 12px 0;
            page-break-after: avoid;
        }

        /* Table Styling */
        .part-1-container table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            table-layout: fixed;
        }

        .part-1-container th,
        .part-1-container td {
            border: 1px solid #cbd5e1;
            padding: 8px 10px;
            word-wrap: break-word;
            vertical-align: top;
        }

        .part-1-container th {
            background-color: #f1f5f9;
            color: #334155;
            font-weight: 700;
            font-size: 9pt;
            text-transform: uppercase;
            text-align: center;
        }

        /* Identity Table */
        .part-1-container .table-identity td {
            border: none;
            padding: 4px 0;
        }

        .part-1-container .table-identity .label {
            width: 30%;
            font-weight: 700;
            color: #475569;
        }

        .part-1-container .table-identity .separator {
            width: 3%;
            text-align: center;
        }

        /* Badges */
        .part-1-container .code-badge {
            display: inline-block;
            padding: 2px 8px;
            background: #e0e7ff;
            color: #3730a3;
            font-size: 8.5pt;
            font-weight: 700;
            border-radius: 4px;
            border: 1px solid #c7d2fe;
        }

        .part-1-container .sub-badge {
            background: #f3e8ff;
            color: #6b21a8;
            border: 1px solid #e9d5ff;
        }

        /* Helpers */
        .part-1-container .rich-text {
            text-align: justify;
            font-size: 9.5pt;
        }

        .part-1-container .empty-state {
            text-align: center;
            font-style: italic;
            color: #94a3b8;
            padding: 15px;
        }

        .part-1-container .text-center {
            text-align: center;
        }

        .part-1-container .font-bold {
            font-weight: 700;
        }
    </style>

    <table class="header-table">
        <tr>
            <td width="70">
                <img src="{{ $logo_path }}" width="60" alt="Logo">
            </td>
            <td>
                <div class="univ-name">Universitas Muhammadiyah Yogyakarta</div>
                <div class="dept-info">Fakultas {{ $course->prodi->fakultas->name ?? '-' }}</div>
                <div class="dept-info">Program Studi {{ $course->prodi->name ?? '-' }}</div>
            </td>
        </tr>
    </table>

    <div class="doc-title-wrapper">
        <h1>RENCANA PEMBELAJARAN SEMESTER (RPS)</h1>
        <h2>{{ strtoupper($course->name ?? 'MATA KULIAH') }} ({{ $course->code ?? '-' }})</h2>
    </div>

    <div class="section-header">I. Identitas Mata Kuliah</div>
    <table class="table-identity">
        <tr>
            <td class="label">Program Studi</td>
            <td class="separator">:</td>
            <td>{{ $course->prodi->name ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Mata Kuliah / Kode</td>
            <td class="separator">:</td>
            <td>{{ $course->name ?? '-' }} / {{ $course->code ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Bobot SKS / Semester</td>
            <td class="separator">:</td>
            <td>{{ $course->sks ?? '0' }} SKS / Semester {{ $course->semester ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Tahun Ajaran</td>
            <td class="separator">:</td>
            <td>{{ $rps->tahun_ajaran ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Dosen Pengampu / PJ</td>
            <td class="separator">:</td>
            <td>{{ $rps->dosen->name ?? ($rps->penanggung_jawab ?? '-') }}</td>
        </tr>
    </table>

    <div class="section-header">II. Deskripsi Mata Kuliah</div>
    <div class="rich-text" style="padding: 0 5px;">
        {!! $rps->deskripsi ?: '<span style="color: #94a3b8 italic;">- Belum ada deskripsi mata kuliah -</span>' !!}
    </div>

    <div class="section-header">III. Capaian Pembelajaran Lulusan (CPL)</div>
    <table>
        <thead>
            <tr>
                <th width="15%">Kode</th>
                <th>Deskripsi Capaian Pembelajaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rps->cpls as $cpl)
                <tr>
                    <td class="text-center"><span class="code-badge">{{ $cpl->code }}</span></td>
                    <td class="rich-text">{!! $cpl->description !!}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="empty-state">Data CPL belum tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-header">IV. Capaian Pembelajaran Mata Kuliah (CPMK)</div>
    <table>
        <thead>
            <tr>
                <th width="15%">Kode</th>
                <th>Deskripsi Capaian</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rps->cpmks as $cpmk)
                <tr>
                    <td class="text-center"><span class="code-badge">{{ $cpmk->code ?? '-' }}</span></td>
                    <td class="rich-text">{!! $cpmk->description ?? '-' !!}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="empty-state">Data CPMK belum tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-header">V. Sub Capaian Pembelajaran Mata Kuliah (Sub-CPMK)</div>
    <table>
        <thead>
            <tr>
                <th width="8%">No</th>
                <th width="15%">Kode</th>
                <th width="15%">Induk</th>
                <th>Deskripsi Kemampuan Akhir</th>
            </tr>
        </thead>
        <tbody>
            @php $rowNo = 1; @endphp
            @forelse($rps->cpmks as $index => $cpmk)
                @foreach ($cpmk->subCpmks as $subIndex => $sub)
                    <tr>
                        <td class="text-center" style="font-size: 9pt; color: #64748b;">{{ $rowNo++ }}</td>
                        <td class="text-center"><span class="code-badge sub-badge">{{ $sub->code ?? '-' }}</span></td>
                        <td class="text-center" style="font-weight: 600; color: #1e40af;">{{ $cpmk->code ?? '-' }}</td>
                        <td class="rich-text">{!! $sub->description ?? '-' !!}</td>
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="4" class="empty-state">Data Sub-CPMK belum tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
