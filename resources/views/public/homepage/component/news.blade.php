<section id="berita-terkini" class="border-y border-[#e0e0e0] bg-white">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 sm:py-16 lg:px-8 lg:py-[72px]">
        <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between md:gap-6" data-aos="fade-up">
            <div>
                <p class="flex items-center gap-3 text-[10px] font-semibold uppercase leading-none tracking-[0.12em] text-[#9a7a18] sm:gap-[14px] sm:text-[11px]">
                    <span class="h-0.5 w-7 bg-[#08236f] sm:w-[34px]" aria-hidden="true"></span>
                    Informasi Terbaru
                </p>
                <h2 class="mt-3 text-[28px] font-semibold leading-[1.12] text-[#08236f] sm:mt-4 sm:text-[40px] sm:leading-[1.1]">Berita Terkini</h2>
                <p class="mt-3 max-w-2xl text-[13px] leading-[1.55] tracking-[-0.12px] text-[#6b7280] sm:mt-4 sm:text-[14px] sm:leading-[1.43] sm:tracking-[-0.224px] sm:text-[#7a7a7a]">
                    Update terbaru mengenai kegiatan, pengumuman, dan layanan BPSMB Surakarta.
                </p>
            </div>
            <a href="{{ route('media.news.index') }}"
                class="hidden min-h-11 items-center justify-center rounded-[8px] bg-[#d4af37] px-5 py-2.5 text-[14px] font-semibold leading-[1.29] tracking-[-0.224px] text-white shadow-[0_16px_36px_rgba(212,175,55,0.24)] transition-colors transition-transform hover:bg-[#b99018] active:scale-95 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-[3px] focus-visible:outline-[#f4d35e] md:inline-flex">Lihat Semua &rarr;</a>
        </div>

        <div class="mt-7 grid gap-5 sm:mt-10 sm:grid-cols-2 sm:gap-7 lg:grid-cols-4">
            @forelse ($latestNews as $news)
                <article class="group overflow-hidden rounded-[8px] border border-black/5 bg-white text-[#1d1d1f] shadow-[0_8px_24px_rgba(15,23,42,0.10)] transition-transform transition-colors transition-shadow hover:-translate-y-1 hover:border-black/10 hover:shadow-[0_18px_42px_rgba(15,23,42,0.16)]" data-aos="fade-up" data-aos-delay="{{ $loop->index * 90 }}">
                    <a href="{{ route('media.news.show', $news) }}" class="flex h-full flex-col">
                        <!-- Image Container with Absolute Category Badge -->
                        <div class="relative overflow-hidden w-full h-34 sm:h-44 lg:h-48 bg-gray-50">
                            <span style="background-color: rgba(8, 35, 111, 0.9);" class="absolute top-3 left-3 z-10 rounded-[5px] px-2.5 py-1 text-[10px] font-semibold uppercase tracking-[0.12em] text-white">
                                {{ $news->category?->name ?? 'Berita' }}
                            </span>
                            <img src="{{ $news->thumbnail_url ?: asset('assets/section1.jpg') }}" alt="{{ $news->title }}"
                                class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        
                        <!-- Card Content -->
                        <div class="flex flex-1 flex-col p-4 sm:p-6">
                            <div class="flex items-center justify-between w-full gap-2">
                                <div class="flex items-center gap-1.5">
                                    <svg class="h-3.5 w-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-[12px] font-medium leading-none text-[#7a7a7a]">
                                        {{ $news->published_at?->locale('id')->translatedFormat('d F Y') }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-1.5 text-[#7a7a7a]">
                                    <svg class="h-3.5 w-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span class="text-[12px] font-medium leading-none">
                                        {{ number_format($news->views ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                            <h3 class="mt-3 line-clamp-2 text-[14px] font-semibold leading-[1.3] tracking-[-0.12px] text-[#1d1d1f] sm:mt-4 sm:text-[16px] sm:leading-[1.25] sm:tracking-[-0.12px] lg:text-[17px]">
                                {{ $news->title }}
                            </h3>
                            <p class="mt-2 line-clamp-3 text-[13px] leading-[1.5] tracking-[-0.12px] text-[#6b7280] sm:mt-3 sm:text-[13px] sm:leading-[1.48] sm:tracking-[-0.12px] sm:text-[#7a7a7a]">
                                {{ $news->excerpt ?: Str::limit(strip_tags($news->content), 130) }}
                            </p>
                            <span class="mt-auto self-end pt-4 text-[13px] font-semibold leading-[1.29] tracking-[-0.12px] text-[#d4af37] sm:pt-5 sm:text-[14px] sm:font-normal sm:tracking-[-0.224px]">
                                Selengkapnya &rarr;
                            </span>
                        </div>
                    </a>
                </article>
            @empty
                @foreach ([['Berita', 'Update Layanan BPSMB Surakarta', 'Informasi terbaru mengenai layanan, kegiatan, dan pengumuman BPSMB Surakarta.'], ['Layanan', 'Pembaruan Alur Kalibrasi Alat Ukur Industri', 'Informasi alur layanan kalibrasi untuk membantu pelanggan menyiapkan dokumen dan jadwal.'], ['Kegiatan', 'Sosialisasi Standar Mutu Ekspor Komoditas', 'Kegiatan edukasi mutu barang untuk mendukung daya saing produk daerah.']] as [$tag, $title, $copy])
                    <article class="group overflow-hidden rounded-[8px] border border-black/5 bg-white text-[#1d1d1f] shadow-[0_8px_24px_rgba(15,23,42,0.10)] transition-transform transition-colors transition-shadow hover:-translate-y-1 hover:border-black/10 hover:shadow-[0_18px_42px_rgba(15,23,42,0.16)]" data-aos="fade-up" data-aos-delay="{{ $loop->index * 90 }}">
                        <a href="{{ route('home') }}" class="flex h-full flex-col">
                            <!-- Image Container with Absolute Category Badge -->
                            <div class="relative overflow-hidden w-full h-34 sm:h-44 lg:h-48 bg-gray-50">
                                <span style="background-color: rgba(8, 35, 111, 0.9);" class="absolute top-3 left-3 z-10 rounded-[5px] px-2.5 py-1 text-[10px] font-semibold uppercase tracking-[0.12em] text-white">
                                    {{ $tag }}
                                </span>
                                <img src="{{ asset('assets/section1.jpg') }}" alt="{{ $title }}" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            
                            <div class="flex flex-1 flex-col p-4 sm:p-6">
                                <div class="flex items-center gap-2">
                                    <svg class="h-3.5 w-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-[12px] font-medium leading-none text-[#7a7a7a]">
                                        11 Jul 2026
                                    </span>
                                </div>
                                <h3 class="mt-3 text-[14px] font-semibold leading-[1.3] tracking-[-0.12px] text-[#1d1d1f] sm:mt-4 sm:text-[16px] sm:leading-[1.25] sm:tracking-[-0.12px] lg:text-[17px]">
                                    {{ $title }}
                                </h3>
                                <p class="mt-2 line-clamp-3 text-[13px] leading-[1.5] tracking-[-0.12px] text-[#6b7280] sm:mt-3 sm:text-[13px] sm:leading-[1.48] sm:tracking-[-0.12px] sm:text-[#7a7a7a]">
                                    {{ $copy }}
                                </p>
                                <span class="mt-auto self-end pt-4 text-[13px] font-semibold leading-[1.29] tracking-[-0.12px] text-[#d4af37] sm:pt-5 sm:text-[14px] sm:font-normal sm:tracking-[-0.224px]">
                                    Selengkapnya &rarr;
                                </span>
                            </div>
                        </a>
                    </article>
                @endforeach
            @endforelse
        </div>

        <a href="{{ route('media.news.index') }}"
            class="mt-8 inline-flex min-h-11 w-full items-center justify-center rounded-[8px] bg-[#d4af37] px-5 py-2.5 text-[14px] font-semibold leading-[1.29] tracking-[-0.224px] text-white shadow-[0_16px_36px_rgba(212,175,55,0.24)] transition-colors transition-transform hover:bg-[#b99018] active:scale-95 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-[3px] focus-visible:outline-[#f4d35e] md:hidden">Lihat Semua &rarr;</a>
    </div>
</section>
