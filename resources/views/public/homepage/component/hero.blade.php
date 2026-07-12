@php
    $heroSections = isset($sections) ? $sections->filter()->values() : collect([$section])->filter()->values();

    $heroSlides = $heroSections->flatMap(function ($item) {
        $images = collect([
            $item->image_url,
            $item->image_2_url,
            $item->image_3_url,
        ])->filter()->values();

        if ($images->isEmpty()) {
            $images = collect([asset('assets/section1.jpg')]);
        }

        return $images->map(fn ($image) => [
            'subtitle' => $item->subtitle ?: 'Balai Pengujian & Sertifikasi Mutu Barang',
            'title' => $item->title ?: 'Menjamin Integritas Mutu Untuk Produk Daerah Berdaya Saing Global',
            'description' => $item->description ?: 'Layanan teknis pengujian, kalibrasi, dan sertifikasi terakreditasi untuk memastikan standar kualitas produk unggulan Anda.',
            'image' => $image,
            'primary_label' => $item->primary_button_label ?: 'Layanan Kami',
            'primary_url' => $item->primary_button_url ?: route('services.index'),
            'secondary_label' => $item->secondary_button_label ?: 'Profil',
            'secondary_url' => $item->secondary_button_url ?: route('profile.pendahuluan'),
        ]);
    })->values();

    if ($heroSlides->isEmpty()) {
        $heroSlides = collect([[
            'subtitle' => 'Balai Pengujian & Sertifikasi Mutu Barang',
            'title' => 'Menjamin Integritas Mutu Untuk Produk Daerah Berdaya Saing Global',
            'description' => 'Layanan teknis pengujian, kalibrasi, dan sertifikasi terakreditasi untuk memastikan standar kualitas produk unggulan Anda.',
            'image' => asset('assets/section1.jpg'),
            'primary_label' => 'Layanan Kami',
            'primary_url' => route('services.index'),
            'secondary_label' => 'Profil',
            'secondary_url' => route('profile.pendahuluan'),
        ]]);
    }

    $heroCopy = $heroSlides->first();
@endphp

<section class="relative min-h-[300px] overflow-hidden bg-black text-white sm:min-h-0" data-home-hero data-slides='@json($heroSlides)'>
    <div class="absolute inset-0">
        <div class="absolute inset-0 flex will-change-transform" data-hero-bg-track
            style="width: {{ $heroSlides->count() * 100 }}%; transition: transform 1200ms cubic-bezier(0.77, 0, 0.175, 1);">
            @foreach ($heroSlides as $slide)
                <div class="h-full flex-1 bg-cover bg-center"
                    style="background-image: linear-gradient(90deg, rgba(0, 0, 0, 0.72), rgba(0, 0, 0, 0.36) 52%, rgba(0, 0, 0, 0.18)), url('{{ $slide['image'] }}')">
                </div>
            @endforeach
        </div>
        <div class="absolute inset-0 bg-black/10"></div>
    </div>
    <div class="absolute inset-x-0 bottom-0 h-28 bg-gradient-to-t from-black/18 to-transparent"></div>
    <div class="mx-auto grid min-h-[300px] max-w-7xl px-4 py-5 sm:min-h-0 sm:px-6 sm:py-14 lg:min-h-[560px] lg:px-8">
        <div class="relative z-10 flex max-w-xl flex-col justify-center sm:py-10" data-hero-copy data-aos="fade-up">
            <span class="w-fit max-w-full rounded-full bg-white/94 px-3 py-1.5 text-[9px] font-semibold uppercase tracking-[0.10em] text-[#08236f] shadow-[0_12px_30px_rgba(0,0,0,0.18)] sm:px-4 sm:py-2 sm:text-[11px]">
                {{ $heroCopy['subtitle'] }}
            </span>
            <h1 class="mt-3 text-[22px] font-semibold leading-[1.12] tracking-[-0.28px] text-white drop-shadow-[0_3px_14px_rgba(0,0,0,0.38)] sm:mt-7 sm:text-[40px] sm:leading-[1.07]">
                {{ $heroCopy['title'] }}
            </h1>
            <p class="mt-3 max-w-lg text-[12px] leading-[1.45] tracking-[-0.12px] text-white/90 drop-shadow-[0_2px_10px_rgba(0,0,0,0.32)] sm:mt-6 sm:text-[17px] sm:leading-[1.47] sm:tracking-[-0.374px] sm:text-white/86">
                {{ $heroCopy['description'] }}
            </p>
            <div class="mt-5 flex flex-wrap gap-3 sm:mt-8 sm:gap-4">
                <a href="{{ $heroCopy['primary_url'] }}"
                    class="inline-flex min-h-10 items-center justify-center rounded-[8px] bg-[#08236f] px-4 py-2.5 text-[13px] font-semibold leading-[1.29] tracking-[-0.224px] text-white shadow-[0_16px_36px_rgba(0,0,0,0.24)] transition-colors transition-transform hover:bg-[#0b2f93] active:scale-95 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-[3px] focus-visible:outline-white sm:min-h-11 sm:px-[22px] sm:py-[11px] sm:text-[14px]">
                    {{ $heroCopy['primary_label'] }} &rarr;
                </a>
                <a href="{{ $heroCopy['secondary_url'] }}"
                    class="inline-flex min-h-10 items-center justify-center rounded-[8px] border border-white/80 bg-white/92 px-4 py-2.5 text-[13px] font-semibold leading-[1.29] tracking-[-0.224px] text-[#08236f] shadow-[0_14px_34px_rgba(0,0,0,0.22)] backdrop-blur-sm transition-colors transition-transform hover:bg-white active:scale-95 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-[3px] focus-visible:outline-white sm:min-h-11 sm:px-[22px] sm:py-[11px] sm:text-[14px]">
                    {{ $heroCopy['secondary_label'] }}
                </a>
            </div>
        </div>

    </div>
</section>

@if ($heroSlides->count() > 1)
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const hero = document.querySelector('[data-home-hero]');

                if (!hero) {
                    return;
                }

                const slides = JSON.parse(hero.dataset.slides || '[]');

                if (slides.length <= 1) {
                    return;
                }

                const bgTrack = hero.querySelector('[data-hero-bg-track]');
                let activeIndex = 0;
                let timer = null;

                const setSlide = (index) => {
                    const slide = slides[index];

                    if (!slide || index === activeIndex) {
                        return;
                    }

                    activeIndex = index;

                    if (bgTrack) {
                        bgTrack.style.transform = `translate3d(-${index * (100 / slides.length)}%, 0, 0)`;
                    }

                    if (window.AOS) {
                        window.AOS.refresh();
                    }
                };

                const startTimer = () => {
                    window.clearInterval(timer);
                    timer = window.setInterval(() => {
                        setSlide((activeIndex + 1) % slides.length);
                    }, 5200);
                };

                startTimer();
            });
        </script>
    @endpush
@endif
