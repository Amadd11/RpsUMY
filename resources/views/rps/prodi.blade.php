@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">


        <!-- Hero Section -->
        <div class="mb-8">
            <h1
                class="text-4xl md:text-5xl font-bold mb-3 font-heading bg-linear-to-r from-primary to-chart-3 bg-clip-text text-transparent">
                Fakultas Ekonomi & Bisnis
            </h1>
            <p class="text-lg text-muted-foreground max-w-3xl">
                Jelajahi program studi di Fakultas Ekonomi & Bisnis yang menawarkan pendidikan berkualitas tinggi di bidang
                ekonomi, manajemen, dan bisnis dengan pendekatan inovatif dan berbasis syariah.
            </p>
        </div>

        <!-- Search Bar -->
        <div class="mb-8">
            <div class="relative">
                <iconify-icon icon="solar:magnifying-glass-bold"
                    class="size-5 text-muted-foreground absolute left-4 top-1/2 -translate-y-1/2"></iconify-icon>
                <input type="text"
                    class="w-full pl-12 pr-4 py-4 rounded-2xl bg-card shadow-lg border border-border focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all duration-300"
                    placeholder="Cari program studi..." />
            </div>
        </div>

        <!-- Programs Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach ($prodis as $prodi)
                <a href="{{ route('rps.prodi.show', $prodi->slug) }}"
                    class="group bg-card rounded-2xl p-6 text-left shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-border overflow-hidden">
                    <div class="mb-4 mx-auto w-32 h-32 flex items-center justify-center">
                        <img src="{{ Storage::url($prodi->logo) }}" alt="{{ $prodi->name }} Logo"
                            class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300 rounded-2xl">
                    </div>
                    <div class="flex-1 min-w-0 mt-4">
                        <h3 class="font-bold text-xl mb-3 group-hover:text-primary transition-colors">{{ $prodi->name }}
                        </h3>
                        <p class="text-sm text-muted-foreground mb-4 leading-relaxed">
                            {!! $prodi->deskripsi !!}
                        </p>
                        <div class="flex items-center gap-2 text-sm text-primary font-semibold">
                            <span>Akses RPS</span>
                            <iconify-icon icon="solar:arrow-right-linear"
                                class="size-4 group-hover:translate-x-1 transition-transform"></iconify-icon>
                        </div>
                    </div>
                </a>
            @endforeach


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
