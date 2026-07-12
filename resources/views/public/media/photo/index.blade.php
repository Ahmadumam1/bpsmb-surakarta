@extends('layouts.public')

@section('title', 'Foto | BPSMB Surakarta')
@section('meta_description', 'Galeri foto kegiatan, layanan, dan dokumentasi BPSMB Surakarta.')

@section('content')
    <section class="relative overflow-hidden border-b border-black/10 bg-[#f5f5f7]">
        <div class="absolute inset-0 bg-[linear-gradient(135deg,rgba(8,35,111,0.08),rgba(245,245,247,0)_45%),radial-gradient(circle_at_85%_18%,rgba(212,175,55,0.22),rgba(212,175,55,0)_28%)]"></div>
        <div class="absolute inset-0 bg-[linear-gradient(rgba(8,35,111,0.055)_1px,transparent_1px),linear-gradient(90deg,rgba(8,35,111,0.055)_1px,transparent_1px)] bg-[size:44px_44px]"></div>
        <img src="{{ asset('assets/profile-hero.png') }}" alt="" aria-hidden="true"
            class="pointer-events-none absolute -right-16 bottom-0 h-full max-h-[300px] w-[82%] object-cover object-left opacity-45 blur-[0.5px] saturate-110 sm:max-h-[360px] sm:w-[70%] sm:opacity-50 lg:-right-10 lg:max-h-[420px] lg:w-[58%] lg:opacity-60">
        <div
            class="absolute inset-y-0 right-0 w-full bg-gradient-to-r from-[#f5f5f7] via-[#f5f5f7]/70 to-[#f5f5f7]/15 sm:via-[#f5f5f7]/65 lg:w-4/3 lg:via-[#f5f5f7]/70 lg:to-[#f5f5f7]/10">
        </div>
        <div class="absolute -bottom-28 left-10 h-72 w-72 rounded-full border border-[#08236f]/10"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-7 sm:px-6 sm:py-14 lg:px-8 lg:py-20">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-[#d4af37] sm:text-[12px] sm:tracking-[0.16em]">Media</p>
                    <h1 class="mt-2 max-w-3xl text-[25px] font-semibold leading-[1.12] text-[#08236f] sm:mt-4 sm:text-[40px]">
                        Galeri Foto
                    </h1>
                    <p class="mt-3 max-w-2xl text-[13px] leading-6 text-[#4b5563] sm:mt-5 sm:text-[16px] sm:leading-7">
                        Dokumentasi kegiatan, layanan, dan aktivitas BPSMB Surakarta.
                    </p>
                    <div class="mt-4 h-0.5 w-14 rounded-full bg-[#d4af37] sm:mt-7 sm:h-1 sm:w-24"></div>
                </div>

                <form id="photo-search-form" action="{{ route('media.photo.index') }}" method="GET"
                    class="w-full rounded-[8px] border border-black/10 bg-white p-2 shadow-[0_14px_36px_rgba(15,23,42,0.06)] lg:max-w-md">
                    <div class="relative">
                        <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-[#64748b]"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197M15.803 15.803A7.5 7.5 0 1 0 5.197 5.197a7.5 7.5 0 0 0 10.606 10.606Z" />
                        </svg>
                        <input name="search" value="{{ request('search') }}"
                            class="h-11 w-full rounded-[6px] border border-transparent bg-[#f5f5f7] pl-12 pr-4 text-sm font-medium text-[#1d1d1f] outline-none transition placeholder:text-[#9ca3af] focus:border-[#08236f] focus:bg-white"
                            placeholder="Cari foto">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8 lg:py-10">
            <div id="photo-results" class="transition-opacity duration-300 ease-out" aria-live="polite">
            </div>
        </div>
    </section>

    <div data-photo-gallery-modal class="fixed inset-0 z-50 hidden place-items-center bg-black/82 px-4 py-6 backdrop-blur-sm">
        <button type="button" data-photo-gallery-close class="absolute inset-0 cursor-zoom-out" aria-label="Tutup preview foto"></button>
        <figure class="relative z-10 w-full max-w-5xl">
            <img data-photo-gallery-image src="" alt=""
                class="mx-auto max-h-[82vh] w-auto max-w-full rounded-[8px] object-contain shadow-[0_24px_80px_rgba(0,0,0,0.42)]">
            <figcaption class="mt-3 rounded-[8px] bg-white/92 px-4 py-3 text-[#1d1d1f] shadow-[0_16px_48px_rgba(0,0,0,0.24)]">
                <p data-photo-gallery-title class="text-[14px] font-semibold leading-[1.35]"></p>
                <p data-photo-gallery-category class="mt-1 text-[12px] leading-none text-[#7a7a7a]"></p>
            </figcaption>
            <button type="button" data-photo-gallery-close
                class="absolute right-3 top-3 grid h-10 w-10 cursor-pointer place-items-center rounded-full bg-white/92 text-[22px] leading-none text-[#08236f] shadow-[0_12px_30px_rgba(0,0,0,0.24)]"
                aria-label="Tutup preview foto">&times;</button>
        </figure>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const results = document.getElementById('photo-results');
            const form = document.getElementById('photo-search-form');
            const modal = document.querySelector('[data-photo-gallery-modal]');
            const modalImage = document.querySelector('[data-photo-gallery-image]');
            const modalTitle = document.querySelector('[data-photo-gallery-title]');
            const modalCategory = document.querySelector('[data-photo-gallery-category]');

            if (!results || !form) {
                return;
            }

            const searchInput = form.querySelector('input[name="search"]');
            const allPhotos = @js($photos->values());
            const perPage = 8;
            let timer;
            let currentPage = 1;
            let filteredPhotos = allPhotos;

            const syncUrl = () => {
                const url = new URL(window.location.href);
                const keyword = searchInput?.value || '';

                if (keyword) {
                    url.searchParams.set('search', keyword);
                } else {
                    url.searchParams.delete('search');
                }

                if (currentPage > 1) {
                    url.searchParams.set('page', currentPage);
                } else {
                    url.searchParams.delete('page');
                }

                window.history.pushState({}, '', url.toString());
            };

            const filterPhotos = () => {
                const keyword = (searchInput?.value || '').trim().toLowerCase();

                filteredPhotos = keyword
                    ? allPhotos.filter((photo) => photo.search.includes(keyword))
                    : allPhotos;

                currentPage = Math.min(Math.max(currentPage, 1), Math.max(Math.ceil(filteredPhotos.length / perPage), 1));
                renderPhotos();
            };

            const renderPhotos = (shouldScroll = false) => {
                const from = (currentPage - 1) * perPage;
                const pageItems = filteredPhotos.slice(from, from + perPage);

                results.innerHTML = pageItems.length
                    ? `<div class="grid gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4">${pageItems.map(renderCard).join('')}</div>${renderPagination()}`
                    : renderEmpty();

                syncUrl();

                if (shouldScroll) {
                    results.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            };

            const renderCard = (photo) => `
                <article class="overflow-hidden rounded-[8px] border border-black/5 bg-white text-[#1d1d1f] shadow-[0_8px_24px_rgba(15,23,42,0.10)] transition-transform transition-colors transition-shadow hover:-translate-y-1 hover:border-black/10 hover:shadow-[0_18px_42px_rgba(15,23,42,0.16)]">
                    <button type="button" class="block h-full w-full cursor-zoom-in text-left" data-photo-gallery-open data-photo-src="${escapeHtml(photo.image_url)}" data-photo-title="${escapeHtml(photo.title)}" data-photo-category="${escapeHtml(photo.category)}">
                        <img src="${escapeHtml(photo.image_url)}" alt="${escapeHtml(photo.title)}" class="h-44 w-full object-cover sm:h-52" loading="lazy">
                        <span class="block p-4 sm:p-5">
                            <span class="rounded-[5px] bg-[#f5f5f7] px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.12em] text-[#08236f]">${escapeHtml(photo.category)}</span>
                            <span class="mt-4 line-clamp-2 block text-[15px] font-semibold leading-[1.35] text-[#1d1d1f]">${escapeHtml(photo.title)}</span>
                        </span>
                    </button>
                </article>
            `;

            const renderEmpty = () => `
                <div class="grid min-h-[320px] w-full place-items-center rounded-[8px] border border-black/10 bg-[#f5f5f7] p-8 text-center">
                    <div class="w-full max-w-2xl">
                        <div class="mx-auto grid h-14 w-14 place-items-center rounded-full bg-white text-[#08236f] shadow-[0_14px_36px_rgba(15,23,42,0.08)]">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Z" /></svg>
                        </div>
                        <h2 class="mt-5 text-xl font-semibold text-[#08236f]">Foto belum tersedia</h2>
                        <p class="mt-3 text-sm leading-6 text-[#64748b]">Dokumentasi foto akan tampil setelah diaktifkan.</p>
                    </div>
                </div>
            `;

            const renderPagination = () => {
                const lastPage = Math.ceil(filteredPhotos.length / perPage);

                if (lastPage <= 1) return '';

                return `<div class="mt-8 flex flex-wrap items-center justify-center gap-1.5 sm:mt-10 sm:gap-2" data-photo-pagination>${paginationRange(currentPage, lastPage).map((page) => {
                    if (page === '...') return '<span class="grid h-10 min-w-10 place-items-center px-2 text-[14px] font-semibold text-[#8a8a8a] sm:h-11 sm:min-w-11 sm:text-[15px]">...</span>';

                    const isActive = page === currentPage;
                    return `<button type="button" data-photo-page="${page}" class="grid h-10 min-w-10 place-items-center rounded-[8px] border text-[14px] font-semibold transition sm:h-11 sm:min-w-11 sm:text-[15px] ${isActive ? 'border-[#d4af37] bg-[#d4af37] text-white' : 'border-black/10 bg-white text-[#4b5563] hover:border-[#08236f] hover:text-[#08236f]'}">${page}</button>`;
                }).join('')}</div>`;
            };

            const paginationRange = (page, totalPages) => {
                if (totalPages <= 7) return Array.from({ length: totalPages }, (_, index) => index + 1);
                if (page <= 4) return [1, 2, 3, 4, 5, '...', totalPages];
                if (page >= totalPages - 3) return [1, '...', totalPages - 4, totalPages - 3, totalPages - 2, totalPages - 1, totalPages];
                return [1, '...', page - 1, page, page + 1, '...', totalPages];
            };

            const escapeHtml = (value) => String(value ?? '').replace(/[&<>"']/g, (char) => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;',
            })[char]);

            form.addEventListener('submit', (event) => {
                event.preventDefault();
                currentPage = 1;
                filterPhotos();
            });

            searchInput?.addEventListener('input', () => {
                window.clearTimeout(timer);
                timer = window.setTimeout(() => {
                    currentPage = 1;
                    filterPhotos();
                }, 60);
            });

            results.addEventListener('click', (event) => {
                const openButton = event.target.closest('[data-photo-gallery-open]');

                if (openButton && modal && modalImage && modalTitle && modalCategory) {
                    modalImage.src = openButton.dataset.photoSrc || '';
                    modalImage.alt = openButton.dataset.photoTitle || '';
                    modalTitle.textContent = openButton.dataset.photoTitle || '';
                    modalCategory.textContent = openButton.dataset.photoCategory || '';
                    modal.classList.remove('hidden');
                    modal.classList.add('grid');
                    document.body.classList.add('overflow-hidden');
                    return;
                }

                const button = event.target.closest('[data-photo-page]');

                if (!button) {
                    return;
                }

                event.preventDefault();
                currentPage = Number(button.dataset.photoPage || 1);
                renderPhotos(true);
            });

            window.addEventListener('popstate', () => {
                const params = new URLSearchParams(window.location.search);

                if (searchInput) {
                    searchInput.value = params.get('search') || '';
                }

                currentPage = Number(params.get('page') || 1);
                filterPhotos();
            });

            const closePhotoModal = () => {
                if (!modal || !modalImage) {
                    return;
                }

                modal.classList.add('hidden');
                modal.classList.remove('grid');
                modalImage.src = '';
                modalImage.alt = '';
                document.body.classList.remove('overflow-hidden');
            };

            document.addEventListener('click', (event) => {
                if (event.target.closest('[data-photo-gallery-close]')) {
                    closePhotoModal();
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    closePhotoModal();
                }
            });
            const params = new URLSearchParams(window.location.search);
            if (searchInput) searchInput.value = params.get('search') || '';
            currentPage = Number(params.get('page') || 1);
            filterPhotos();
        });
    </script>
@endpush
