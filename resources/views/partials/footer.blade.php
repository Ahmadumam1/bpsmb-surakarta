<footer class="bg-[#08236f] text-white">
    @php
        $siteSettings = $siteSettings ?? [];
        $footerAddress = $siteSettings['contact.address'] ?? 'Jl. Pajang - Kartasura KM. 8 Pabelan, Kartasura, Sukoharjo, Jawa Tengah 57169';
        $footerPhone = $siteSettings['contact.phone'] ?? '(0271) 743959 / (0271) 7881926 / 0812-1536-6242';
        $footerEmail = $siteSettings['contact.email'] ?? 'bpsmb_surakarta@disperindag.jatengprov.go.id';
        $footerSecondaryEmail = $siteSettings['contact.secondary_email'] ?? 'bpsmbsurakarta@yahoo.com';
        $footerWorkingHours = $siteSettings['contact.working_hours'] ?? 'Senin - Jumat: 07.30 - 16.00 WIB';
        $instagramUrl = ($siteSettings['social.instagram_url'] ?? '') ?: route('contact');
        $facebookUrl = ($siteSettings['social.facebook_url'] ?? '') ?: route('contact');
        $youtubeUrl = ($siteSettings['social.youtube_url'] ?? '') ?: route('contact');
    @endphp

    <div
        class="mx-auto grid max-w-7xl gap-7 px-4 py-7 sm:gap-10 sm:px-6 sm:py-10 md:grid-cols-2 lg:grid-cols-[1.1fr_0.9fr_1fr_1.1fr] lg:px-8 lg:py-12">
        <div>
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 sm:gap-3">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo Jawa Tengah" class="h-10 w-10 object-contain sm:h-14 sm:w-14">
                <span class="text-[17px] font-semibold leading-[1.19] tracking-[0.1px] sm:text-[21px] sm:tracking-[0.231px]">BPSMB Surakarta</span>
            </a>
            <p class="mt-4 max-w-xs text-[12px] leading-5 text-white/72 sm:mt-6 sm:text-[14px] sm:leading-[1.43] sm:tracking-[-0.224px]">Instansi pemerintah
                yang berdedikasi memberikan layanan teknis pengujian, kalibrasi, dan sertifikasi mutu barang dengan
                integritas dan profesionalisme tinggi.</p>
            <div class="mt-4 flex gap-2.5 sm:mt-5 sm:gap-3">
                <a href="{{ $instagramUrl }}" aria-label="Instagram"
                    class="grid h-8 w-8 place-items-center text-[#e8b84b] transition-colors hover:text-white sm:h-9 sm:w-9">
                    <svg class="h-5 w-5 sm:h-[22px] sm:w-[22px]" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <rect x="3" y="3" width="18" height="18" rx="5" stroke="currentColor"
                            stroke-width="1.8" />
                        <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.8" />
                        <circle cx="17.2" cy="6.8" r="1.1" fill="currentColor" />
                    </svg>
                </a>
                <a href="{{ $facebookUrl }}" aria-label="Facebook"
                    class="grid h-8 w-8 place-items-center text-[#e8b84b] transition-colors hover:text-white sm:h-9 sm:w-9">
                    <svg class="h-5 w-5 sm:h-[22px] sm:w-[22px]" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path
                            d="M14.5 8.5h2V5.6c-.35-.05-1.54-.15-2.93-.15-2.9 0-4.89 1.77-4.89 5.02v2.63H6v3.3h3.68V21h3.4v-4.6h3.13l.5-3.3h-3.63v-2.28c0-.96.26-1.62 1.42-1.62Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                    </svg>
                </a>
                <a href="{{ $youtubeUrl }}" aria-label="YouTube"
                    class="grid h-8 w-8 place-items-center text-[#e8b84b] transition-colors hover:text-white sm:h-9 sm:w-9">
                    <svg class="h-5 w-5 sm:h-[22px] sm:w-[22px]" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <rect x="2.5" y="6" width="19" height="12" rx="3.5" stroke="currentColor"
                            stroke-width="1.8" />
                        <path d="M10.5 9.5v5l4.3-2.5-4.3-2.5Z" fill="currentColor" />
                    </svg>
                </a>
            </div>
        </div>

        <div>
            <h2 class="text-[12px] font-semibold leading-tight text-[#e8b84b] sm:text-[14px] sm:leading-[1.29] sm:tracking-[-0.224px]">Tautan Cepat</h2>
            <div class="mt-3 grid grid-cols-2 gap-x-4 gap-y-2.5 text-[12px] leading-5 text-white/70 sm:mt-5 sm:grid-cols-1 sm:gap-3 sm:text-[14px] sm:leading-[1.43] sm:tracking-[-0.224px]">
                <a href="{{ route('profile.visi-misi') }}" class="transition-colors hover:text-white">Visi & Misi</a>
                <a href="{{ route('profile.sotk') }}" class="transition-colors hover:text-white">Struktur Organisasi</a>
                <a href="{{ route('profile.jenis-pelayanan') }}" class="transition-colors hover:text-white">Standar
                    Pelayanan</a>
                <a href="{{ route('cost') }}" class="transition-colors hover:text-white">Maklumat Pelayanan</a>
                <a href="{{ route('surveys.index') }}" class="transition-colors hover:text-white">Indeks Kepuasan
                    Masyarakat</a>
            </div>
        </div>

        <div>
            <h2 class="text-[12px] font-semibold leading-tight text-[#e8b84b] sm:text-[14px] sm:leading-[1.29] sm:tracking-[-0.224px]">Layanan & Regulasi
            </h2>
            <div class="mt-3 grid grid-cols-2 gap-x-4 gap-y-2.5 text-[12px] leading-5 text-white/70 sm:mt-5 sm:grid-cols-1 sm:gap-3 sm:text-[14px] sm:leading-[1.43] sm:tracking-[-0.224px]">
                <a href="{{ route('services.index') }}" class="transition-colors hover:text-white">Laboratorium
                    Pengujian</a>
                <a href="{{ route('services.calibration') }}" class="transition-colors hover:text-white">Laboratorium
                    Kalibrasi</a>
                <a href="{{ route('services.index') }}" class="transition-colors hover:text-white">Lembaga Sertifikasi
                    Produk</a>
                <a href="{{ route('documents.index') }}" class="transition-colors hover:text-white">Peraturan
                    Perundangan</a>
                <a href="{{ route('documents.index') }}" class="transition-colors hover:text-white">SOP Layanan</a>
            </div>
        </div>

        <div>
            <h2 class="text-[12px] font-semibold leading-tight text-[#e8b84b] sm:text-[14px] sm:leading-[1.29] sm:tracking-[-0.224px]">Hubungi Kami</h2>
            <div class="mt-3 grid gap-2.5 text-[12px] leading-5 text-white/70 sm:mt-5 sm:gap-3.5 sm:text-[14px] sm:leading-[1.43] sm:tracking-[-0.224px]">
                <div class="flex items-start gap-2.5 sm:gap-3">
                    <span class="mt-0.5 grid h-5 w-5 shrink-0 place-items-center sm:h-7 sm:w-7">
                        <svg class="h-4 w-4 text-[#e8b84b] sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 21s-7-6.1-7-11.5A7 7 0 0 1 19 9.5C19 14.9 12 21 12 21Z" stroke="currentColor"
                                stroke-width="1.8" stroke-linejoin="round" />
                            <circle cx="12" cy="9.5" r="2.3" stroke="currentColor" stroke-width="1.8" />
                        </svg>
                    </span>
                    <span class="pt-0.5">{{ $footerAddress }}</span>
                </div>
                <div class="flex items-center gap-2.5 sm:gap-3">
                    <span class="grid h-5 w-5 shrink-0 place-items-center sm:h-7 sm:w-7">
                        <svg class="h-4 w-4 text-[#e8b84b] sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path
                                d="M4 5.5c0-.6.4-1 1-1h2.2c.5 0 .9.3 1 .8l.8 3a1 1 0 0 1-.3 1L7.4 10.6a12 12 0 0 0 6 6l1.3-1.3a1 1 0 0 1 1-.3l3 .8c.5.1.8.5.8 1V19c0 .6-.4 1-1 1h-1C10.6 20 4 13.4 4 6.5v-1Z"
                                stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <span>{{ $footerPhone }}</span>
                </div>
                <div class="flex items-center gap-2.5 sm:gap-3">
                    <span class="grid h-5 w-5 shrink-0 place-items-center sm:h-7 sm:w-7">
                        <svg class="h-4 w-4 text-[#e8b84b] sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none"
                            aria-hidden="true">
                            <rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor"
                                stroke-width="1.6" />
                            <path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                    <span class="break-all">{{ $footerEmail }}</span>
                </div>
                @if ($footerSecondaryEmail)
                    <div class="flex items-center gap-2.5 sm:gap-3">
                        <span class="grid h-5 w-5 shrink-0 place-items-center sm:h-7 sm:w-7" aria-hidden="true"></span>
                        <span class="break-all">{{ $footerSecondaryEmail }}</span>
                    </div>
                @endif
                <div class="flex items-center gap-2.5 sm:gap-3">
                    <span class="grid h-5 w-5 shrink-0 place-items-center sm:h-7 sm:w-7">
                        <svg class="h-4 w-4 text-[#e8b84b] sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none"
                            aria-hidden="true">
                            <circle cx="12" cy="12" r="8.5" stroke="currentColor"
                                stroke-width="1.6" />
                            <path d="M12 7.5V12l3 2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                    <span>{{ $footerWorkingHours }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="border-t border-white/10 bg-[#0b1424]">
        <div
            class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-4 text-center sm:px-6 sm:py-6 lg:flex-row lg:items-center lg:justify-between lg:px-8 lg:text-left">
            <p class="text-[11px] leading-5 text-[#b7c6dc] sm:text-[15px] sm:leading-6">&copy; {{ now()->year }} Pemerintah Provinsi Jawa Tengah - BPSMB Surakarta. Hak Cipta Dilindungi.</p>

            <div class="grid flex-1 grid-cols-3 items-center gap-2 text-center sm:flex sm:justify-center sm:gap-9 lg:max-w-[520px]">
                <div>
                    <p class="text-[10px] font-bold leading-tight text-white sm:text-[13px] sm:leading-none">Total Pengunjung</p>
                    <p class="mt-1 text-[11px] leading-none text-white/88 sm:mt-2 sm:text-[13px]">{{ number_format($visitorTotal ?? 0, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold leading-tight text-white sm:text-[13px] sm:leading-none">Bulan ini</p>
                    <p class="mt-1 text-[11px] leading-none text-white/88 sm:mt-2 sm:text-[13px]">{{ number_format($visitorWeek ?? 0, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold leading-tight text-white sm:text-[13px] sm:leading-none">Hari ini</p>
                    <p class="mt-1 text-[11px] leading-none text-white/88 sm:mt-2 sm:text-[13px]">{{ number_format($visitorToday ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
</footer>
