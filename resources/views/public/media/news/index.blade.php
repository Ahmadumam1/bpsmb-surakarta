@extends('layouts.public')

@section('title', 'Berita | BPSMB Surakarta')
@section('meta_description', 'Berita terbaru, kegiatan, pengumuman, dan informasi layanan BPSMB Surakarta.')

@section('content')
    <section class="relative overflow-hidden border-b border-black/10 bg-[#f5f5f7]">
        <div
            class="absolute inset-0 bg-[linear-gradient(135deg,rgba(8,35,111,0.08),rgba(245,245,247,0)_45%),radial-gradient(circle_at_85%_18%,rgba(212,175,55,0.22),rgba(212,175,55,0)_28%)]">
        </div>
        <div
            class="absolute inset-0 bg-[linear-gradient(rgba(8,35,111,0.055)_1px,transparent_1px),linear-gradient(90deg,rgba(8,35,111,0.055)_1px,transparent_1px)] bg-[size:44px_44px]">
        </div>
        <img src="{{ asset('assets/profile-hero.png') }}" alt="" aria-hidden="true"
            class="pointer-events-none absolute -right-16 bottom-0 h-full max-h-[300px] w-[82%] object-cover object-left opacity-45 blur-[0.5px] saturate-110 sm:max-h-[360px] sm:w-[70%] sm:opacity-50 lg:-right-10 lg:max-h-[420px] lg:w-[58%] lg:opacity-60">
        <div
            class="absolute inset-y-0 right-0 w-full bg-gradient-to-r from-[#f5f5f7] via-[#f5f5f7]/70 to-[#f5f5f7]/15 sm:via-[#f5f5f7]/65 lg:w-4/3 lg:via-[#f5f5f7]/70 lg:to-[#f5f5f7]/10">
        </div>
        <div class="absolute -bottom-28 left-10 h-72 w-72 rounded-full border border-[#08236f]/10"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-7 sm:px-6 sm:py-14 lg:px-8 lg:py-20">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-3xl">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-[#d4af37] sm:text-[12px] sm:tracking-[0.16em]">Media</p>
                    <h1 class="mt-2 max-w-3xl text-[25px] font-semibold leading-[1.12] text-[#08236f] sm:mt-4 sm:text-[40px]">
                        Berita
                    </h1>
                    <p class="mt-3 max-w-2xl text-[13px] leading-6 text-[#4b5563] sm:mt-5 sm:text-[16px] sm:leading-7">
                        Kegiatan, pengumuman, dan informasi layanan terbaru.
                    </p>
                    <div class="mt-4 h-0.5 w-14 rounded-full bg-[#d4af37] sm:mt-7 sm:h-1 sm:w-24"></div>
                </div>

                <form id="news-filter-form" action="{{ route('media.news.index') }}" method="GET"
                    class="w-full rounded-[8px] border border-black/10 bg-white p-2 shadow-[0_14px_36px_rgba(15,23,42,0.06)] lg:max-w-2xl">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                        <div class="relative min-w-0 flex-1">
                            <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-[#64748b]"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197M15.803 15.803A7.5 7.5 0 1 0 5.197 5.197a7.5 7.5 0 0 0 10.606 10.606Z" />
                            </svg>
                            <input name="search" value="{{ request('search') }}"
                                class="h-11 w-full rounded-[6px] border border-transparent bg-[#f5f5f7] pl-12 pr-4 text-sm font-medium text-[#1d1d1f] outline-none transition placeholder:text-[#9ca3af] focus:border-[#08236f] focus:bg-white"
                                placeholder="Cari berita">
                        </div>
                        <select name="category"
                            class="h-11 w-full shrink-0 rounded-[6px] border border-transparent bg-[#f5f5f7] px-4 text-sm font-medium text-[#1d1d1f] outline-none transition focus:border-[#08236f] focus:bg-white sm:w-[220px]">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8 lg:py-5">
            <div id="news-results" class="transition-opacity duration-300 ease-out" aria-live="polite">
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('news-filter-form');
            const results = document.getElementById('news-results');

            if (!form || !results) {
                return;
            }

            const searchInput = form.querySelector('input[name="search"]');
            const categoryInput = form.querySelector('select[name="category"]');
            const allNews = @js($newsItems->values());
            const perPage = 8;
            let timer;
            let currentPage = 1;
            let filteredNews = allNews;

            const skeletonMarkup = () => `
                <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-4" data-news-skeleton>
                    ${Array.from({ length: 8 }).map(() => `
                        <article class="overflow-hidden rounded-[8px] border border-[#e0e0e0] bg-white">
                            <div class="h-52 w-full animate-pulse bg-[#eef2f7]"></div>
                            <div class="p-6">
                                <div class="flex items-center justify-between gap-4">
                                    <span class="h-6 w-24 animate-pulse rounded-[5px] bg-[#eef2f7]"></span>
                                    <span class="h-4 w-16 animate-pulse rounded bg-[#eef2f7]"></span>
                                </div>
                                <div class="mt-5 h-6 w-full animate-pulse rounded bg-[#eef2f7]"></div>
                                <div class="mt-2 h-6 w-4/5 animate-pulse rounded bg-[#eef2f7]"></div>
                                <div class="mt-4 space-y-2">
                                    <div class="h-4 w-full animate-pulse rounded bg-[#eef2f7]"></div>
                                    <div class="h-4 w-11/12 animate-pulse rounded bg-[#eef2f7]"></div>
                                    <div class="h-4 w-2/3 animate-pulse rounded bg-[#eef2f7]"></div>
                                </div>
                                <div class="mt-5 h-4 w-28 animate-pulse rounded bg-[#eef2f7]"></div>
                            </div>
                        </article>
                    `).join('')}
                </div>
            `;

            const syncFormToUrl = () => {
                const url = new URL(window.location.href);
                const params = new URLSearchParams(new FormData(form));

                for (const [key, value] of [...params.entries()]) {
                    if (value) {
                        url.searchParams.set(key, value);
                    } else {
                        url.searchParams.delete(key);
                    }
                }

                if (currentPage > 1) {
                    url.searchParams.set('page', currentPage);
                } else {
                    url.searchParams.delete('page');
                }

                window.history.pushState({}, '', url.toString());
            };

            const setFormFromUrl = () => {
                const params = new URLSearchParams(window.location.search);

                if (searchInput) {
                    searchInput.value = params.get('search') || '';
                }

                if (categoryInput) {
                    categoryInput.value = params.get('category') || '';
                }

                currentPage = Number(params.get('page') || 1);
            };

            let searchLogTimer;
            const logSearchToServer = (keyword) => {
                if (!keyword || keyword.length < 3) return;
                fetch('{{ route('media.news.log-search') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ keyword })
                }).catch(() => {});
            };

            const filterNews = () => {
                const keyword = (searchInput?.value || '').trim().toLowerCase();
                const category = categoryInput?.value || '';

                window.clearTimeout(searchLogTimer);
                if (keyword) {
                    searchLogTimer = window.setTimeout(() => {
                        logSearchToServer(keyword);
                    }, 1000);
                }

                filteredNews = allNews.filter((news) => {
                    const matchesKeyword = !keyword || news.search.includes(keyword);
                    const matchesCategory = !category || news.category_slug === category;

                    return matchesKeyword && matchesCategory;
                });

                const lastPage = Math.max(Math.ceil(filteredNews.length / perPage), 1);
                currentPage = Math.min(Math.max(currentPage, 1), lastPage);
                renderNews();
            };

            const renderNews = (shouldScroll = false) => {
                const total = filteredNews.length;
                const from = total ? (currentPage - 1) * perPage : 0;
                const pageItems = filteredNews.slice(from, from + perPage);

                results.innerHTML = pageItems.length
                    ? `<div class="grid gap-4 sm:grid-cols-2 sm:gap-7 lg:grid-cols-4">${pageItems.map(renderCard).join('')}</div>${renderPagination()}`
                    : renderEmpty();

                syncFormToUrl();

                if (shouldScroll) {
                    results.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            };

            const renderCard = (news) => `
                <article class="overflow-hidden rounded-[8px] border border-black/5 bg-white text-[#1d1d1f] shadow-[0_8px_24px_rgba(15,23,42,0.10)] transition-transform transition-colors transition-shadow hover:-translate-y-1 hover:border-black/10 hover:shadow-[0_18px_42px_rgba(15,23,42,0.16)]">
                    <a href="${escapeHtml(news.url)}">
                        <img src="${escapeHtml(news.thumbnail_url)}" alt="${escapeHtml(news.title)}" class="h-44 w-full object-cover sm:h-52" loading="lazy">
                        <div class="p-4 sm:p-6">
                            <div class="flex items-center justify-between gap-4">
                                <span class="rounded-[5px] bg-[#f5f5f7] px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.12em] text-[#08236f]">${escapeHtml(news.category_name)}</span>
                            </div>
                            <div class="mt-4 flex items-center justify-between w-full border-b border-black/5 pb-3">
                                <div class="flex items-center gap-1.5">
                                    <svg class="h-3.5 w-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-[12px] font-medium leading-none text-[#7a7a7a]">${escapeHtml(news.published_at)}</span>
                                </div>
                                <div class="flex items-center gap-1 text-[#7a7a7a]">
                                    <svg class="h-3.5 w-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span class="text-[12px] font-medium leading-none">${escapeHtml(news.views)}</span>
                                </div>
                            </div>
                            <h2 class="mt-4 line-clamp-2 text-[18px] font-semibold leading-[1.22] tracking-[0.231px] text-[#1d1d1f] sm:mt-5 sm:text-[21px] sm:leading-[1.19]">${escapeHtml(news.title)}</h2>
                            <p class="mt-3 line-clamp-3 text-[14px] leading-[1.43] tracking-[-0.224px] text-[#7a7a7a]">${escapeHtml(news.excerpt)}</p>
                            <span class="mt-5 inline-block text-[14px] leading-[1.29] tracking-[-0.224px] text-[#d4af37]">Selengkapnya &rarr;</span>
                        </div>
                    </a>
                </article>
            `;

            const renderEmpty = () => `
                <div class="grid min-h-[360px] w-full place-items-center rounded-[8px] border border-black/10 bg-[#f5f5f7] p-8 text-center">
                    <div class="w-full max-w-2xl">
                        <div class="mx-auto grid h-14 w-14 place-items-center rounded-full bg-white text-[#08236f] shadow-[0_14px_36px_rgba(15,23,42,0.08)]">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197M15.803 15.803A7.5 7.5 0 1 0 5.197 5.197a7.5 7.5 0 0 0 10.606 10.606Z" /></svg>
                        </div>
                        <h2 class="mt-5 text-xl font-semibold text-[#08236f]">Berita tidak ditemukan</h2>
                        <p class="mt-3 text-sm leading-6 text-[#64748b]">Tidak ada berita yang cocok dengan kata kunci atau kategori yang dipilih.</p>
                    </div>
                </div>
            `;

            const renderPagination = () => {
                const lastPage = Math.ceil(filteredNews.length / perPage);

                if (lastPage <= 1) return '';

                return `<div class="mt-8 flex flex-wrap items-center justify-center gap-1.5 sm:mt-10 sm:gap-2" data-news-pagination>${paginationRange(currentPage, lastPage).map((page) => {
                    if (page === '...') return '<span class="grid h-10 min-w-10 place-items-center px-2 text-[14px] font-semibold text-[#8a8a8a] sm:h-11 sm:min-w-11 sm:text-[15px]">...</span>';

                    const isActive = page === currentPage;
                    return `<button type="button" data-news-page="${page}" class="grid h-10 min-w-10 place-items-center rounded-[8px] border text-[14px] font-semibold transition sm:h-11 sm:min-w-11 sm:text-[15px] ${isActive ? 'border-[#d4af37] bg-[#d4af37] text-white' : 'border-black/10 bg-white text-[#4b5563] hover:border-[#08236f] hover:text-[#08236f]'}">${page}</button>`;
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
                filterNews();
            });

            searchInput?.addEventListener('input', () => {
                window.clearTimeout(timer);
                timer = window.setTimeout(() => {
                    currentPage = 1;
                    filterNews();
                }, 60);
            });

            categoryInput?.addEventListener('change', () => {
                currentPage = 1;
                filterNews();
            });

            results.addEventListener('click', (event) => {
                const button = event.target.closest('[data-news-page]');

                if (!button) {
                    return;
                }

                event.preventDefault();
                currentPage = Number(button.dataset.newsPage || 1);
                renderNews(true);
            });

            window.addEventListener('popstate', () => {
                setFormFromUrl();
                filterNews();
            });

            setFormFromUrl();
            filterNews();
        });
    </script>
@endpush
