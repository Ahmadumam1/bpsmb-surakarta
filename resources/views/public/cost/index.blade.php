@extends('layouts.public')

@section('title', 'Biaya Layanan | BPSMB Surakarta')
@section('meta_description', 'Informasi biaya layanan BPSMB Surakarta berdasarkan Pergub Jateng No. 35 Tahun 2024.')

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
                    <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-[#d4af37] sm:text-[12px] sm:tracking-[0.16em]">Informasi Publik</p>
                    <h1
                        class="mt-2 max-w-3xl text-[25px] font-semibold leading-[1.12] text-[#08236f] sm:mt-4 sm:text-[40px]">
                        Biaya Layanan
                    </h1>
                    <p class="mt-3 max-w-2xl text-[13px] leading-6 text-[#4b5563] sm:mt-5 sm:text-[16px] sm:leading-7">
                        Daftar tarif layanan BPSMB Surakarta berdasarkan Pergub Jateng No. 35 Tahun 2024.
                    </p>
                    <div class="mt-4 h-0.5 w-14 rounded-full bg-[#d4af37] sm:mt-7 sm:h-1 sm:w-24"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#f5f5f7]">
        <div class="mx-auto max-w-7xl px-4 py-7 sm:px-6 sm:py-10 lg:px-8 lg:py-12">
            <div class="rounded-[8px] border border-black/10 bg-[#08236f] p-4 text-white shadow-[0_10px_28px_rgba(8,35,111,0.14)] sm:p-5 sm:shadow-[0_14px_40px_rgba(8,35,111,0.16)]">
                <div class="flex items-center justify-between gap-3">
                    <div class="min-w-0">
                        <p class="text-[9px] font-semibold uppercase tracking-[0.12em] text-white/64 sm:text-[12px] sm:tracking-[0.14em]">Dasar Tarif</p>
                        <p class="mt-1 text-[13px] font-semibold leading-5 sm:mt-2 sm:text-[16px] sm:leading-6">Pergub Jateng No. 35 Tahun 2024</p>
                    </div>
                    @if ($costDocument)
                        <a href="{{ $costDocument->openUrl() }}" target="_blank" rel="noopener"
                            class="inline-flex h-8 shrink-0 items-center justify-center gap-1.5 rounded-[7px] bg-white px-3 text-[11px] font-semibold text-[#08236f] transition hover:bg-[#f5f5f7] sm:h-11 sm:gap-2 sm:rounded-[8px] sm:px-4 sm:text-sm">
                            <span>Lihat File</span>
                            <svg class="h-3.5 w-3.5 sm:h-4 sm:w-4" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 6H18m0 0v4.5M18 6l-7.5 7.5M6 6h4.5M6 6v12h12v-4.5" />
                            </svg>
                        </a>
                    @else
                        <span class="shrink-0 text-[11px] font-semibold text-white/72 sm:text-sm">File belum tersedia</span>
                    @endif
                </div>
            </div>

            <div id="service-fee-app" class="mt-6 overflow-hidden rounded-[8px] border border-black/10 bg-white shadow-[0_24px_70px_rgba(15,23,42,0.08)]">
                <div class="border-b border-black/10 p-4 sm:p-5">
                    <div>
                        <label class="relative block">
                            <span class="sr-only">Cari biaya layanan</span>
                            <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-[#71717a]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" />
                            </svg>
                            <input type="search" data-fee-search value="{{ $search }}" placeholder="Cari layanan, parameter, satuan, atau tarif..." class="h-12 w-full rounded-[8px] border border-black/10 bg-[#f8fafc] pl-12 pr-4 text-[14px] font-medium text-[#1f2937] outline-none transition placeholder:text-[#8a8a8a] focus:border-[#08236f] focus:bg-white focus:ring-4 focus:ring-[#08236f]/10">
                        </label>
                    </div>
                    <p class="mt-3 text-sm font-medium text-[#71717a]" data-fee-count>
                        Menampilkan 0 data.
                    </p>
                </div>

                <div data-fee-results>
                    <div class="service-table-compact overflow-x-auto">
                        <table class="w-full min-w-[960px] text-left">
                            <thead class="sticky top-0 z-10 bg-[#08236f] text-white">
                                <tr>
                                    <th class="w-16 px-5 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">No</th>
                                    <th class="w-[230px] px-5 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">Kategori</th>
                                    <th class="px-5 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">Uraian Layanan</th>
                                    <th class="w-[160px] px-5 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">Satuan</th>
                                    <th class="w-[180px] px-5 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">Tarif</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-black/10" data-fee-table-body></tbody>
                        </table>
                    </div>

                    <div class="hidden" data-fee-card-list></div>
                </div>

                <div class="border-t border-black/10 px-4 py-4 sm:px-5">
                    <div class="flex flex-nowrap items-center justify-start gap-1.5 overflow-x-auto sm:justify-center sm:gap-2" data-fee-pagination></div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const app = document.querySelector('#service-fee-app');

            if (!app) return;

            const allFees = @js($fees->values());
            const searchInput = app.querySelector('[data-fee-search]');
            const tableBody = app.querySelector('[data-fee-table-body]');
            const cardList = app.querySelector('[data-fee-card-list]');
            const countLabel = app.querySelector('[data-fee-count]');
            const pagination = app.querySelector('[data-fee-pagination]');
            const perPage = 15;
            let currentPage = 1;
            let requestTimer = null;
            let filteredFees = allFees;

            const scrollToResults = () => {
                const top = app.getBoundingClientRect().top + window.scrollY - 88;
                window.scrollTo({ top: Math.max(top, 0), behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth' });
            };

            const renderPage = (page = 1, shouldScroll = false) => {
                currentPage = page;
                const total = filteredFees.length;
                const from = total ? (currentPage - 1) * perPage + 1 : 0;
                const to = Math.min(currentPage * perPage, total);
                const pageItems = filteredFees.slice(from ? from - 1 : 0, to);

                tableBody.innerHTML = pageItems.length ? pageItems.map(renderTableRow).join('') : renderEmptyTable();
                cardList.innerHTML = pageItems.length ? pageItems.map(renderCard).join('') : renderEmptyCard();
                countLabel.textContent = total ? `Menampilkan ${from}-${to} dari ${total} data.` : 'Menampilkan 0 data.';
                renderPagination();

                if (shouldScroll) requestAnimationFrame(scrollToResults);
            };

            const filterFees = () => {
                const keyword = searchInput.value.trim().toLowerCase();

                filteredFees = keyword
                    ? allFees.filter((fee) => fee.search.includes(keyword))
                    : allFees;

                renderPage(1);
            };

            const scheduleSearch = () => {
                clearTimeout(requestTimer);
                requestTimer = setTimeout(filterFees, 60);
            };

            const renderPagination = () => {
                pagination.innerHTML = '';
                const lastPage = Math.ceil(filteredFees.length / perPage);

                if (lastPage <= 1) return;

                const controls = [
                    { label: 'first', page: 1, icon: 'first', disabled: currentPage === 1 },
                    { label: 'prev', page: currentPage - 1, icon: 'prev', disabled: currentPage === 1 },
                    ...paginationRange(currentPage, lastPage),
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

                    if (typeof control === 'number') control = { label: `page-${control}`, page: control };

                    const button = document.createElement('button');
                    const isActive = control.page === currentPage && !control.icon;
                    button.type = 'button';
                    button.disabled = control.disabled;
                    button.setAttribute('aria-label', control.label);
                    button.className = [
                        'grid h-9 min-w-9 shrink-0 place-items-center rounded-[7px] border text-[13px] font-semibold transition sm:h-12 sm:min-w-14 sm:rounded-[8px] sm:text-[16px]',
                        isActive ? 'border-[#d4af37] bg-[#d4af37] text-white shadow-[0_14px_30px_rgba(212,175,55,0.28)]' : 'border-black/10 bg-white text-[#4b5563] hover:border-[#08236f] hover:text-[#08236f]',
                        control.disabled ? 'cursor-not-allowed opacity-45 hover:border-black/10 hover:text-[#4b5563]' : '',
                    ].join(' ');
                    button.innerHTML = control.icon ? paginationIcon(control.icon) : control.page;
                    button.addEventListener('click', () => !control.disabled && renderPage(control.page, true));
                    pagination.appendChild(button);
                });
            };

            const renderTableRow = (fee, index) => `
                <tr class="transition odd:bg-white even:bg-[#f8fafc] hover:bg-[#fff8e1]">
                    <td class="px-5 py-4 align-top text-sm font-semibold text-[#71717a]">${((currentPage - 1) * perPage) + index + 1}</td>
                    <td class="px-5 py-4 align-top">
                        <p class="text-[14px] font-medium leading-6 text-[#4b5563]">${escapeHtml(fee.category)}</p>
                    </td>
                    <td class="px-5 py-4 align-top">
                        <p class="text-[15px] font-semibold leading-6 text-[#1f2937]">${escapeHtml(fee.service_name)}</p>
                        ${fee.description ? `<p class="mt-1 text-sm leading-6 text-[#71717a]">${escapeHtml(fee.description)}</p>` : ''}
                    </td>
                    <td class="px-5 py-4 align-top">
                        <p class="text-[14px] font-medium leading-6 text-[#4b5563]">${escapeHtml(fee.unit)}</p>
                    </td>
                    <td class="px-5 py-4 align-top">
                        <p class="text-[14px] font-semibold leading-6 text-[#1f2937]">${escapeHtml(fee.formatted_price)}</p>
                    </td>
                </tr>
            `;

            const renderCard = (fee) => `
                <div class="rounded-[8px] border border-black/10 bg-white p-4 shadow-[0_10px_30px_rgba(15,23,42,0.05)]">
                    <div class="grid gap-1.5">
                        <p class="text-[13px] font-medium leading-5 text-[#4b5563]">${escapeHtml(fee.category)}</p>
                        <p class="text-[13px] font-medium leading-5 text-[#4b5563]">${escapeHtml(fee.unit)}</p>
                        <p class="text-[13px] font-semibold leading-5 text-[#1f2937]">${escapeHtml(fee.formatted_price)}</p>
                    </div>
                    <p class="mt-3 text-[15px] font-semibold leading-6 text-[#1f2937]">${escapeHtml(fee.service_name)}</p>
                    ${fee.description ? `<p class="mt-1 text-sm leading-6 text-[#71717a]">${escapeHtml(fee.description)}</p>` : ''}
                </div>
            `;

            const renderEmptyTable = () => `
                <tr>
                    <td colspan="5" class="px-5 py-12 text-center">
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
                    if (totalPages <= 5) return Array.from({ length: totalPages }, (_, index) => index + 1);
                    if (page <= 2) return [1, 2, '...', totalPages];
                    if (page >= totalPages - 1) return [1, '...', totalPages - 1, totalPages];
                    return [1, '...', page, '...', totalPages];
                }

                if (totalPages <= 7) return Array.from({ length: totalPages }, (_, index) => index + 1);
                if (page <= 4) return [1, 2, 3, 4, 5, '...', totalPages];
                if (page >= totalPages - 3) return [1, '...', totalPages - 4, totalPages - 3, totalPages - 2, totalPages - 1, totalPages];
                return [1, '...', page - 1, page, page + 1, '...', totalPages];
            };

            const paginationIcon = (type) => ({
                first: '<svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m18 17-5-5 5-5M11 17l-5-5 5-5" /></svg>',
                prev: '<svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m15 18-6-6 6-6" /></svg>',
                next: '<svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6" /></svg>',
                last: '<svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m6 17 5-5-5-5M13 17l5-5-5-5" /></svg>',
            })[type];

            searchInput.addEventListener('input', scheduleSearch);
            filterFees();
        });
    </script>
@endpush
