@php
    $defaultPhotos = collect([
        ['date' => '15 Okt 2023', 'title' => 'Kunjungan Kerja Dinas Perdagangan'],
        ['date' => '10 Okt 2023', 'title' => 'Pelatihan Kalibrasi Massa & Suhu'],
        ['date' => '05 Okt 2023', 'title' => 'Pengujian Komoditas Beras Premium'],
        ['date' => '01 Okt 2023', 'title' => 'Rapat Koordinasi Evaluasi Mutu Tahunan'],
    ]);
@endphp

<section id="galeri-foto" class="border-t border-[#e0e0e0] bg-white">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 sm:py-16 lg:px-8 lg:py-[72px]">
        <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between md:gap-6" data-aos="fade-up">
            <div>
                <p class="flex items-center gap-3 text-[10px] font-semibold uppercase leading-none tracking-[0.12em] text-[#9a7a18] sm:gap-[14px] sm:text-[11px]">
                    <span class="h-0.5 w-7 bg-[#08236f] sm:w-[34px]" aria-hidden="true"></span>
                    Arsip Kegiatan
                </p>
                <h2 class="mt-3 text-[28px] font-semibold leading-[1.12] text-[#08236f] sm:mt-4 sm:text-[40px] sm:leading-[1.1]">Galeri Foto</h2>
                <p class="mt-3 max-w-2xl text-[13px] leading-[1.55] tracking-[-0.12px] text-[#6b7280] sm:mt-4 sm:text-[14px] sm:leading-[1.43] sm:tracking-[-0.224px] sm:text-[#7a7a7a]">
                    Dokumentasi operasional, kunjungan kerja, dan layanan teknis.
                </p>
            </div>
            <a href="{{ route('media.photo.index') }}"
                class="hidden min-h-11 items-center justify-center rounded-[8px] bg-[#d4af37] px-5 py-2.5 text-[14px] font-semibold leading-[1.29] tracking-[-0.224px] text-white shadow-[0_16px_36px_rgba(212,175,55,0.24)] transition-colors transition-transform hover:bg-[#b99018] active:scale-95 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-[3px] focus-visible:outline-[#f4d35e] md:inline-flex">Lihat Semua &rarr;</a>
        </div>

        <div class="mt-7 grid gap-5 sm:mt-10 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4">
            @forelse ($photoSections->take(4) as $photo)
                <article class="overflow-hidden rounded-[8px] border border-black/5 bg-white text-[#1d1d1f] shadow-[0_8px_24px_rgba(15,23,42,0.10)] transition-transform transition-colors transition-shadow hover:-translate-y-1 hover:border-black/10 hover:shadow-[0_18px_42px_rgba(15,23,42,0.16)]" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                    <button type="button"
                        class="block h-full w-full cursor-zoom-in text-left"
                        data-photo-preview-open
                        data-photo-src="{{ $photo->image_url ?: asset('assets/section1.jpg') }}"
                        data-photo-title="{{ $photo->title }}"
                        data-photo-date="{{ $photo->created_at?->format('d M Y') }}">
                        <img src="{{ $photo->image_url ?: asset('assets/section1.jpg') }}" alt="{{ $photo->title }}"
                            class="h-40 w-full object-cover sm:h-48">
                        <span class="block p-3 sm:p-4">
                            <span class="line-clamp-2 text-[14px] font-semibold leading-[1.35] tracking-[-0.12px] text-[#333333] sm:leading-[1.29] sm:tracking-[-0.224px]">
                                {{ $photo->title }}
                            </span>
                            <span class="mt-2 block text-[12px] leading-none tracking-[-0.12px] text-[#7a7a7a]">
                                {{ $photo->created_at?->format('d M Y') }}
                            </span>
                        </span>
                    </button>
                </article>
            @empty
                @foreach ($defaultPhotos as $photo)
                    <article class="overflow-hidden rounded-[8px] border border-black/5 bg-white text-[#1d1d1f] shadow-[0_8px_24px_rgba(15,23,42,0.10)] transition-transform transition-colors transition-shadow hover:-translate-y-1 hover:border-black/10 hover:shadow-[0_18px_42px_rgba(15,23,42,0.16)]" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                        <button type="button"
                            class="block h-full w-full cursor-zoom-in text-left"
                            data-photo-preview-open
                            data-photo-src="{{ asset('assets/section1.jpg') }}"
                            data-photo-title="{{ $photo['title'] }}"
                            data-photo-date="{{ $photo['date'] }}">
                            <img src="{{ asset('assets/section1.jpg') }}" alt="{{ $photo['title'] }}"
                                class="h-40 w-full object-cover sm:h-48">
                            <span class="block p-3 sm:p-4">
                                <span class="line-clamp-2 text-[14px] font-semibold leading-[1.35] tracking-[-0.12px] text-[#333333] sm:leading-[1.29] sm:tracking-[-0.224px]">
                                    {{ $photo['title'] }}
                                </span>
                                <span class="mt-2 block text-[12px] leading-none tracking-[-0.12px] text-[#7a7a7a]">
                                    {{ $photo['date'] }}
                                </span>
                            </span>
                        </button>
                    </article>
                @endforeach
            @endforelse
        </div>

        <a href="{{ route('media.photo.index') }}"
            class="mt-8 inline-flex min-h-11 w-full items-center justify-center rounded-[8px] bg-[#d4af37] px-5 py-2.5 text-[14px] font-semibold leading-[1.29] tracking-[-0.224px] text-white shadow-[0_16px_36px_rgba(212,175,55,0.24)] transition-colors transition-transform hover:bg-[#b99018] active:scale-95 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-[3px] focus-visible:outline-[#f4d35e] md:hidden">Lihat Semua Foto &rarr;</a>
    </div>
