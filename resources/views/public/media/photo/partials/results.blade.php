@if ($photos->isNotEmpty())
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($photos as $photo)
            <article class="overflow-hidden rounded-[8px] border border-[#e0e0e0] bg-white text-[#1d1d1f] transition-transform transition-colors hover:-translate-y-0.5 hover:border-[#08236f]/20">
                <button type="button"
                    class="block h-full w-full cursor-zoom-in text-left"
                    data-photo-gallery-open
                    data-photo-src="{{ $photo->image_url ?: asset('assets/section1.jpg') }}"
                    data-photo-title="{{ $photo->title }}"
                    data-photo-category="{{ $photo->category ?: 'Galeri' }}">
                    <img src="{{ $photo->image_url ?: asset('assets/section1.jpg') }}" alt="{{ $photo->title }}"
                        class="h-52 w-full object-cover" loading="lazy">
                    <span class="block p-5">
                        <span class="rounded-[5px] bg-[#f5f5f7] px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.12em] text-[#08236f]">
                            {{ $photo->category ?: 'Galeri' }}
                        </span>
                        <span class="mt-4 line-clamp-2 block text-[15px] font-semibold leading-[1.35] text-[#1d1d1f]">
                            {{ $photo->title }}
                        </span>
                    </span>
                </button>
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
                        d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Z" />
                </svg>
            </div>
            <h2 class="mt-5 text-xl font-semibold text-[#08236f]">Foto belum tersedia</h2>
            <p class="mt-3 text-sm leading-6 text-[#64748b]">Dokumentasi foto akan tampil setelah diaktifkan.</p>
        </div>
    </div>
@endif

@if ($photos->hasPages())
    <div class="mt-10" data-photo-pagination>
        {{ $photos->links() }}
    </div>
@endif
