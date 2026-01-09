<div class="bg-card rounded-3xl p-6 md:p-8 shadow-xl border border-border/50 space-y-8 font-sans">
    <!-- Section Header -->
    <header class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-linear-to-br from-accent to-accent/80 rounded-xl shadow-md">
                <iconify-icon icon="solar:branching-paths-bold" class="size-5 text-accent-foreground"></iconify-icon>
            </div>
            <div>
                <h2 class="text-xl font-bold tracking-tight text-foreground font-heading">
                    Daftar Tugas & Penilaian
                </h2>
            </div>
        </div>
    </header>

    <!-- Accordion Container -->
    <div x-data="{ active: 0 }" class="space-y-4">
        @forelse ($daftarTugas as $index => $tugas)
            <div class="group bg-white border-2 rounded-4xl transition-all duration-500 overflow-hidden"
                :class="active === {{ $index }} ?
                    'border-primary/30 shadow-2xl shadow-primary/10 ring-4 ring-primary/5' :
                    'border-slate-100 hover:border-slate-200 shadow-sm'">

                <!-- Accordion Header -->
                <button type="button"
                    x-on:click="active === {{ $index }} ? active = null : active = {{ $index }}"
                    class="w-full px-6 py-5 flex items-center justify-between text-left focus:outline-none transition-colors cursor-pointer"
                    :class="active === {{ $index }} ? 'bg-primary/5' : 'hover:bg-slate-50/50'">

                    <div class="flex-1 min-w-0 pr-4">
                        <h3
                            class="text-lg font-bold text-slate-800 group-hover:text-primary transition-colors font-heading leading-tight truncate">
                            {{ $tugas->judul_penilaian ?? 'Tugas ' . ($index + 1) }}
                        </h3>
                    </div>

                    <div class="shrink-0 size-9 rounded-full flex items-center justify-center transition-all duration-500"
                        :class="active === {{ $index }} ?
                            'bg-primary text-primary-foreground rotate-180 shadow-lg shadow-primary/20' :
                            'bg-slate-100 text-slate-400'">
                        <iconify-icon icon="solar:alt-arrow-down-bold" class="size-4"></iconify-icon>
                    </div>
                </button>

                <!-- Accordion Body -->
                <div x-show="active === {{ $index }}" x-collapse.duration.500ms x-cloak>
                    <div class="px-6 pb-8 space-y-8 border-t border-slate-100 bg-slate-50/20">

                        <!-- Quick Info Grid -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-6">
                            <div class="p-3 bg-white rounded-2xl border border-slate-100 shadow-sm">
                                <label
                                    class="text-sm font-black text-slate-400  tracking-widest mb-1 block">Week</label>
                                <p class="text-xs font-bold text-slate-700 leading-tight">
                                    {{ $tugas->jadwal_pelaksanaan ?? '-' }}</p>
                            </div>
                            <div class="p-3 bg-white rounded-2xl border border-slate-100 shadow-sm">
                                <label class="text-sm font-black text-slate-400  tracking-widest mb-1 block">Bentuk
                                    Penilaian</label>
                                <p class="text-xs font-bold text-slate-700 leading-tight">{!! $tugas->bentuk_penilaian ?? '-' !!}</p>
                            </div>
                            <div class="p-3 bg-white rounded-2xl border border-slate-100 shadow-sm col-span-2">
                                <label
                                    class="text-sm font-black text-slate-400  tracking-widest mb-1 block">Sub-CPMK</label>
                                <p class="text-xs font-bold text-slate-700 truncate">{!! $tugas->sub_cpmk ?? '-' !!}</p>
                            </div>
                        </div>

                        <!-- Detail Content Grid -->
                        <div class="grid lg:grid-cols-2 gap-8">
                            <!-- Left: Deskripsi & Metode -->
                            <div class="space-y-6">
                                @if ($tugas->deskripsi_penilaian)
                                    <div class="space-y-2.5">
                                        <div class="flex items-center gap-2 text-indigo-600">
                                            <iconify-icon icon="solar:document-text-bold-duotone"
                                                class="size-4"></iconify-icon>
                                            <h4 class="text-sm font-black ">Deskripsi
                                                Penilaian</h4>
                                        </div>
                                        <div
                                            class="max-w-none text-slate-600 bg-white p-5 rounded-2xl border border-slate-100 leading-relaxed shadow-sm">
                                            {!! $tugas->deskripsi_penilaian !!}
                                        </div>
                                    </div>
                                @endif

                                @if ($tugas->metode_penilaian)
                                    <div class="space-y-2.5">
                                        <div class="flex items-center gap-2 text-blue-600">
                                            <iconify-icon icon="solar:transmission-bold-duotone"
                                                class="size-4"></iconify-icon>
                                            <h4 class="text-sm font-black  ">Metode
                                                Penilaian</h4>
                                        </div>
                                        <div
                                            class="prose prose-xs prose-slate max-w-none text-slate-600 bg-white p-5 rounded-2xl border border-slate-100 leading-relaxed shadow-sm">
                                            {!! $tugas->metode_penilaian !!}
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Right: Indikator & Luaran -->
                            <div class="space-y-6">
                                @if ($tugas->indikator_kriteria_bobot)
                                    <div class="space-y-2.5">
                                        <div class="flex items-center gap-2 text-amber-600">
                                            <iconify-icon icon="solar:chart-square-bold-duotone"
                                                class="size-4"></iconify-icon>
                                            <h4 class="text-sm font-black  ">Indikator &
                                                Kriteria</h4>
                                        </div>
                                        <div
                                            class="prose prose-xs prose-slate max-w-none text-slate-600 bg-white p-5 rounded-2xl border border-slate-100 leading-relaxed shadow-sm">
                                            {!! $tugas->indikator_kriteria_bobot !!}
                                        </div>
                                    </div>
                                @endif

                                @if ($tugas->bentuk_dan_format_luaran)
                                    <div class="space-y-2.5">
                                        <div class="flex items-center gap-2 text-emerald-600">
                                            <iconify-icon icon="solar:box-bold-duotone" class="size-4"></iconify-icon>
                                            <h4 class="text-sm font-black  ">Bentuk &
                                                Format Luaran</h4>
                                        </div>
                                        <div
                                            class="prose prose-xs prose-slate max-w-none text-slate-600 bg-white p-5 rounded-2xl border border-slate-100 leading-relaxed shadow-sm">
                                            {!! $tugas->bentuk_dan_format_luaran !!}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Full Width Bottom Section -->
                        <div class="grid md:grid-cols-2 gap-5">
                            @if ($tugas->pustaka)
                                <div class="p-4 bg-indigo-50 border border-indigo-100 rounded-2xl shadow-sm">
                                    <div class="flex items-center gap-2 text-indigo-700 mb-2.5">
                                        <iconify-icon icon="solar:library-bold-duotone" class="size-4"></iconify-icon>
                                        <h4 class="text-sm font-black  tracking-widest">Pustaka Utama</h4>
                                    </div>
                                    <div class="prose prose-xs max-w-none text-indigo-950/70 italic">
                                        {!! $tugas->pustaka !!}
                                    </div>
                                </div>
                            @endif

                            @if ($tugas->lain_lain)
                                <div class="p-4 bg-slate-100 border border-slate-200 rounded-2xl shadow-sm">
                                    <div class="flex items-center gap-2 text-slate-700 mb-2.5">
                                        <iconify-icon icon="solar:info-square-bold-duotone"
                                            class="size-4"></iconify-icon>
                                        <h4 class="text-sm font-black  tracking-widest">Informasi Lainnya
                                        </h4>
                                    </div>
                                    <div class="prose prose-xs max-w-none text-slate-700/70">
                                        {!! $tugas->lain_lain !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div
                class="flex flex-col items-center justify-center p-20 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[3rem] text-center">
                <h3 class="text-lg font-bold text-slate-900 font-heading mb-2">Belum Ada Tugas dan Penilaian</h3>
                <p class="text-slate-500 max-w-sm leading-relaxed text-sm italic">
                    Detail tugas dan penilaian untuk mata kuliah ini sedang dalam proses penyusunan.
                </p>
            </div>
        @endforelse
    </div>
</div>
