@extends('layouts.public')

@section('title', 'Jasa Sertifikasi Produk | BPSMB Surakarta')
@section('meta_description', 'Informasi layanan sertifikasi produk LSPro BPSMB Surakarta, akreditasi, alur layanan, persyaratan, dan kontak layanan.')

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

        <div class="relative mx-auto grid max-w-7xl gap-4 px-4 py-6 sm:gap-8 sm:px-6 sm:py-14 lg:grid-cols-[1fr_390px] lg:items-center lg:px-8 lg:py-20">
            <div class="max-w-4xl">
                <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-[#d4af37] sm:text-[12px] sm:tracking-[0.16em]">Jasa Sertifikasi Produk</p>
                <h1 class="mt-2 max-w-3xl text-[25px] font-semibold leading-[1.12] text-[#08236f] sm:mt-4 sm:text-[40px]">
                    LSPro BPSMB Surakarta
                </h1>
                <p class="mt-3 max-w-2xl text-[13px] leading-6 text-[#4b5563] sm:mt-5 sm:text-[16px] sm:leading-7">
                    Lembaga Sertifikasi Produk BPSMB Surakarta melayani sertifikasi produk berbasis SNI untuk membantu
                    pelaku usaha memastikan kesesuaian mutu barang secara profesional dan terakreditasi.
                </p>

                <div class="mt-5 grid gap-2 sm:mt-7 sm:flex sm:flex-wrap sm:gap-3">
                    <a href="#informasi-sertifikasi"
                        class="inline-flex h-10 items-center justify-center rounded-[8px] bg-[#08236f] px-4 text-[13px] font-semibold text-white transition hover:bg-[#061a53] sm:h-11 sm:text-sm">
                        Lihat Informasi
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex h-10 items-center justify-center rounded-[8px] border border-black/10 bg-white px-4 text-[13px] font-semibold text-[#08236f] transition hover:border-[#08236f]/30 sm:h-11 sm:text-sm">
                        Hubungi LSPro
                    </a>
                </div>
            </div>

            <div class="rounded-[8px] border border-black/10 bg-white/88 p-4 shadow-[0_16px_42px_rgba(15,23,42,0.08)] backdrop-blur sm:p-5 sm:shadow-[0_24px_70px_rgba(15,23,42,0.08)]">
                <div class="flex items-center gap-3 border-b border-black/10 pb-4 sm:gap-4 sm:pb-5">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo BPSMB Surakarta" class="h-12 w-12 shrink-0 object-contain sm:h-16 sm:w-16">
                    <div>
                        <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#d4af37] sm:text-[12px]">Akreditasi</p>
                        <p class="mt-1 text-[18px] font-semibold leading-tight text-[#08236f] sm:text-[22px]">LSPr 049.IDN</p>
                    </div>
                </div>
                <div class="mt-4 grid gap-2 sm:mt-5 sm:gap-3">
                    <div class="rounded-[8px] bg-[#f8fafc] p-3 sm:p-4">
                        <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-[#64748b] sm:text-[12px]">Standar</p>
                        <p class="mt-1 text-[13px] font-semibold text-[#1f2937] sm:text-[15px]">ISO/IEC 17065:2012</p>
                    </div>
                    <div class="rounded-[8px] bg-[#f8fafc] p-3 sm:p-4">
                        <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-[#64748b] sm:text-[12px]">Berdiri</p>
                        <p class="mt-1 text-[13px] font-semibold text-[#1f2937] sm:text-[15px]">21 Oktober 2015</p>
                    </div>
                    <div class="rounded-[8px] bg-[#08236f] p-3 text-white sm:p-4">
                        <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-white/62 sm:text-[12px]">Fokus Layanan</p>
                        <p class="mt-1 text-[13px] font-semibold leading-5 sm:text-[15px]">Sertifikasi produk sesuai persyaratan SNI</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#f5f5f7]">
        <div class="mx-auto max-w-7xl px-4 py-7 sm:px-6 sm:py-10 lg:px-8 lg:py-12">
            <div id="informasi-sertifikasi">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#d4af37] sm:text-[12px] sm:tracking-[0.16em]">Pusat Informasi</p>
                        <h2 class="mt-2 text-[22px] font-semibold leading-tight text-[#08236f] sm:mt-3 sm:text-[28px]">
                            Ruang Lingkup Lembaga Sertifikasi Produk
                        </h2>
                    </div>
                </div>

                <div class="mt-4 overflow-hidden rounded-[8px] border border-black/10 bg-white shadow-[0_24px_70px_rgba(15,23,42,0.08)] sm:mt-6">
                    <div class="service-table-compact overflow-x-auto">
                        <table class="w-full min-w-[900px] text-left">
                            <thead class="sticky top-0 z-10 bg-[#08236f] text-white">
                                <tr>
                                    <th class="w-16 px-5 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">No</th>
                                    <th class="w-[150px] px-5 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">Skema</th>
                                    <th class="w-[240px] px-5 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">Kategori</th>
                                    <th class="px-5 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">Jenis Produk</th>
                                    <th class="w-[180px] px-5 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">Acuan</th>
                                    <th class="w-[130px] px-5 py-4 text-[12px] font-semibold uppercase tracking-[0.12em]">File</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-black/10">
                                @forelse ($certificationMenus as $menu)
                                    <tr class="transition odd:bg-white even:bg-[#f8fafc] hover:bg-[#fff8e1]">
                                        <td class="px-5 py-4 align-top text-sm font-semibold text-[#71717a]">{{ $loop->iteration }}</td>
                                        <td class="px-5 py-4 align-top text-[15px] font-medium leading-6 text-[#1f2937]">{{ $menu->scheme }}</td>
                                        <td class="px-5 py-4 align-top text-[15px] font-medium leading-6 text-[#4b5563]">{{ $menu->category }}</td>
                                        <td class="px-5 py-4 align-top text-[15px] font-semibold leading-6 text-[#1f2937]">{{ $menu->product_type }}</td>
                                        <td class="px-5 py-4 align-top text-[15px] font-medium leading-6 text-[#4b5563]">{{ $menu->reference }}</td>
                                        <td class="px-5 py-4 align-top">
                                            @if (filled($menu->file_path))
                                                <a href="{{ $menu->openUrl() }}" target="_blank" rel="noopener"
                                                    class="inline-flex h-9 items-center justify-center rounded-[7px] bg-[#08236f] px-3 text-[12px] font-semibold text-white transition hover:bg-[#061a53]">
                                                    Lihat
                                                </a>
                                            @else
                                                <span class="inline-flex h-9 items-center justify-center rounded-[7px] bg-[#f1f5f9] px-3 text-[12px] font-semibold text-[#64748b]">
                                                    Belum ada
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-5 py-12 text-center">
                                            <p class="text-[15px] font-semibold text-[#1f2937]">Informasi sertifikasi produk belum tersedia.</p>
                                            <p class="mt-1 text-sm text-[#71717a]">Data dapat ditambahkan melalui admin.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @include('public.services.partials.related-services', ['current' => 'product-certification'])

                <div class="mt-6 overflow-hidden rounded-[8px] border border-black/10 bg-white shadow-[0_12px_34px_rgba(15,23,42,0.06)] sm:mt-8 sm:shadow-[0_18px_50px_rgba(15,23,42,0.06)]">
                    <div class="grid lg:grid-cols-[1fr_420px]">
                        <div class="p-4 sm:p-6 lg:p-8">
                            <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#d4af37] sm:text-[12px] sm:tracking-[0.16em]">Kanal Layanan LSPro</p>
                            <h3 class="mt-2 text-[22px] font-semibold leading-tight text-[#08236f] sm:mt-3 sm:text-[28px]">
                                Butuh informasi lebih lengkap?
                            </h3>
                            <p class="mt-3 max-w-2xl text-[13px] leading-6 text-[#52525b] sm:mt-4 sm:text-sm">
                                Tim LSPro BPSMB Surakarta dapat membantu menjelaskan dokumen pengajuan, status layanan,
                                serta informasi teknis terkait sertifikasi produk.
                            </p>

                            <div class="mt-4 grid gap-2 text-[13px] text-[#475569] sm:mt-6 sm:gap-3 sm:text-sm md:grid-cols-2">
                                <div class="rounded-[8px] bg-[#f8fafc] p-3 sm:p-4">
                                    <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-[#64748b] sm:text-[11px]">Instansi</p>
                                    <p class="mt-1.5 font-semibold leading-6 text-[#08236f] sm:mt-2">
                                        Balai Pengujian dan Sertifikasi Mutu Barang Surakarta
                                    </p>
                                </div>
                                <div class="rounded-[8px] bg-[#f8fafc] p-3 sm:p-4">
                                    <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-[#64748b] sm:text-[11px]">Unit</p>
                                    <p class="mt-1.5 font-semibold leading-6 text-[#08236f] sm:mt-2">LSPro BPSMB Surakarta</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-black/10 bg-[#08236f] p-4 text-white sm:p-6 lg:border-l lg:border-t-0 lg:p-8">
                            <div class="grid gap-4 sm:gap-5">
                                <div>
                                    <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-white/55 sm:text-[11px]">Alamat</p>
                                    <p class="mt-2 text-[13px] leading-6 text-white/82 sm:text-sm">
                                        Jl. Pajang - Kartasura km.8 Pabelan, Kartasura, Sukoharjo, Kode Pos 57169
                                    </p>
                                </div>

                                <div>
                                    <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-white/55 sm:text-[11px]">Email</p>
                                    <div class="mt-2 grid gap-2 text-[13px] leading-6 sm:text-sm">
                                        <a href="mailto:bpsmbsurakarta@yahoo.com" class="break-words font-semibold text-white underline decoration-white/25 underline-offset-4 transition hover:text-[#d4af37]">
                                            bpsmbsurakarta@yahoo.com
                                        </a>
                                        <a href="mailto:lsprobpsmbjateng@yahoo.com" class="break-words font-semibold text-white underline decoration-white/25 underline-offset-4 transition hover:text-[#d4af37]">
                                            lsprobpsmbjateng@yahoo.com
                                        </a>
                                    </div>
                                </div>

                                <div class="grid gap-2 pt-1 sm:flex sm:flex-row sm:gap-3 lg:flex-col">
                                    <a href="{{ route('contact') }}"
                                        class="inline-flex h-10 items-center justify-center rounded-[8px] bg-white px-4 text-[13px] font-semibold text-[#08236f] transition hover:bg-[#f5f5f7] sm:h-11 sm:text-sm">
                                        Hubungi Kami
                                    </a>
                                    <a href="mailto:lsprobpsmbjateng@yahoo.com"
                                        class="inline-flex h-10 items-center justify-center rounded-[8px] border border-white/25 px-4 text-[13px] font-semibold text-white transition hover:border-white/45 hover:bg-white/8 sm:h-11 sm:text-sm">
                                        Kirim Email
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
