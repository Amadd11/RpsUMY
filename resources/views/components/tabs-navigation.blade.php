<!-- Tabs Navigation -->
<div class="top-20 z-20 border-border/20 -mt-6 pt-6 mb-8">
    <div
        class="flex flex-nowrap md:flex-wrap gap-2 py-4 overflow-x-auto no-scrollbar justify-start md:justify-center px-4">
        <button data-target="deskripsi" data-color="primary"
            class="tab-button active flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm transition-all border border-transparent bg-primary text-primary-foreground shadow-md shadow-primary/20">
            <iconify-icon icon="solar:info-circle-bold" class="size-4"></iconify-icon> Deskripsi
        </button>
        <button data-target="cpl" data-color="accent"
            class="tab-button flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm transition-all border border-transparent text-muted-foreground hover:bg-muted hover:shadow-sm">
            <iconify-icon icon="solar:target-bold" class="size-4"></iconify-icon> CPL
        </button>
        <button data-target="cpmk" data-color="secondary"
            class="tab-button flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm transition-all border border-transparent text-muted-foreground hover:bg-muted hover:shadow-sm">
            <iconify-icon icon="solar:star-bold" class="size-4"></iconify-icon> CPMK
        </button>
        <button data-target="subcpmk" data-color="chart-2"
            class="tab-button flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm transition-all border border-transparent text-muted-foreground hover:bg-muted hover:shadow-sm">
            <iconify-icon icon="solar:clapperboard-edit-bold" class="size-4"></iconify-icon> SubCPMK
        </button>
        <button data-target="rencana" data-color="primary"
            class="tab-button flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm transition-all border border-transparent text-muted-foreground hover:bg-muted hover:shadow-sm">
            <iconify-icon icon="solar:calendar-bold" class="size-4"></iconify-icon> Rencana
        </button>
        <button data-target="tugas" data-color="accent"
            class="tab-button flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm transition-all border border-transparent text-muted-foreground hover:bg-muted hover:shadow-sm">
            <iconify-icon icon="solar:clipboard-check-bold" class="size-4"></iconify-icon> Tugas
        </button>
        <button data-target="evaluasi" data-color="secondary"
            class="tab-button flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm transition-all border border-transparent text-muted-foreground hover:bg-muted hover:shadow-sm">
            <iconify-icon icon="solar:chart-bold" class="size-4"></iconify-icon> Evaluasi
        </button>
        <button data-target="referensi" data-color="chart-2"
            class="tab-button flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm transition-all border border-transparent text-muted-foreground hover:bg-muted hover:shadow-sm">
            <iconify-icon icon="solar:book-bookmark-bold-duotone" class="size-4"></iconify-icon> Referensi
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetId = button.getAttribute('data-target');
                const color = button.getAttribute('data-color');

                // 1. Reset Semua Button
                tabButtons.forEach(btn => {
                    btn.classList.remove('active', 'shadow-md');
                    btn.classList.add('text-muted-foreground', 'hover:bg-muted',
                        'hover:shadow-sm', 'border-transparent');
                    // Remove all color-specific active classes
                    btn.classList.remove('bg-primary', 'text-primary-foreground',
                        'shadow-primary/20',
                        'bg-accent', 'text-accent-foreground', 'shadow-accent/20',
                        'bg-secondary', 'text-secondary-foreground',
                        'shadow-secondary/20',
                        'bg-chart-2', 'text-chart-2-foreground', 'shadow-chart-2/20'
                    );
                });

                // 2. Aktifkan Button yang Diklik
                button.classList.add('active', 'shadow-md');
                button.classList.remove('text-muted-foreground', 'hover:bg-muted',
                    'hover:shadow-sm');
                // Add color-specific active classes
                if (color === 'primary') {
                    button.classList.add('bg-primary', 'text-primary-foreground',
                        'shadow-primary/20');
                } else if (color === 'accent') {
                    button.classList.add('bg-accent', 'text-accent-foreground',
                        'shadow-accent/20');
                } else if (color === 'secondary') {
                    button.classList.add('bg-secondary', 'text-secondary-foreground',
                        'shadow-secondary/20');
                } else if (color === 'chart-2') {
                    button.classList.add('bg-chart-2', 'text-foreground',
                        'shadow-accent/20'); // Use foreground for text on chart-2
                }

                // 3. Sembunyikan Semua Konten
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                    content.style.opacity = '0';
                });

                // 4. Tampilkan Konten yang Sesuai
                const activeContent = document.getElementById(targetId);
                if (activeContent) {
                    activeContent.classList.remove('hidden');
                    // Trigger animasi fade-in sederhana
                    setTimeout(() => {
                        activeContent.style.opacity = '1';
                    }, 50);
                }
            });
        });

        // Set Default Active Tab (Deskripsi)
        document.querySelector('[data-target="deskripsi"]').click();
    });
</script>

<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .tab-button.active {
        transform: translateY(-2px);
    }

    .tab-content {
        transition: opacity 0.3s ease;
    }
</style>
