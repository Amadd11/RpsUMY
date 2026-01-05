<div class="bg-card rounded-3xl p-6 md:p-8 shadow-xl border border-border/50 space-y-10">

    <div class="flex items-center gap-3">
        <div class="p-2 bg-linear-to-br from-primary to-primary/80 rounded-xl shadow-md">
            <iconify-icon icon="solar:target-bold" class="size-5 text-primary-foreground"></iconify-icon>
        </div>
        <h2 class="text-xl font-bold tracking-tight text-foreground">
            Capaian Pembelajaran Lulusan (CPL)
        </h2>
    </div>

    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-foreground">
                Daftar Seluruh CPL Prodi
            </h3>

            <span
                class="px-3 py-1 text-xs font-bold bg-muted/50 text-muted-foreground rounded-full border border-muted/20">
                Total {{ $allCpls->count() }} CPL
            </span>
        </div>

        <div class="grid grid-cols-1 gap-4">
            @forelse ($allCpls as $cpl)
                <div class="group relative p-5 rounded-2xl border border-border/50 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 bg-card overflow-hidden"
                    style="border-left: 6px solid {{ $cpl->bg_color }};">
                    {{-- Background tint --}}
                    <div class="absolute inset-0 opacity-[0.03]" style="background-color: {{ $cpl->bg_color }};"></div>

                    <div class="relative z-10 flex flex-wrap items-center justify-between gap-3 mb-3">
                        <div class="flex items-center gap-3">
                            <span class="text-lg font-black tracking-wider" style="color: {{ $cpl->bg_color }};">
                                {{ $cpl->code }}
                            </span>
                        </div>

                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold rounded-full bg-primary/10 text-primary border border-primary/20 shadow-sm">
                            <iconify-icon icon="solar:tag-bold" class="size-3"></iconify-icon>
                            Taksonomi: {{ $cpl->taksonomi }}
                        </span>

                    </div>

                    <div class="relative z-10">
                        @if ($cpl->description)
                            <div class="prose prose-sm max-w-none text-muted-foreground font-medium">
                                {!! $cpl->description !!}
                            </div>
                        @else
                            <p class="italic text-muted-foreground text-sm">
                                Deskripsi tidak tersedia untuk CPL ini.
                            </p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="p-10 text-center bg-muted/30 rounded-2xl border border-dashed border-border">
                    <iconify-icon icon="solar:document-add-bold-duotone"
                        class="size-12 text-muted-foreground/50 mx-auto mb-3 block"></iconify-icon>
                    <h3 class="text-lg font-semibold text-foreground">Data Kosong</h3>
                    <p class="text-muted-foreground text-sm">
                        Belum ada data CPL yang tersedia untuk Program Studi ini.
                    </p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- ================= CPL TERPILIH ================= --}}
    @if ($rps && $rps->cpls->isNotEmpty())
        <div class="mt-12 p-1 bg-linear-to-br from-primary/20 via-transparent to-secondary/10 rounded-4xl">
            <div class="bg-card/80 backdrop-blur-sm border border-white/20 shadow-2xl rounded-[1.8rem] p-6 md:p-8">

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <div class="flex items-center gap-3">
                        <div class="size-12 flex items-center justify-center bg-primary/10 rounded-2xl text-primary">
                            <iconify-icon icon="solar:check-read-bold" class="size-7"></iconify-icon>
                        </div>
                        <h4 class="text-xl font-bold text-foreground">
                            CPL Terpilih
                        </h4>
                    </div>

                    <div
                        class="flex items-center gap-2 px-5 py-3 bg-white shadow-sm border border-border/50 rounded-2xl">
                        <iconify-icon icon="solar:chart-pie-bold" class="size-5 text-secondary"></iconify-icon>
                        <span class="text-sm font-medium text-muted-foreground">Total Bobot:</span>
                        <span class="text-lg font-black text-foreground">
                            {{ number_format($totalBobotCpl, 1) }}%
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    @foreach ($rps->cpls as $cpl)
                        <div class="group flex items-start gap-4 p-5 bg-white border border-border/40 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300"
                            style="border-right: 4px solid {{ $cpl->bg_color ?? '#3b82f6' }};">
                            <div class="mt-1 p-1.5 rounded-lg"
                                style="background-color: {{ $cpl->bg_color ?? '#3b82f6' }}15;">
                                <iconify-icon icon="solar:verified-check-bold" class="size-5"
                                    style="color: {{ $cpl->bg_color ?? '#3b82f6' }}"></iconify-icon>
                            </div>

                            <div class="flex-1">
                                <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                                    <span class="font-bold text-foreground tracking-tight">
                                        {{ $cpl->code }}
                                    </span>

                                    @if ($cpl->pivot?->bobot !== null)
                                        <div
                                            class="flex items-center gap-1.5 px-3 py-1 rounded-lg bg-secondary/10 border border-secondary/20">
                                            <span
                                                class="text-[10px] font-black text-secondary uppercase tracking-widest">
                                                Weight
                                            </span>
                                            <span class="text-xs font-bold text-foreground">
                                                {{ number_format($cpl->pivot->bobot, 1) }}%
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="text-sm leading-relaxed text-muted-foreground/90 font-medium italic">
                                    {!! $cpl->description !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    @else
        <div class="p-10 text-center border-2 border-dashed border-border bg-muted/20 rounded-3xl">
            <iconify-icon icon="solar:info-circle-bold-duotone"
                class="size-10 text-muted-foreground mx-auto mb-3 block"></iconify-icon>
            <p class="text-base font-medium text-muted-foreground">
                Belum ada CPL yang ditautkan ke mata kuliah ini.
            </p>
        </div>
    @endif

    {{-- ================= FOOTER INFO ================= --}}
    <div
        class="flex items-center gap-3 p-5 text-sm text-muted-foreground bg-muted/30 rounded-2xl border border-border/50">
        <div class="size-8 flex items-center justify-center bg-primary/10 rounded-full text-primary">
            <iconify-icon icon="solar:shield-check-bold" class="size-4"></iconify-icon>
        </div>
        <p class="italic font-medium leading-tight">
            Data CPL disinkronkan dari standar kurikulum Program Studi.
            Pastikan total bobot CPL pada mata kuliah ini mencapai
            <span class="text-foreground font-bold">100%</span>.
        </p>
    </div>

</div>
