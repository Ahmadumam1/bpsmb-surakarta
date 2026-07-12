@extends('layouts.public')

@section('title', $page->title . ' | BPSMB Surakarta')
@section('meta_description', $page->meta_description ?: Str::limit(strip_tags($page->content ?? ''), 150))

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
                    <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-[#d4af37] sm:text-[12px] sm:tracking-[0.16em]">
                        {{ $page->subtitle ?: 'Profil BPSMB Surakarta' }}
                    </p>
                    <h1
                        class="mt-2 max-w-3xl text-[25px] font-semibold leading-[1.12] text-[#08236f] sm:mt-4 sm:text-[40px]">
                        {{ $page->title }}
                    </h1>
                    <div class="mt-4 h-0.5 w-14 rounded-full bg-[#d4af37] sm:mt-7 sm:h-1 sm:w-24"></div>
                </div>
            </div>
        </div>
    </section>

    <article class="bg-[#f5f5f7]">
        <div class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8 lg:py-10">
            <div class="overflow-hidden rounded-[8px] border border-black/10 bg-white shadow-[0_24px_70px_rgba(15,23,42,0.08)]">
                <div class="h-1.5 bg-gradient-to-r from-[#08236f] via-[#d4af37] to-[#08236f]"></div>
                <div class="px-5 py-8 sm:px-8 lg:px-10 lg:py-11">
                    <div
                        class="max-w-none text-[16px] leading-8 text-[#3f3f46] antialiased [&_a]:font-semibold [&_a]:text-[#08236f] [&_a]:underline [&_a]:decoration-[#d4af37]/50 [&_a]:decoration-2 [&_a]:underline-offset-4 [&_blockquote]:my-8 [&_blockquote]:border-l-4 [&_blockquote]:border-[#d4af37] [&_blockquote]:bg-[#f8fafc] [&_blockquote]:px-5 [&_blockquote]:py-4 [&_blockquote]:text-[#334155] [&_h2]:relative [&_h2]:mt-12 [&_h2]:border-b [&_h2]:border-black/10 [&_h2]:pb-3 [&_h2]:text-[28px] [&_h2]:font-semibold [&_h2]:leading-tight [&_h2]:tracking-[-0.3px] [&_h2]:text-[#08236f] [&_h3]:mt-8 [&_h3]:text-[22px] [&_h3]:font-semibold [&_h3]:leading-snug [&_h3]:text-[#08236f] [&_img]:my-8 [&_img]:rounded-[8px] [&_img]:shadow-[0_20px_60px_rgba(8,35,111,0.14)] [&_li]:mt-2 [&_li]:pl-1 [&_li::marker]:font-semibold [&_li::marker]:text-[#d4af37] [&_ol]:mt-5 [&_ol]:list-decimal [&_ol]:pl-6 [&_p]:mt-5 [&_p]:text-pretty [&_strong]:font-semibold [&_strong]:text-[#111827] [&_table]:my-8 [&_table]:w-full [&_table]:overflow-hidden [&_table]:rounded-[8px] [&_table]:border [&_table]:border-black/10 [&_td]:border-t [&_td]:border-black/10 [&_td]:px-4 [&_td]:py-3 [&_th]:bg-[#08236f] [&_th]:px-4 [&_th]:py-3 [&_th]:text-left [&_th]:font-semibold [&_th]:text-white [&_ul]:mt-5 [&_ul]:list-disc [&_ul]:pl-6">
                        {!! $page->content ?: '<p>Konten halaman ini sedang disiapkan.</p>' !!}
                    </div>
                </div>
            </div>

            @if ($page->image_url)
                @if ($page->isPdf())
                    <div class="mt-6 overflow-hidden rounded-[8px] border border-black/10 bg-white p-3 shadow-[0_18px_55px_rgba(15,23,42,0.08)]">
                        <div class="relative overflow-hidden rounded-[6px] bg-[#f8fafc] md:hidden"
                            style="height: min(58vh, 460px);">
                            <div class="absolute inset-x-0 top-0 z-10 flex items-center justify-between gap-3 bg-white/95 px-3 py-3 shadow-[0_10px_26px_rgba(15,23,42,0.10)] backdrop-blur">
                                <p class="text-[13px] font-semibold text-[#08236f]">Pratinjau PDF</p>
                                <a href="{{ $page->image_url }}" target="_blank" rel="noopener"
                                    class="inline-flex min-h-9 items-center justify-center rounded-[8px] bg-[#08236f] px-3 py-2 text-[12px] font-semibold text-white">
                                    Buka File
                                </a>
                            </div>
                            <div class="h-full overflow-y-auto px-3 pb-4 pt-[69px]" data-profile-pdf-viewer
                                data-pdf-url="{{ $page->image_url }}">
                                <div class="rounded-[8px] bg-white px-4 py-5 text-center text-[13px] font-medium text-[#64748b] shadow-sm"
                                    data-profile-pdf-status>
                                    Memuat pratinjau PDF...
                                </div>
                            </div>
                        </div>

                        <div class="relative hidden overflow-hidden rounded-[6px] bg-[#f8fafc] md:block"
                            style="height: clamp(560px, 75vh, 820px);">
                            <a href="{{ $page->image_url }}" target="_blank" rel="noopener"
                                aria-label="Buka PDF di tab baru"
                                class="absolute right-3 top-3 z-10 grid h-10 w-10 place-items-center rounded-[8px] bg-black/70 text-white shadow-[0_10px_24px_rgba(0,0,0,0.22)] transition hover:bg-[#08236f]">
                                <svg class="h-4.5 w-4.5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 6H18m0 0v4.5M18 6l-7.5 7.5M6 6h4.5M6 6v12h12v-4.5" />
                                </svg>
                            </a>
                            <iframe src="{{ $page->image_url }}#toolbar=1&navpanes=0&scrollbar=1&page=1&view=FitH"
                                title="{{ $page->title }}" class="h-full w-full border-0" loading="lazy">
                            </iframe>
                        </div>
                    </div>
                @elseif ($page->isImage())
                    <input id="profile-image-preview" type="checkbox" class="peer/image-preview sr-only">

                    <div class="mt-6 overflow-hidden rounded-[8px] border border-black/10 bg-white p-3 shadow-[0_18px_55px_rgba(15,23,42,0.08)]">
                        <label for="profile-image-preview"
                            class="group relative block cursor-zoom-in overflow-hidden rounded-[6px] bg-[#f8fafc]">
                            <img src="{{ $page->image_url }}" alt="{{ $page->title }}"
                                class="h-auto max-h-[520px] w-full object-contain transition duration-500 group-hover:scale-[1.015]">
                            <span
                                class="absolute right-3 top-3 grid h-10 w-10 place-items-center rounded-full border border-white/70 bg-white/90 text-[#08236f] shadow-[0_12px_30px_rgba(15,23,42,0.16)] backdrop-blur transition group-hover:bg-[#08236f] group-hover:text-white">
                                <svg class="h-4.5 w-4.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 3.75h6m-6 0v6m0-6 7.5 7.5M20.25 20.25h-6m6 0v-6m0 6-7.5-7.5" />
                                </svg>
                            </span>
                        </label>
                    </div>

                    <label for="profile-image-preview"
                        class="fixed inset-0 z-50 hidden cursor-zoom-out place-items-center bg-[#020617]/88 p-4 backdrop-blur-sm peer-checked/image-preview:grid">
                        <span
                            class="absolute right-4 top-4 grid h-11 w-11 place-items-center rounded-full bg-white text-[#08236f] shadow-[0_16px_40px_rgba(0,0,0,0.28)]">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </span>
                        <img src="{{ $page->image_url }}" alt="{{ $page->title }}"
                            class="max-h-[88vh] max-w-[94vw] rounded-[8px] bg-white object-contain shadow-[0_28px_90px_rgba(0,0,0,0.45)]">
                    </label>
                @endif
            @endif
        </div>
    </article>
@endsection

@if ($page->image_url && $page->isPdf())
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const viewer = document.querySelector('[data-profile-pdf-viewer]');

                if (!viewer || !window.pdfjsLib) {
                    return;
                }

                const status = viewer.querySelector('[data-profile-pdf-status]');
                const pdfUrl = viewer.dataset.pdfUrl;

                window.pdfjsLib.GlobalWorkerOptions.workerSrc =
                    'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

                const renderPage = async (pdf, pageNumber) => {
                    const page = await pdf.getPage(pageNumber);
                    const containerWidth = Math.max(viewer.clientWidth - 24, 260);
                    const viewport = page.getViewport({ scale: 1 });
                    const scale = containerWidth / viewport.width;
                    const scaledViewport = page.getViewport({ scale });
                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');
                    const pixelRatio = window.devicePixelRatio || 1;

                    canvas.width = Math.floor(scaledViewport.width * pixelRatio);
                    canvas.height = Math.floor(scaledViewport.height * pixelRatio);
                    canvas.style.width = `${Math.floor(scaledViewport.width)}px`;
                    canvas.style.height = `${Math.floor(scaledViewport.height)}px`;
                    canvas.className = 'mx-auto mb-4 rounded-[6px] bg-white shadow-[0_10px_30px_rgba(15,23,42,0.12)]';

                    context.setTransform(pixelRatio, 0, 0, pixelRatio, 0, 0);

                    await page.render({
                        canvasContext: context,
                        viewport: scaledViewport,
                    }).promise;

                    viewer.appendChild(canvas);
                };

                const renderPdf = async () => {
                    try {
                        const pdf = await window.pdfjsLib.getDocument(pdfUrl).promise;

                        if (status) {
                            status.remove();
                        }

                        for (let pageNumber = 1; pageNumber <= pdf.numPages; pageNumber += 1) {
                            await renderPage(pdf, pageNumber);
                        }
                    } catch (error) {
                        if (status) {
                            status.textContent = 'Pratinjau gagal dimuat. Silakan gunakan tombol Buka File.';
                        }
                    }
                };

                renderPdf();
            });
        </script>
    @endpush
@endif
