<footer class="relative mt-24 border-t border-border/40 bg-white/70 font-sans overflow-hidden">
    <!-- Decorative Background Elements -->
    <div
        class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 size-96 bg-primary/5 rounded-full blur-[120px] pointer-events-none">
    </div>
    <div
        class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 size-64 bg-accent/5 rounded-full blur-[100px] pointer-events-none">
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 pt-20 pb-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-16 mb-20">

            <!-- Column 1: Identity (5 Cols) -->
            <div class="lg:col-span-5 space-y-8">
                <div class="flex items-center gap-5">
                    <div class="relative group">
                        <div
                            class="absolute -inset-2 bg-primary/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition duration-500">
                        </div>
                        <img alt="UMY Logo" src="{{ asset('assets/images/logo/logo.png') }}"
                            class="relative h-16 w-16 object-contain drop-shadow-xl"
                            onerror="this.src='https://ggrhecslgdflloszjkwl.supabase.co/storage/v1/object/public/generation-assets/placeholder/square.png'" />
                    </div>
                    <div>
                        <div
                            class="font-black text-xl text-slate-900 leading-[1.1] font-heading uppercase tracking-tighter">
                            Universitas Muhammadiyah <br>
                            <span
                                class="text-primary bg-linear-to-r from-primary to-primary/70 bg-clip-text">Yogyakarta</span>
                        </div>
                        <div
                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mt-2 flex items-center gap-2">
                            <span class="size-1 bg-accent rounded-full"></span>
                            Unggul & Islami
                        </div>
                    </div>
                </div>
                <p class="text-sm text-slate-500 leading-relaxed max-w-sm font-medium">
                    Sistem Manajemen Rencana Pembelajaran Semester (RPS) terintegrasi. Berkomitmen dalam mewujudkan
                    transparansi kurikulum dan standarisasi mutu akademik tingkat dunia.
                </p>
            </div>

            <!-- Column 2: Quick Navigation (3 Cols) -->
            <div class="lg:col-span-3 space-y-8">
                <h4
                    class="text-xs font-black text-slate-900 uppercase tracking-[0.25em] font-heading flex items-center gap-2">
                    <span class="w-6 h-px bg-primary/30"></span>
                    Eksplorasi
                </h4>
                <ul class="space-y-4">
                    <li>
                        <a href="/"
                            class="group flex items-center gap-2 text-sm text-slate-500 hover:text-primary transition-all duration-300">
                            <span class="w-0 group-hover:w-4 h-0.5 bg-primary transition-all duration-300"></span>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rps.fakultas') }}"
                            class="group flex items-center gap-2 text-sm text-slate-500 hover:text-primary transition-all duration-300">
                            <span class="w-0 group-hover:w-4 h-0.5 bg-primary transition-all duration-300"></span>
                            RPS
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}"
                            class="group flex items-center gap-2 text-sm text-slate-500 hover:text-primary transition-all duration-300">
                            <span class="w-0 group-hover:w-4 h-0.5 bg-primary transition-all duration-300"></span>
                            Tentang Website
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dokumen.index') }}"
                            class="group flex items-center gap-2 text-sm text-slate-500 hover:text-primary transition-all duration-300">
                            <span class="w-0 group-hover:w-4 h-0.5 bg-primary transition-all duration-300"></span>
                            Dokumen
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 3: Presence (4 Cols) -->
            <div class="lg:col-span-4 space-y-8">
                <h4
                    class="text-xs font-black text-slate-900 uppercase tracking-[0.25em] font-heading flex items-center gap-2">
                    <span class="w-6 h-px bg-primary/30"></span>
                    Hubungi Kami
                </h4>
                <div class="space-y-5">
                    <div class="flex items-start gap-4 group cursor-default">
                        <div
                            class="size-10 rounded-xl bg-white border border-slate-100 flex items-center justify-center text-primary shrink-0 shadow-sm group-hover:bg-primary group-hover:text-white transition-all duration-500 group-hover:-translate-y-1">
                            <iconify-icon icon="solar:map-point-bold-duotone" class="size-5"></iconify-icon>
                        </div>
                        <div class="space-y-1">
                            <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">Alamat
                                Kampus</span>
                            <span class="text-xs text-slate-600 leading-relaxed font-medium block">
                                Jl. Brawijaya, Tamantirto, Kasihan, Bantul, Yogyakarta 55183
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 group">
                        <div
                            class="size-10 rounded-xl bg-white border border-slate-100 flex items-center justify-center text-primary shrink-0 shadow-sm group-hover:bg-primary group-hover:text-white transition-all duration-500 group-hover:-translate-y-1">
                            <iconify-icon icon="solar:letter-bold-duotone" class="size-5"></iconify-icon>
                        </div>
                        <div class="space-y-1">
                            <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">Email
                                Resmi</span>
                            <a href="mailto:rps@umy.ac.id"
                                class="text-xs text-slate-600 font-bold hover:text-primary transition-colors">rps@umy.ac.id</a>
                        </div>
                    </div>
                </div>

                <!-- Social Pills -->
                <div class="pt-4 flex flex-wrap gap-3">

                    <a href="#"
                        class="flex items-center justify-center size-10 rounded-full bg-white border border-slate-200 text-slate-400
               hover:bg-[#1877F2] hover:text-white hover:border-transparent hover:shadow-xl
               transition-all duration-300 active:scale-90">
                        <iconify-icon icon="ri:facebook-fill" class="size-5"></iconify-icon>
                    </a>

                    <a href="#"
                        class="flex items-center justify-center size-10 rounded-full bg-white border border-slate-200 text-slate-400
               hover:bg-linear-to-tr hover:from-[#FCAF45] hover:to-[#E1306C]
               hover:text-white hover:border-transparent hover:shadow-xl
               transition-all duration-300 active:scale-90">
                        <iconify-icon icon="ri:instagram-line" class="size-5"></iconify-icon>
                    </a>

                    <a href="#"
                        class="flex items-center justify-center size-10 rounded-full bg-white border border-slate-200 text-slate-400
               hover:bg-[#000000] hover:text-white hover:border-transparent hover:shadow-xl
               transition-all duration-300 active:scale-90">
                        <iconify-icon icon="ri:twitter-x-fill" class="size-5"></iconify-icon>
                    </a>

                    <a href="#"
                        class="flex items-center justify-center size-10 rounded-full bg-white border border-slate-200 text-slate-400
               hover:bg-[#FF0000] hover:text-white hover:border-transparent hover:shadow-xl
               transition-all duration-300 active:scale-90">
                        <iconify-icon icon="ri:youtube-fill" class="size-5"></iconify-icon>
                    </a>
                </div>

            </div>
        </div>

        <!-- Footer Bottom Bar -->
        <div class="pt-10 border-t border-slate-100/60 flex flex-col md:flex-row justify-between items-center gap-6">
            <div
                class="flex flex-col md:flex-row items-center gap-2 md:gap-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.25em]">
                <span>© {{ date('Y') }} My RPS Digital System</span>
                <span class="hidden md:block size-1 bg-slate-200 rounded-full"></span>
                <span>Universitas Muhammadiyah Yogyakarta</span>
            </div>
        </div>
    </div>
</footer>