</section>

<div data-photo-preview-modal class="fixed inset-0 z-50 hidden place-items-center bg-black/82 px-4 py-6 backdrop-blur-sm">
    <button type="button" data-photo-preview-close class="absolute inset-0 cursor-zoom-out" aria-label="Tutup preview foto"></button>
    <figure class="relative z-10 w-full max-w-5xl">
        <img data-photo-preview-image src="" alt=""
            class="mx-auto max-h-[82vh] w-auto max-w-full rounded-[8px] object-contain shadow-[0_24px_80px_rgba(0,0,0,0.42)]">
        <figcaption class="mt-3 rounded-[8px] bg-white/92 px-4 py-3 text-[#1d1d1f] shadow-[0_16px_48px_rgba(0,0,0,0.24)]">
            <p data-photo-preview-title class="text-[14px] font-semibold leading-[1.35]"></p>
            <p data-photo-preview-date class="mt-1 text-[12px] leading-none text-[#7a7a7a]"></p>
        </figcaption>
        <button type="button" data-photo-preview-close
            class="absolute right-3 top-3 grid h-10 w-10 cursor-pointer place-items-center rounded-full bg-white/92 text-[22px] leading-none text-[#08236f] shadow-[0_12px_30px_rgba(0,0,0,0.24)]"
            aria-label="Tutup preview foto">&times;</button>
    </figure>
</div>

@push('scripts')
    <script>
        (() => {
            const modal = document.querySelector('[data-photo-preview-modal]');
            const image = document.querySelector('[data-photo-preview-image]');
            const title = document.querySelector('[data-photo-preview-title]');
            const date = document.querySelector('[data-photo-preview-date]');

            if (!modal || !image || !title || !date) {
                return;
            }

            const closePreview = () => {
                modal.classList.add('hidden');
                modal.classList.remove('grid');
                image.src = '';
                image.alt = '';
                document.body.classList.remove('overflow-hidden');
            };

            document.addEventListener('click', (event) => {
                const openButton = event.target.closest('[data-photo-preview-open]');

                if (openButton) {
                    image.src = openButton.dataset.photoSrc || '';
                    image.alt = openButton.dataset.photoTitle || '';
                    title.textContent = openButton.dataset.photoTitle || '';
                    date.textContent = openButton.dataset.photoDate || '';
                    modal.classList.remove('hidden');
                    modal.classList.add('grid');
                    document.body.classList.add('overflow-hidden');
                    return;
                }

                if (event.target === modal || event.target.closest('[data-photo-preview-close]')) {
                    closePreview();
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    closePreview();
                }
            });
        })();
    </script>
@endpush
