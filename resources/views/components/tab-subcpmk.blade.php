<div class="bg-card rounded-3xl p-6 md:p-8 shadow-xl border border-border/50 space-y-8">
    <!-- Header: Sub-CPMK -->
    <div class="flex items-center gap-3">
        <div class="p-2 bg-gradient-to-br from-accent to-accent/80 rounded-xl shadow-md">
            <iconify-icon icon="solar:branching-paths-bold" class="size-5 text-accent-foreground"></iconify-icon>
        </div>
        <h2 class="text-xl font-bold tracking-tight text-foreground">
            Sub-Capaian Pembelajaran Mata Kuliah (Sub-CPMK)
        </h2>
    </div>

    <!-- List Content: Grouped by CPMK -->
    @if ($rps->cpmks->isEmpty())
        <div
            class="flex flex-col items-center justify-center py-12 text-center border-2 border-dashed border-border/50 rounded-2xl bg-muted/50">
            <div class="p-4 mb-4 bg-muted rounded-full">
                <iconify-icon icon="solar:document-add-bold" class="size-8 text-muted-foreground/50"></iconify-icon>
            </div>
            <h3 class="text-lg font-semibold text-foreground">Belum Ada Sub-CPMK</h3>
            <p class="max-w-md text-muted-foreground text-sm">
                Silakan isi data CPMK terlebih dahulu agar dapat merumuskan Sub-CPMK.
            </p>
        </div>
    @else
        <div class="space-y-8">
            @foreach ($rps->cpmks as $cpmk)
                <div class="space-y-6">
                    <!-- CPMK Parent Label -->
                    <div class="flex items-center justify-between border-b border-border/30 pb-4">
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-foreground">
                                Sub-CPMK dari {{ $cpmk->code }}
                            </span>
                            <span
                                class="px-3 py-1 text-xs font-bold bg-amber-100 text-amber-700 rounded-full border border-amber-200">
                                {{ $cpmk->subCpmks->count() }} Sub-CPMK
                            </span>
                        </div>
                    </div>

                    <!-- Sub-CPMK Cards Grid -->
                    <div class="grid grid-cols-1 gap-4">
                        @forelse ($cpmk->subCpmks as $subCpmk)
                            <div
                                class="group relative p-5 border border-border/50 bg-card rounded-2xl transition-all duration-300 hover:shadow-md hover:border-accent/30 hover:-translate-y-0.5 overflow-hidden">
                                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                                    <div class="flex-1 space-y-2">
                                        <div class="flex items-center gap-2">
                                            <div class="size-2 rounded-full bg-accent group-hover:animate-ping"></div>
                                            <h4 class="font-bold text-foreground">
                                                {{ $subCpmk->code }}
                                            </h4>
                                        </div>
                                        <div
                                            class="prose prose-sm prose-slate max-w-none text-muted-foreground leading-relaxed">
                                            {!! $subCpmk->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 text-center border border-dashed border-border rounded-xl bg-muted/50">
                                <p class="text-sm text-muted-foreground italic">Belum ada rincian Sub-CPMK untuk capaian
                                    ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
