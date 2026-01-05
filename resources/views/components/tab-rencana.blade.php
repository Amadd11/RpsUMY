<div class="bg-card rounded-3xl p-6 md:p-8 shadow-xl border border-border/50 space-y-8">
    <!-- Card Header -->
    <header class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-linear-to-br from-primary to-primary/80 rounded-xl shadow-md">
                <iconify-icon icon="solar:book-open-bold" class="size-5 text-primary-foreground"></iconify-icon>
            </div>
            <div>
                <h2 class="text-xl font-bold tracking-tight text-foreground">Rencana Kegiatan Pembelajaran</h2>
                <p class="text-sm text-muted-foreground font-medium">Distribusi capaian, metode, dan penilaian selama 1
                    semester</p>
            </div>
        </div>
    </header>

    <!-- Scrollable Table -->
    <div class="overflow-hidden border border-border/50 rounded-4xl shadow-sm bg-white/50 ">
        <div class="overflow-x-auto no-scrollbar">
            <div class="min-w-[1400px]">
                <table class="w-full text-sm text-left border-collapse">
                    <thead>
                        <!-- Main Header Row -->
                        <tr
                            class="bg-linear-to-r from-indigo-50 to-purple-50/50 text-indigo-900 border-b-2 border-indigo-200/50">
                            <th rowspan="2"
                                class="w-20 p-4 font-bold tracking-wider text-sm text-center border border-indigo-200/50">
                                Minggu ke <br><span class="text-indigo-600 font-black"></span>
                            </th>
                            <th rowspan="2"
                                class="w-56 p-4 font-bold  tracking-wider text-sm text-center border border-indigo-200/50">
                                Kemampuan Akhir (Sub-CPMK) <br><span class="text-purple-600 font-black"></span>
                            </th>
                            <th colspan="2"
                                class="p-3 font-bold  tracking-wider text-sm text-center border border-indigo-200/50 bg-indigo-100/50">
                                Penilaian</th>
                            <th colspan="2"
                                class="p-3 font-bold  tracking-wider text-sm text-center border border-indigo-200/50 bg-emerald-100/50">
                                Bentuk / Strategi Pembelajaran <br>(Metode & Tugas)
                            </th>
                            <th rowspan="2"
                                class="w-56 p-4 font-bold  tracking-wider text-sm text-center border border-indigo-200/50">
                                Materi Pembelajaran <br><span class="text-slate-600 font-black"></span>
                            </th>
                            <th rowspan="2"
                                class="w-24 p-4 font-bold  tracking-wider text-sm text-center border border-indigo-200/50">
                                Bobot Penilaian (%) <br><span class="text-emerald-600 font-black"></span>
                            </th>
                        </tr>
                        <!-- Subheader Row -->
                        <tr
                            class="text-indigo-900 bg-linear-to-r from-indigo-100/50 to-amber-100/50 border border-indigo-200/50">
                            <th
                                class="w-56 p-3 font-bold  tracking-wider text-sm text-center border border-indigo-200/50">
                                Indikator <span class="text-blue-600 font-black"></span>
                            </th>
                            <th
                                class="w-56 p-3 font-bold  tracking-wider text-sm text-center border border-indigo-200/50">
                                Kriteria & Teknik <span class="text-amber-600 font-black"></span>
                            </th>
                            <th
                                class="w-40 p-3 font-bold  tracking-wider text-sm text-center border border-indigo-200/50">
                                Luring <span class="text-indigo-600 font-black"></span>
                            </th>
                            <th
                                class="w-40 p-3 font-bold  tracking-wider text-sm text-center border border-indigo-200/50">
                                Daring <span class="text-emerald-600 font-black"></span>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-border/40">
                        @forelse ($rencanas as $index => $rencana)
                            <tr
                                class="group hover:bg-muted/20 transition-all duration-300 {{ $index % 2 === 0 ? 'bg-white/50' : 'bg-indigo-50/20' }}">
                                <!-- Week -->
                                <td class="p-4 text-center align-top border border-indigo-200/30 font-black">
                                    <div
                                        class="inline-flex flex-col items-center justify-center size-12 rounded-2xl bg-white/80 border border-border shadow-sm group-hover:bg-indigo-100 group-hover:border-indigo-300 transition-all duration-300">
                                        <span
                                            class="text-sm  tracking-tighter leading-none mb-0.5 text-indigo-600"></span>
                                        <span class="text-base leading-none">{{ $rencana->week }}</span>
                                    </div>
                                </td>

                                <!-- Sub-CPMK -->
                                <td class="p-4 align-top border border-indigo-200/30">
                                    @if ($rencana->subCpmk)
                                        <div class="space-y-2">
                                            <div
                                                class="inline-flex px-2 py-0.5 bg-purple-100/50 text-purple-700 text-xs font-black rounded border border-purple-200/50  tracking-widest mb-1">
                                                {{ $rencana->subCpmk->code }}
                                            </div>
                                            <div
                                                class="text-sm leading-relaxed text-foreground prose prose-sm max-w-none">
                                                {!! $rencana->subCpmk->description !!}
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted-foreground">-</span>
                                    @endif
                                </td>

                                <!-- Indikator -->
                                <td class="p-4 align-top border border-indigo-200/30">
                                    <x-rencana-cell :content="$rencana->indikator" />
                                </td>


                                <!-- Kriteria & Teknik -->
                                <td class="p-4 align-top border border-indigo-200/30">
                                    <x-rencana-cell :content="$rencana->kriteria_teknik" />
                                </td>

                                <!-- Luring -->
                                <td class="p-4 align-top border border-indigo-200/30 text-sm">
                                    <x-rencana-cell :content="$rencana->luring" />
                                </td>

                                <!-- Daring -->
                                <td class="p-4 align-top border border-indigo-200/30 text-sm">
                                    <x-rencana-cell :content="$rencana->daring" />
                                </td>

                                <!-- Materi Pembelajaran -->
                                <td class="p-4 align-top border border-indigo-200/30">
                                    <x-rencana-cell :content="$rencana->materi_pembelajaran" />
                                </td>

                                <!-- Bobot -->
                                <td class="p-4 text-center align-top border border-indigo-200/30">
                                    <div
                                        class="inline-flex items-center justify-center px-3 py-1.5 bg-emerald-50/50 text-emerald-700 rounded-xl border border-emerald-100/50 group-hover:bg-emerald-100 group-hover:border-emerald-300 transition-all duration-300">
                                        <span
                                            class="text-sm font-black text-emerald-800">{{ $rencana->bobot ?? '-' }}%</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="p-20 text-center">
                                    <div class="flex flex-col items-center justify-center opacity-40">
                                        <iconify-icon icon="solar:ghost-bold"
                                            class="size-16 mb-4 text-muted-foreground"></iconify-icon>
                                        <p class="text-sm font-bold  tracking-widest">Belum ada rencana
                                            pembelajaran yang disusun.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                        @if ($rencanas->isNotEmpty())
                            <tr class="bg-linear-to-r from-indigo-100/50 via-purple-100/50 to-emerald-100/50 font-bold">
                                <td colspan="7" class="p-4 text-center text-lg font-black">
                                    Total Bobot Penilaian
                                </td>
                                <td class="p-4 text-xl font-black text-center text-emerald-700">
                                    {{ $totalBobotRencana }}%
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer Summary -->
    <footer class="flex items-center justify-between p-5 bg-indigo-50/50 rounded-2xl border border-indigo-100/50">
        <div class="flex items-center gap-3">
            <iconify-icon icon="solar:info-square-bold" class="size-5 text-indigo-600 shrink-0"></iconify-icon>
            <p class="text-sm text-indigo-800 font-medium leading-relaxed">
                Rencana pembelajaran di atas mencakup pemetaan indikator capaian dan teknik penilaian untuk memastikan
                kualitas pembelajaran yang terukur.
            </p>
        </div>
    </footer>
</div>
