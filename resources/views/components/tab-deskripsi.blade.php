<div class="bg-card rounded-3xl p-6 md:p-8 shadow-xl border border-border/50 space-y-8">
    <!-- Header: Deskripsi -->
    <div class="flex items-center gap-3">
        <div class="p-2 bg-linear-to-br from-primary to-primary/80 rounded-xl shadow-md">
            <iconify-icon icon="solar:book-open-bold" class="size-5 text-primary-foreground"></iconify-icon>
        </div>
        <h2 class="text-xl font-bold tracking-tight text-foreground">
            Deskripsi Mata Kuliah
        </h2>
    </div>

    <!-- Informasi Umum Grid -->
    <div class="space-y-4">
        <h4 class="text-lg font-bold tracking-tight text-foreground">
            Informasi Umum
        </h4>

        <div class="grid gap-6 p-6 bg-muted/50 border border-muted/50 rounded-2xl md:grid-cols-3">
            <!-- Penanggung Jawab -->
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-sm font-medium text-muted-foreground">
                    <iconify-icon icon="solar:user-bold" class="size-4 text-muted"></iconify-icon>
                    Penanggung Jawab
                </div>
                <p class="font-bold text-foreground leading-tight">
                    {{ $rps->dosen->name ?? $rps->penanggung_jawab }}
                </p>
            </div>

            <!-- Tahun Ajaran -->
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-sm font-medium text-muted-foreground">
                    <iconify-icon icon="solar:calendar-bold" class="size-4 text-muted"></iconify-icon>
                    Tahun Ajaran
                </div>
                <p class="font-bold text-foreground">
                    {{ $rps->tahun_ajaran }}
                </p>
            </div>

            <!-- Tanggal Penyusunan -->
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-sm font-medium text-muted-foreground">
                    <iconify-icon icon="solar:clock-circle-bold" class="size-4 text-muted"></iconify-icon>
                    Tanggal Penyusunan
                </div>
                <p class="font-bold text-foreground">
                    {{ \Carbon\Carbon::parse($rps->tgl_penyusunan)->format('d F Y') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Konten Deskripsi -->
    <div class="space-y-4">
        <h4 class="text-lg font-bold tracking-tight text-foreground">
            Detail Deskripsi
        </h4>
        <div class="p-6 bg-card border border-border/50 rounded-2xl shadow-sm">
            @if ($rps->deskripsi)
                <div class="leading-relaxed prose prose-sm prose-primary text-foreground max-w-none">
                    {!! $rps->deskripsi !!}
                </div>
            @else
                <p class="italic text-muted-foreground text-sm text-center py-4">
                    Belum ada deskripsi mata kuliah yang ditambahkan.
                </p>
            @endif
        </div>
    </div>

    <!-- Materi Pembelajaran Section -->
    <div class="space-y-4">
        <div class="flex items-center gap-3">
            <h4 class="text-lg font-bold tracking-tight text-foreground">
                Materi Pembelajaran
            </h4>
        </div>
        <div class="p-6 bg-card border border-border/50 rounded-2xl shadow-sm">
            @if ($rps->materi_pembelajaran)
                <div class="leading-relaxed prose prose-sm prose-secondary text-foreground max-w-none">
                    {!! $rps->materi_pembelajaran !!}
                </div>
            @else
                <p class="italic text-muted-foreground text-sm text-center py-4">
                    Belum ada materi pembelajaran yang ditambahkan.
                </p>
            @endif
        </div>
    </div>

    <!-- Download Section (Opsional jika ada file PDF) -->
    @if ($rps->file_pdf)
        <div class="flex justify-center pt-4">
            <a href="{{ asset(Storage::url($rps->file_pdf)) }}" target="_blank" rel="noopener noreferrer"
                class="inline-flex items-center gap-2 px-8 py-3 font-bold text-primary-foreground transition-all duration-300 transform shadow-xl bg-linear-to-r from-primary to-primary/80 rounded-2xl hover:from-accent hover:to-accent/80 hover:scale-105 active:scale-95 border border-primary/20">
                <iconify-icon icon="solar:download-bold" class="size-5"></iconify-icon>
                Unduh Dokumen RPS (PDF)
            </a>
        </div>
    @endif
</div>
