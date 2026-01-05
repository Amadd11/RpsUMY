@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <!-- Page Header -->
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-heading font-bold text-foreground tracking-tight mb-4">
                Dokumen Akademik
            </h1>
            <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                Akses seluruh dokumen akademik resmi Universitas Muhammadiyah Yogyakarta, termasuk RPS, silabus, dan
                kurikulum per fakultas.
            </p>
        </div>

        <!-- Fakultas Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($fakultas as $item)
                <a href="{{ route('dokumen.fakultas', $item->slug) }}"
                    class="group relative bg-card/80 border border-border/50 rounded-3xl p-8 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">

                    <!-- Gradient Overlay Background -->
                    <div
                        class="absolute inset-0 bg-linear-to-br from-primary/5 to-primary/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>

                    <!-- Content -->
                    <div class="relative z-10">
                        <!-- Fakultas Icon Placeholder (bisa diganti dengan logo fakultas nanti) -->
                        <div class="mb-6 flex justify-center">
                            <div class="mb-4 mx-auto w-32 h-32 flex items-center justify-center">
                                <img src="{{ Storage::url($item->logo) }}" alt="{{ $item->name }} Logo"
                                    class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300 rounded-2xl">
                            </div>
                        </div>

                        <!-- Nama Fakultas -->
                        <h2
                            class="text-2xl font-heading font-bold text-foreground text-center mb-3 group-hover:text-primary transition-colors duration-300">
                            {{ $item->name }}
                        </h2>

                        <!-- Jumlah Prodi -->
                        <p class="text-center text-muted-foreground text-sm mb-6">
                            <span class="font-bold text-lg text-primary">{{ $item->prodi_count }}</span> Program Studi
                        </p>

                        <!-- Call to Action -->
                        <div class="text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="inline-flex items-center gap-2 text-sm font-semibold text-primary">
                                Lihat Dokumen
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="size-4"></iconify-icon>
                            </span>
                        </div>
                    </div>

                    <!-- Bottom Accent Line -->
                    <div
                        class="absolute bottom-0 left-0 right-0 h-1 bg-linear-to-r from-primary to-primary/50 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500">
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Empty State (jika tidak ada fakultas) -->
        @if ($fakultas->isEmpty())
            <div class="text-center py-20">
                <iconify-icon icon="solar:document-text-bold-duotone"
                    class="size-24 text-muted-foreground/30 mx-auto mb-6"></iconify-icon>
                <p class="text-xl text-muted-foreground">Belum ada dokumen fakultas yang tersedia saat ini.</p>
            </div>
        @endif
    </div>
@endsection
