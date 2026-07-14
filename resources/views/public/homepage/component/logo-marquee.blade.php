@php
    $defaultMarqueeLogos = collect([
        [
            'name' => 'BPSMB Surakarta',
            'image' => asset('assets/logo.png'),
            'url' => url('/'),
        ],
    ]);

    $displayMarqueeLogos = isset($marqueeLogos) && $marqueeLogos->isNotEmpty()
        ? $marqueeLogos->map(fn ($logo) => [
            'name' => $logo->name,
            'image' => $logo->image_url ?: asset('assets/logo.png'),
            'url' => $logo->url ?: url('/'),
        ])
        : $defaultMarqueeLogos;

    $marqueeSequence = $displayMarqueeLogos
        ->concat($displayMarqueeLogos)
        ->concat($displayMarqueeLogos);
@endphp

@once
    <style>
        @keyframes logo-marquee {
            from { transform: translateX(0); }
            to   { transform: translateX(-50%); }
        }

        /* Wrapper: cursor grab, no text selection saat drag */
        .logo-marquee-outer {
            overflow: hidden;
            cursor: grab;
            user-select: none;
            -webkit-user-select: none;
        }
        .logo-marquee-outer.dragging {
            cursor: grabbing;
        }

        /* Track: auto-scroll by default */
        .logo-marquee-track {
            animation: logo-marquee 90s linear infinite;
            will-change: transform;
        }

        /* Pause saat hover logo — dikontrol via JS agar konsisten dengan inline style */

        /* Nonaktifkan klik link saat sedang drag */
        .logo-marquee-outer.dragging .logo-marquee-track a {
            pointer-events: none;
        }
    </style>
@endonce

