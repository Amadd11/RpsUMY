<div class="bg-card rounded-3xl p-6 md:p-8 shadow-xl border border-border/50 space-y-8 font-sans">
    <header class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-linear-to-br from-indigo-600 to-indigo-700 rounded-xl shadow-md">
                <iconify-icon icon="solar:book-open-bold" class="size-5 text-white"></iconify-icon>
            </div>
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-foreground font-heading">
                    Matriks Evaluasi & Penilaian
                </h2>
            </div>
        </div>
    </header>

    <div class="overflow-hidden border border-border/50 rounded-4xl shadow-sm bg-white/60">
        <div class="overflow-x-auto no-scrollbar">
            <table class="w-full text-sm text-left border-collapse">
                <thead>
                    <tr
                        class="bg-linear-to-r from-indigo-50 to-purple-50 text-indigo-900 border-b-2 border-indigo-200">
                        <th
                            class="p-5 text-xs font-bold uppercase tracking-wider text-center w-20 border-r border-indigo-200/30">
                            Minggu
                        </th>
                        <th class="p-5 text-xs font-bold uppercase tracking-wider w-28 border-r border-indigo-200/30">
                            CPL
                        </th>
                        <th
                            class="p-5 text-xs font-bold uppercase tracking-wider min-w-[200px] border-r border-indigo-200/30">
                            CPMK
                        </th>
                        <th class="p-5 text-xs font-bold uppercase tracking-wider w-48 border-r border-indigo-200/30">
                            Sub-CPMK
                        </th>
                        <th
                            class="p-5 text-xs font-bold uppercase tracking-wider text-center w-32 border-r border-indigo-200/30 bg-indigo-100/40">
                            Bobot Sub-CPMK (%)
                        </th>
                        <th
                            class="p-5 text-xs font-bold uppercase tracking-wider min-w-[120px] border-r border-indigo-200/30">
                            Indikator Penilaian
                        </th>
                        <th class="p-5 text-xs font-bold uppercase tracking-wider w-40 border-r border-indigo-200/30">
                            Bentuk Penilaian
                        </th>
                        <th class="p-5 text-xs font-bold uppercase tracking-wider text-center w-32 bg-emerald-100/40">
                            Bobot CPMK (%)
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-border/30">
                    @forelse ($groupedEvaluasi as $data)
                        @php
                            $items = $data['items'];
                        @endphp

                        @foreach ($items as $index => $item)
                            <tr class="hover:bg-indigo-50/30 transition-colors">

                                {{-- Minggu --}}
                                @if ($index === 0 || $item->week !== $items[$index - 1]->week)
                                    @php
                                        // Mengambil jumlah baris untuk minggu ini dari hasil countBy di Service
                                        $weekSpan = $data['week_counts'][$item->week];
                                    @endphp
                                    <td rowspan="{{ $weekSpan }}"
                                        class="p-5 text-center font-bold text-indigo-900 bg-indigo-50/50 border-r border-border/20">
                                        <div
                                            class="inline-flex items-center justify-center size-10 rounded-xl bg-white border border-indigo-200 shadow-sm text-base">
                                            {{ $item->week ?? '-' }}
                                        </div>
                                    </td>
                                @endif

                                {{-- CPL --}}
                                @if ($index === 0)
                                    <td rowspan="{{ $items->count() }}"
                                        class="p-5 border-r border-border/20 align-top bg-indigo-50/20">
                                        <span
                                            class="inline-block px-3 py-1.5 bg-indigo-600 text-white text-xs font-bold rounded-lg uppercase tracking-tight shadow-sm">
                                            {{ $data['cpl']->code ?? '-' }}
                                        </span>
                                    </td>

                                    {{-- CPMK --}}
                                    <td rowspan="{{ $items->count() }}" class="p-5 border-r border-border/20 align-top">
                                        <div class="space-y-2">
                                            <span
                                                class="inline-block px-3 py-1 bg-purple-600 text-white text-xs font-bold rounded-lg uppercase tracking-tight shadow-sm">
                                                {{ $data['cpmk']->code ?? '-' }}
                                            </span>
                                            <div class="text-sm text-foreground leading-relaxed">
                                                {!! $data['cpmk']->description !!}
                                            </div>
                                        </div>
                                    </td>
                                @endif

                                {{-- Sub-CPMK --}}
                                <td class="p-5 border-r border-border/20 align-top">
                                    <div class="space-y-1">
                                        <span class="text-xs font-bold text-indigo-700 uppercase tracking-wider">
                                            {{ $item->subCpmk->code ?? '-' }}
                                        </span>
                                        <div class="text-sm text-muted-foreground leading-relaxed">
                                            {!! $item->subCpmk->description ?? '-' !!}
                                        </div>
                                    </div>
                                </td>

                                {{-- Bobot Sub-CPMK --}}
                                <td class="p-5 text-center border-r border-border/20 align-top">
                                    <div
                                        class="inline-flex items-center justify-center px-3 py-1.5 bg-indigo-100 text-indigo-800 rounded-lg border border-indigo-300 font-bold text-sm">
                                        {{ $item->bobot_sub_cpmk ?? 0 }}%
                                    </div>
                                </td>

                                {{-- Indikator Penilaian --}}
                                <td class="p-5 border-r border-border/20 align-top">
                                    <div class="text-sm text-muted-foreground leading-relaxed">
                                        {!! $item->indikator ?? '<span class="text-muted-foreground/50">Belum diatur</span>' !!}
                                    </div>
                                </td>

                                {{-- Bentuk Penilaian --}}
                                <td class="p-5 border-r border-border/20 align-top">
                                    <div class="text-sm text-foreground leading-relaxed font-medium">
                                        {!! $item->bentuk_penilaian ?? '-' !!}
                                    </div>
                                </td>

                                {{-- Total Bobot CPMK --}}
                                @if ($index === 0)
                                    <td rowspan="{{ $items->count() }}"
                                        class="p-5 text-center align-top bg-emerald-50/50">
                                        <div
                                            class="inline-flex flex-col items-center justify-center px-4 py-3 bg-emerald-600 text-white rounded-xl shadow-md">
                                            <span
                                                class="text-xs font-bold uppercase tracking-tight opacity-80">Total</span>
                                            <span class="text-lg font-black">{{ $data['total_bobot_cpmk'] }}%</span>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="8" class="p-20 text-center text-muted-foreground font-medium">
                                Matriks Evaluasi Belum Disusun
                            </td>
                        </tr>
                    @endforelse
                </tbody>

                @if ($groupedEvaluasi->isNotEmpty())
                    <tfoot>
                        <tr class="bg-emerald-100 border-t-4 border-emerald-300 font-bold">
                            <td colspan="7" class="p-6 text-right text-sm uppercase tracking-wider text-emerald-900">
                                Total Bobot Keseluruhan CPMK
                            </td>
                            <td class="p-6 text-center">
                                <div
                                    class="inline-flex items-center justify-center px-6 py-3 bg-emerald-700 text-white text-xl font-black rounded-xl shadow-lg">
                                    {{ $totalBobotEvaluasi }}%
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>

    <footer class="p-5 bg-indigo-50 border border-indigo-200/50 rounded-2xl flex items-start gap-4">
        <div class="p-2 bg-indigo-600 rounded-xl shadow-md shrink-0">
            <iconify-icon icon="solar:info-square-bold" class="size-5 text-white"></iconify-icon>
        </div>
        <div class="flex-1 space-y-2">
            <p class="text-sm text-indigo-800 leading-relaxed">
                Matriks di atas menjamin setiap tahapan pembelajaran (Sub-CPMK) memiliki instrumen penilaian yang valid
                dan reliabel.
                Total bobot penilaian per CPMK dihitung dari akumulasi bobot semua Sub-CPMK terkait.
            </p>
            @if ($totalBobotEvaluasi != 100)
                <p class="text-sm font-bold text-rose-600 uppercase mt-3 animate-pulse">
                    ⚠️ Perhatian: Total bobot saat ini {{ $totalBobotEvaluasi }}%. Harus tepat 100%.
                </p>
            @endif
        </div>
    </footer>
</div>
