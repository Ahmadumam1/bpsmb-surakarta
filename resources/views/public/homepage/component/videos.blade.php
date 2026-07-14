@php
    $featuredVideo = $videoSections->first();
    $sideVideos = $videoSections->skip(1)->take(3);
    $hasRealVideos = $videoSections->isNotEmpty();
    $defaultVideos = collect([
        ['date' => '15 Okt 2023', 'title' => 'Sosialisasi Akreditasi Laboratorium KAN'],
        ['date' => '10 Okt 2023', 'title' => 'Prosedur Kalibrasi Alat Ukur Industri'],
        ['date' => '05 Okt 2023', 'title' => 'Kunjungan Kerja Dinas Perindustrian'],
    ]);
@endphp

<section id="galeri-video" class="relative overflow-hidden bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('assets/bg.jpg') }}')">
    <div class="absolute inset-0 bg-gradient-to-r from-[#f5f5f7]/90 via-[#f5f5f7]/76 to-[#f5f5f7]/56" aria-hidden="true"></div>
    <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 sm:py-16 lg:px-8 lg:py-[72px]">
        <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between md:gap-6" data-aos="fade-up">
            <div>
                <p class="flex items-center gap-3 text-[10px] font-semibold uppercase leading-none tracking-[0.12em] text-[#9a7a18] sm:gap-[14px] sm:text-[11px]">
                    <span class="h-0.5 w-7 bg-[#08236f] sm:w-[34px]" aria-hidden="true"></span>
                    Media Digital
                </p>
                <div class="mt-3 sm:mt-4">
                    <h2 class="text-[28px] font-semibold leading-[1.12] text-[#08236f] sm:text-[40px] sm:leading-[1.1]">Galeri Video</h2>
                    <p class="mt-3 max-w-2xl text-[13px] leading-[1.55] tracking-[-0.12px] text-[#6b7280] sm:mt-4 sm:text-[14px] sm:leading-[1.43] sm:tracking-[-0.224px] sm:text-[#7a7a7a]">
                        Dokumentasi kegiatan dan sosialisasi layanan BPSMB Surakarta untuk transparansi dan edukasi publik.
                    </p>
                </div>
            </div>
            <a href="{{ route('media.video.index') }}"
                class="hidden min-h-11 items-center justify-center rounded-[8px] bg-[#d4af37] px-5 py-2.5 text-[14px] font-semibold leading-[1.29] tracking-[-0.224px] text-white shadow-[0_16px_36px_rgba(212,175,55,0.24)] transition-colors transition-transform hover:bg-[#b99018] active:scale-95 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-[3px] focus-visible:outline-[#f4d35e] md:inline-flex">Lihat Semua &rarr;</a>
        </div>

        {{-- Grid: 2 kolom hanya jika ada video di sidebar, atau tidak ada video sama sekali (mode dummy) --}}
        <div class="mt-8 grid gap-8 sm:mt-10 {{ ($sideVideos->isNotEmpty() || !$hasRealVideos) ? 'lg:grid-cols-[1fr_340px]' : '' }}">
            <div data-aos="fade-up" class="{{ ($sideVideos->isEmpty() && $hasRealVideos) ? 'mx-auto w-full max-w-3xl' : '' }}">
            <a href="{{ $featuredVideo?->embed_url ?: '#galeri-video' }}"
                data-video-modal-open
                data-video-embed-url="{{ $featuredVideo?->embed_url }}"
                data-video-title="{{ $featuredVideo?->title ?? 'Profil Balai Pengujian dan Sertifikasi Mutu Barang Surakarta' }}"
                class="relative flex aspect-video min-h-0 items-end overflow-hidden rounded-[8px] shadow-[0_8px_24px_rgba(15,23,42,0.10)] transition-transform transition-shadow hover:-translate-y-1 hover:shadow-[0_18px_42px_rgba(15,23,42,0.16)] {{ ($sideVideos->isEmpty() && $hasRealVideos) ? 'lg:aspect-video' : 'lg:aspect-auto lg:min-h-[430px]' }}" data-aos="zoom-in" data-aos-delay="120">
                <img src="{{ $featuredVideo?->image_url ?: asset('assets/section1.jpg') }}"
                    alt="{{ $featuredVideo?->title ?? 'Profil Balai Pengujian dan Sertifikasi Mutu Barang Surakarta' }}"
                    class="absolute inset-0 h-full w-full object-cover">
                <span class="absolute inset-0 bg-gradient-to-t from-black/82 via-black/30 to-transparent"></span>
                <span class="absolute left-1/2 top-1/2 grid h-12 w-12 -translate-x-1/2 -translate-y-1/2 place-items-center rounded-full bg-white/92 text-[#08236f] shadow-lg sm:h-16 sm:w-16">
                    <svg class="ml-1 h-5 w-5 sm:h-7 sm:w-7" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M8 5.5v13l10-6.5-10-6.5Z" />
                    </svg>
                </span>
                <div class="relative z-10 w-full bg-gradient-to-t from-black/82 via-black/30 to-transparent p-4 text-white sm:p-8">
                    <span class="rounded-[5px] bg-[#d4af37] px-2.5 py-1 text-[9px] font-semibold uppercase tracking-[0.14em] sm:px-3 sm:text-[10px]">
                        Featured
                    </span>
                    <h3 class="mt-3 line-clamp-2 max-w-2xl text-[17px] font-semibold leading-[1.22] tracking-[-0.12px] sm:mt-5 sm:text-[34px] sm:leading-[1.18] sm:tracking-[-0.374px]">
                        {{ $featuredVideo?->title ?? 'Profil Balai Pengujian dan Sertifikasi Mutu Barang Surakarta' }}
                    </h3>
                    <p class="mt-2 text-[12px] leading-[1.4] tracking-[-0.12px] text-white/72 sm:mt-5 sm:text-[14px] sm:leading-[1.43] sm:tracking-[-0.224px]">
                        {{ $featuredVideo?->description ?? '5:24 - 2.4K Views' }}
                    </p>
                </div>
            </a>
            </div>

            {{-- Sidebar: tampil jika ada video lebih dari 1, atau jika tidak ada video sama sekali (dummy) --}}
            @if ($sideVideos->isNotEmpty() || !$hasRealVideos)
            <aside class="self-end" data-aos="fade-left" data-aos-delay="160">
            @forelse ($sideVideos as $video)
                <a href="{{ $video->embed_url ?: '#galeri-video' }}"
                    data-video-modal-open
                    data-video-embed-url="{{ $video->embed_url }}"
                    data-video-title="{{ $video->title }}"
                    class="mb-6 grid grid-cols-[112px_1fr] gap-4 rounded-[8px] bg-white p-2 shadow-[0_8px_24px_rgba(15,23,42,0.10)] transition-transform transition-shadow hover:-translate-y-1 hover:shadow-[0_18px_42px_rgba(15,23,42,0.16)]">
                    <span class="relative h-20 overflow-hidden rounded-[8px] bg-[#f5f5f7]">
                        <img src="{{ $video->image_url ?: asset('assets/section1.jpg') }}" alt="{{ $video->title }}"
                            class="h-full w-full object-cover">
                        <span class="absolute inset-0 grid place-items-center bg-black/18 text-white">
                            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M8 5.5v13l10-6.5-10-6.5Z" />
                            </svg>
                        </span>
                    </span>
                    <span>
                        <span class="block text-[12px] leading-none tracking-[-0.12px] text-[#7a7a7a]">
                            {{ $video->category ?: 'Video' }}
                        </span>
                        <span class="mt-2 block text-[14px] font-semibold leading-[1.29] tracking-[-0.224px] text-[#1d1d1f]">
                            {{ $video->title }}
                        </span>
                        <span class="mt-1 block text-[12px] leading-none tracking-[-0.12px] text-[#7a7a7a]">
                            {{ $video->description ?: 'Dokumentasi BPSMB Surakarta' }}
                        </span>
                    </span>
                </a>
            @empty
                {{-- Dummy hanya muncul jika benar-benar tidak ada video sama sekali --}}
                @if (!$hasRealVideos)
                    @foreach ($defaultVideos as $video)
                        <a href="#galeri-video" class="mb-6 grid grid-cols-[112px_1fr] gap-4 rounded-[8px] bg-white p-2 shadow-[0_8px_24px_rgba(15,23,42,0.10)] transition-transform transition-shadow hover:-translate-y-1 hover:shadow-[0_18px_42px_rgba(15,23,42,0.16)]">
                            <img src="{{ asset('assets/section1.jpg') }}" alt="{{ $video['title'] }}"
                                class="h-20 w-full rounded-[8px] object-cover">
                            <span>
                                <span class="block text-[12px] leading-none tracking-[-0.12px] text-[#7a7a7a]">{{ $video['date'] }}</span>
                                <span class="mt-2 block text-[14px] font-semibold leading-[1.29] tracking-[-0.224px] text-[#1d1d1f]">{{ $video['title'] }}</span>
                                <span class="mt-1 block text-[12px] leading-none tracking-[-0.12px] text-[#7a7a7a]">Duration: 3:45</span>
                            </span>
                        </a>
                    @endforeach
                @endif
            @endforelse
            </aside>
            @endif
        </div>

        <a href="{{ route('media.video.index') }}"
            class="mt-8 inline-flex min-h-11 w-full items-center justify-center rounded-[8px] bg-[#d4af37] px-5 py-2.5 text-[14px] font-semibold leading-[1.29] tracking-[-0.224px] text-white shadow-[0_16px_36px_rgba(212,175,55,0.24)] transition-colors transition-transform hover:bg-[#b99018] active:scale-95 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-[3px] focus-visible:outline-[#f4d35e] md:hidden">Lihat Semua Video &rarr;</a>
    </div>
</section>
