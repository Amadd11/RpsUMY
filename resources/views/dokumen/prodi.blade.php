@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 md:py-24">
        <!-- Breadcrumb -->
        <nav class="flex items-center text-sm text-muted-foreground mb-8">
            <a href="{{ route('dokumen.index') }}" class="hover:text-primary transition-colors">
                Dokumen Akademik
            </a>
            <iconify-icon icon="solar:alt-arrow-right-linear" class="size-4 mx-3 text-muted-foreground/50"></iconify-icon>
            <span class="font-semibold text-foreground">{{ $fakultas->name }}</span>
        </nav>

        <!-- Page Header -->
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-heading font-bold text-foreground tracking-tight mb-4">
                {{ $fakultas->name }}
            </h1>
            <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                Pilih program studi di bawah ini untuk melihat dokumen akademik seperti RPS, silabus, dan kurikulum.
            </p>
            <p class="mt-4 text-sm text-muted-foreground">
                <span class="font-bold text-lg text-primary">{{ $prodis->count() }}</span> Program Studi
            </p>
        </div>

        <!-- Prodi Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($prodis as $prodi)
                <a href="{{ route('dokumen.prodi', $prodi->slug) }}"
                    class="group relative bg-card/80 border border-border/50 rounded-3xl p-8 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">

                    <!-- Gradient Overlay Background -->
                    <div
                        class="absolute inset-0 bg-linear-to-br from-primary/5 to-primary/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>

                    <!-- Content -->
                    <div class="relative z-10 text-center">
                        <!-- Icon Prodi (placeholder, bisa diganti logo prodi nanti) -->
                        <div class="mb-6 flex justify-center">
                            <div
                                class="w-24 h-24 bg-primary/10 rounded-2xl flex items-center justify-center group-hover:bg-primary/20 transition-colors duration-300">
                                <iconify-icon icon="solar:book-bold-duotone" class="size-12 text-primary"></iconify-icon>
                            </div>
                        </div>

                        <!-- Nama Prodi -->
                        <h2
                            class="text-2xl font-heading font-bold text-foreground mb-3 group-hover:text-primary transition-colors duration-300">
                            {{ $prodi->name }}
                        </h2>

                        <p class="text-sm text-muted-foreground mb-6">
                            Program Studi
                        </p>

                        <!-- Optional: Jumlah dokumen -->
                        @if (isset($prodi->document_count))
                            <p class="text-sm font-medium text-primary/80">
                                {{ $prodi->document_count }} Dokumen Tersedia
                            </p>
                        @endif

                        <!-- CTA -->
                        <div class="mt-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="inline-flex items-center gap-2 text-sm font-semibold text-primary">
                                Lihat Dokumen
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="size-4"></iconify-icon>
                            </span>
                        </div>
                    </div>

                    <!-- Bottom Accent Line -->
                    <div
                        class="absolute bottom-0 left-0 right-0 h-1 bg-linear-to-r from-primary to-primary/50 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-20">
                    <iconify-icon icon="solar:document-text-bold-duotone"
                        class="size-24 text-muted-foreground/30 mx-auto mb-6"></iconify-icon>
                    <p class="text-xl text-muted-foreground">
                        Belum ada program studi yang tersedia untuk fakultas ini.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
