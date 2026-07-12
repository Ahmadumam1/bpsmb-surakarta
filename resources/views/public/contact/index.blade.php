@extends('layouts.public')

@section('title', 'Kontak | BPSMB Surakarta')
@section('meta_description', 'Hubungi BPSMB Surakarta melalui alamat kantor, telepon, fax, mobile, dan email resmi.')

@section('content')
    @php
        $contactSettings = $contactSettings ?? [];
        $address = $contactSettings['contact.address'] ?? 'Jl. Pajang - Kartasura KM. 8 Pabelan, Kartasura, Sukoharjo, Jawa Tengah 57169';
        $phone = $contactSettings['contact.phone'] ?? '(0271) 743959 / (0271) 7881926 / 0812-1536-6242';
        $whatsappNumber = $contactSettings['contact.whatsapp_number'] ?? '0812-1536-6242';
        $whatsappUrl = \App\Support\SiteSettings::whatsappUrl($contactSettings);
        $phoneItems = collect(explode('/', $phone))->map(fn ($item) => trim($item))->filter();
        $email = $contactSettings['contact.email'] ?? 'bpsmb_surakarta@disperindag.jatengprov.go.id';
        $secondaryEmail = $contactSettings['contact.secondary_email'] ?? 'bpsmbsurakarta@yahoo.com';
        $workingHours = $contactSettings['contact.working_hours'] ?? 'Senin - Jumat: 07.30 - 16.00 WIB';
        $socialLinks = collect([
            'Instagram' => $contactSettings['social.instagram_url'] ?? '',
            'Facebook' => $contactSettings['social.facebook_url'] ?? '',
            'YouTube' => $contactSettings['social.youtube_url'] ?? '',
        ])->filter();
    @endphp

    @once
        <style>
            /* Contact layout responsive classes (Tailwind JIT-independent) */
            .contact-layout-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            @media (min-width: 1024px) {
                .contact-layout-grid {
                    grid-template-columns: 1fr 1fr;
                }
            }
            
            .contact-info-panel-styled {
                display: flex;
                flex-direction: column;
                gap: 1.6rem;
                background-color: #ffffff;
                border-top: 4px solid #08236f;
            }
            
            .contact-icon-box {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 44px;
                height: 44px;
                border-radius: 8px; /* Square shape */
                background-color: #f5f7fc; /* Very light clean blue-gray */
                border: 1px solid rgba(8, 35, 111, 0.12); /* Clean navy border */
                color: #08236f; /* Corporate Navy color */
                flex-shrink: 0;
                transition: all 0.2s ease-in-out;
            }
            
            .contact-item:hover .contact-icon-box {
                background-color: #08236f;
                color: #ffffff;
                border-color: #08236f;
                transform: scale(1.05) rotate(3deg);
            }

            .social-badge {
                display: inline-flex;
                align-items: center;
                border-radius: 8px; /* Square shape */
                background-color: #f5f5f7;
                border: 1px solid rgba(8, 35, 111, 0.08);
                padding: 0.35rem 0.75rem;
                font-size: 13px;
                font-weight: 600;
                color: #08236f;
                transition: all 0.2s ease-in-out;
            }

            .social-badge:hover {
                background-color: #08236f;
                color: #ffffff;
                border-color: #08236f;
                transform: translateY(-1.5px);
            }
        </style>
    @endonce

    <!-- Hero Header Section -->
    <section class="relative overflow-hidden border-b border-black/10 bg-[#f5f5f7]">
        <div class="absolute inset-0 bg-[linear-gradient(135deg,rgba(8,35,111,0.08),rgba(245,245,247,0)_45%),radial-gradient(circle_at_85%_18%,rgba(212,175,55,0.22),rgba(212,175,55,0)_28%)]"></div>
        <div class="absolute inset-0 bg-[linear-gradient(rgba(8,35,111,0.055)_1px,transparent_1px),linear-gradient(90deg,rgba(8,35,111,0.055)_1px,transparent_1px)] bg-[size:44px_44px]"></div>
        <img src="{{ asset('assets/profile-hero.png') }}" alt="" aria-hidden="true"
            class="pointer-events-none absolute -right-16 bottom-0 h-full max-h-[300px] w-[82%] object-cover object-left opacity-45 blur-[0.5px] saturate-110 sm:max-h-[360px] sm:w-[70%] sm:opacity-50 lg:-right-10 lg:max-h-[420px] lg:w-[58%] lg:opacity-60">
        <div class="absolute inset-y-0 right-0 w-full bg-gradient-to-r from-[#f5f5f7] via-[#f5f5f7]/70 to-[#f5f5f7]/15 sm:via-[#f5f5f7]/65 lg:w-4/3 lg:via-[#f5f5f7]/70 lg:to-[#f5f5f7]/10"></div>
        <div class="absolute -bottom-28 left-10 h-72 w-72 rounded-full border border-[#08236f]/10"></div>

        <div class="relative mx-auto grid max-w-7xl gap-8 px-4 py-7 sm:gap-10 sm:px-6 sm:py-14 lg:grid-cols-[1fr_380px] lg:px-8 lg:py-20">
            <div class="flex items-center">
                <div class="max-w-3xl">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-[#d4af37] sm:text-[12px] sm:tracking-[0.16em]">Kontak</p>
                    <h1 class="mt-2 max-w-3xl text-[25px] font-semibold leading-[1.12] text-[#08236f] sm:mt-4 sm:text-[40px]">
                        Hubungi BPSMB Surakarta
                    </h1>
                    <div class="mt-4 h-0.5 w-14 rounded-full bg-[#d4af37] sm:mt-7 sm:h-1 sm:w-24"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="bg-[#f5f5f7]">
        <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
            <div class="contact-layout-grid">
                
                <!-- Left Column: Info Kontak & Map -->
                <div class="flex flex-col gap-6">
                    <!-- Info Kontak Card -->
                    <div class="contact-info-panel-styled rounded-xl border border-black/5 bg-white p-6 sm:p-8 shadow-sm">
                        <!-- Alamat / Lokasi -->
                        <div class="contact-item flex items-start gap-4">
                            <span class="contact-icon-box shadow-sm">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Lokasi</p>
                                <p class="mt-1 text-[14px] font-semibold leading-relaxed text-[#08236f]">
                                    {{ $address }}
                                </p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="contact-item flex items-start gap-4">
                            <span class="contact-icon-box shadow-sm">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5A2.25 2.25 0 0 1 19.5 19.5h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0-8.54 5.693a2.25 2.25 0 0 1-2.42 0L2.25 6.75" />
                                </svg>
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Email Resmi</p>
                                <div class="mt-1 flex flex-col gap-0.5">
                                    <a href="mailto:{{ $email }}" class="text-[14px] font-semibold text-[#08236f] hover:text-[#3b6fd9] hover:underline transition break-words">
                                        {{ $email }}
                                    </a>
                                    @if ($secondaryEmail)
                                        <a href="mailto:{{ $secondaryEmail }}" class="text-[13px] font-medium text-gray-500 hover:text-[#3b6fd9] hover:underline transition break-words">
                                            {{ $secondaryEmail }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Telepon & WhatsApp -->
                        <div class="contact-item flex items-start gap-4">
                            <span class="contact-icon-box shadow-sm">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5h3A2.25 2.25 0 0 1 15.75 3.75v16.5A2.25 2.25 0 0 1 13.5 22.5h-3a2.25 2.25 0 0 1-2.25-2.25V3.75A2.25 2.25 0 0 1 10.5 1.5Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 18.75h1.5" />
                                </svg>
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Telepon & WhatsApp</p>
                                <div class="mt-1 flex flex-col gap-0.5">
                                    @foreach ($phoneItems as $phoneItem)
                                        @php($phoneHref = preg_replace('/[^0-9+]/', '', $phoneItem))
                                        <a href="tel:{{ $phoneHref }}" class="text-[14px] font-semibold text-[#08236f] hover:text-[#3b6fd9] hover:underline transition">
                                            {{ $phoneItem }}
                                        </a>
                                    @endforeach
                                    @if ($whatsappUrl)
                                        <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="mt-1.5 inline-flex items-center gap-1.5 text-[14px] font-semibold text-[#128c7e] hover:underline transition">
                                            <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.457L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.413 9.863-9.83 0-2.628-1.02-5.1-2.871-6.955C16.612 1.963 14.153.943 11.53.943c-5.439 0-9.859 4.414-9.863 9.831-.001 1.762.464 3.487 1.348 5.02L1.975 22.1l6.574-1.722.098-.058z"/>
                                            </svg>
                                            WhatsApp: {{ $whatsappNumber }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Jam Kerja -->
                        <div class="contact-item flex items-start gap-4">
                            <span class="contact-icon-box shadow-sm">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <circle cx="12" cy="12" r="8.5" stroke="currentColor" />
                                    <path d="M12 7.5V12l3 2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Jam Kerja</p>
                                <p class="mt-1 text-[14px] font-semibold text-[#08236f]">
                                    {{ $workingHours }}
                                </p>
                            </div>
                        </div>

                        <!-- Media Sosial -->
                        @if ($socialLinks->isNotEmpty())
                            <div class="contact-item flex items-start gap-4">
                                <span class="contact-icon-box shadow-sm">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H18m0 0v4.5M18 6l-6 6m-2.25-4.5H6A2.25 2.25 0 0 0 3.75 9.75V18A2.25 2.25 0 0 0 6 20.25h8.25A2.25 2.25 0 0 0 16.5 18v-3.75" />
                                    </svg>
                                </span>
                                <div class="min-w-0 flex-1">
                                    <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Media Sosial</p>
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        @foreach ($socialLinks as $label => $url)
                                            <a href="{{ $url }}" target="_blank" rel="noopener" class="social-badge">
                                                {{ $label }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Peta Card -->
                    <div class="rounded-xl border border-black/5 bg-white overflow-hidden shadow-sm h-[350px] w-full">
                        <iframe src="https://www.google.com/maps?q=BPSMB+Surakarta&output=embed"
                            class="h-full w-full border-0" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" title="Peta lokasi BPSMB Surakarta"></iframe>
                    </div>
                </div>

                <!-- Right Column: Contact Message Form -->
                <div class="rounded-xl border border-black/5 bg-white p-6 sm:p-8 shadow-sm flex flex-col justify-between h-fit">
                    <div>
                        <h2 class="text-[20px] font-bold text-[#08236f]">Kirim Pesan</h2>
                        <p class="mt-1 text-[13px] text-gray-500">Hubungi kami secara langsung melalui formulir di bawah ini. Kami akan membalas pesan Anda ke alamat email yang Anda masukkan.</p>
                        
                        <!-- Success / Error Alerts -->
                        @if(session('success'))
                            <div class="mt-4 rounded-lg bg-green-50 p-4 text-[13px] font-medium text-green-700 border border-green-200">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="mt-4 rounded-lg bg-red-50 p-4 text-[13px] font-medium text-red-700 border border-red-200">
                                {{ session('error') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('contact.send') }}" method="POST" class="mt-6 flex flex-col gap-4">
                            @csrf
                            <!-- Name Input -->
                            <div>
                                <label for="name" class="block text-[11px] font-bold uppercase tracking-wider text-gray-400">Nama Lengkap</label>
                                <input type="text" id="name" name="name" required class="mt-1.5 w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2.5 text-[14px] text-gray-800 focus:border-[#08236f] focus:bg-white focus:outline-none transition-all" placeholder="Masukkan nama lengkap Anda">
                            </div>
                            
                            <!-- Email Input -->
                            <div>
                                <label for="email" class="block text-[11px] font-bold uppercase tracking-wider text-gray-400">Alamat Email</label>
                                <input type="email" id="email" name="email" required class="mt-1.5 w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2.5 text-[14px] text-gray-800 focus:border-[#08236f] focus:bg-white focus:outline-none transition-all" placeholder="nama@domain.com">
                            </div>
                            
                            <!-- Subject Input -->
                            <div>
                                <label for="subject" class="block text-[11px] font-bold uppercase tracking-wider text-gray-400">Subjek</label>
                                <input type="text" id="subject" name="subject" required class="mt-1.5 w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2.5 text-[14px] text-gray-800 focus:border-[#08236f] focus:bg-white focus:outline-none transition-all" placeholder="Apa subjek atau tujuan pesan Anda?">
                            </div>
                            
                            <!-- Message Input -->
                            <div>
                                <label for="message" class="block text-[11px] font-bold uppercase tracking-wider text-gray-400">Pesan</label>
                                <textarea id="message" name="message" rows="5" required class="mt-1.5 w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2.5 text-[14px] text-gray-800 focus:border-[#08236f] focus:bg-white focus:outline-none transition-all resize-none" placeholder="Tuliskan isi pesan Anda di sini..."></textarea>
                            </div>
                            
                            <!-- Submit Button -->
                            <button type="submit" class="mt-2 w-full rounded-lg bg-[#08236f] hover:bg-[#0b2f93] py-3 text-sm font-semibold text-white shadow-md active:scale-[0.98] transition-all focus:outline-none">
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
