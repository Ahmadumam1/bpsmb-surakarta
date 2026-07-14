<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Tidak Ditemukan - BPSMB Surakarta</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo2.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/logo2.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/logo2.png') }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
</head>

<body class="h-full bg-[#030a1e] font-sans antialiased text-white overflow-hidden flex flex-col justify-between">
    <!-- Background glowing orbs -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-[#08236f]/30 rounded-full blur-[128px] animate-pulse" style="animation-duration: 6s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-[#d4af37]/5 rounded-full blur-[150px]"></div>
        <div class="absolute -bottom-40 -right-40 w-[400px] h-[400px] bg-[#08236f]/20 rounded-full blur-[128px] animate-pulse" style="animation-duration: 8s;"></div>
    </div>

    <!-- Header Logo -->
    <header class="relative z-10 w-full pt-8 px-6 flex justify-center">
        <a href="{{ route('home') }}" class="flex items-center gap-3 transition-transform duration-300 hover:scale-105">
            <img src="{{ asset('assets/logo2.png') }}" alt="BPSMB Surakarta" class="h-12 w-12 object-contain drop-shadow-[0_4px_12px_rgba(8,35,111,0.2)]">
            <div class="text-left leading-none">
                <span class="block text-sm font-bold tracking-wider text-white uppercase">BPSMB</span>
                <span class="block text-[10px] tracking-widest text-[#d4af37] font-semibold uppercase">Surakarta</span>
            </div>
        </a>
    </header>

    <!-- Main Content -->
    <main class="relative z-10 flex-grow flex items-center justify-center p-4">
        <div class="max-w-md w-full text-center" data-aos="fade-up" data-aos-duration="1000">
            <!-- Glass Card -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8 sm:p-10 shadow-[0_24px_60px_rgba(0,0,0,0.4)] relative overflow-hidden">
                <!-- Golden edge glow line -->
                <div class="absolute top-0 inset-x-0 h-[2px] bg-gradient-to-r from-transparent via-[#d4af37]/60 to-transparent"></div>
                
                <!-- Giant 404 Text -->
                <div class="relative mb-6 inline-block">
                    <h1 class="text-[100px] sm:text-[130px] font-black leading-none tracking-tight bg-gradient-to-r from-[#d4af37] via-white to-[#08236f] bg-clip-text text-transparent select-none drop-shadow-[0_10px_20px_rgba(0,0,0,0.3)]">
                        404
                    </h1>
                </div>

                <!-- Error Title & Description -->
                <div class="space-y-3 mb-8">
                    <h2 class="text-xl sm:text-2xl font-extrabold text-[#d4af37] tracking-tight">
                        Halaman Tidak Ditemukan
                    </h2>
                    <p class="text-sm text-gray-300 leading-relaxed">
                        Maaf, halaman yang Anda tuju tidak tersedia, telah dihapus, atau dialihkan ke alamat lain.
                    </p>
                </div>

                <!-- Visual Compass SVG -->
                <div class="mb-8 flex justify-center">
                    <div class="relative w-28 h-28 bg-white/5 rounded-full border border-white/10 flex items-center justify-center shadow-inner group">
                        <svg class="w-16 h-16 text-gray-400 stroke-[#d4af37] fill-none transition-transform duration-1000 group-hover:rotate-180" viewBox="0 0 24 24" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="9" stroke-dasharray="2 2" stroke="gray"></circle>
                            <circle cx="12" cy="12" r="8" class="stroke-white/30"></circle>
                            <line x1="12" y1="3" x2="12" y2="5" class="stroke-white/50"></line>
                            <line x1="12" y1="19" x2="12" y2="21" class="stroke-white/50"></line>
                            <polygon points="12,7 14,12 12,17 10,12" class="fill-[#d4af37]/10 stroke-[#d4af37]" stroke-width="1"></polygon>
                            <path d="M12 7 L14 11 L12 10 L10 11 Z" class="fill-[#d4af37] stroke-[#d4af37]"></path>
                            <path d="M12 17 L14 13 L12 14 L10 13 Z" class="fill-white/20 stroke-white/20"></path>
                            <circle cx="12" cy="12" r="1.5" class="fill-white stroke-[#08236f]" stroke-width="2"></circle>
                        </svg>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col gap-3">
                    <a href="{{ route('home') }}" 
                       class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-semibold rounded-xl text-white bg-[#08236f] hover:bg-[#0c3199] border-t border-white/10 shadow-[0_4px_20px_rgba(8,35,111,0.4)] hover:shadow-[0_6px_24px_rgba(8,35,111,0.6)] transition-all duration-300 hover:-translate-y-0.5 focus:outline-none">
                        <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer Copyright -->
    <footer class="relative z-10 w-full pb-8 px-6 text-center text-xs text-gray-500">
        <p>&copy; {{ date('Y') }} BPSMB Surakarta. Hak Cipta Dilindungi.</p>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        window.addEventListener('load', () => {
            if (window.AOS) {
                window.AOS.init({
                    duration: 800,
                    easing: 'ease-out-cubic',
                    once: true,
                });
            }
        });
    </script>
</body>

</html>
