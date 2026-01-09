@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-32 ">
        <!-- Hero Section -->
        <div class="mb-8">
            <h1
                class="text-4xl md:text-5xl font-bold mb-3 font-heading bg-linear-to-r from-primary to-chart-3 bg-clip-text pb-2 text-transparent">
                Program Studi di {{ $fakultas->name }} </h1>
            <p class="text-lg text-muted-foreground max-w-3xl">
                Jelajahi program studi di {{ $fakultas->name }} yang menawarkan pendidikan berkualitas tinggi di bidang
                ekonomi, manajemen, dan bisnis dengan pendekatan inovatif dan berbasis syariah.
            </p>
        </div>

        <!-- Programs Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($prodis as $prodi)
                <a href="{{ route('rps.prodi.show', $prodi->slug) }}"
                    class="group relative bg-card/80 border border-border/50 rounded-3xl p-6 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 text-center flex flex-col justify-between">

                    <!-- Gradient Overlay Background -->
                    <div
                        class="absolute inset-0 bg-linear-to-br from-primary/5 to-primary/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>

                    <!-- Content -->
                    <div class="relative z-10">
                        <!-- Logo Prodi -->
                        <div class="mb-6 mx-auto w-28 h-28 flex items-center justify-center">
                            <img src="{{ Storage::url($prodi->logo) }}" alt="{{ $prodi->name }} Logo"
                                class="w-full h-full object-contain rounded-2xl group-hover:scale-105 transition-transform duration-500 shadow-md">
                        </div>

                        <!-- Nama Prodi (Tengah) -->
                        <h3
                            class="text-xl font-heading font-bold text-foreground mb-4 group-hover:text-primary transition-colors duration-300">
                            {{ $prodi->name }}
                        </h3>

                        <!-- Deskripsi: Full, rata kiri -->
                        <div class="text-sm text-muted-foreground mb-8 leading-relaxed text-left">
                            {!! $prodi->deskripsi !!}
                        </div>
                    </div>

                    <!-- CTA: Selalu di bagian paling bawah -->
                    <div class="relative z-10 mt-auto">
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="inline-flex items-center gap-2 text-sm font-semibold text-primary">
                                Akses RPS
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="size-4"></iconify-icon>
                            </span>
                        </div>
                    </div>

                    <!-- Bottom Accent Line -->
                    <div
                        class="absolute bottom-0 left-0 right-0 h-1 bg-linear-to-r from-primary to-primary/50 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
                    </div>
                </a>
            @endforeach

            <!-- Empty State -->
            @if ($prodis->isEmpty())
                <div class="col-span-full text-center py-20">
                    <iconify-icon icon="solar:book-bold-duotone"
                        class="size-32 text-muted-foreground/20 mx-auto mb-8"></iconify-icon>
                    <h3 class="text-2xl font-heading font-semibold text-muted-foreground mb-4">
                        Belum Ada Program Studi
                    </h3>
                    <p class="text-lg text-muted-foreground max-w-md mx-auto">
                        Data program studi akan segera ditambahkan.
                    </p>
                </div>
            @endif
        </div>
    </div>

    <!-- Help Section -->
    <div class="bg-linear-to-br from-secondary to-secondary/50 rounded-2xl p-8 mb-8">
        <div class="flex items-start gap-4">
            <div class="bg-primary rounded-2xl p-4 shrink-0 ">
                <iconify-icon icon="solar:help-bold" class="size-8 text-primary-foreground"></iconify-icon>
            </div>
            <div class="flex-1">
                <h3 class="text-2xl font-bold mb-3 text-foreground">Butuh Bantuan?</h3>
                <p class="text-muted-foreground mb-4 leading-relaxed">
                    Jika Anda memerlukan panduan lebih lanjut tentang program studi atau akses RPS, hubungi tim fakultas
                    kami.
                </p>
                <a href="#"
                    class="inline-flex items-center gap-2 text-lg font-semibold text-primary hover:text-accent transition-colors">
                    <span>Hubungi Dukungan Fakultas</span>
                    <iconify-icon icon="solar:arrow-right-linear" class="size-5"></iconify-icon>
                </a>
            </div>
        </div>
    </div>
    </div>
@endsection
