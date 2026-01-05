@extends('layouts.app')

@section('content')
    <section class="min-h-screen flex items-center overflow-hidden bg-[#0A0F1E] text-white px-4 py-32 relative">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 z-0">
            <!-- Blobs -->
            <div
                class="absolute -top-[10%] -left-[10%] w-[50%] h-[50%] bg-primary/20 rounded-full blur-[120px] animate-blob">
            </div>
            <div
                class="absolute top-[20%] -right-[10%] w-[40%] h-[40%] bg-chart-3/20 rounded-full blur-[100px] animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute -bottom-[10%] left-[20%] w-[30%] h-[30%] bg-accent/20 rounded-full blur-[80px] animate-blob animation-delay-4000">
            </div>

            <!-- Grid Pattern -->
            <div
                class="absolute inset-0 bg-[url('https://play.tailwindcss.com/img/grid.svg')] bg-center mask-[linear-linear(180deg,white,rgba(255,255,255,0))] opacity-20">
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto w-full">
            <div class="grid lg:grid-cols-2 gap-12 items-center">

                <!-- Left Content: Text -->
                <div class="text-left space-y-8 animate-fade-in-up">
                    <div>
                        <span
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-accent text-sm font-bold tracking-wide mb-6">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-accent"></span>
                            </span>
                            UMY Digital Ecosystem
                        </span>
                        <h1 class="text-5xl md:text-7xl font-black leading-[1.1] tracking-tight mb-6">
                            Transformasi <br>
                            <span
                                class="bg-linear-to-r from-primary via-accent to-chart-3 bg-clip-text text-transparent animate-linear">Pembelajaran</span>
                        </h1>
                        <p class="text-lg md:text-xl text-slate-400 max-w-xl leading-relaxed">
                            Platform cerdas untuk manajemen <span class="text-white font-medium">Rencana Pembelajaran
                                Semester</span> yang terintegrasi, transparan, dan akuntabel di seluruh lingkungan
                            Universitas Muhammadiyah Yogyakarta.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-4">
                        <button
                            class="group relative px-8 py-4 bg-primary text-primary-foreground rounded-2xl font-bold shadow-2xl shadow-primary/30 transition-all duration-300 hover:scale-105 active:scale-95 overflow-hidden">
                            <div
                                class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            </div>

                            <span class="relative flex items-center justify-center gap-3">
                                Mulai Jelajahi
                            </span>
                        </button>

                        <button
                            class="group relative px-8 py-4 bg-accent text-primary-foreground rounded-2xl font-bold shadow-2xl shadow-primary/30 transition-all duration-300 hover:scale-105 active:scale-95 overflow-hidden">
                            <div
                                class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            </div>

                            <span class="relative flex items-center justify-center gap-3">
                                Tentang Website
                            </span>
                        </button>
                    </div>

                    <!-- Stats/Trust Badges -->
                    <div class="pt-8 flex items-center gap-8 border-t border-white/10">
                        <div>
                            <div class="text-2xl font-bold text-white">40+</div>
                            <div class="text-xs text-slate-500 uppercase tracking-widest font-bold">Prodi Terdaftar</div>
                        </div>
                        <div class="w-px h-8 bg-white/10"></div>
                        <div>
                            <div class="text-2xl font-bold text-white">100%</div>
                            <div class="text-xs text-slate-500 uppercase tracking-widest font-bold">Terintegrasi</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content: Decorative Elements/Cards -->
                <div class="relative hidden lg:block animate-float">
                    <div
                        class="relative z-10 bg-linear-to-br from-white/10 to-white/5 border border-white/20 rounded-[2.5rem] p-8 shadow-3xl">
                        <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=1000&auto=format&fit=crop"
                            alt="Dashboard Preview" class="rounded-2xl shadow-2xl mb-6 opacity-80 border border-white/10">

                        <div class="grid grid-cols-2 gap-4 text-left">
                            <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                                <iconify-icon icon="solar:chart-square-bold" class="text-accent size-8 mb-2"></iconify-icon>
                                <div class="text-sm font-bold text-white">CPL Terukur</div>
                                <div class="text-[10px] text-slate-400">Analisis capaian otomatis</div>
                            </div>
                            <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                                <iconify-icon icon="solar:shield-check-bold"
                                    class="text-primary size-8 mb-2"></iconify-icon>
                                <div class="text-sm font-bold text-white">Validasi Kaprodi</div>
                                <div class="text-[10px] text-slate-400">Verifikasi standar mutu</div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Badges -->
                    <div class="absolute -top-6 -right-6 bg-accent p-4 rounded-2xl shadow-xl animate-bounce-slow z-20">
                        <iconify-icon icon="solar:star-bold" class="text-white size-6"></iconify-icon>
                    </div>
                    <div class="absolute -bottom-6 -left-6 bg-primary p-4 rounded-2xl shadow-xl animate-bounce-slow z-20">
                        <iconify-icon icon="solar:rocket-bold" class="text-white size-6"></iconify-icon>
                    </div>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 opacity-50">
                <div class="w-px h-12 bg-linear-to-b from-white to-transparent"></div>
            </div>
    </section>

    <section class="px-4 py-12 max-w-7xl mx-auto">
        <div class="bg-card rounded-2xl p-6 shadow-sm">
            <h2 class="text-2xl font-bold mb-4 font-heading">Apa itu RPS?</h2>
            <p class="text-muted-foreground mb-4">
                Rencana Pembelajaran Semester (RPS) adalah dokumen program pembelajaran yang dirancang
                untuk mengorganisasikan proses pembelajaran dalam satu semester. RPS memuat identitas
                mata kuliah, capaian pembelajaran, bahan kajian, metode pembelajaran, dan kriteria
                penilaian.
            </p>
            <p class="text-muted-foreground mb-4">
                Melalui sistem digital ini, mahasiswa, dosen, dan stakeholder dapat mengakses RPS dengan
                mudah untuk memahami struktur dan target pembelajaran setiap mata kuliah di Universitas
                Muhammadiyah Yogyakarta.
            </p>
            <div class="flex items-center gap-2 text-primary font-semibold">
                <span>Pelajari lebih lanjut</span>
                <iconify-icon icon="solar:arrow-right-linear" class="size-5"></iconify-icon>
            </div>
        </div>
    </section>

    <section class="px-4 py-20 max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2
                class="text-3xl md:text-5xl pb-2 font-extrabold mb-4 font-heading bg-linear-to-r from-foreground via-primary to-foreground bg-clip-text text-transparent">
                Fitur Unggulan Sistem RPS
            </h2>
            <p class="text-lg text-muted-foreground max-w-2xl mx-auto leading-relaxed">
                Nikmati ekosistem manajemen RPS yang cerdas, cepat, dan terintegrasi untuk mendukung standar akademik
                tertinggi.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Fitur 1 --}}
            <div
                class="group bg-card rounded-3xl p-8 shadow-sm hover:shadow-2xl transition-all duration-500 border border-border hover:border-primary/20 hover:-translate-y-2">
                <div
                    class="bg-secondary rounded-2xl p-4 mb-6 w-fit mx-auto group-hover:bg-primary transition-colors duration-500">
                    <iconify-icon icon="solar:document-add-bold-duotone"
                        class="size-9 text-primary group-hover:text-primary-foreground transition-colors"></iconify-icon>
                </div>
                <h3 class="text-xl font-bold mb-3 text-foreground">Akses Digital RPS</h3>
                <p class="text-muted-foreground text-sm leading-relaxed">
                    Penyimpanan dokumen terpusat yang memudahkan dosen dan mahasiswa mengakses kurikulum kapan saja.
                </p>
            </div>

            {{-- Fitur 2 --}}
            <div
                class="group bg-card rounded-3xl p-8 shadow-sm hover:shadow-2xl transition-all duration-500 border border-border hover:border-accent/20 hover:-translate-y-2">
                <div
                    class="bg-accent/10 rounded-2xl p-4 mb-6 w-fit mx-auto group-hover:bg-accent transition-colors duration-500">
                    <iconify-icon icon="solar:minimalistic-magnifer-zoom-in-bold-duotone"
                        class="size-9 text-accent group-hover:text-accent-foreground transition-colors"></iconify-icon>
                </div>
                <h3 class="text-xl font-bold mb-3 text-foreground">Pencarian Cerdas</h3>
                <p class="text-muted-foreground text-sm leading-relaxed">
                    Temukan mata kuliah secara instan dengan filter semester, prodi, maupun kode mata kuliah yang akurat.
                </p>
            </div>

            {{-- Fitur 3 --}}
            <div
                class="group bg-card rounded-3xl p-8 shadow-sm hover:shadow-2xl transition-all duration-500 border border-border hover:border-secondary/20 hover:-translate-y-2">
                <div
                    class="bg-secondary rounded-2xl p-4 mb-6 w-fit mx-auto group-hover:bg-secondary-foreground transition-colors duration-500">
                    <iconify-icon icon="solar:restart-bold-duotone"
                        class="size-9 text-secondary-foreground group-hover:text-secondary transition-colors"></iconify-icon>
                </div>
                <h3 class="text-xl font-bold mb-3 text-foreground">Sinkronisasi Real-time</h3>
                <p class="text-muted-foreground text-sm leading-relaxed">
                    Setiap perubahan data oleh Admin Prodi langsung terupdate secara otomatis di seluruh sistem.
                </p>
            </div>

            {{-- Fitur 4 --}}
            <div
                class="group bg-card rounded-3xl p-8 shadow-sm hover:shadow-2xl transition-all duration-500 border border-border hover:border-muted/20 hover:-translate-y-2">
                <div
                    class="bg-muted rounded-2xl p-4 mb-6 w-fit mx-auto group-hover:bg-muted-foreground transition-colors duration-500">
                    <iconify-icon icon="solar:verified-check-bold-duotone"
                        class="size-9 text-muted-foreground group-hover:text-muted transition-colors"></iconify-icon>
                </div>
                <h3 class="text-xl font-bold mb-3 text-foreground">Standar Mutu</h3>
                <p class="text-muted-foreground text-sm leading-relaxed">
                    Struktur penulisan RPS yang sudah disesuaikan dengan standar akreditasi nasional dan internasional.
                </p>
            </div>
        </div>
    </section>

    {{-- SECTION: JELAJAHI FAKULTAS --}}
    <section class="bg-secondary/50 px-4 py-24 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-linear-to-r from-transparent via-primary/20 to-transparent"></div>
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-black mb-4 font-heading text-secondary-foreground tracking-tight">
                    Jelajahi RPS per Fakultas
                </h2>
                <p class="text-lg text-muted-foreground max-w-xl mx-auto">
                    Klik pada fakultas untuk melihat daftar Program Studi dan dokumen RPS yang tersedia.
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($fakultas as $item)
                    <a href="{{ route('rps.prodi', $item->slug) }}"
                        class="group relative bg-card rounded-3xl p-8 shadow-sm hover:shadow-xl transition-all duration-500 border border-border hover:border-primary/30 hover:-translate-y-2 flex flex-col">

                        {{-- Logo --}}
                        <div class="mb-4 mx-auto w-32 h-32 flex items-center justify-center">
                            <img src="{{ Storage::url($item->logo) }}" alt="{{ $item->name }} Logo"
                                class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300 rounded-2xl">
                        </div>
                        {{-- Title --}}
                        <h3 class="font-bold text-xl mb-3 text-foreground text-center">
                            {{ $item->name }}
                        </h3>

                        {{-- Description --}}
                        <div class="mb-6 grow text-sm text-muted-foreground">
                            <div class="prose prose-sm max-w-none prose-p:my-2 prose-ul:my-2 prose-li:my-0">
                                {!! $item->deskripsi !!}
                            </div>
                        </div>

                        {{-- Footer --}}
                        <div class="flex items-center justify-between text-sm text-primary font-bold mt-auto">
                            <span class="px-3 py-1 bg-primary/10 rounded-full">
                                {{ $item->prodi_count ?? $item->prodis->count() }} Prodi
                            </span>

                            <iconify-icon icon="solar:arrow-right-up-linear"
                                class="size-5 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform">
                            </iconify-icon>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection

<style>
    @keyframes blob {
        0% {
            transform: translate(0px, 0px) scale(1);
        }

        33% {
            transform: translate(30px, -50px) scale(1.1);
        }

        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }

        100% {
            transform: translate(0px, 0px) scale(1);
        }
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }

    .animation-delay-4000 {
        animation-delay: 4s;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes linear {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .animate-linear {
        background-size: 200% 200%;
        animation: linear 8s linear infinite;
    }

    .animate-bounce-slow {
        animation: bounce 3s infinite;
    }

    .animate-fade-in-up {
        animation: fadeInUp 1s ease-out forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
