<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', 'Website resmi BPSMB Surakarta untuk informasi layanan pengujian dan sertifikasi mutu barang.')">
    <title>@yield('title', 'BPSMB Surakarta')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo2.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/logo2.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/logo2.png') }}">
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
</head>

<body class="min-h-screen bg-[#f5f5f7] font-sans text-[#1d1d1f] antialiased">
    <div data-page-loader
        class="pointer-events-none fixed inset-0 z-[9999] grid place-items-center bg-white opacity-0 transition duration-500">
        <div class="flex flex-col items-center gap-4">
            <img src="{{ asset('assets/logo.png') }}"
                alt="BPSMB Surakarta"
                class="h-16 w-16 object-contain">
            <div class="h-10 w-10 rounded-full border-4 border-[#e5eaf2] border-t-[#d4af37] animate-page-loader-spin" aria-hidden="true"></div>
            <p class="text-[13px] font-semibold text-[#08236f]">Memuat halaman...</p>
        </div>
    </div>

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    <div data-video-modal
        class="fixed inset-0 z-[9998] hidden place-items-center bg-black/82 px-4 py-6 backdrop-blur-sm">
        <button type="button" data-video-modal-close class="absolute inset-0 cursor-zoom-out" aria-label="Tutup video"></button>
        <div class="relative z-10 w-full max-w-5xl">
            <div class="aspect-video overflow-hidden rounded-[8px] bg-black shadow-[0_24px_80px_rgba(0,0,0,0.42)]" data-video-modal-frame></div>
            <p data-video-modal-title class="mt-3 rounded-[8px] bg-white/92 px-4 py-3 text-[14px] font-semibold leading-[1.35] text-[#08236f] shadow-[0_16px_48px_rgba(0,0,0,0.24)]"></p>
            <button type="button" data-video-modal-close
                class="absolute right-3 top-3 grid h-10 w-10 cursor-pointer place-items-center rounded-full bg-white/92 text-[22px] leading-none text-[#08236f] shadow-[0_12px_30px_rgba(0,0,0,0.24)]"
                aria-label="Tutup video">&times;</button>
        </div>
    </div>

    @if ($whatsappUrl ?? null)
        <a href="{{ $whatsappUrl }}"
            target="_blank"
            rel="noopener"
            data-whatsapp-floating
            aria-label="Hubungi melalui WhatsApp"
            class="pointer-events-none fixed bottom-[76px] right-5 z-40 grid h-12 w-12 translate-y-3 place-items-center rounded-full bg-[#25d366] text-white opacity-0 shadow-[0_16px_36px_rgba(18,140,76,0.28)] transition duration-200 hover:bg-[#1fb85a] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#25d366] sm:bottom-[92px] sm:right-7 sm:h-[52px] sm:w-[52px]">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M5.2 18.8 6.1 15.5A7.4 7.4 0 1 1 9 18.1l-3.8.7Z"
                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M9.2 8.4c.2-.4.4-.4.6-.4h.5c.2 0 .4 0 .5.4l.7 1.7c.1.3.1.5-.1.7l-.4.5c-.1.1-.2.3-.1.5.3.6.8 1.2 1.3 1.7.6.5 1.2.9 1.9 1.2.2.1.4.1.5-.1l.6-.7c.2-.2.4-.3.7-.2l1.6.8c.3.2.4.3.4.5 0 .5-.3 1.4-.8 1.8-.5.4-1.5.5-2.7 0-1.6-.6-3-1.6-4.2-2.8-1.2-1.2-2.2-2.8-2.6-4.1-.3-.9.2-1.8.6-2.1Z"
                    fill="currentColor" />
            </svg>
        </a>
    @endif

    <button type="button"
        data-back-to-top
        aria-label="Kembali ke atas"
        class="pointer-events-none fixed bottom-5 right-5 z-40 grid h-12 w-12 translate-y-3 place-items-center rounded-full bg-[#d4af37] text-white opacity-0 shadow-[0_16px_36px_rgba(8,35,111,0.22)] transition duration-200 hover:bg-[#b99018] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#f4d35e] sm:bottom-7 sm:right-7 sm:h-[52px] sm:w-[52px]">
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M12 19V5M5 12l7-7 7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </button>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        const initAos = () => {
            if (!window.AOS) {
                return;
            }

            window.AOS.init({
                duration: 700,
                easing: 'ease-out-cubic',
                once: true,
                offset: 80,
            });
        };

        window.addEventListener('load', initAos);
        window.addEventListener('pageshow', () => {
            if (window.AOS) {
                window.AOS.refreshHard();
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
