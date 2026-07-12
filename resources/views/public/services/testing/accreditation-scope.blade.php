@extends('layouts.public')

@section('title', 'Ruang Lingkup Akreditasi Laboratorium Pengujian | BPSMB Surakarta')
@section('meta_description', 'Ruang lingkup akreditasi Laboratorium Penguji BPSMB Surakarta berdasarkan jenis komoditas dan acuan SNI.')

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

        <div class="relative mx-auto grid max-w-7xl gap-8 px-4 py-7 sm:gap-10 sm:px-6 sm:py-14 lg:grid-cols-[1fr_380px] lg:px-8 lg:py-20">
            <div class="flex items-center">
                <div class="max-w-3xl">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-[#d4af37] sm:text-[12px] sm:tracking-[0.16em]">Jasa Pengujian</p>
                    <h1
                        class="mt-2 max-w-3xl text-[25px] font-semibold leading-[1.12] text-[#08236f] sm:mt-4 sm:text-[40px]">
                        Ruang Lingkup Akreditasi Laboratorium Pengujian
                    </h1>
                    <p class="mt-3 max-w-2xl text-[13px] leading-6 text-[#4b5563] sm:mt-5 sm:text-[16px] sm:leading-7">
                        Daftar jenis komoditas dan acuan SNI dalam ruang lingkup akreditasi.
                    </p>
                    <div class="mt-4 h-0.5 w-14 rounded-full bg-[#d4af37] sm:mt-7 sm:h-1 sm:w-24"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#f5f5f7]">
        <div class="mx-auto max-w-7xl px-4 py-5 sm:px-6 sm:py-8 lg:px-8 lg:py-10">

            <div id="accreditation-scope-app"
                class="overflow-hidden rounded-[8px] border border-black/10 bg-white shadow-[0_24px_70px_rgba(15,23,42,0.08)]">
                <div class="border-b border-black/10 p-4 sm:p-5">
                    <div>
                        <label class="relative block">
                            <span class="sr-only">Cari ruang lingkup akreditasi</span>
                            <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-[#71717a]"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" />
                            </svg>
                            <input type="search" data-scope-search value="{{ $search }}" placeholder="Cari jenis komoditas atau acuan..."
                                class="h-12 w-full rounded-[8px] border border-black/10 bg-[#f8fafc] pl-12 pr-4 text-[14px] font-medium text-[#1f2937] outline-none transition placeholder:text-[#8a8a8a] focus:border-[#08236f] focus:bg-white focus:ring-4 focus:ring-[#08236f]/10">
                        </label>
                    </div>
                    <p class="mt-3 text-sm font-medium text-[#71717a]" data-scope-count>
                        Menampilkan 0 data.
                    </p>
                </div>

                <div data-scope-results>
                    <div class="service-table-compact overflow-x-auto">
                        <table class="w-full min-w-[640px] text-left">
                            <thead class="sticky top-0 z-10 bg-[#08236f] text-white">
                                <tr>
                                    <th class="w-14 px-4 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">No</th>
                                    <th class="px-4 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">Jenis Komoditas</th>
                                    <th class="w-[260px] px-4 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">Acuan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-black/10" data-scope-table-body></tbody>
                        </table>
                    </div>

                    <div class="hidden" data-scope-card-list></div>
                </div>

                <div class="border-t border-black/10 px-4 py-4 sm:px-5">
                    <div class="flex flex-nowrap items-center justify-start gap-1.5 overflow-x-auto sm:justify-center sm:gap-2" data-scope-pagination></div>
                </div>
            </div>

            @include('public.services.partials.related-services', ['current' => 'testing-accreditation-scope'])
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const app = document.querySelector('#accreditation-scope-app');

            if (!app) {
                return;
            }

            const allScopes = @js($scopes->values());
            const searchInput = app.querySelector('[data-scope-search]');
            const tableBody = app.querySelector('[data-scope-table-body]');
            const cardList = app.querySelector('[data-scope-card-list]');
            const countLabel = app.querySelector('[data-scope-count]');
            const pagination = app.querySelector('[data-scope-pagination]');
            const perPage = 15;
            let currentPage = 1;
            let requestTimer = null;
            let filteredScopes = allScopes;

            const scrollToResults = () => {
                const top = app.getBoundingClientRect().top + window.scrollY - 88;

                window.scrollTo({
                    top: Math.max(top, 0),
                    behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth',
                });
            };

            const renderPage = (page = 1, shouldScroll = false) => {
                currentPage = page;
                const total = filteredScopes.length;
                const from = total ? (currentPage - 1) * perPage + 1 : 0;
                const to = Math.min(currentPage * perPage, total);
                const pageItems = filteredScopes.slice(from ? from - 1 : 0, to);

                tableBody.innerHTML = pageItems.length ? pageItems.map(renderTableRow).join('') : renderEmptyTable();
                cardList.innerHTML = pageItems.length ? pageItems.map(renderCard).join('') : renderEmptyCard();
                countLabel.textContent = total
                    ? `Menampilkan ${from}-${to} dari ${total} data.`
                    : 'Menampilkan 0 data.';

                renderPagination();

                if (shouldScroll) {
                    requestAnimationFrame(scrollToResults);
                }
            };

            const filterScopes = () => {
                const keyword = searchInput.value.trim().toLowerCase();

                filteredScopes = allScopes.filter((scope) => {
                    return keyword === '' || scope.search.includes(keyword);
                });

                renderPage(1);
            };

            const scheduleSearch = () => {
                clearTimeout(requestTimer);
                requestTimer = setTimeout(filterScopes, 60);
            };

            const renderPagination = () => {
                pagination.innerHTML = '';
                const lastPage = Math.ceil(filteredScopes.length / perPage);

                if (lastPage <= 1) {
                    return;
                }

                const pages = paginationRange(currentPage, lastPage);
                const controls = [
                    { label: 'first', page: 1, icon: 'first', disabled: currentPage === 1 },
                    { label: 'prev', page: currentPage - 1, icon: 'prev', disabled: currentPage === 1 },
                    ...pages,
                    { label: 'next', page: currentPage + 1, icon: 'next', disabled: currentPage === lastPage },
                    { label: 'last', page: lastPage, icon: 'last', disabled: currentPage === lastPage },
                ];

                controls.forEach((control) => {
                    if (control === '...') {
                        const ellipsis = document.createElement('span');
                        ellipsis.className = 'grid h-9 min-w-7 place-items-center px-1 text-[13px] font-semibold text-[#8a8a8a] sm:h-12 sm:min-w-12 sm:px-2 sm:text-[16px]';
                        ellipsis.textContent = '...';
                        pagination.appendChild(ellipsis);

                        return;
                    }

                    if (typeof control === 'number') {
                        control = {
                            label: `page-${control}`,
                            page: control,
                        };
                    }

                    const button = document.createElement('button');
                    const isActive = control.page === currentPage && !control.icon;

                    button.type = 'button';
                    button.disabled = control.disabled;
                    button.setAttribute('aria-label', control.label);
                    button.className = [
                        'grid h-9 min-w-9 shrink-0 place-items-center rounded-[7px] border text-[13px] font-semibold transition sm:h-12 sm:min-w-14 sm:rounded-[8px] sm:text-[16px]',
                        isActive
                            ? 'border-[#d4af37] bg-[#d4af37] text-white shadow-[0_14px_30px_rgba(212,175,55,0.28)]'
                            : 'border-black/10 bg-white text-[#4b5563] hover:border-[#08236f] hover:text-[#08236f]',
                        control.disabled ? 'cursor-not-allowed opacity-45 hover:border-black/10 hover:text-[#4b5563]' : '',
                    ].join(' ');

                    button.innerHTML = control.icon ? paginationIcon(control.icon) : control.page;
                    button.addEventListener('click', () => {
                        if (control.disabled) {
                            return;
                        }

                        renderPage(control.page, true);
                    });

                    pagination.appendChild(button);
                });
            };

            const renderTableRow = (scope, index) => `
                <tr class="transition odd:bg-white even:bg-[#f8fafc] hover:bg-[#fff8e1]">
                    <td class="px-4 py-4 align-top text-sm font-semibold text-[#71717a]">${((currentPage - 1) * perPage) + index + 1}</td>
                    <td class="px-4 py-4 align-top text-[14px] font-semibold leading-6 text-[#1f2937]">${escapeHtml(scope.commodity_type)}</td>
                    <td class="px-4 py-4 align-top text-[14px] leading-6 text-[#374151]">${escapeHtml(scope.reference)}</td>
                </tr>
            `;

            const renderCard = (scope) => `
                <div class="rounded-[8px] border border-black/10 bg-white p-4 shadow-[0_10px_30px_rgba(15,23,42,0.05)]">
                    <div class="flex flex-wrap gap-2">
                        <span class="rounded-full bg-[#d4af37]/15 px-3 py-1 text-[12px] font-semibold text-[#7a5b00]">${escapeHtml(scope.reference)}</span>
                    </div>
                    <p class="mt-4 text-[15px] font-semibold leading-6 text-[#1f2937]">${escapeHtml(scope.commodity_type)}</p>
                </div>
            `;

            const renderEmptyTable = () => `
                <tr>
                    <td colspan="3" class="px-4 py-10 text-center">
                        <p class="text-[15px] font-semibold text-[#1f2937]">Data tidak ditemukan.</p>
                        <p class="mt-1 text-sm text-[#71717a]">Coba gunakan kata kunci lain.</p>
                    </td>
                </tr>
            `;

            const renderEmptyCard = () => `
                <div class="rounded-[8px] border border-black/10 bg-white p-8 text-center">
                    <p class="text-[15px] font-semibold text-[#1f2937]">Data tidak ditemukan.</p>
                    <p class="mt-1 text-sm text-[#71717a]">Coba gunakan kata kunci lain.</p>
                </div>
            `;

            const escapeHtml = (value) => String(value ?? '').replace(/[&<>"']/g, (char) => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;',
            })[char]);

            const paginationRange = (page, totalPages) => {
                if (window.matchMedia('(max-width: 639px)').matches) {
                    if (totalPages <= 5) {
                        return Array.from({ length: totalPages }, (_, index) => index + 1);
                    }

                    if (page <= 2) {
                        return [1, 2, '...', totalPages];
                    }

                    if (page >= totalPages - 1) {
                        return [1, '...', totalPages - 1, totalPages];
                    }

                    return [1, '...', page, '...', totalPages];
                }

                if (totalPages <= 7) {
                    return Array.from({ length: totalPages }, (_, index) => index + 1);
                }

                if (page <= 4) {
                    return [1, 2, 3, 4, 5, '...', totalPages];
                }

                if (page >= totalPages - 3) {
                    return [1, '...', totalPages - 4, totalPages - 3, totalPages - 2, totalPages - 1, totalPages];
                }

                return [1, '...', page - 1, page, page + 1, '...', totalPages];
            };

            const paginationIcon = (type) => {
                const icons = {
                    first: '<svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m18 17-5-5 5-5M11 17l-5-5 5-5" /></svg>',
                    prev: '<svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m15 18-6-6 6-6" /></svg>',
                    next: '<svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6" /></svg>',
                    last: '<svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m6 17 5-5-5-5M13 17l5-5-5-5" /></svg>',
                };

                return icons[type];
            };

            searchInput.addEventListener('input', scheduleSearch);
            filterScopes();
        });
    </script>
@endpush
