@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-background font-sans selection:bg-primary/10 selection:text-primary">

        <!-- Decorative Background Blobs -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
            <div class="absolute top-[20%] -left-[10%] w-[40%] h-[40%] bg-primary/5 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[10%] -right-[5%] w-[30%] h-[30%] bg-accent/5 rounded-full blur-[100px]"></div>
        </div>

        <!-- 1. About RPS & Platform Section -->
        <section class="relative py-24 z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center mb-24">
                    <!-- Left: Text Content -->
                    <div class="lg:col-span-7 space-y-8">
                        <div>
                            <span
                                class="inline-block px-4 py-1.5 mb-4 text-[10px] font-black uppercase tracking-[0.2em] bg-primary/10 text-primary rounded-full border border-primary/20">
                                Mengenal Ekosistem Kami
                            </span>
                            <h2 class="text-4xl md:text-5xl font-black text-slate-900 leading-tight font-heading mb-6">
                                Apa itu <span class="text-primary italic">Sistem RPS Digital?</span>
                            </h2>
                            <p class="text-lg text-slate-600 leading-relaxed font-medium">
                                Sistem RPS Digital Universitas Muhammadiyah Yogyakarta adalah platform integrasi kurikulum
                                yang dirancang untuk menjembatani transparansi akademik antara program studi, dosen, dan
                                mahasiswa.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <div class="size-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                                    <iconify-icon icon="solar:globus-bold" class="size-6"></iconify-icon>
                                </div>
                                <h4 class="font-bold text-slate-900 font-heading">Sentralisasi Data</h4>
                                <p class="text-sm text-slate-500 leading-relaxed">Seluruh dokumen kurikulum tersimpan aman
                                    dalam satu gerbang akses untuk memastikan validitas data akademik.</p>
                            </div>
                            <div class="space-y-3">
                                <div class="size-10 bg-accent/10 rounded-xl flex items-center justify-center text-accent">
                                    <iconify-icon icon="solar:transmission-bold" class="size-6"></iconify-icon>
                                </div>
                                <h4 class="font-bold text-slate-900 font-heading">Standarisasi OBE</h4>
                                <p class="text-sm text-slate-500 leading-relaxed">Mendukung penuh kurikulum <i>Outcome Based
                                        Education</i> (OBE) melalui pemetaan CPL dan CPMK yang presisi.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Definition Card (Visual Depth) -->
                    <div class="lg:col-span-5 relative group">
                        <div
                            class="absolute inset-0 bg-primary/10 rounded-[3rem] blur-2xl group-hover:bg-primary/20 transition-all">
                        </div>
                        <div
                            class="relative bg-white border border-slate-200 rounded-[3rem] p-10 shadow-2xl overflow-hidden transition-transform duration-500 group-hover:-translate-y-2">
                            <div class="absolute -right-8 -bottom-8 size-40 bg-accent/5 rounded-full blur-3xl"></div>
                            <iconify-icon icon="solar:book-bookmark-bold-duotone"
                                class="size-16 text-primary mb-6"></iconify-icon>
                            <h3 class="text-2xl font-black text-slate-900 mb-4 font-heading">Memahami RPS</h3>
                            <div class="space-y-4 text-slate-600">
                                <p class="text-sm leading-relaxed">
                                    <b>Rencana Pembelajaran Semester (RPS)</b> adalah dokumen perencanaan pembelajaran yang
                                    disusun sebagai panduan bagi mahasiswa dalam melaksanakan kegiatan perkuliahan selama
                                    satu semester.
                                </p>
                                <p class="text-sm leading-relaxed">
                                    RPS bukan sekadar jadwal, melainkan <b>kontrak belajar</b> yang memuat capaian
                                    pembelajaran, metode evaluasi, hingga rincian materi mingguan yang terukur.
                                </p>
                            </div>
                            <div class="mt-8 pt-8 border-t border-slate-100 flex items-center gap-4">
                                <div class="size-12 rounded-full bg-slate-100 flex items-center justify-center">
                                    <iconify-icon icon="solar:shield-user-bold"
                                        class="text-slate-400 size-6"></iconify-icon>
                                </div>
                                <div>
                                    <div class="text-xs font-black text-slate-900 uppercase">Terverifikasi Mutu</div>
                                    <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Lembaga
                                        Penjaminan Mutu UMY</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bento Style Secondary Info -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-slate-900 rounded-[2.5rem] p-8 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:scale-110 transition-transform">
                            <iconify-icon icon="solar:medal-star-bold" class="size-20 text-white"></iconify-icon>
                        </div>
                        <div class="relative z-10">
                            <h4 class="text-xl font-bold text-white mb-3 font-heading">Transparansi Capaian</h4>
                            <p class="text-slate-400 text-sm leading-relaxed italic">Memastikan mahasiswa mengetahui target
                                kompetensi (CPL) yang akan dicapai sejak hari pertama perkuliahan.</p>
                        </div>
                    </div>
                    <div class="bg-primary rounded-[2.5rem] p-8 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:scale-110 transition-transform">
                            <iconify-icon icon="solar:users-group-rounded-bold" class="size-20 text-white"></iconify-icon>
                        </div>
                        <div class="relative z-10">
                            <h4 class="text-xl font-bold text-white mb-3 font-heading">Kolaborasi Dosen</h4>
                            <p class="text-primary-foreground/70 text-sm leading-relaxed italic">Memudahkan tim teaching
                                dalam melakukan sinkronisasi materi dan metode penilaian secara kolektif.</p>
                        </div>
                    </div>
                    <div class="bg-accent rounded-[2.5rem] p-8 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 p-8 opacity-20 group-hover:scale-110 transition-transform">
                            <iconify-icon icon="solar:magic-stick-3-bold" class="size-20 text-slate-900"></iconify-icon>
                        </div>
                        <div class="relative z-10">
                            <h4 class="text-xl font-bold text-slate-900 mb-3 font-heading">Efisiensi Administrasi</h4>
                            <p class="text-slate-900/60 text-sm leading-relaxed italic">Digitalisasi penuh yang
                                mengeliminasi kerumitan pengelolaan dokumen fisik di tingkat Program Studi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 2. How It Works Section (Modern Stepper) -->
        <section class="relative py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="text-center mb-20">
                    <h2 class="text-4xl font-black text-slate-900 mb-4 font-heading tracking-tight">
                        Alur Akses yang <span class="text-primary italic">Sederhana</span>
                    </h2>
                    <p class="text-slate-500 max-w-xl mx-auto">
                        Dirancang untuk efisiensi maksimal bagi Dosen, Mahasiswa, dan Admin Program Studi.
                    </p>
                </div>

                <div class="relative grid grid-cols-1 md:grid-cols-3 gap-12">
                    <!-- Connecting Line (Desktop) -->
                    <div
                        class="hidden md:block absolute top-12 left-[15%] right-[15%] h-0.5 border-t-2 border-dashed border-slate-200 z-0">
                    </div>

                    <!-- Step 1 -->
                    <div class="relative z-10 flex flex-col items-center text-center group">
                        <div
                            class="size-20 bg-white border-4 border-slate-50 shadow-xl rounded-3xl flex items-center justify-center mb-8 group-hover:bg-primary group-hover:border-primary/20 transition-all duration-500">
                            <iconify-icon icon="solar:minimalistic-magnifer-bold"
                                class="size-8 text-primary group-hover:text-white transition-colors"></iconify-icon>
                        </div>
                        <div
                            class="size-8 bg-slate-900 text-white rounded-full flex items-center justify-center text-xs font-black mb-4 ring-8 ring-white">
                            1</div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2 font-heading">Eksplorasi Prodi</h3>
                        <p class="text-slate-500 text-sm leading-relaxed px-4">Pilih Fakultas dan Program Studi Anda melalui
                            katalog digital yang intuitif.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative z-10 flex flex-col items-center text-center group">
                        <div
                            class="size-20 bg-white border-4 border-slate-50 shadow-xl rounded-3xl flex items-center justify-center mb-8 group-hover:bg-accent group-hover:border-accent/20 transition-all duration-500">
                            <iconify-icon icon="solar:filter-bold"
                                class="size-8 text-accent group-hover:text-slate-900 transition-colors"></iconify-icon>
                        </div>
                        <div
                            class="size-8 bg-slate-900 text-white rounded-full flex items-center justify-center text-xs font-black mb-4 ring-8 ring-white">
                            2</div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2 font-heading">Pilih Mata Kuliah</h3>
                        <p class="text-slate-500 text-sm leading-relaxed px-4">Dapatkan rincian dokumen yang
                            spesifik dan akurat.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative z-10 flex flex-col items-center text-center group">
                        <div
                            class="size-20 bg-white border-4 border-slate-50 shadow-xl rounded-3xl flex items-center justify-center mb-8 group-hover:bg-chart-3 group-hover:border-chart-3/20 transition-all duration-500">
                            <iconify-icon icon="solar:file-download-bold"
                                class="size-8 text-chart-3 group-hover:text-white transition-colors"></iconify-icon>
                        </div>
                        <div
                            class="size-8 bg-slate-900 text-white rounded-full flex items-center justify-center text-xs font-black mb-4 ring-8 ring-white">
                            3</div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2 font-heading">Akses & Unduh</h3>
                        <p class="text-slate-500 text-sm leading-relaxed px-4">Lihat visualisasi CPL atau unduh RPS dalam
                            format PDF standar akademik.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- <!-- CTA Section (Final Lifecycle) -->
        <section class="py-20 px-4">
            <div
                class="max-w-5xl mx-auto bg-primary rounded-[3rem] p-8 md:p-16 text-center relative overflow-hidden shadow-3xl shadow-primary/20">
                <!-- Decorative Circle -->
                <div class="absolute -top-24 -right-24 size-64 bg-white/5 rounded-full blur-3xl"></div>

                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-black text-white mb-6 font-heading">Siap Memulai Perkuliahan?</h2>
                    <p class="text-white/70 max-w-xl mx-auto mb-10 text-lg">
                        Dapatkan panduan belajar terlengkap dan terstandarisasi untuk mendukung perjalanan akademik Anda di
                        UMY.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('rps.fakultas') }}"
                            class="w-full sm:w-auto px-10 py-4 bg-accent text-slate-900 font-black rounded-2xl hover:scale-105 transition-all shadow-xl shadow-accent/20">
                            Jelajahi Sekarang
                        </a>
                        <a href="#"
                            class="w-full sm:w-auto px-10 py-4 bg-white/10 text-white font-bold rounded-2xl backdrop-blur-md border border-white/20 hover:bg-white/20 transition-all">
                            Kontak Admin
                        </a>
                    </div>
                </div>
            </div>
        </section> --}}

    </div>
@endsection
