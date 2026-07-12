@extends('layouts.public')

@section('title', 'Pengaduan | BPSMB Surakarta')
@section('meta_description', 'Sampaikan pengaduan pelayanan publik BPSMB Surakarta melalui kanal resmi LAPOR.')

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
                    <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-[#d4af37] sm:text-[12px] sm:tracking-[0.16em]">Pengaduan Publik</p>
                    <h1
                        class="mt-2 max-w-3xl text-[25px] font-semibold leading-[1.12] text-[#08236f] sm:mt-4 sm:text-[40px]">
                        Layanan Aspirasi dan Pengaduan
                    </h1>
                    <div class="mt-4 h-0.5 w-14 rounded-full bg-[#d4af37] sm:mt-7 sm:h-1 sm:w-24"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#f5f5f7]">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-12">
            <div class="rounded-[8px] border border-black/10 bg-white p-6 shadow-[0_18px_50px_rgba(15,23,42,0.07)] sm:p-8">
                <p class="text-[12px] font-semibold uppercase tracking-[0.14em] text-[#d4af37]">Kanal Resmi</p>
                <h2 class="mt-3 text-2xl font-semibold text-[#08236f]">Pengaduan melalui LAPOR</h2>
                <p class="mt-4 text-sm leading-7 text-[#52525b]">
                    BPSMB Surakarta menggunakan SP4N-LAPOR sebagai kanal pengaduan resmi agar laporan dapat tercatat,
                    dipantau, dan ditindaklanjuti sesuai mekanisme pelayanan publik.
                </p>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="https://www.lapor.go.id/" target="_blank" rel="noopener"
                        class="inline-flex items-center gap-2 rounded-[8px] bg-[#08236f] px-5 py-3 text-sm font-semibold text-white shadow-[0_16px_36px_rgba(8,35,111,0.22)] transition hover:bg-[#061a54]">
                        <span>Buka LAPOR</span>
                        <svg class="h-4.5 w-4.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 6H18m0 0v4.5M18 6l-7.5 7.5M6 6h4.5M6 6v12h12v-4.5" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
