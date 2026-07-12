@php
    $navItems = [
        [
            'label' => 'Beranda', 
            'url' => route('home'), 
            'active' => request()->routeIs('home'),
            'icon' => '<svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>'
        ],
        [
            'label' => 'Jasa Layanan', 
            'url' => route('services.index'), 
            'active' => request()->routeIs('services.*') || request()->routeIs('lph'),
            'icon' => '<svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>'
        ],
        [
            'label' => 'Biaya', 
            'url' => route('cost'), 
            'active' => request()->routeIs('cost*'),
            'icon' => '<svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 8h6m-6 2h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>'
        ],
        [
            'label' => 'Pengaduan', 
            'url' => route('complaints.create'), 
            'active' => request()->routeIs('complaints.*'),
            'icon' => '<svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>'
        ],
        [
            'label' => 'Survei', 
            'url' => route('surveys.index'), 
            'active' => request()->routeIs('surveys.*'),
            'icon' => '<svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a1 1 0 001 1h2a1 1 0 001-1m6 0a2 2 0 002-2v-6a2 2 0 00-2-2h-2a2 2 0 00-2 2v6a2 2 0 002 2h2z"/></svg>'
        ],
        [
            'label' => 'Download', 
            'url' => route('documents.index'), 
            'active' => request()->routeIs('documents.*'),
            'icon' => '<svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>'
        ],
        [
            'label' => 'Kontak', 
            'url' => route('contact'), 
            'active' => request()->routeIs('contact'),
            'icon' => '<svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>'
        ],
    ];

    $profileItems = [
        ['label' => 'Pendahuluan', 'url' => route('profile.pendahuluan'), 'active' => request()->routeIs('profile.pendahuluan')],
        ['label' => 'Visi dan Misi', 'url' => route('profile.visi-misi'), 'active' => request()->routeIs('profile.visi-misi')],
        ['label' => 'Jenis Layanan', 'url' => route('profile.jenis-pelayanan'), 'active' => request()->routeIs('profile.jenis-pelayanan')],
        ['label' => 'SOTK', 'url' => route('profile.sotk'), 'active' => request()->routeIs('profile.sotk')],
    ];

    $mediaItems = [
        ['label' => 'Berita', 'url' => route('media.news.index'), 'active' => request()->routeIs('media.news.*')],
        ['label' => 'Foto', 'url' => route('media.photo.index'), 'active' => request()->routeIs('media.photo.*')],
        ['label' => 'Video', 'url' => route('media.video.index'), 'active' => request()->routeIs('media.video.*')],
    ];
@endphp

@once
    <style>
        /* Responsive navigation row styling */
        @media (min-width: 1024px) {
            .nav-menu-row {
                display: flex !important;
            }
        }
        
        /* Mobile menu toggle styling */
        #site-nav-toggle:checked ~ .nav-brand-row .burger-btn {
            background-color: #08236f !important;
            color: #ffffff !important;
        }
        #site-nav-toggle:checked ~ .nav-brand-row .burger-open {
            display: none !important;
        }
        #site-nav-toggle:checked ~ .nav-brand-row .burger-close {
            display: block !important;
        }
        #site-nav-toggle:checked ~ .mobile-nav {
            display: block !important;
        }

        /* Custom menu link classes to prevent Tailwind JIT compilation dependencies */
        .nav-menu-link {
            padding: 1.1rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 13px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
            transition: all 0.2s ease-in-out;
        }
        
        .nav-menu-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }
        
        .nav-menu-link.active {
            background-color: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            font-weight: 600;
        }

        .active-dropdown-item {
            background-color: #f5f5f7 !important;
            color: #08236f !important;
            font-weight: 600 !important;
        }
    </style>
@endonce

