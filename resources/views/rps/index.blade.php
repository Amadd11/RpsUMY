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
                            <span>TA: {{ $rps->tahun_ajaran }}</span>
                        </div>
                        <div class="flex items-center gap-2 bg-primary-foreground/10 px-3 py-1 rounded-lg">
                            <iconify-icon icon="solar:clock-bold" class="size-4 text-primary-foreground/80"></iconify-icon>
                            <span>{{ \Carbon\Carbon::parse($rps->tgl_penyusunan)->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation Component -->
        <x-tabs-navigation />

        <!-- Tab Content Container -->
        <div class="mt-6 min-h-[400px]">

            <!-- 1. Deskripsi Tab -->
            <div id="deskripsi" class="tab-content transition-opacity duration-300">
                <x-tab-deskripsi :rps="$rps" />
            </div>

            <!-- 2. CPL Tab -->
            <div id="cpl" class="tab-content hidden transition-opacity duration-300">
                <x-tab-cpl :rps="$rps" :allCpls="$allCpls" :selectedCplIds="$selectedCplIds" :totalBobotCpl="$totalBobotCpl" />
            </div>

            <!-- 3. CPMK Tab -->
            <div id="cpmk" class="tab-content hidden transition-opacity duration-300">
                <x-tab-cpmk :rps="$rps" :groupedCpmks="$groupedCpmks" :course="$course" />
            </div>

            <!-- 4. SubCpmk Tab -->
            <div id="subcpmk" class="tab-content hidden transition-opacity duration-300">
                <x-tab-subcpmk :rps="$rps" />
            </div>

            <!-- 5. Rencana Tab -->
            <div id="rencana" class="tab-content hidden transition-opacity duration-300">
                <x-tab-rencana :rps="$rps" :totalBobotRencana="$totalBobotRencana" :rencanas="$rencanas" />
            </div>

            <!-- 6. Tugas Tab -->
            <div id="tugas" class="tab-content hidden transition-opacity duration-300">
                <x-tab-tugas :rps="$rps" :daftarTugas="$daftarTugas" />
            </div>

            <!-- 7. Evaluasi Tab -->
            <div id="evaluasi" class="tab-content hidden transition-opacity duration-300">
                <x-tab-evaluasi :rps="$rps" :grouped-evaluasi="$groupedEvaluasi" :totalBobotEvaluasi="$totalBobotEvaluasi" />
            </div>

            <!-- 8. Referensi Tab -->
            <div id="referensi" class="tab-content hidden transition-opacity duration-300">
                <x-tab-referensi :rps="$rps" />
            </div>

        </div>
    </div>
@endsection
