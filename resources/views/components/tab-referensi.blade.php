<div class="bg-card rounded-3xl p-8 shadow-xl border border-border">
    <h2 class="text-2xl font-bold mb-6 text-foreground">Daftar Pustaka & Referensi</h2>
    <div class="space-y-4">
        @forelse($rps->referensi as $ref)
            <div class="p-4 rounded-2xl bg-muted/50 border-l-4 border-primary">
                <p class="text-muted-foreground italic leading-relaxed">
                    {{ $ref->description ?? 'Tidak ada deskripsi' }}</p>
            </div>
        @empty
            <p class="text-muted-foreground italic">Belum ada referensi yang ditambahkan.</p>
        @endforelse
    </div>
</div>