<header class="sticky top-0 z-50 w-full flex flex-col shadow-sm">
    <div class="relative w-full">
        <input id="site-nav-toggle" type="checkbox" class="peer sr-only">

        <!-- Tier 1: Brand Header Row -->
        <div class="nav-brand-row bg-white border-b border-gray-100 py-3 px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <!-- Logo & Brand Text -->
            <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-3">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo BPSMB Surakarta" class="h-10 w-10 shrink-0 object-contain sm:h-11 sm:w-11">
                <span class="min-w-0">
                    <span class="block truncate text-[16px] font-bold leading-tight text-[#08236f] sm:text-[18px]">
                        BPSMB Surakarta
                    </span>
                    <span class="block truncate text-[9px] font-semibold uppercase tracking-[0.14em] text-[#7a7a7a]">
                        Provinsi Jawa Tengah
                    </span>
                </span>
            </a>

            <!-- Right Actions (CTA and Burger Menu Toggle) -->
            <div class="flex items-center gap-4">
                <a href="{{ route('contact') }}" class="hidden sm:flex items-center gap-2 rounded-full border border-gray-200 bg-[#f5f5f7] px-4 py-1.5 text-[12px] font-semibold text-[#08236f] hover:bg-[#e9e9ee] hover:text-[#0b2f93] transition-all">
                    <svg class="h-4 w-4 text-[#d4af37]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    Hubungi Kami
                </a>

                <!-- Mobile Burger Toggle Button -->
                <label for="site-nav-toggle"
                    class="burger-btn grid h-10 w-10 cursor-pointer place-items-center rounded-[8px] bg-[#f5f5f7] text-[#08236f] transition hover:bg-[#e9e9ee] lg:hidden"
                    aria-label="Buka atau tutup menu">
                    <svg class="burger-open h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="burger-close hidden h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2.2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6 6 18" />
                    </svg>
                </label>
            </div>
        </div>

        <!-- Tier 2: Menu Navigation Row (Desktop Only) -->
        <div class="hidden nav-menu-row bg-[#08236f] border-b border-black/10 px-4 sm:px-6 lg:px-8">
            <nav aria-label="Navigasi utama" class="w-full">
                <ul class="flex items-center justify-center text-[13px] font-medium leading-none">
                    @foreach ($navItems as $item)
                        <!-- Normal Links / Dropdown Anchors -->
                        @if ($loop->first)
                            <!-- Beranda Link -->
                            <li class="relative">
                                <a href="{{ $item['url'] }}"
                                    class="nav-menu-link {{ $item['active'] ? 'active' : '' }}">
                                    {!! $item['icon'] !!}
                                    {{ $item['label'] }}
                                </a>
                            </li>

                            <!-- Profile Nested Dropdown -->
                            <li class="group relative">
                                <button type="button"
                                    class="nav-menu-link {{ request()->routeIs('profile.*') ? 'active' : '' }} focus:outline-none">
                                    <!-- Profile icon -->
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    Profil
                                    <svg class="h-3.5 w-3.5 transition group-hover:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7" />
                                    </svg>
                                </button>
                                <div class="invisible absolute left-0 top-full z-40 w-52 pt-1 opacity-0 transition group-hover:visible group-hover:opacity-100">
                                    <div class="rounded-lg border border-gray-100 bg-white p-1.5 shadow-xl text-gray-800">
                                        @foreach ($profileItems as $profileItem)
                                            <a href="{{ $profileItem['url'] }}"
                                                class="block rounded-md px-3 py-2 text-[13px] text-gray-700 hover:bg-[#f5f5f7] hover:text-[#08236f] transition {{ $profileItem['active'] ? 'active-dropdown-item' : '' }}">
                                                {{ $profileItem['label'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </li>

                            <!-- Media Nested Dropdown -->
                            <li class="group relative">
                                <button type="button"
                                    class="nav-menu-link {{ request()->routeIs('media.*') ? 'active' : '' }} focus:outline-none">
                                    <!-- Media icon -->
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    Media
                                    <svg class="h-3.5 w-3.5 transition group-hover:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7" />
                                    </svg>
                                </button>
                                <div class="invisible absolute left-0 top-full z-40 w-52 pt-1 opacity-0 transition group-hover:visible group-hover:opacity-100">
                                    <div class="rounded-lg border border-gray-100 bg-white p-1.5 shadow-xl text-gray-800">
                                        @foreach ($mediaItems as $mediaItem)
                                            <a href="{{ $mediaItem['url'] }}"
                                                class="block rounded-md px-3 py-2 text-[13px] text-gray-700 hover:bg-[#f5f5f7] hover:text-[#08236f] transition {{ $mediaItem['active'] ? 'active-dropdown-item' : '' }}">
                                                {{ $mediaItem['label'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                        @else
                            <!-- Other Top Level Links -->
                            <li class="relative">
                                <a href="{{ $item['url'] }}"
                                    class="nav-menu-link {{ $item['active'] ? 'active' : '' }}">
                                    {!! $item['icon'] !!}
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </nav>
        </div>

        <!-- Mobile Navigation Menu (Dropdown Card) -->
        <nav aria-label="Navigasi mobile" class="mobile-nav hidden absolute top-full left-0 right-0 z-50 border-t border-gray-100 bg-white px-5 py-4 shadow-xl lg:hidden">
            <div class="grid gap-1.5">
                @foreach ($navItems as $item)
                    <a href="{{ $item['url'] }}"
                        class="{{ $item['active'] ? 'bg-[#f5f5f7] text-[#08236f] font-semibold' : 'text-[#4b5563] hover:bg-[#f5f5f7] hover:text-[#08236f]' }} rounded-[8px] px-3.5 py-2.5 text-[14px] font-medium transition">
                        {{ $item['label'] }}
                    </a>
                    @if ($loop->first)
                        <details class="group rounded-[8px] bg-[#f5f5f7]/70 px-3.5 py-2.5">
                            <summary class="{{ request()->routeIs('profile.*') ? 'text-[#08236f] font-semibold' : 'text-[#4b5563]' }} flex cursor-pointer list-none items-center justify-between py-0.5 text-[14px] font-medium transition hover:text-[#08236f] [&::-webkit-details-marker]:hidden">
                                <span>Profil</span>
                                <svg class="h-4 w-4 transition group-open:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7" />
                                </svg>
                            </summary>
                            <div class="mt-2 grid gap-1 pl-2 border-l border-black/5">
                                @foreach ($profileItems as $profileItem)
                                    <a href="{{ $profileItem['url'] }}"
                                        class="{{ $profileItem['active'] ? 'text-[#08236f] font-semibold' : 'text-[#4b5563] hover:text-[#08236f]' }} rounded-[6px] px-3 py-1.5 text-[13px] font-medium transition">
                                        {{ $profileItem['label'] }}
                                    </a>
                                @endforeach
                            </div>
                        </details>
                        <details class="group rounded-[8px] bg-[#f5f5f7]/70 px-3.5 py-2.5">
                            <summary class="{{ request()->routeIs('media.*') ? 'text-[#08236f] font-semibold' : 'text-[#4b5563]' }} flex cursor-pointer list-none items-center justify-between py-0.5 text-[14px] font-medium transition hover:text-[#08236f] [&::-webkit-details-marker]:hidden">
                                <span>Media</span>
                                <svg class="h-4 w-4 transition group-open:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7" />
                                </svg>
                            </summary>
                            <div class="mt-2 grid gap-1 pl-2 border-l border-black/5">
                                @foreach ($mediaItems as $mediaItem)
                                    <a href="{{ $mediaItem['url'] }}"
                                        class="{{ $mediaItem['active'] ? 'text-[#08236f] font-semibold' : 'text-[#4b5563] hover:text-[#08236f]' }} rounded-[6px] px-3 py-1.5 text-[13px] font-medium transition">
                                        {{ $mediaItem['label'] }}
                                    </a>
                                @endforeach
                            </div>
                        </details>
                    @endif
                @endforeach
                
                <!-- Extra Contact CTA inside mobile menu for small screens -->
                <a href="{{ route('contact') }}" class="sm:hidden mt-2 flex items-center justify-center gap-2 rounded-[8px] bg-[#08236f] px-3.5 py-3 text-[14px] font-semibold text-white hover:bg-[#0b2f93] transition">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    Hubungi Kami
                </a>
            </div>
        </nav>
    </div>
</header>
