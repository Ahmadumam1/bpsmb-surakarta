@extends('layouts.public')

@section('title', 'Jasa Kalibrasi | BPSMB Surakarta')
@section('meta_description', 'Informasi layanan dan ruang lingkup Laboratorium Kalibrasi BPSMB Surakarta.')

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
                    <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-[#d4af37] sm:text-[12px] sm:tracking-[0.16em]">Jasa Layanan</p>
                    <h1
                        class="mt-2 max-w-3xl text-[25px] font-semibold leading-[1.12] text-[#08236f] sm:mt-4 sm:text-[40px]">
                        Jasa Kalibrasi
                    </h1>
                    <p class="mt-3 max-w-2xl text-[13px] leading-6 text-[#4b5563] sm:mt-5 sm:text-[16px] sm:leading-7">
                        Layanan kalibrasi untuk memastikan akurasi dan keandalan alat ukur melalui standar acuan yang
                        tertelusur.
                    </p>
                    <div class="mt-4 h-0.5 w-14 rounded-full bg-[#d4af37] sm:mt-7 sm:h-1 sm:w-24"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#f5f5f7]">
        <div class="mx-auto max-w-7xl px-4 py-5 sm:px-6 sm:py-8 lg:px-8 lg:py-10">
            <div id="calibration-scope-app"
                class="overflow-hidden rounded-[8px] border border-black/10 bg-white shadow-[0_24px_70px_rgba(15,23,42,0.08)]">
                <div class="border-b border-black/10 p-4 sm:p-5">
                    <div>
                        <label class="relative block">
                            <span class="sr-only">Cari ruang lingkup kalibrasi</span>
                            <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-[#71717a]"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" />
                            </svg>
                            <input type="search" data-calibration-search placeholder="Cari kategori atau alat..."
                                class="h-12 w-full rounded-[8px] border border-black/10 bg-[#f8fafc] pl-12 pr-4 text-[14px] font-medium text-[#1f2937] outline-none transition placeholder:text-[#8a8a8a] focus:border-[#08236f] focus:bg-white focus:ring-4 focus:ring-[#08236f]/10">
                        </label>
                    </div>
                </div>

                <div class="service-table-compact overflow-x-auto">
                    <table class="w-full min-w-[820px] text-left">
                        <thead class="sticky top-0 z-10 bg-[#08236f] text-white">
                            <tr>
                                <th class="w-16 px-5 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">No</th>
                                <th class="w-[260px] px-5 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">
                                    Kategori Pengukuran</th>
                                <th class="px-5 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">Jenis Alat atau
                                    Standar</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black/10" data-calibration-rows>
                            @foreach ($calibrationScopes as $scope)
                                @foreach ($scope['items'] as $item)
                                    <tr class="transition odd:bg-white even:bg-[#f8fafc] hover:bg-[#fff8e1]"
                                        data-calibration-row data-category="{{ Str::slug($scope['category']) }}"
                                        data-search="{{ Str::lower($scope['category'] . ' ' . $item) }}">
                                        @if ($loop->first)
                                            <td class="px-5 py-4 align-top text-sm font-semibold text-[#71717a]"
                                                rowspan="{{ count($scope['items']) }}">
                                                {{ $scope['number'] }}
                                            </td>
                                            <td class="px-5 py-4 align-top" rowspan="{{ count($scope['items']) }}">
                                                <p class="text-[15px] font-semibold leading-6 text-[#1f2937]">
                                                    {{ $scope['category'] }}</p>
                                            </td>
                                        @endif
                                        <td class="px-5 py-4 align-top">
                                            <p class="text-[15px] font-medium leading-6 text-[#4b5563]">{{ $item }}
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <div class="hidden px-5 py-12 text-center" data-calibration-empty>
                        <p class="text-[15px] font-semibold text-[#1f2937]">Data tidak ditemukan.</p>
                        <p class="mt-1 text-sm text-[#71717a]">Coba gunakan kata kunci lain.</p>
                    </div>
                </div>

                <div class="hidden">
                    @foreach ($calibrationScopes as $scope)
                        <div class="rounded-[8px] border border-black/10 bg-white p-4 shadow-[0_10px_30px_rgba(15,23,42,0.05)]"
                            data-calibration-card
                            data-search="{{ Str::lower($scope['category'] . ' ' . implode(' ', $scope['items'])) }}">
                            <div class="flex items-center gap-2">
                                <span
                                    class="grid h-8 w-8 shrink-0 place-items-center rounded-full bg-[#eef2ff] text-sm font-semibold text-[#08236f]">
                                    {{ $scope['number'] }}
                                </span>
                                <p class="text-[15px] font-semibold leading-6 text-[#1f2937]">{{ $scope['category'] }}</p>
                            </div>
                            <div class="mt-3 flex flex-wrap gap-2">
                                @foreach ($scope['items'] as $item)
                                    <span
                                        class="rounded-full bg-[#f8fafc] px-3 py-1 text-[12px] font-semibold leading-5 text-[#4b5563]">
                                        {{ $item }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    <div class="hidden rounded-[8px] border border-black/10 bg-white p-8 text-center"
                        data-calibration-empty-mobile>
                        <p class="text-[15px] font-semibold text-[#1f2937]">Data tidak ditemukan.</p>
                        <p class="mt-1 text-sm text-[#71717a]">Coba gunakan kata kunci lain.</p>
                    </div>
                </div>
            </div>

            @include('public.services.partials.related-services', ['current' => 'calibration'])

            <div
                class="mt-5 grid gap-3 rounded-[8px] border border-black/10 bg-[#08236f] p-3 text-white shadow-[0_12px_32px_rgba(8,35,111,0.14)] sm:mt-6 sm:gap-4 sm:p-5 sm:shadow-[0_20px_56px_rgba(8,35,111,0.16)] lg:grid-cols-[1fr_auto] lg:items-center">
                <div>
                    <p class="text-[15px] font-semibold leading-snug sm:text-[18px]">Perlu kalibrasi alat ukur?</p>
                    <p class="mt-1.5 max-w-2xl text-[12px] leading-5 text-white/72 sm:text-[13px] sm:leading-6">
                        Hubungi petugas layanan untuk memastikan jenis alat, dokumen pendukung, dan jadwal kalibrasi.
                    </p>
                </div>
                <div class="grid gap-2 sm:flex sm:flex-wrap sm:gap-2.5 lg:justify-end">
                    <a href="{{ route('contact') }}"
                        class="inline-flex h-9 w-full items-center justify-center rounded-[7px] bg-white px-3 text-[12px] font-semibold text-[#08236f] transition hover:bg-[#f5f5f7] sm:h-10 sm:w-auto sm:rounded-[8px] sm:px-4 sm:text-sm">
                        Hubungi Kami
                    </a>
                    <a href="{{ route('complaints.create') }}"
                        class="inline-flex h-9 w-full items-center justify-center rounded-[7px] border border-white/25 px-3 text-[12px] font-semibold text-white transition hover:bg-white/10 sm:h-10 sm:w-auto sm:rounded-[8px] sm:px-4 sm:text-sm">
                        Ajukan Layanan
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const app = document.querySelector('#calibration-scope-app');

            if (!app) {
                return;
            }

            const searchInput = app.querySelector('[data-calibration-search]');
            const rows = Array.from(app.querySelectorAll('[data-calibration-row]'));
            const cards = Array.from(app.querySelectorAll('[data-calibration-card]'));
            const emptyTable = app.querySelector('[data-calibration-empty]');
            const emptyMobile = app.querySelector('[data-calibration-empty-mobile]');

            const filterScopes = () => {
                const keyword = searchInput.value.trim().toLowerCase();
                const matchingCategories = new Set();
                let visibleRows = 0;

                rows.forEach((row) => {
                    if (row.dataset.search.includes(keyword)) {
                        matchingCategories.add(row.dataset.category);
                    }
                });

                rows.forEach((row) => {
                    const isVisible = keyword === '' || matchingCategories.has(row.dataset.category);

                    row.classList.toggle('hidden', !isVisible);
                    visibleRows += isVisible ? 1 : 0;
                });

                cards.forEach((card) => {
                    const isVisible = card.dataset.search.includes(keyword);

                    card.classList.toggle('hidden', !isVisible);
                });

                emptyTable.classList.toggle('hidden', visibleRows > 0);
                emptyMobile.classList.toggle('hidden', matchingCategories.size > 0 || keyword === '');
            };

            searchInput.addEventListener('input', filterScopes);
        });
    </script>
@endpush
