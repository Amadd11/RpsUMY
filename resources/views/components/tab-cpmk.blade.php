<div class="bg-card rounded-3xl p-6 md:p-8 shadow-xl border border-border/50 space-y-8">
    <div class="flex items-center gap-3">
        <div class="p-2 bg-linear-to-br from-primary to-primary/80 rounded-xl shadow-md">
            <iconify-icon icon="solar:list-check-bold" class="size-5 text-primary-foreground"></iconify-icon>
        </div>
        <h2 class="text-xl font-bold tracking-tight text-foreground">
            Capaian Pembelajaran Mata Kuliah (CPMK)
        </h2>
    </div>
    <div class="p-6 border border-primary/20 rounded-2xl bg-linear-to-r from-primary/5 to-transparent">
        <div class="flex items-start gap-3">
            <iconify-icon icon="solar:info-circle-bold" class="size-5 text-primary mt-0.5"></iconify-icon>
            <div>
                <h3 class="font-semibold text-primary">
                    Pemetaan CPMK terhadap CPL
                </h3>
                <p class="mt-1 text-sm text-muted-foreground leading-relaxed">
                    CPMK merupakan penjabaran dari CPL yang dibebankan pada mata kuliah ini.
                    Tampilan bersifat <span class="font-bold text-primary">read-only</span>.
                </p>
            </div>
        </div>
    </div>

    @if (!$rps || $groupedCpmks->isEmpty())
        <div class="flex flex-col items-center justify-center py-14 text-center">
            <div class="p-4 mb-4 bg-muted rounded-full">
                <iconify-icon icon="solar:book-open-bold" class="size-8 text-muted-foreground"></iconify-icon>
            </div>
            <h3 class="mb-2 text-lg font-semibold text-foreground">
                Belum Ada CPMK
            </h3>
            <p class="max-w-md text-muted-foreground text-sm">
                CPMK belum dipetakan pada mata kuliah ini.
                Silakan hubungi Admin Prodi apabila terjadi ketidaksesuaian data.
            </p>
        </div>
    @else
        <div class="space-y-6">

            @foreach ($groupedCpmks as $item)
                @php
                    $cpl = $item['cpl'];
                    $cpmks = $item['cpmks'];
                @endphp
                <div
                    class="transition-all duration-300 border border-border/50 shadow-sm bg-linear-to-r from-muted/20 to-transparent rounded-2xl hover:shadow-md hover:border-primary/30">
                    <div class="p-5 space-y-4">
                        <div class="flex items-center justify-between border-b border-border/30 pb-4">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-foreground">
                                    CPMK dari {{ $cpl->code }}
                                </span>
                                <span
                                    class="px-3 py-1 text-xs font-bold bg-primary/10 text-primary rounded-full border border-primary/20">
                                    {{ $cpmks->count() }} CPMK
                                </span>
                            </div>
                        </div>

                        <div class="space-y-4">
                            @foreach ($cpmks as $cpmk)
                                <div
                                    class="p-4 border-l-4 border-primary/50 bg-card rounded-r-xl transition-all duration-200 hover:bg-primary/5 border border-border/30">

                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="font-bold text-foreground flex items-center gap-2">
                                            <iconify-icon icon="solar:check-circle-bold" class="text-primary size-4" />
                                            {{ $cpmk->code }}
                                        </h4>

                                        @if (!is_null($cpmk->bobot))
                                            <span
                                                class="text-xs font-bold bg-secondary/10 text-secondary-foreground px-2 py-1 rounded-md border border-secondary/20">
                                                Bobot {{ number_format($cpmk->bobot, 1) }}%
                                            </span>
                                        @endif
                                    </div>

                                    <div
                                        class="prose prose-sm prose-primary max-w-none text-muted-foreground leading-relaxed">
                                        {!! $cpmk->description !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
