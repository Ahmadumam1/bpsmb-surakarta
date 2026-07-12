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
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        .logo-marquee-track {
            animation: logo-marquee 90s linear infinite;
        }

        .logo-marquee-track:hover {
            animation-play-state: paused;
        }
    </style>
@endonce

<section class="relative overflow-hidden bg-[#f5f5f7] py-5 sm:py-9" data-aos="fade-up">
    <div class="relative mx-auto max-w-7xl overflow-hidden px-4 sm:px-6 lg:px-8">
        <div class="overflow-hidden py-2 sm:py-3">
            <div class="flex w-max items-center logo-marquee-track">
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
