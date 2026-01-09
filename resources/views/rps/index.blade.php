@extends('layouts.app')

@section('content')
    <div class="mx-auto px-4 py-32">
        <!-- Hero Header -->
        <div
            class="relative mb-8 overflow-hidden rounded-3xl bg-linear-to-br from-primary to-primary/80 p-8 text-primary-foreground shadow-xl">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <div
                            class="bg-primary-foreground/20 backdrop-blur-md rounded-xl px-3 py-1 border border-primary-foreground/30">
                            <span class="text-sm font-bold text-primary-foreground/80">{{ $course->code }}</span>
                        </div>
                        <div class="text-sm font-medium opacity-90">{{ $course->sks }} SKS Semester
                            {{ $course->semester }}</div>
                    </div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-black mb-2 tracking-tight">
                        {{ $course->name }}
                    </h1>
                    <p class="text-lg opacity-90 max-w-md font-medium">
                        Rencana Pembelajaran Semester (RPS)
                    </p>
                </div>
                <div class="mt-6 lg:mt-0 flex flex-col gap-2 items-start lg:items-end">
                    <div class="flex items-center gap-6 text-sm font-bold">
                        <div class="flex items-center gap-2 bg-primary-foreground/10 px-3 py-1 rounded-lg">
                            <iconify-icon icon="solar:calendar-bold"
                                class="size-4 text-primary-foreground/80"></iconify-icon>
                            <span>TA: {{ $rps->tahun_ajaran ?? '-' }}</span>
                        </div>
                        <div class="flex items-center gap-2 bg-primary-foreground/10 px-3 py-1 rounded-lg">
                            <iconify-icon icon="solar:clock-bold" class="size-4 text-primary-foreground/80"></iconify-icon>
                            {{ $rps ? \Carbon\Carbon::parse($rps->tgl_penyusunan)->format('d M Y') : 'Belum Disusun' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation Component -->
        @if ($rps)
            <!-- Tampilkan Navigasi Tabs hanya jika RPS ada -->
            <x-tabs-navigation />

            <!-- Tab Content Container -->
            <div class="mt-6 min-h-[400px]">
                <div id="deskripsi" class="tab-content transition-opacity duration-300">
                    <x-tab-deskripsi :rps="$rps" />
                </div>

                <div id="cpl" class="tab-content hidden transition-opacity duration-300">
                    <x-tab-cpl :rps="$rps" :allCpls="$allCpls" :selectedCplIds="$selectedCplIds" :totalBobotCpl="$totalBobotCpl" />
                </div>

                <div id="cpmk" class="tab-content hidden transition-opacity duration-300">
                    <x-tab-cpmk :rps="$rps" :groupedCpmks="$groupedCpmks" :course="$course" />
                </div>

                <div id="subcpmk" class="tab-content hidden transition-opacity duration-300">
                    <x-tab-subcpmk :rps="$rps" />
                </div>

                <div id="rencana" class="tab-content hidden transition-opacity duration-300">
                    <x-tab-rencana :rps="$rps" :totalBobotRencana="$totalBobotRencana" :rencanas="$rencanas" />
                </div>

                <div id="tugas" class="tab-content hidden transition-opacity duration-300">
                    <x-tab-tugas :rps="$rps" :daftarTugas="$daftarTugas" />
                </div>

                <div id="evaluasi" class="tab-content hidden transition-opacity duration-300">
                    <x-tab-evaluasi :rps="$rps" :grouped-evaluasi="$groupedEvaluasi" :totalBobotEvaluasi="$totalBobotEvaluasi" />
                </div>

                <div id="referensi" class="tab-content hidden transition-opacity duration-300">
                    <x-tab-referensi :rps="$rps" :referensi="$referensi" />
                </div>
            </div>
        @else
            <!-- Tampilan Empty State jika RPS belum ada -->
            <div
                class="flex flex-col items-center justify-center p-20 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[3rem] text-center">
                <div
                    class="size-24 bg-white rounded-full flex items-center justify-center shadow-xl border border-slate-100 mb-8">
                    <iconify-icon icon="solar:document-add-bold-duotone" class="size-12 text-slate-300"></iconify-icon>
                </div>
                <h3 class="text-2xl font-black text-slate-900 font-heading mb-3 uppercase tracking-tighter">Dokumen Belum
                    Tersedia</h3>
                <p class="text-slate-500 max-w-sm leading-relaxed font-medium italic">
                    Rencana Pembelajaran Semester untuk mata kuliah ini sedang dalam tahap penyusunan oleh tim pengampu.
                </p>
                <div class="mt-8">
                    <a href="{{ route('rps.prodi.show', $course->prodi->slug) }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 rounded-2xl font-bold text-sm text-slate-600 hover:bg-slate-50 transition-all">
                        <iconify-icon icon="solar:alt-arrow-left-bold"></iconify-icon>
                        Kembali ke Daftar Matakuliah
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
