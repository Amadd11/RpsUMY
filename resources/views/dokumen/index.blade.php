@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-32">
        <!-- Page Header -->
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-heading font-bold text-foreground tracking-tight mb-4">
                Dokumen Akademik
            </h1>
            <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                Kumpulan dokumen pendukung terkait RPS resmi dari seluruh Program Studi di Universitas Muhammadiyah
                Yogyakarta.
            </p>
            @if (isset($dokumens))
                Total: <span class="font-bold">{{ $dokumens->count() }}</span> Dokumen
            @endif

        </div>

        <!-- Tabel dalam Card Elegan -->
        <div
            class="relative bg-card/80 border border-border/50 rounded-3xl overflow-hidden hover:shadow-2xl transition-all duration-500">
            <!-- Gradient Overlay (hanya muncul saat ada hover di row) -->
            <div class="absolute inset-0 bg-linear-to-br from-primary/5 to-primary/10 opacity-0 pointer-events-none">
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-secondary/50 border-b border-border/50">
                        <tr>
                            <th class="px-8 py-6 text-left text-sm font-semibold text-foreground">
                                Judul Dokumen
                            </th>
                            <th class="px-8 py-6 text-left text-sm font-semibold text-foreground">
                                Program Studi
                            </th>
                            <th class="px-8 py-6 text-center text-sm font-semibold text-foreground">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border/50">
                        @forelse ($dokumens as $dokumen)
                            <tr class="group hover:bg-primary/5 transition-all duration-300">
                                {{-- Judul --}}
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center group-hover:bg-primary/20 transition-colors">
                                            <iconify-icon
                                                icon="{{ $dokumen->tipe === 'url' ? 'solar:link-bold-duotone' : 'solar:document-text-bold-duotone' }}"
                                                class="size-5 text-primary">
                                            </iconify-icon>
                                        </div>

                                        <span
                                            class="font-medium text-foreground group-hover:text-primary transition-colors">
                                            {{ $dokumen->judul }}
                                        </span>
                                    </div>
                                </td>

                                {{-- Prodi --}}
                                <td class="px-8 py-6 text-muted-foreground">
                                    {{ $dokumen->prodi->name ?? 'Umum' }}
                                </td>

                                {{-- Aksi --}}
                                <td class="px-8 py-6 text-center">
                                    @php
                                        $url =
                                            $dokumen->tipe === 'url'
                                                ? $dokumen->file_url
                                                : asset('storage/' . $dokumen->file_path);
                                    @endphp

                                    <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                                        class="inline-flex items-center gap-2 px-5 py-3 rounded-xl
                       bg-primary/10 text-primary font-semibold
                       hover:bg-primary/20 opacity-80 group-hover:opacity-100
                       transition-all duration-300">
                                        Lihat Dokumen
                                        <iconify-icon icon="solar:alt-arrow-right-linear" class="size-4"></iconify-icon>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-20 text-center">
                                    <div class="max-w-md mx-auto">
                                        <iconify-icon icon="solar:document-text-bold-duotone"
                                            class="size-32 text-muted-foreground/20 mx-auto mb-6"></iconify-icon>
                                        <h3 class="text-xl font-heading font-semibold text-muted-foreground mb-2">
                                            Belum Ada Dokumen
                                        </h3>
                                        <p class="text-muted-foreground">
                                            Dokumen akademik akan segera ditambahkan. Silakan cek kembali nanti.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Bottom Accent Line -->
            <div
                class="absolute bottom-0 left-0 right-0 h-1 bg-linear-to-r from-primary to-primary/50 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
            </div>
        </div>

        <!-- Pagination (jika pakai paginate) -->
        @if ($dokumens instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="mt-12 flex justify-center">
                {{ $dokumens->links() }}
            </div>
        @endif
    </div>
@endsection
