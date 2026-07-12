@extends('layouts.public')

@section('title', 'Lembaga Pemeriksa Halal | BPSMB Surakarta')
@section('meta_description', 'Layanan Lembaga Pemeriksa Halal BPSMB Surakarta untuk mendukung sertifikasi halal pelaku usaha.')

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

        <div class="relative mx-auto grid max-w-7xl gap-5 px-4 py-7 sm:gap-8 sm:px-6 sm:py-14 lg:grid-cols-[1fr_380px] lg:items-center lg:px-8 lg:py-20">
            <div>
                <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-[#d4af37] sm:text-[12px] sm:tracking-[0.16em]">Jasa Layanan</p>
                <h1 class="mt-2 max-w-3xl text-[25px] font-semibold leading-[1.12] text-[#08236f] sm:mt-4 sm:text-[40px]">
                    Lembaga Pemeriksa Halal
                </h1>
                <p class="mt-3 max-w-2xl text-[13px] leading-6 text-[#4b5563] sm:mt-5 sm:text-[16px] sm:leading-7">
                    Layanan pemeriksaan dan/atau pengujian kehalalan produk untuk mendukung proses sertifikasi halal
                    pelaku usaha sesuai ketentuan BPJPH.
                </p>
                <div class="mt-5 grid gap-2 sm:mt-7 sm:flex sm:flex-wrap sm:gap-3">
                    <a href="https://ptsp.halal.go.id/login" target="_blank" rel="noopener noreferrer"
                        class="inline-flex h-10 items-center justify-center rounded-[8px] bg-[#08236f] px-4 text-[13px] font-semibold text-white transition hover:bg-[#061a53] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-[3px] focus-visible:outline-[#d4af37] sm:h-11 sm:text-sm">
                        Daftar via PTSP Halal &rarr;
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex h-10 items-center justify-center rounded-[8px] border border-black/10 bg-white px-4 text-[13px] font-semibold text-[#08236f] transition hover:border-[#08236f]/30 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-[3px] focus-visible:outline-[#d4af37] sm:h-11 sm:text-sm">
                        Konsultasi Layanan
                    </a>
                </div>
            </div>

            <aside class="rounded-[8px] border border-black/10 bg-white/88 p-4 shadow-[0_16px_42px_rgba(15,23,42,0.08)] backdrop-blur sm:p-5 sm:shadow-[0_24px_70px_rgba(15,23,42,0.08)]">
                <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-[#d4af37] sm:text-[12px]">Status Layanan</p>
                <h2 class="mt-2 text-[18px] font-semibold leading-tight text-[#08236f] sm:mt-3 sm:text-[22px]">Terintegrasi proses sertifikasi halal</h2>
                <div class="mt-4 grid gap-3 text-[13px] leading-6 text-[#4b5563] sm:mt-5 sm:text-sm">
                    <p>
                        BPSMB Surakarta mendukung pemeriksaan produk, bahan, proses produksi, dan dokumen pendukung
                        sebagai bagian dari ekosistem jaminan produk halal.
                    </p>
                    <p>
                        Pengajuan sertifikasi halal dilakukan melalui sistem resmi PTSP Halal BPJPH.
                    </p>
                </div>
            </aside>
        </div>
    </section>

    <section class="bg-[#f5f5f7]" data-lph-tabs>
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
            <div class="overflow-hidden rounded-[8px] border border-black/10 bg-white p-4 shadow-[0_18px_50px_rgba(15,23,42,0.07)] sm:p-5">
                <div class="mb-4 flex flex-col gap-1 sm:mb-5">
                    <p class="text-[12px] font-semibold uppercase tracking-[0.14em] text-[#d4af37]">Informasi LPH</p>
                    <h2 class="text-[20px] font-semibold leading-tight text-[#08236f] sm:text-[24px]">
                        Informasi apa yang ingin Anda lihat?
                    </h2>
                    <p class="text-sm leading-6 text-[#52525b]">
                        Pilih salah satu topik di bawah agar halaman hanya menampilkan informasi yang Anda butuhkan.
                    </p>
                </div>
                <div class="flex items-center justify-between gap-2 overflow-x-auto whitespace-nowrap pb-1 [scrollbar-width:thin]" role="tablist" aria-label="Pilihan informasi LPH">
                    @foreach ($sections as $section)
                        <a href="#{{ $section['slug'] }}"
                            data-lph-tab="{{ $section['slug'] }}"
                            role="tab"
                            aria-controls="{{ $section['slug'] }}"
                            class="min-w-[132px] shrink-0 rounded-full border border-black/10 bg-[#f8fafc] px-4 py-2.5 text-center text-[13px] font-semibold text-[#52525b] transition hover:border-[#08236f]/35 hover:bg-[#eef4ff] hover:text-[#08236f] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#f4d35e] lg:min-w-0 lg:flex-1">
                            {{ $section['tab_label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="mt-6">
                @foreach ($sections as $section)
                    @php
                        $items = collect($section['items'] ?? [])->filter(fn ($item) => filled($item['title'] ?? null));
                    @endphp
                    <section id="{{ $section['slug'] }}" data-lph-panel class="{{ $loop->first ? '' : 'hidden ' }}rounded-[8px] bg-white p-6 shadow-[0_18px_50px_rgba(15,23,42,0.07)] lg:p-8" role="tabpanel">
                        <div class="grid gap-8 lg:grid-cols-[0.8fr_1.2fr]">
                            <div>
                                @if (filled($section['eyebrow'] ?? null))
                                    <p class="text-[12px] font-semibold uppercase tracking-[0.14em] text-[#d4af37]">{{ $section['eyebrow'] }}</p>
                                @endif
                                <h2 class="mt-3 text-[28px] font-semibold leading-[1.12] text-[#08236f] sm:text-[36px]">
                                    {{ $section['title'] }}
                                </h2>
                                @if (filled($section['description'] ?? null))
                                    <p class="mt-4 text-sm leading-6 text-[#52525b]">
                                        {{ $section['description'] }}
                                    </p>
                                @endif

                                @if (filled($section['primary_button_label'] ?? null) || filled($section['secondary_button_label'] ?? null))
                                    <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                                        @if (filled($section['primary_button_label'] ?? null) && filled($section['primary_button_url'] ?? null))
                                            <a href="{{ $section['primary_button_url'] }}" target="{{ str_starts_with($section['primary_button_url'], 'http') ? '_blank' : '_self' }}" rel="noopener noreferrer"
                                                class="inline-flex min-h-11 items-center justify-center rounded-[8px] bg-[#08236f] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#061a54] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-[3px] focus-visible:outline-[#f4d35e]">
                                                {{ $section['primary_button_label'] }} &rarr;
                                            </a>
                                        @endif
                                        @if (filled($section['secondary_button_label'] ?? null) && filled($section['secondary_button_url'] ?? null))
                                            <a href="{{ $section['secondary_button_url'] }}" target="{{ str_starts_with($section['secondary_button_url'], 'http') ? '_blank' : '_self' }}" rel="noopener noreferrer"
                                                class="inline-flex min-h-11 items-center justify-center rounded-[8px] border border-black/10 bg-white px-5 py-2.5 text-sm font-semibold text-[#08236f] transition hover:border-[#08236f]/35 hover:bg-[#eef4ff]">
                                                {{ $section['secondary_button_label'] }}
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="grid gap-3 {{ $section['slug'] === 'alur-lph' ? 'lg:grid-cols-2' : '' }}">
                                @forelse ($items as $item)
                                    <div class="flex items-start gap-3 rounded-[8px] border border-black/10 bg-[#f8fafc] p-4">
                                        <span class="grid h-7 w-7 shrink-0 place-items-center rounded-full bg-[#08236f] text-[11px] font-semibold text-white">
                                            {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                        </span>
                                        <div>
                                            <p class="text-sm font-semibold leading-6 text-[#1f2937]">{{ $item['title'] }}</p>
                                            @if (filled($item['description'] ?? null))
                                                <p class="mt-1 text-sm leading-6 text-[#52525b]">{{ $item['description'] }}</p>
                                            @endif
                                            @if (filled($item['file_path'] ?? null))
                                                <a href="{{ \Illuminate\Support\Facades\Storage::url($item['file_path']) }}" target="_blank" rel="noopener noreferrer"
                                                    class="mt-3 inline-flex min-h-9 items-center justify-center rounded-[8px] bg-[#08236f] px-3 py-2 text-[12px] font-semibold text-white transition hover:bg-[#061a54]">
                                                    Lihat File
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="rounded-[8px] border border-dashed border-black/15 bg-[#f8fafc] p-5 text-sm font-semibold text-[#52525b]">
                                        Konten belum tersedia.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </section>
                @endforeach
            </div>

            @include('public.services.partials.related-services', ['current' => 'lph'])
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        (() => {
            const root = document.querySelector('[data-lph-tabs]');

            if (!root) {
                return;
            }

            const tabs = [...root.querySelectorAll('[data-lph-tab]')];
            const panels = [...root.querySelectorAll('[data-lph-panel]')];
            const defaultPanel = tabs[0]?.dataset.lphTab || 'lingkup-lph';

            const activatePanel = (panelId, shouldPushState = true) => {
                const targetPanel = panels.find((panel) => panel.id === panelId) ? panelId : defaultPanel;

                tabs.forEach((tab) => {
                    const isActive = tab.dataset.lphTab === targetPanel;
                    tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
                    tab.classList.toggle('bg-[#08236f]', isActive);
                    tab.classList.toggle('bg-[#f8fafc]', !isActive);
                    tab.classList.toggle('text-white', isActive);
                    tab.classList.toggle('text-[#52525b]', !isActive);
                    tab.classList.toggle('border-[#08236f]', isActive);
                    tab.classList.toggle('border-black/10', !isActive);
                    tab.classList.toggle('shadow-[0_10px_24px_rgba(8,35,111,0.18)]', isActive);

                    tab.classList.toggle('hover:bg-[#061a54]', isActive);
                    tab.classList.toggle('hover:text-white', isActive);
                    tab.classList.toggle('hover:border-[#061a54]', isActive);
                    tab.classList.toggle('hover:bg-[#eef4ff]', !isActive);
                    tab.classList.toggle('hover:text-[#08236f]', !isActive);
                    tab.classList.toggle('hover:border-[#08236f]/35', !isActive);
                });

                panels.forEach((panel) => {
                    const isActive = panel.id === targetPanel;
                    panel.classList.toggle('hidden', !isActive);
                });

                if (shouldPushState) {
                    window.history.replaceState(null, '', `#${targetPanel}`);
                }
            };

            tabs.forEach((tab) => {
                tab.addEventListener('click', (event) => {
                    event.preventDefault();
                    activatePanel(tab.dataset.lphTab);
                    root.scrollIntoView({ behavior: 'smooth', block: 'start' });
                });
            });

            window.addEventListener('hashchange', () => {
                activatePanel(window.location.hash.replace('#', ''), false);
            });

            activatePanel(window.location.hash.replace('#', '') || defaultPanel, false);
        })();
    </script>
@endpush
