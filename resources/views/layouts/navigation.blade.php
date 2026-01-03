<header class="sticky top-0 w-full z-50 bg-card/80 border-b border-border shadow-sm rounded-b-3xl backdrop-blur-md">
    <!-- Permanen rounded & blur -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between h-20">
            <!-- Logo & Title -->
            <div class="flex items-center gap-4">
                <img alt="UMY Logo" src="{{ asset('assets/logo.png') }}"
                    class="h-12 w-12 object-contain hover:scale-105 transition-transform duration-300" />
                <div class="border-l-2 border-gray-500/50 pl-4 py-1">
                    <div class="font-heading font-bold text-base md:text-xl text-primary leading-tight tracking-tight">
                        Universitas Muhammadiyah Yogyakarta
                    </div>
                    <div class="text-[10px] md:text-sm font-medium text-muted-foreground tracking-widest font-sans ">
                        Sistem RPS Digital
                    </div>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center gap-1">
                <a href="{{ route('index') }}"
                    class="px-4 py-2 rounded-lg text-base font-heading font-semibold transition-all duration-300 {{ request()->routeIs('index') ? 'bg-primary text-primary-foreground shadow-md' : 'text-foreground hover:bg-secondary hover:text-primary hover:shadow-sm' }}">
                    Beranda
                </a>
                <a href="{{ route('rps.fakultas') }}"
                    class="px-4 py-2 rounded-lg text-base font-heading font-semibold transition-all duration-300 {{ request()->routeIs('rps.fakultas') ? 'bg-primary text-primary-foreground shadow-md' : 'text-foreground hover:bg-secondary hover:text-primary hover:shadow-sm' }}">
                    RPS
                </a>
                <a href="{{ route('about') }}"
                    class="px-4 py-2 rounded-lg text-base font-heading font-semibold transition-all duration-300 {{ request()->routeIs('about') ? 'bg-primary text-primary-foreground shadow-md' : 'text-foreground hover:bg-secondary hover:text-primary hover:shadow-sm' }}">
                    Tentang
                </a>
                <a href="#"
                    class="px-4 py-2 rounded-lg text-base font-heading font-semibold transition-all duration-300 {{ request()->routeIs('contact') ? 'bg-primary text-primary-foreground shadow-md' : 'text-foreground hover:bg-secondary hover:text-primary hover:shadow-sm' }}">
                    Kontak
                </a>
            </nav>

            <!-- Mobile Hamburger Toggle -->
            <button id="mobile-menu-toggle"
                class="md:hidden flex items-center justify-center size-12 rounded-full hover:bg-muted transition-all duration-300 hover:scale-105 focus:outline-none focus-visible:outline-2 focus-visible:outline-primary/50 focus-visible:outline-offset-2">
                <iconify-icon icon="mdi:menu" class="size-6 text-foreground transition-transform"></iconify-icon>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Dropdown -->
    <div id="mobile-menu"
        class="md:hidden hidden bg-card border-t border-border overflow-hidden transition-all duration-300 ease-in-out shadow-lg">
        <nav class="px-4 py-4 flex flex-col gap-1"> <a href="{{ route('index') }}"
                class="flex items-center justify-between px-4 py-3 rounded-xl font-heading font-semibold text-sm text-foreground hover:bg-secondary hover:text-primary transition-all duration-300 {{ request()->routeIs('index') ? 'bg-primary text-primary-foreground' : '' }}">
                Beranda
            </a>

            <a href="{{ route('rps.fakultas') }}"
                class="flex items-center justify-between px-4 py-3 rounded-xl font-heading font-semibold text-sm text-foreground hover:bg-secondary hover:text-primary transition-all duration-300 {{ request()->routeIs('rps.fakultas') ? 'bg-primary text-primary-foreground' : '' }}">
                RPS
            </a>

            <a href="{{ route('about') }}"
                class="flex items-center justify-between px-4 py-3 rounded-xl font-heading font-semibold text-sm text-foreground hover:bg-secondary hover:text-primary transition-all duration-300 {{ request()->routeIs('about') ? 'bg-primary text-primary-foreground' : '' }}">
                Tentang
            </a>

            <a href="#"
                class="flex items-center justify-between px-4 py-3 rounded-xl font-heading font-semibold text-sm text-foreground hover:bg-secondary hover:text-primary transition-all duration-300 {{ request()->routeIs('contact') ? 'bg-primary text-primary-foreground' : '' }}">
                Kontak
            </a>

        </nav>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('mobile-menu-toggle');
        const menu = document.getElementById('mobile-menu');
        const icon = toggle.querySelector('iconify-icon');

        if (!toggle || !menu || !icon) return;

        toggle.addEventListener('click', function() {
            const isOpen = menu.classList.contains('hidden');
            if (isOpen) {
                menu.classList.remove('hidden');
                menu.style.maxHeight = menu.scrollHeight + 'px'; // Smooth expand
                icon.setAttribute('icon', 'mdi:close'); // Ganti close icon ke mdi:close
                document.body.style.overflow = 'hidden'; // Prevent body scroll on mobile
            } else {
                menu.style.maxHeight = '0';
                setTimeout(() => {
                    menu.classList.add('hidden');
                    document.body.style.overflow = ''; // Restore body scroll
                }, 300);
                icon.setAttribute('icon', 'mdi:menu'); // Back to hamburger
            }
        });

        // Close on resize to desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                menu.classList.add('hidden');
                menu.style.maxHeight = '';
                icon.setAttribute('icon', 'mdi:menu');
                document.body.style.overflow = '';
            }
        });

        // Close mobile menu when clicking a link
        const mobileLinks = menu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                menu.style.maxHeight = '0';
                setTimeout(() => menu.classList.add('hidden'), 300);
                icon.setAttribute('icon', 'mdi:menu');
                document.body.style.overflow = '';
            });
        });
    });
</script>