<section class="relative overflow-hidden bg-[#f5f5f7] py-5 sm:py-9" data-aos="fade-up">
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Wrapper draggable --}}
        <div class="logo-marquee-outer py-2 sm:py-3" id="marqueeOuter">
            <div class="flex w-max items-center logo-marquee-track" id="marqueeTrack">
                @foreach ([1, 2] as $loopIndex)
                    <div class="flex items-center gap-3 pr-3 sm:gap-4 sm:pr-4" @if ($loopIndex === 2) aria-hidden="true" @endif>
                        @foreach ($marqueeSequence as $logo)
                            @php
                                $isExternalLink = str_starts_with($logo['url'], 'http://') || str_starts_with($logo['url'], 'https://');
                            @endphp
                            <a href="{{ $logo['url'] }}"
                                aria-label="{{ $logo['name'] }}"
                                @if ($isExternalLink) target="_blank" rel="noopener noreferrer" @endif
                                @if ($loopIndex === 2) tabindex="-1" @endif
                                class="flex h-16 w-56 shrink-0 items-center gap-2 rounded-[8px] bg-white px-1.5 transition duration-200 hover:-translate-y-0.5 hover:ring-1 hover:ring-[#d4af37] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#f4d35e] sm:h-20 sm:w-64 sm:gap-3 sm:px-2">
                                <img src="{{ $logo['image'] }}"
                                    alt=""
                                    class="max-h-16 w-auto max-w-16 shrink-0 object-contain sm:max-h-20 sm:max-w-20">
                                <span class="min-w-0 text-left text-[14px] font-semibold leading-[1.25] text-[#08236f] sm:text-[16px]">
                                    {{ $logo['name'] }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@once
<script>
(function () {
    function initMarqueeDrag() {
        const outer = document.getElementById('marqueeOuter');
        const track = document.getElementById('marqueeTrack');
        if (!outer || !track) return;

        const ANIMATION_DURATION = 90; // detik, harus sama dengan CSS

        let isDragging = false;
        let startX    = 0;
        let baseX     = 0;   // translateX saat drag dimulai
        let currentX  = 0;   // translateX terakhir
        let velX      = 0;   // velocity untuk momentum
        let lastX     = 0;
        let lastTime  = 0;
        let rafId     = null;

        /** Baca nilai translateX saat ini dari computed style (posisi animasi berjalan) */
        function getComputedTranslateX() {
            const mat = new DOMMatrixReadOnly(window.getComputedStyle(track).transform);
            return mat.m41;
        }

        /** Freeze animasi & ambil posisi saat ini */
        function freezeTrack() {
            currentX = getComputedTranslateX();
            track.style.animationPlayState = 'paused';
            // Tempel posisi langsung supaya tidak loncat
            track.style.transform = `translateX(${currentX}px)`;
            // Matikan animasi agar transform manual bisa bekerja
            track.style.animation = 'none';
        }

        /** Lanjutkan animasi dari posisi currentX secara mulus */
        function resumeTrack(x) {
            const halfWidth = track.scrollWidth / 2;
            // Normalkan agar tetap dalam range [−halfWidth, 0]
            let normalized = x % -halfWidth;
            if (normalized > 0) normalized -= halfWidth;

            const progress  = Math.abs(normalized) / halfWidth; // 0‒1
            const delay     = -(progress * ANIMATION_DURATION);  // delay negatif = mulai di tengah

            track.style.transform        = '';
            track.style.animation        = `logo-marquee ${ANIMATION_DURATION}s linear infinite`;
            track.style.animationDelay   = `${delay}s`;
            track.style.animationPlayState = 'running';
        }

        /** Gerakkan track secara manual */
        function moveTo(x) {
            const halfWidth = track.scrollWidth / 2;
            // Batas: tidak melebihi 0 ke kanan, tidak melebihi -halfWidth ke kiri
            x = Math.max(-halfWidth, Math.min(0, x));
            currentX = x;
            track.style.transform = `translateX(${x}px)`;
        }

        /** Momentum setelah lepas drag */
        function momentumScroll() {
            velX *= 0.92; // friction
            moveTo(currentX + velX);
            if (Math.abs(velX) > 0.3) {
                rafId = requestAnimationFrame(momentumScroll);
            } else {
                resumeTrack(currentX);
            }
        }

        /* ---- START ---- */
        function onStart(x) {
            cancelAnimationFrame(rafId);
            freezeTrack();
            isDragging = true;
            startX   = x;
            baseX    = currentX;
            velX     = 0;
            lastX    = x;
            lastTime = performance.now();
            outer.classList.add('dragging');
        }

        /* ---- MOVE ---- */
        function onMove(x) {
            if (!isDragging) return;
            const now   = performance.now();
            const dt    = now - lastTime || 1;
            velX        = ((x - lastX) / dt) * 16; // normalkan ke ~60fps
            lastX       = x;
            lastTime    = now;
            moveTo(baseX + (x - startX));
        }

        /* ---- END ---- */
        function onEnd() {
            if (!isDragging) return;
            isDragging = false;
            outer.classList.remove('dragging');
            // Momentum lembut lalu lanjutkan animasi
            rafId = requestAnimationFrame(momentumScroll);
        }

        // Mouse
        outer.addEventListener('mousedown',  (e) => { e.preventDefault(); onStart(e.clientX); });
        window.addEventListener('mousemove', (e) => { onMove(e.clientX); });
        window.addEventListener('mouseup',   ()  => { onEnd(); });

        // Touch
        outer.addEventListener('touchstart', (e) => { onStart(e.touches[0].clientX); }, { passive: true });
        outer.addEventListener('touchmove',  (e) => { onMove(e.touches[0].clientX); },  { passive: true });
        outer.addEventListener('touchend',   ()  => { onEnd(); });

        // Hover pause/resume — dikontrol JS agar tidak bentrok dengan inline style
        track.addEventListener('mouseenter', () => {
            if (!isDragging) track.style.animationPlayState = 'paused';
        });
        track.addEventListener('mouseleave', () => {
            if (!isDragging) track.style.animationPlayState = 'running';
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMarqueeDrag);
    } else {
        initMarqueeDrag();
    }
})();
</script>
@endonce
