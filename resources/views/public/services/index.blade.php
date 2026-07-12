@extends('layouts.public')

@section('title', 'Jasa Layanan | BPSMB Surakarta')

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
                        Daftar layanan BPSMB Surakarta
                    </h1>
                    <div class="mt-4 h-0.5 w-14 rounded-full bg-[#d4af37] sm:mt-7 sm:h-1 sm:w-24"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#f5f5f7]">
        <div class="mx-auto max-w-7xl px-4 py-7 sm:px-6 sm:py-10 lg:px-8 lg:py-12">
            @php
                $serviceCards = [
                    [
                        'route' => route('services.testing-duration'),
                        'eyebrow' => 'Jasa Pengujian',
                        'title' => 'Lama Pengujian',
                        'description' => 'Lihat estimasi waktu pengujian berdasarkan kategori dan karakteristik uji.',
                        'tags' => ['Search', 'Accordion'],
                        'accent' => 'text-[#2563eb]',
                        'icon' => 'bg-[#dbeafe] text-[#1d4ed8] group-hover:bg-[#2563eb] group-hover:text-white',
                        'tag' => 'text-[#1d4ed8]',
                        'hover' => 'hover:border-[#2563eb]/45 hover:shadow-[0_24px_70px_rgba(37,99,235,0.12)]',
                    ],
                    [
                        'route' => route('services.testing-accreditation-scope'),
                        'eyebrow' => 'Jasa Pengujian',
                        'title' => 'Ruang Lingkup Akreditasi',
                        'description' => 'Lihat produk, parameter uji, dan metode dalam lingkup akreditasi laboratorium pengujian.',
                        'tags' => ['Produk', 'Metode Uji'],
                        'accent' => 'text-[#2563eb]',
                        'icon' => 'bg-[#dbeafe] text-[#1d4ed8] group-hover:bg-[#2563eb] group-hover:text-white',
                        'tag' => 'text-[#1d4ed8]',
                        'hover' => 'hover:border-[#2563eb]/45 hover:shadow-[0_24px_70px_rgba(37,99,235,0.12)]',
                    ],
                    [
                        'route' => route('services.product-certification'),
                        'eyebrow' => 'Jasa Sertifikasi',
                        'title' => 'Sertifikasi Produk',
                        'description' => 'Informasi LSPro, akreditasi, persyaratan, alur proses, dan pengajuan sertifikasi produk.',
                        'tags' => ['LSPro', 'SNI'],
                        'accent' => 'text-[#2563eb]',
                        'icon' => 'bg-[#dbeafe] text-[#1d4ed8] group-hover:bg-[#2563eb] group-hover:text-white',
                        'tag' => 'text-[#1d4ed8]',
                        'hover' => 'hover:border-[#2563eb]/45 hover:shadow-[0_24px_70px_rgba(37,99,235,0.12)]',
                    ],
                    [
                        'route' => route('services.sample-collection'),
                        'eyebrow' => 'Jasa Layanan',
                        'title' => 'Pengambilan Contoh',
                        'description' => 'Lihat daftar biaya pengambilan contoh berdasarkan uraian komoditas dan satuan layanan.',
                        'tags' => ['Tabel Biaya', 'Sample'],
                        'accent' => 'text-[#2563eb]',
                        'icon' => 'bg-[#dbeafe] text-[#1d4ed8] group-hover:bg-[#2563eb] group-hover:text-white',
                        'tag' => 'text-[#1d4ed8]',
                        'hover' => 'hover:border-[#2563eb]/45 hover:shadow-[0_24px_70px_rgba(37,99,235,0.12)]',
                    ],
                    [
                        'route' => route('services.calibration'),
                        'eyebrow' => 'Jasa Layanan',
                        'title' => 'Kalibrasi',
                        'description' => 'Lihat ruang lingkup kalibrasi alat ukur, mulai dari massa, suhu, volume, hingga pH meter.',
                        'tags' => ['Tabel Scope', 'KAN'],
                        'accent' => 'text-[#2563eb]',
                        'icon' => 'bg-[#dbeafe] text-[#1d4ed8] group-hover:bg-[#2563eb] group-hover:text-white',
                        'tag' => 'text-[#1d4ed8]',
                        'hover' => 'hover:border-[#2563eb]/45 hover:shadow-[0_24px_70px_rgba(37,99,235,0.12)]',
                    ],
                    [
                        'route' => route('lph'),
                        'eyebrow' => 'Jasa Sertifikasi',
                        'title' => 'Lembaga Pemeriksa Halal',
                        'description' => 'Pemeriksaan produk, bahan, proses, dan dokumen pendukung untuk sertifikasi halal.',
                        'tags' => ['Halal', 'BPJPH'],
                        'accent' => 'text-[#2563eb]',
                        'icon' => 'bg-[#dbeafe] text-[#1d4ed8] group-hover:bg-[#2563eb] group-hover:text-white',
                        'tag' => 'text-[#1d4ed8]',
                        'hover' => 'hover:border-[#2563eb]/45 hover:shadow-[0_24px_70px_rgba(37,99,235,0.12)]',
                    ],
                ];
            @endphp

            <div class="grid gap-3 sm:mt-8 sm:gap-5 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($serviceCards as $card)
                    <a href="{{ $card['route'] }}"
                        class="group border-l-4 border-l-[#d4af37] rounded-[8px] border border-black/10 bg-white p-4 shadow-[0_10px_28px_rgba(15,23,42,0.06)] transition hover:-translate-y-0.5 {{ $card['hover'] }} sm:p-6 sm:shadow-[0_18px_50px_rgba(15,23,42,0.07)]">
                        <div class="flex items-start justify-between gap-3 sm:gap-4">
                            <div class="min-w-0">
                                <p class="text-[9px] font-semibold uppercase tracking-[0.12em] {{ $card['accent'] }} sm:text-[12px] sm:tracking-[0.14em]">
                                    {{ $card['eyebrow'] }}
                                </p>
                                <h2 class="mt-2 text-[15px] font-semibold leading-snug text-[#08236f] sm:mt-3 sm:text-xl">
                                    {{ $card['title'] }}
                                </h2>
                            </div>
                            <span class="grid h-8 w-8 shrink-0 place-items-center rounded-full transition {{ $card['icon'] }} sm:h-10 sm:w-10">
                                <svg class="h-3.5 w-3.5 sm:h-4.5 sm:w-4.5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                </svg>
                            </span>
                        </div>
                        <p class="mt-3 text-[12px] leading-5 text-[#52525b] sm:mt-4 sm:text-sm sm:leading-6">
                            {{ $card['description'] }}
                        </p>
                        <div class="mt-3 flex flex-wrap items-center gap-x-2 gap-y-1 text-[10px] font-semibold uppercase tracking-[0.1em] sm:mt-5 sm:text-[11px]">
                            @foreach ($card['tags'] as $tagIndex => $tag)
                                @if ($tagIndex > 0)
                                    <span class="h-1 w-1 rounded-full bg-[#d4af37]" aria-hidden="true"></span>
                                @endif
                                <span class="{{ $card['tag'] }}">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
