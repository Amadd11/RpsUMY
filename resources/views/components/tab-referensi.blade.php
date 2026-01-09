@php
    $referensiUtama = $referensi->where('tipe', 'utama');
    $referensiTambahan = $referensi->where('tipe', 'tambahan');
@endphp

<div class="bg-card rounded-3xl p-6 md:p-8 shadow-xl border border-border/50 space-y-8 font-sans">
    <!-- Section Header -->
    <header class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-linear-to-br from-accent to-accent/80 rounded-xl shadow-md">
                <iconify-icon icon="solar:branching-paths-bold" class="size-5 text-accent-foreground"></iconify-icon>
            </div>
            <div>
                <h2 class="text-xl font-bold tracking-tight text-foreground font-heading">
                    Referensi
                </h2>
            </div>
        </div>
    </header>
    <!-- Container Grid Bersebelahan -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">

        <!-- Kolom Kiri: Referensi Utama -->
        <section class="relative space-y-6">
            <div class="flex items-center gap-3">
                <h3
                    class="px-4 py-1.5 bg-indigo-50 text-indigo-700 text-[11px] font-black uppercase tracking-[0.2em] rounded-full border border-indigo-100 shadow-sm">
                    Pustaka Wajib (Utama)
                </h3>
                <span class="h-px flex-1 bg-indigo-100/50"></span>
            </div>

            <div class="space-y-4">
                @forelse($referensiUtama as $index => $ref)
                    <div
                        class="group flex items-start gap-4 p-5 bg-white border border-slate-100 rounded-3xl hover:border-indigo-300 hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-500 hover:-translate-y-1 relative overflow-hidden">

                        <div class="flex-1 pt-1">
                            <div
                                class="prose prose-sm prose-slate max-w-none text-slate-700 leading-relaxed font-medium text-sm">
                                {!! $ref->referensi !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="p-10 text-center bg-slate-50/50 border-2 border-dashed border-slate-200 rounded-[2.5rem]">
                        <iconify-icon icon="solar:ghost-bold" class="size-10 text-slate-300 mb-2"></iconify-icon>
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-widest italic">Belum ada data.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Kolom Kanan: Referensi Tambahan -->
        <section class="relative space-y-6">
            <div class="flex items-center gap-3">
                <h3
                    class="px-4 py-1.5 bg-slate-100 text-slate-600 text-[11px] font-black uppercase tracking-[0.2em] rounded-full border border-slate-200 shadow-sm">
                    Pustaka Pendukung (Tambahan)
                </h3>
                <span class="h-px flex-1 bg-slate-200/50"></span>
            </div>

            <div class="space-y-4">
                @forelse($referensiTambahan as $index => $ref)
                    <div
                        class="group flex items-start gap-4 p-5 bg-slate-50/40 border border-transparent rounded-3xl hover:bg-white hover:border-slate-200 hover:shadow-lg transition-all duration-500">
                        <div class="flex-1 pt-0.5">
                            <div
                                class="prose prose-sm prose-slate max-w-none text-slate-500 leading-relaxed text-sm group-hover:text-slate-700 transition-colors">
                                {!! $ref->referensi !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-10 text-center border-2 border-dashed border-slate-100 rounded-[2.5rem]">
                        <p class="text-xs text-slate-400 font-medium italic">Tidak ada pustaka tambahan.</p>
                    </div>
                @endforelse
            </div>
        </section>

    </div>
    <!-- Catatan Kaki Akademik -->
    <footer class="mt-4 p-5 bg-indigo-50/50 rounded-4xl border border-indigo-100/50 flex items-center gap-4">
        <div class="p-2 bg-indigo-600 rounded-xl shadow-md shrink-0">
            <iconify-icon icon="solar:info-square-bold" class="size-4 text-white"></iconify-icon>
        </div>
        <p class="text-[10px] md:text-[11px] text-indigo-900/60 leading-relaxed font-medium font-sans">
            Referensi di atas disusun berdasarkan standar kurikulum Prodi. Mahasiswa disarankan untuk mengakses
            literatur lengkap melalui <strong>E-Library Universitas Muhammadiyah Yogyakarta</strong> atau perpustakaan
            fisik fakultas.
        </p>
    </footer>
</div>
