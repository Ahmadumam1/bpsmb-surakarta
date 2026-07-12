@php
    $commitmentSections = collect($sections ?? [])->filter();

    if ($commitmentSections->isEmpty() && $section) {
        $commitmentSections = collect([$section]);
    }

    $commitmentSlides = $commitmentSections->map(fn ($item) => [
        'subtitle' => $item?->subtitle ?: 'Komitmen Pelayanan',
        'title' => $item?->title ?: 'Maklumat Pelayanan',
        'statement' => $item?->statement ?: 'Dengan ini, kami menyatakan sanggup menyelenggarakan pelayanan sesuai Standar Pelayanan yang telah ditetapkan...',
        'description' => $item?->description ?: 'BPSMB Surakarta berkomitmen penuh untuk melakukan perbaikan secara terus menerus serta siap menerima sanksi sesuai peraturan perundang-undangan yang berlaku.',
        'image' => $item?->image_url ?: asset('assets/section1.jpg'),
    ])->values();

    if ($commitmentSlides->isEmpty()) {
        $commitmentSlides = collect([[
            'subtitle' => 'Komitmen Pelayanan',
            'title' => 'Maklumat Pelayanan',
            'statement' => 'Dengan ini, kami menyatakan sanggup menyelenggarakan pelayanan sesuai Standar Pelayanan yang telah ditetapkan...',
            'description' => 'BPSMB Surakarta berkomitmen penuh untuk melakukan perbaikan secara terus menerus serta siap menerima sanksi sesuai peraturan perundang-undangan yang berlaku.',
            'image' => asset('assets/section1.jpg'),
        ]]);
    }

    $firstCommitmentSlide = $commitmentSlides->first();
@endphp

<section class="relative overflow-hidden bg-cover bg-center bg-no-repeat" data-commitment-carousel style="background-image: url('{{ asset('assets/bg.jpg') }}')">
    <div class="absolute inset-0 bg-gradient-to-r from-[#f5f5f7]/88 via-[#f5f5f7]/72 to-[#f5f5f7]/52" aria-hidden="true"></div>
    <div class="relative mx-auto grid max-w-7xl items-center gap-8 px-4 py-12 sm:px-6 sm:py-20 lg:grid-cols-[1fr_420px] lg:gap-10 lg:px-8">
        <div data-aos="fade-right">
            <p class="flex items-center gap-3 text-[10px] font-semibold uppercase leading-none tracking-[0.12em] text-[#9a7a18] sm:gap-[14px] sm:text-[11px]">
                <span class="h-0.5 w-7 bg-[#08236f] sm:w-[34px]" aria-hidden="true"></span>
                <span data-commitment-subtitle>{{ $firstCommitmentSlide['subtitle'] }}</span>
            </p>
            <h2 class="mt-3 text-[28px] font-semibold leading-[1.12] text-[#08236f] transition duration-300 sm:mt-4 sm:text-[40px] sm:leading-[1.1]" data-commitment-title>
                {{ $firstCommitmentSlide['title'] }}
            </h2>
            <blockquote class="mt-5 max-w-3xl rounded-[8px] bg-white/58 px-4 py-4 text-[14px] leading-[1.55] tracking-[-0.12px] text-[#333333] shadow-[0_12px_30px_rgba(15,23,42,0.06)] transition duration-300 sm:mt-8 sm:rounded-[18px] sm:bg-transparent sm:px-6 sm:py-5 sm:text-[17px] sm:leading-[1.47] sm:tracking-[-0.374px] sm:shadow-none" data-commitment-statement>
                "{{ $firstCommitmentSlide['statement'] }}"
            </blockquote>
            <p class="mt-5 max-w-3xl text-[13px] leading-[1.55] tracking-[-0.12px] text-[#6b7280] transition duration-300 sm:mt-7 sm:text-[14px] sm:leading-[1.43] sm:tracking-[-0.224px] sm:text-[#7a7a7a]" data-commitment-description>
                {{ $firstCommitmentSlide['description'] }}
            </p>
            <div class="hidden sm:mt-8 sm:block sm:h-8 lg:h-12" aria-hidden="true"></div>
        </div>
        <div class="mx-auto w-full max-w-[230px] [perspective:1200px] sm:max-w-[320px]" data-aos="fade-left" data-aos-delay="120">
            <div class="bg-white p-3 shadow-[rgba(0,0,0,0.16)_3px_5px_24px_0] transition-transform duration-500 [transform-style:preserve-3d] sm:p-5 sm:shadow-[rgba(0,0,0,0.22)_3px_5px_30px_0]" data-commitment-flip-card>
                <img src="{{ $firstCommitmentSlide['image'] }}"
                    alt="{{ $firstCommitmentSlide['title'] }}"
                    class="aspect-[3/4] w-full border border-[#e0e0e0] object-cover [backface-visibility:hidden]"
                    data-commitment-image>
            </div>
        </div>
    </div>
    <script type="application/json" data-commitment-slides>@json($commitmentSlides)</script>
</section>

@if ($commitmentSlides->count() > 1)
    @push('scripts')
        <script>
            document.querySelectorAll('[data-commitment-carousel]').forEach((carousel) => {
                const slidesData = carousel.querySelector('[data-commitment-slides]');
                const slides = JSON.parse(slidesData?.textContent || '[]');

                if (slides.length < 2) {
                    return;
                }

                const subtitle = carousel.querySelector('[data-commitment-subtitle]');
                const title = carousel.querySelector('[data-commitment-title]');
                const statement = carousel.querySelector('[data-commitment-statement]');
                const description = carousel.querySelector('[data-commitment-description]');
                const image = carousel.querySelector('[data-commitment-image]');
                const flipCard = carousel.querySelector('[data-commitment-flip-card]');
                let activeIndex = 0;
                let timer = null;

                const setTextOpacity = (opacity) => {
                    [title, statement, description].forEach((element) => {
                        element.style.opacity = opacity;
                        element.style.transform = opacity ? 'translateY(0)' : 'translateY(8px)';
                    });
                };

                const showSlide = (nextIndex) => {
                    if (nextIndex === activeIndex) {
                        return;
                    }

                    const nextSlide = slides[nextIndex];
                    setTextOpacity(0);
                    flipCard.style.transform = 'rotateY(90deg)';

                    window.setTimeout(() => {
                        subtitle.textContent = nextSlide.subtitle;
                        title.textContent = nextSlide.title;
                        statement.textContent = `"${nextSlide.statement}"`;
                        description.textContent = nextSlide.description;
                        image.src = nextSlide.image;
                        image.alt = nextSlide.title;
                        flipCard.style.transform = 'rotateY(0deg)';
                        setTextOpacity(1);
                        activeIndex = nextIndex;
                    }, 260);
                };

                const startTimer = () => {
                    timer = window.setInterval(() => {
                        showSlide((activeIndex + 1) % slides.length);
                    }, 5200);
                };

                startTimer();
            });
        </script>
    @endpush
@endif
