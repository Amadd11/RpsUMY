@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">
        <nav class="flex items-center gap-2 text-sm text-muted-foreground mb-6 flex-wrap">
            <a href="{{ route('index') }}" class="hover:text-primary font-medium">Beranda</a>

            <iconify-icon icon="solar:arrow-right-linear" class="size-4"></iconify-icon>

            <a href="{{ route('rps.fakultas') }}" class="hover:text-primary font-medium">
                {{ $prodi->fakultas->name }}
            </a>

            <iconify-icon icon="solar:arrow-right-linear" class="size-4"></iconify-icon>

            <span class="text-foreground font-semibold">
                {{ $prodi->name }}
            </span>
        </nav>


        <!-- Header -->
        <div class="mb-8">
            <h1
                class="text-4xl md:text-3xl font-bold mb-3 font-heading bg-linear-to-r from-primary to-chart-3 bg-clip-text text-transparent">
                Program Studi {{ $prodi->name }}
            </h1>

            <p class="text-lg text-muted-foreground max-w-2xl">
                Fakultas {{ $prodi->fakultas->name }}
            </p>
        </div>

        <!-- Filters -->
        <div class="bg-card rounded-2xl p-6 shadow-sm mb-6">
            <div class="flex flex-col sm:flex-row gap-4 mb-6">
                <div class="flex-1">
                    <label class="block text-sm font-semibold mb-2 text-foreground">Semester</label>
                    <div class="relative">
                        <select
                            class="w-full px-4 py-3 rounded-xl bg-input border border-border focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all duration-300 appearance-none pr-10">
                            <option>Semua Semester</option>
                            <option>Semester 1</option>
                            <option>Semester 2</option>
                            <option>Semester 3</option>
                            <option>Semester 4</option>
                            <option>Semester 5</option>
                            <option>Semester 6</option>
                            <option>Semester 7</option>
                            <option>Semester 8</option>
                        </select>
                        <iconify-icon icon="solar:alt-arrow-down-bold"
                            class="size-5 absolute right-3 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none"></iconify-icon>
                    </div>
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-semibold mb-2 text-foreground">Tahun Akademik</label>
                    <div class="relative">
                        <select
                            class="w-full px-4 py-3 rounded-xl bg-input border border-border focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all duration-300 appearance-none pr-10">
                            <option>2024/2025</option>
                            <option>2023/2024</option>
                            <option>2022/2023</option>
                            <option>2021/2022</option>
                        </select>
                        <iconify-icon icon="solar:alt-arrow-down-bold"
                            class="size-5 absolute right-3 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none"></iconify-icon>
                    </div>
                </div>
            </div>
            <div class="relative">
                <iconify-icon icon="solar:magnifying-glass-bold"
                    class="size-5 text-muted-foreground absolute left-4 top-1/2 -translate-y-1/2"></iconify-icon>
                <input type="text"
                    class="w-full pl-12 pr-4 py-3 rounded-xl bg-input border border-border focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all duration-300"
                    placeholder="Cari mata kuliah..." />
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Courses Table -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-card rounded-2xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-secondary">
                                <tr>
                                    <th class="text-left px-6 py-4 text-sm font-semibold text-secondary-foreground">Kode
                                    </th>
                                    <th class="text-left px-6 py-4 text-sm font-semibold text-secondary-foreground">Mata
                                        Kuliah</th>
                                    <th class="text-center px-6 py-4 text-sm font-semibold text-secondary-foreground">SKS
                                    </th>
                                    <th class="text-center px-6 py-4 text-sm font-semibold text-secondary-foreground">
                                        Semester</th>
                                    <th class="text-center px-6 py-4 text-sm font-semibold text-secondary-foreground">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($prodi->courses as $course)
                                    <tr class="border-b border-border hover:bg-muted/50 transition-colors">
                                        <td class="px-6 py-4 text-sm font-medium text-foreground">
                                            {{ $course->code }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-foreground">
                                            {{ $course->name }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-center text-foreground">
                                            {{ $course->sks }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-center text-foreground">
                                            {{ $course->semester }}
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center gap-2">
                                                <!-- VIEW RPS -->
                                                <a href="{{ route('rps.course.show', $course->slug) }}"
                                                    class="flex items-center justify-center size-9 bg-primary/10 rounded-lg hover:bg-primary/20 transition-colors p-2">
                                                    <iconify-icon icon="solar:eye-bold"
                                                        class="size-5 text-primary"></iconify-icon>
                                                </a>

                                                <!-- DOWNLOAD (optional nanti) -->
                                                @if ($course->rps_file ?? false)
                                                    <a href="{{ asset('storage/' . $course->rps_file) }}"
                                                        class="flex items-center justify-center size-9 bg-accent/10 rounded-lg hover:bg-accent/20 transition-colors p-2">
                                                        <iconify-icon icon="solar:download-bold"
                                                            class="size-5 text-accent-foreground"></iconify-icon>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-muted-foreground">
                                            Mata kuliah belum tersedia
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between">
                    <div class="text-sm text-muted-foreground">Menampilkan 8 dari 48 dokumen RPS</div>
                    <div class="flex items-center gap-1">
                        <button
                            class="flex items-center justify-center size-10 rounded-lg border border-border bg-card hover:bg-muted transition-colors p-2">
                            <iconify-icon icon="solar:chevron-left-bold" class="size-5"></iconify-icon>
                        </button>
                        <button
                            class="flex items-center justify-center size-10 rounded-lg bg-primary text-primary-foreground font-semibold px-3">1</button>
                        <button
                            class="flex items-center justify-center size-10 rounded-lg border border-border bg-card hover:bg-muted transition-colors p-2">2</button>
                        <button
                            class="flex items-center justify-center size-10 rounded-lg border border-border bg-card hover:bg-muted transition-colors p-2">3</button>
                        <button
                            class="flex items-center justify-center size-10 rounded-lg border border-border bg-card hover:bg-muted transition-colors p-2">
                            <iconify-icon icon="solar:chevron-right-bold" class="size-5"></iconify-icon>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- About Program -->
                <div class="bg-card rounded-2xl p-6 shadow-sm">
                    <h2 class="text-xl font-bold mb-4 font-heading text-foreground">Tentang Program Studi</h2>
                    <p class="text-sm text-muted-foreground mb-4 leading-relaxed">
                        Program Studi Teknik Informatika UMY dirancang untuk menghasilkan lulusan yang kompeten dalam bidang
                        teknologi informasi dan mampu bersaing di era digital.
                    </p>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <iconify-icon icon="solar:check-circle-bold"
                                class="size-5 text-primary shrink-0 mt-0.5"></iconify-icon>
                            <div class="text-sm text-foreground">Akreditasi A (Unggul)</div>
                        </div>
                        <div class="flex items-start gap-3">
                            <iconify-icon icon="solar:check-circle-bold"
                                class="size-5 text-primary shrink-0 mt-0.5"></iconify-icon>
                            <div class="text-sm text-foreground">Jenjang S1 - 144 SKS</div>
                        </div>
                        <div class="flex items-start gap-3">
                            <iconify-icon icon="solar:check-circle-bold"
                                class="size-5 text-primary shrink-0 mt-0.5"></iconify-icon>
                            <div class="text-sm text-foreground">8 Semester</div>
                        </div>
                    </div>
                </div>

                <!-- Learning Outcomes -->
                <div class="bg-card rounded-2xl p-6 shadow-sm">
                    <h2 class="text-xl font-bold mb-4 font-heading text-foreground">Capaian Pembelajaran</h2>
                    <ul class="space-y-3 text-sm text-muted-foreground">
                        <li class="flex items-start gap-2">
                            <span class="text-primary font-bold shrink-0 mt-1">•</span>
                            <span>Mampu merancang dan mengembangkan sistem perangkat lunak</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-primary font-bold shrink-0 mt-1">•</span>
                            <span>Menguasai konsep teoretis bidang pengetahuan informatika</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-primary font-bold shrink-0 mt-1">•</span>
                            <span>Mampu menganalisis dan menyelesaikan permasalahan teknologi informasi</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-primary font-bold shrink-0 mt-1">•</span>
                            <span>Memiliki kemampuan komunikasi dan kerja sama tim yang baik</span>
                        </li>
                    </ul>
                </div>

                <!-- Coordinator -->
                <div class="bg-card rounded-2xl p-6 shadow-sm">
                    <h2 class="text-xl font-bold mb-4 font-heading text-foreground">Koordinator Program Studi</h2>
                    <div class="flex items-center gap-4 mb-4">
                        <img alt="Coordinator" src="https://randomuser.me/api/portraits/men/32.jpg"
                            class="size-16 rounded-full object-cover" />
                        <div>
                            <div class="font-semibold text-foreground">Dr. Ahmad Hidayat, M.Kom</div>
                            <div class="text-sm text-muted-foreground">Ketua Program Studi</div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <iconify-icon icon="solar:letter-bold" class="size-5 text-primary"></iconify-icon>
                            <div class="text-sm text-muted-foreground">ahmad.hidayat@umy.ac.id</div>
                        </div>
                        <div class="flex items-center gap-3">
                            <iconify-icon icon="solar:phone-bold" class="size-5 text-primary"></iconify-icon>
                            <div class="text-sm text-muted-foreground">+62 274 387656 ext. 234</div>
                        </div>
                    </div>
                </div>

                <!-- Help -->
                <div class="bg-secondary rounded-2xl p-6">
                    <h3 class="text-lg font-bold mb-3 text-foreground">Butuh Bantuan?</h3>
                    <p class="text-sm text-muted-foreground mb-4 leading-relaxed">
                        Hubungi kami untuk informasi lebih lanjut tentang RPS atau program studi.
                    </p>
                    <button
                        class="w-full py-3 px-4 bg-primary text-primary-foreground rounded-xl font-semibold flex items-center justify-center gap-2 hover:opacity-90 transition-opacity">
                        <iconify-icon icon="mdi:whatsapp" class="size-5"></iconify-icon>
                        <span>Hubungi via WhatsApp</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
