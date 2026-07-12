@extends('layouts.public')

@section('title', 'Download | BPSMB Surakarta')
@section('meta_description', 'Lihat dokumen, formulir, regulasi, dan panduan layanan BPSMB Surakarta.')

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
                    <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-[#d4af37] sm:text-[12px] sm:tracking-[0.16em]">Download</p>
                    <h1
                        class="mt-2 max-w-3xl text-[25px] font-semibold leading-[1.12] text-[#08236f] sm:mt-4 sm:text-[40px]">
                        Dokumen dan Formulir
                    </h1>
                    <div class="mt-4 h-0.5 w-14 rounded-full bg-[#d4af37] sm:mt-7 sm:h-1 sm:w-24"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#f5f5f7]">
        <div class="mx-auto max-w-7xl px-4 py-7 sm:px-6 sm:py-10 lg:px-8 lg:py-12">
            @if ($documents->isNotEmpty())
                <div class="overflow-hidden rounded-[8px] border border-black/10 bg-white shadow-[0_18px_50px_rgba(15,23,42,0.06)]">
                    <div class="download-table-compact overflow-hidden sm:overflow-x-auto">
                        <table class="w-full table-fixed border-collapse text-left sm:table-auto sm:min-w-[760px]">
                            <thead>
                                <tr class="border-b border-black/10 bg-[#f8fafc] text-[9px] font-bold uppercase tracking-[0.06em] text-[#64748b] sm:text-[11px] sm:tracking-[0.08em]">
                                    <th class="px-2.5 py-2.5 sm:px-6 sm:py-4">Nama Dokumen</th>
                                    <th class="w-16 px-2 py-2.5 text-right sm:w-36 sm:px-6 sm:py-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-black/10">
                                @foreach ($documents as $document)
                                    <tr class="transition hover:bg-[#f8fafc]">
                                        <td class="min-w-0 px-2.5 py-2.5 sm:px-6 sm:py-5">
                                            <div class="flex min-w-0 items-start gap-2 sm:gap-4">
                                                <span class="grid h-7 w-7 shrink-0 place-items-center rounded-[6px] bg-[#08236f]/10 text-[#08236f] sm:h-11 sm:w-11 sm:rounded-[8px]">
                                                    <svg class="h-3.5 w-3.5 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"
                                                        aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-.988-2.387l-4.5-4.5a3.375 3.375 0 0 0-2.387-.988H8.25A2.25 2.25 0 0 0 6 6v12a2.25 2.25 0 0 0 2.25 2.25h9A2.25 2.25 0 0 0 19.5 18v-3.75Z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9.75 12h4.5m-4.5 3h4.5" />
                                                    </svg>
                                                </span>
                                                <div class="min-w-0">
                                                    <h2 class="break-words text-[11px] font-semibold leading-4 text-[#08236f] sm:text-base sm:leading-6">{{ $document->title }}</h2>
                                                    <span class="mt-1 inline-flex rounded-full bg-[#eef2ff] px-1.5 py-0.5 text-[8px] font-semibold leading-3 text-[#08236f] sm:mt-2 sm:px-3 sm:py-1 sm:text-[12px] sm:leading-normal">
                                                        {{ $document->badgeLabel() }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-2 py-2.5 text-right sm:px-6 sm:py-5">
                                            <a href="{{ $document->viewUrl() }}" target="_blank" rel="noopener"
                                                class="inline-flex h-7 w-7 items-center justify-center rounded-[6px] border border-[#08236f] text-[0] font-semibold text-[#08236f] transition hover:bg-[#08236f] hover:text-white sm:h-10 sm:w-auto sm:gap-2 sm:rounded-[8px] sm:px-4 sm:text-sm">
                                                <svg class="h-3.5 w-3.5 sm:h-4 sm:w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                                    aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12s-3.75 6.75-9.75 6.75S2.25 12 2.25 12Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                                <span class="sr-only sm:not-sr-only">Lihat</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="grid min-h-[260px] place-items-center rounded-[8px] border border-black/10 bg-white p-6 text-center shadow-[0_18px_50px_rgba(15,23,42,0.06)] sm:min-h-[320px] sm:p-8">
                    <div class="max-w-sm">
                        <div class="mx-auto grid h-12 w-12 place-items-center rounded-full bg-[#eef2ff] text-[#08236f] sm:h-14 sm:w-14">
                            <svg class="h-5 w-5 sm:h-6 sm:w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-.988-2.387l-4.5-4.5a3.375 3.375 0 0 0-2.387-.988H8.25A2.25 2.25 0 0 0 6 6v12a2.25 2.25 0 0 0 2.25 2.25h9A2.25 2.25 0 0 0 19.5 18v-3.75Z" />
                            </svg>
                        </div>
                        <p class="mt-4 text-base font-semibold text-[#08236f] sm:text-lg">Dokumen belum tersedia.</p>
                        <p class="mt-2 text-[13px] leading-6 text-[#64748b] sm:text-sm">Dokumen akan tampil di sini setelah diaktifkan.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
