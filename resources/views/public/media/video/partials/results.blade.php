@if ($videos->isNotEmpty())
    <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($videos as $video)
            <article class="overflow-hidden rounded-[8px] border border-[#e0e0e0] bg-white text-[#1d1d1f] transition-transform transition-colors hover:-translate-y-0.5 hover:border-[#08236f]/20">
                <a href="{{ $video->embed_url ?: '#' }}"
                    data-video-modal-open
                    data-video-embed-url="{{ $video->embed_url }}"
                    data-video-title="{{ $video->title }}">
                    <span class="relative block h-56 overflow-hidden bg-[#f5f5f7]">
                        <img src="{{ $video->image_url ?: asset('assets/section1.jpg') }}" alt="{{ $video->title }}"
                            class="h-full w-full object-cover">
                        <span class="absolute inset-0 grid place-items-center bg-black/20 text-white">
                            <span class="grid h-14 w-14 place-items-center rounded-full bg-white/92 text-[#08236f] shadow-lg">
                                <svg class="ml-0.5 h-6 w-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M8 5.5v13l10-6.5-10-6.5Z" />
                                </svg>
                            </span>
                        </span>
                    </span>
                    <div class="p-6">
                        <div class="flex items-center justify-between gap-4">
                            <span class="rounded-[5px] bg-[#f5f5f7] px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.12em] text-[#08236f]">
                                {{ $video->category ?: 'Video' }}
                            </span>
                            @if ($video->is_featured)
                                <span class="text-[12px] font-semibold text-[#d4af37]">Featured</span>
                            @endif
                        </div>
                        <h2 class="mt-5 line-clamp-2 text-[21px] font-semibold leading-[1.19] tracking-[0.231px] text-[#1d1d1f]">
                            {{ $video->title }}
                        </h2>
                        <p class="mt-3 line-clamp-3 text-[14px] leading-[1.43] tracking-[-0.224px] text-[#7a7a7a]">
                            {{ $video->description ?: 'Dokumentasi BPSMB Surakarta' }}
                        </p>
                        <span class="mt-5 inline-block text-[14px] leading-[1.29] tracking-[-0.224px] text-[#d4af37]">
                            Tonton Video &rarr;
                        </span>
                    </div>
                </a>
            </article>
        @endforeach
    </div>
@else
    <div class="grid min-h-[320px] w-full place-items-center rounded-[8px] border border-black/10 bg-[#f5f5f7] p-8 text-center">
        <div class="w-full max-w-2xl">
            <div class="mx-auto grid h-14 w-14 place-items-center rounded-full bg-white text-[#08236f] shadow-[0_14px_36px_rgba(15,23,42,0.08)]">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>
            </div>
            <h2 class="mt-5 text-xl font-semibold text-[#08236f]">Video belum tersedia</h2>
            <p class="mt-3 text-sm leading-6 text-[#64748b]">Dokumentasi video akan tampil setelah diaktifkan.</p>
        </div>
    </div>
@endif

@if ($videos->hasPages())
    <div class="mt-10" data-video-pagination>
        {{ $videos->links() }}
    </div>
@endif
