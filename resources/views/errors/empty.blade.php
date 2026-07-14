<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Konten Kosong' }} - BPSMB Surakarta</title>
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
                
                <!-- Icon Illustration -->
                <div class="mb-6 flex justify-center">
                    <div class="relative w-24 h-24 bg-white/5 rounded-full border border-white/10 flex items-center justify-center shadow-inner">
                        <!-- Subtle ring animation -->
                        <div class="absolute inset-0 rounded-full border border-[#d4af37]/20 animate-ping opacity-70" style="animation-duration: 3s;"></div>
                        
                        <!-- SVG empty box / empty document -->
                        @if(isset($icon) && $icon === 'search')
                            <!-- Search empty icon -->
                            <svg class="w-12 h-12 text-gray-300 stroke-[#d4af37] fill-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2" class="stroke-white" />
                            </svg>
                        @elseif(isset($icon) && $icon === 'document')
                            <!-- Document empty icon -->
                            <svg class="w-12 h-12 text-gray-300 stroke-[#d4af37] fill-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        @else
                            <!-- General empty inbox/box icon -->
                            <svg class="w-12 h-12 text-gray-300 stroke-[#d4af37] fill-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        @endif
                    </div>
                </div>

                <!-- Title & Description -->
                <div class="space-y-3 mb-8">
                    <h2 class="text-xl sm:text-2xl font-extrabold text-[#d4af37] tracking-tight">
                        {{ $title ?? 'Belum Ada Konten' }}
                    </h2>
                    <p class="text-sm text-gray-300 leading-relaxed">
                        {{ $message ?? 'Maaf, data atau informasi yang Anda cari belum tersedia saat ini. Silakan periksa kembali halaman ini nanti.' }}
                    </p>
                </div>

                <!-- Actions -->
                <div class="flex flex-col gap-3">
                    @if(isset($buttonUrl))
                        <a href="{{ $buttonUrl }}" 
                           class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-semibold rounded-xl text-white bg-[#08236f] hover:bg-[#0c3199] border-t border-white/10 shadow-[0_4px_20px_rgba(8,35,111,0.4)] hover:shadow-[0_6px_24px_rgba(8,35,111,0.6)] transition-all duration-300 hover:-translate-y-0.5 focus:outline-none">
                            {{ $buttonText ?? 'Kembali' }}
                        </a>
                    @else
                        <a href="{{ route('home') }}" 
                           class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-semibold rounded-xl text-white bg-[#08236f] hover:bg-[#0c3199] border-t border-white/10 shadow-[0_4px_20px_rgba(8,35,111,0.4)] hover:shadow-[0_6px_24px_rgba(8,35,111,0.6)] transition-all duration-300 hover:-translate-y-0.5 focus:outline-none">
                            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Kembali ke Beranda
                        </a>
                    @endif
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
