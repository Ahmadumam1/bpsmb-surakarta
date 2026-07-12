@extends('layouts.public')

@section('title', 'Survei Kepuasan Pelanggan | BPSMB Surakarta')
@section('meta_description', 'Informasi survei kepuasan pelanggan BPSMB Surakarta dalam bentuk gambar atau PDF.')

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
                    <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-[#d4af37] sm:text-[12px] sm:tracking-[0.16em]">Survei Kepuasan</p>
                    <h1
                        class="mt-2 max-w-3xl text-[25px] font-semibold leading-[1.12] text-[#08236f] sm:mt-4 sm:text-[40px]">
                        Survei Kepuasan Pelanggan
                    </h1>
                    <div class="mt-4 h-0.5 w-14 rounded-full bg-[#d4af37] sm:mt-7 sm:h-1 sm:w-24"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#f5f5f7]">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8 lg:py-12">
            @if ($surveys->isNotEmpty())
                <div class="grid gap-6 md:grid-cols-2 md:justify-between">
                    @foreach ($surveys as $survey)
                        <article class="w-full md:max-w-[420px]">
                            @if ($surveys->count() > 1)
                                <div class="mb-4">
                                    <p class="text-[12px] font-semibold uppercase tracking-[0.14em] text-[#d4af37]">
                                        Dokumen Survei
                                    </p>
                                    <h2 class="mt-2 text-2xl font-semibold text-[#08236f]">{{ $survey->title }}</h2>
                                    @if ($survey->description)
                                        <p class="mt-2 text-sm leading-6 text-[#52525b]">{{ $survey->description }}</p>
                                    @endif
                                </div>
                            @endif

                            @if ($survey->isPdf())
                                <div class="relative w-full overflow-hidden rounded-[8px] border border-black/10 bg-white shadow-[0_4px_24px_rgba(15,23,42,0.10)]"
                                    style="aspect-ratio: 210 / 297;">
                                    <a href="{{ $survey->openUrl() }}" target="_blank" rel="noopener"
                                        aria-label="Buka PDF di tab baru"
                                        class="absolute right-3 top-3 z-10 grid h-10 w-10 place-items-center rounded-[8px] bg-black/70 text-white shadow-[0_10px_24px_rgba(0,0,0,0.22)] transition hover:bg-[#08236f]">
                                        <svg class="h-4.5 w-4.5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.5 6H18m0 0v4.5M18 6l-7.5 7.5M6 6h4.5M6 6v12h12v-4.5" />
                                        </svg>
                                    </a>
                                    <iframe src="{{ $survey->openUrl() }}#toolbar=1&navpanes=0&scrollbar=1&page=1&view=FitH"
                                        title="{{ $survey->title }}" class="h-full w-full border-0" loading="lazy">
                                    </iframe>
                                </div>
                            @elseif ($survey->isImage())
                                <div class="relative grid w-full place-items-center overflow-hidden rounded-[8px] border border-black/10 bg-white p-3 shadow-[0_4px_24px_rgba(15,23,42,0.10)] sm:p-5">
                                    <a href="{{ $survey->openUrl() }}" target="_blank" rel="noopener"
                                        aria-label="Buka gambar di tab baru"
                                        class="absolute right-3 top-3 z-10 grid h-10 w-10 place-items-center rounded-[8px] bg-black/70 text-white shadow-[0_10px_24px_rgba(0,0,0,0.22)] transition hover:bg-[#08236f]">
                                        <svg class="h-4.5 w-4.5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.5 6H18m0 0v4.5M18 6l-7.5 7.5M6 6h4.5M6 6v12h12v-4.5" />
                                        </svg>
                                    </a>
                                    <img src="{{ $survey->openUrl() }}" alt="{{ $survey->title }}"
                                        class="h-auto w-auto max-w-full object-contain" loading="lazy">
                                </div>
                            @endif
                        </article>
                    @endforeach
                </div>
            @else
                <div
                    class="grid min-h-[320px] place-items-center rounded-[8px] border border-black/10 bg-white p-8 text-center shadow-[0_18px_50px_rgba(15,23,42,0.07)]">
                    <div class="max-w-sm">
                        <div
                            class="mx-auto mb-4 grid h-14 w-14 place-items-center rounded-full bg-[#f1f5f9] text-[#94a3b8]">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414A1 1 0 0 1 19 9.414V19a2 2 0 0 1-2 2Z" />
                            </svg>
                        </div>
                        <p class="text-[16px] font-semibold text-[#08236f]">Dokumen survei belum tersedia.</p>
                        <p class="mt-2 text-sm leading-6 text-[#52525b]">
                            Silakan unggah gambar atau PDF melalui menu admin Survei Kepuasan Pelanggan.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
