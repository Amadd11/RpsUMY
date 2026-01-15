@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-32">
        <nav class="flex items-center gap-2 text-sm text-muted-foreground mb-6 flex-wrap">
            <a href="{{ route('index') }}" class="hover:text-primary font-medium">Beranda</a>

            <iconify-icon icon="solar:arrow-right-linear" class="size-4"></iconify-icon>

            <a href="{{ route('rps.prodi', $prodi->fakultas->slug) }}" class="hover:text-primary font-medium">
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
                class="text-4xl md:text-5xl font-bold mb-3 font-heading bg-linear-to-r from-primary to-chart-3 bg-clip-text pb-2 text-transparent">
                Program Studi {{ $prodi->name }}
            </h1>

            <p class="text-lg text-muted-foreground max-w-2xl">
                Fakultas {{ $prodi->fakultas->name }}
            </p>
        </div>

        <!-- Filters -->
        <form method="GET" action="{{ route('rps.prodi.show', $prodi->slug) }}">
            <div class="bg-card rounded-2xl p-6 shadow-sm mb-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Search -->
                    <div class="w-full md:flex-1">
                        <label class="block text-sm font-semibold mb-2 text-foreground">
                            Cari Mata Kuliah
                        </label>

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari mata kuliah..."
                            class="w-full px-4 py-3 rounded-xl bg-input border border-border
                           focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all duration-300">
                    </div>
                    <!-- Filter Semester -->
                    <div class="w-full md:w-1/3">
                        <label class="block text-sm font-semibold mb-2 text-foreground">
                            Semester
                        </label>

                        <div class="relative">
                            <select name="semester" onchange="this.form.submit()"
                                class="w-full px-4 py-3 rounded-xl bg-input border border-border appearance-none">
                                <option value="">Semua Semester</option>

                                @for ($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" @selected(request('semester') == $i)>
                                        Semester {{ $i }}
                                    </option>
                                @endfor
                            </select>

                            <iconify-icon icon="solar:alt-arrow-down-bold"
                                class="size-5 absolute right-3 top-1/2 -translate-y-1/2 text-muted-foreground pointer-events-none">
                            </iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </form>

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
                                @forelse ($courses as $course)
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
                                                @if ($course->rps)
                                                    <a href="{{ route('rps.course.show', $course->slug) }}"
                                                        class="flex items-center justify-center size-9 rounded-lg bg-primary/10 text-primary hover:bg-primary hover:text-primary-foreground transition-all">
                                                        <iconify-icon icon="solar:eye-bold" class="size-5" />
                                                    </a>
                                                @else
                                                    <span
                                                        class="flex items-center justify-center size-9 rounded-lg bg-muted text-muted-foreground opacity-50 cursor-not-allowed">
                                                        <iconify-icon icon="solar:eye-off-bold" class="size-5" />
                                                    </span>
                                                @endif
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
                @if ($courses->hasPages())
                    <div class="flex items-center justify-between mt-6">
                        <!-- Info -->
                        <div class="text-sm text-muted-foreground">
                            Menampilkan {{ $courses->firstItem() }}–{{ $courses->lastItem() }}
                            dari {{ $courses->total() }} dokumen RPS
                        </div>

                        <!-- Pagination -->
                        <div class="flex items-center gap-1">

                            {{-- PREVIOUS --}}
                            @if ($courses->onFirstPage())
                                <span
                                    class="flex items-center justify-center size-10 rounded-lg border border-border bg-muted opacity-50 cursor-not-allowed">
                                    <iconify-icon icon="solar:chevron-left-bold" class="size-5"></iconify-icon>
                                </span>
                            @else
                                <a href="{{ $courses->previousPageUrl() }}"
                                    class="flex items-center justify-center size-10 rounded-lg border border-border bg-card hover:bg-muted transition-colors">
                                    <iconify-icon icon="solar:chevron-left-bold" class="size-5"></iconify-icon>
                                </a>
                            @endif

                            {{-- PAGE NUMBERS --}}
                            @foreach ($courses->getUrlRange(1, $courses->lastPage()) as $page => $url)
                                @if ($page == $courses->currentPage())
                                    <span
                                        class="flex items-center justify-center size-10 rounded-lg bg-primary text-primary-foreground font-semibold">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="flex items-center justify-center size-10 rounded-lg border border-border bg-card hover:bg-muted transition-colors">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            {{-- NEXT --}}
                            @if ($courses->hasMorePages())
                                <a href="{{ $courses->nextPageUrl() }}"
                                    class="flex items-center justify-center size-10 rounded-lg border border-border bg-card hover:bg-muted transition-colors">
                                    <iconify-icon icon="solar:chevron-right-bold" class="size-5"></iconify-icon>
                                </a>
                            @else
                                <span
                                    class="flex items-center justify-center size-10 rounded-lg border border-border bg-muted opacity-50 cursor-not-allowed">
                                    <iconify-icon icon="solar:chevron-right-bold" class="size-5"></iconify-icon>
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar Container -->
            <div class="space-y-6">
                <!-- About Program Card -->
                <div
                    class="bg-card rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/40 border border-slate-100 transition-all duration-500 hover:shadow-2xl hover:shadow-slate-200/50">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 bg-primary/10 rounded-lg flex items-center justify-center">
                            <iconify-icon icon="solar:info-square-bold-duotone" class="size-5 text-primary">
                            </iconify-icon>
                        </div>

                        <h2 class="text-lg font-black text-slate-900 font-heading uppercase">
                            Tentang Program Studi
                        </h2>
                    </div>
                    <div class="prose prose-sm prose-slate max-w-none text-slate-600 mb-8 leading-relaxed">
                        {!! $prodi->deskripsi !!}
                    </div>

                    <!-- Stats List -->
                    <div class="space-y-5 pt-6 border-t border-slate-50">
                        <div class="flex items-center gap-4 group">
                            <div
                                class="size-11 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-500">
                                <iconify-icon icon="solar:medal-star-bold-duotone" class="size-5"></iconify-icon>
                            </div>
                            <div>
                                <div
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">
                                    Status Mutu</div>
                                <div class="text-sm font-black text-slate-900 uppercase">Akreditasi
                                    {{ $prodi->akreditasi }}</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 group">
                            <div
                                class="size-11 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                                <iconify-icon icon="solar:global-bold-duotone" class="size-5"></iconify-icon>
                            </div>
                            <div>
                                <div
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">
                                    Jenjang & Beban SKS</div>
                                <div class="text-sm font-black text-slate-900 uppercase">{{ $prodi->jenjang }} —
                                    {{ $prodi->total_sks }} SKS</div>
                            </div>
                        </div>
                        <!-- Semester -->
                        <div class="flex items-center gap-4 group">
                            <div
                                class="size-11 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-500">
                                <iconify-icon icon="solar:calendar-date-bold-duotone" class="size-5"></iconify-icon>
                            </div>
                            <div>
                                <div
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">
                                    Masa Studi</div>
                                <div class="text-sm font-black text-slate-900 uppercase">{{ $prodi->total_semester }}
                                    Semester</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Help Card: Call to Action -->
                <div
                    class="bg-primary rounded-[2.5rem] p-8 text-white relative overflow-hidden group shadow-2xl shadow-primary/20">
                    <!-- Dekorasi Ikon Transparan di Latar Belakang - Ukuran Diperbesar untuk efek visual -->
                    <iconify-icon icon="solar:chat-dots-bold-duotone"
                        class="absolute -top-6 -right-6 size-40 opacity-10 group-hover:scale-110 transition-transform duration-700"></iconify-icon>

                    <div class="relative z-10 space-y-6">
                        <div>
                            <h3
                                class="text-xl font-black font-heading leading-tight uppercase tracking-tighter text-white">
                                Butuh Bantuan <br> Akademik?</h3>
                            <div class="w-12 h-1 bg-accent mt-3 rounded-full"></div>
                        </div>

                        <p class="text-sm text-white/70 font-medium leading-relaxed">
                            Hubungi admin program studi untuk informasi lebih lanjut mengenai kurikulum atau kendala akses
                            dokumen RPS.
                        </p>

                        <a href="https://wa.me/your-number" target="_blank"
                            class="w-full py-4 px-6 bg-accent text-slate-900 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] flex items-center justify-center gap-3 shadow-lg hover:shadow-accent/40 hover:-translate-y-1 active:scale-95 transition-all">
                            <iconify-icon icon="mdi:whatsapp" class="size-5"></iconify-icon>
                            <span>Hubungi via WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
