@extends('layouts.public')

@section('title', $news->title.' | BPSMB Surakarta')
@section('meta_description', $news->excerpt ?: Str::limit(strip_tags($news->content), 150))

@section('content')
    <article class="bg-[#f8fafc]">
        <header class="border-b border-slate-200 bg-white">
            <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 sm:py-10 lg:px-8 lg:py-12">
                <a href="{{ route('media.news.index') }}"
                    class="inline-flex items-center gap-2 text-[13px] font-semibold text-[#08236f] transition hover:text-[#d4af37]">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m6-6-6 6 6 6" />
                    </svg>
                    Kembali ke Berita
                </a>

                <div class="mt-5 max-w-4xl">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-[#d4af37]/15 px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.16em] text-[#7a5b00]">
                        <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75A2.25 2.25 0 0 1 6 4.5h4.1c.6 0 1.17.24 1.6.66l6.64 6.64a2.25 2.25 0 0 1 0 3.18l-3.36 3.36a2.25 2.25 0 0 1-3.18 0L5.16 11.7a2.25 2.25 0 0 1-.66-1.6V6.75Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h.01" />
                        </svg>
                        {{ $news->category?->name ?? 'Berita' }}
                    </span>
                    <h1 class="mt-4 text-[24px] font-bold leading-[1.15] text-[#081a3c] sm:text-[32px] lg:text-[40px]">
                        {{ $news->title }}
                    </h1>
                    <div class="mt-5 flex flex-wrap items-center gap-x-4 gap-y-2 border-l-4 border-[#d4af37] pl-3 text-[13px] font-medium text-[#64748b] sm:text-sm">
                        <span>{{ $news->published_at?->translatedFormat('d F Y') }}</span>
                        @if ($news->author)
                            <span class="hidden h-1 w-1 rounded-full bg-[#cbd5e1] sm:inline-block"></span>
                            <span>{{ $news->author }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 sm:py-10 lg:px-8 lg:py-12">
            @php($thumbnail = $news->thumbnail_url ?: asset('assets/section1.jpg'))

            <div class="mx-auto max-w-4xl">
                <img src="{{ $thumbnail }}" alt="{{ $news->title }}"
                    class="h-[260px] w-full rounded-[12px] object-cover shadow-[0_18px_50px_rgba(15,23,42,0.12)] sm:h-[360px] lg:h-[430px]">

                <div class="mt-8 rounded-[12px] border border-slate-200 bg-white p-5 text-[#334155] shadow-[0_12px_30px_rgba(15,23,42,0.05)] sm:p-8 [&_a]:font-semibold [&_a]:text-[#08236f] [&_blockquote]:mt-5 [&_blockquote]:border-l-4 [&_blockquote]:border-[#d4af37] [&_blockquote]:bg-[#f8fafc] [&_blockquote]:px-4 [&_blockquote]:py-3 [&_h2]:mt-8 [&_h2]:font-semibold [&_h2]:leading-tight [&_h2]:text-[#08236f] [&_h3]:mt-8 [&_h3]:font-semibold [&_h3]:leading-tight [&_h3]:text-[#08236f] [&_img]:my-6 [&_img]:rounded-[10px] [&_ol]:mt-4 [&_ol]:list-decimal [&_ol]:pl-5 [&_p]:mt-4 [&_p]:text-[15px] [&_p]:leading-8 [&_p]:text-[#334155] [&_strong]:text-[#1f2937] [&_ul]:mt-4 [&_ul]:list-disc [&_ul]:pl-5">
                    {!! $news->content !!}
                </div>
            </div>

            @if ($relatedNews->isNotEmpty())
                <div class="mx-auto mt-10 max-w-4xl rounded-[8px] border border-slate-200 bg-white px-5 py-6 shadow-[0_10px_28px_rgba(15,23,42,0.06)] sm:px-8 sm:py-7">
                    <h2 class="text-[22px] font-bold leading-tight text-[#001b3f]">Berita Terkait</h2>
                    <div class="mt-5 grid gap-5 sm:mt-6">
                        @foreach ($relatedNews as $relatedNewsItem)
                            <a href="{{ route('media.news.show', $relatedNewsItem) }}"
                                class="group grid gap-4 rounded-l-[8px] border-l-[4px] border-[#f1bd58] py-2 pl-4 transition hover:border-[#d4af37] sm:grid-cols-[180px_1fr] sm:gap-5 sm:py-3 sm:pl-5">
                                <span class="block overflow-hidden rounded-[8px] bg-slate-100 shadow-[0_8px_22px_rgba(15,23,42,0.08)]">
                                    <img src="{{ $relatedNewsItem->thumbnail_url ?: asset('assets/section1.jpg') }}"
                                        alt="{{ $relatedNewsItem->title }}"
                                        class="h-36 w-full object-cover transition duration-300 group-hover:scale-[1.03] sm:h-28">
                                </span>
                                <span class="min-w-0 self-center">
                                    <span class="line-clamp-2 block text-[17px] font-semibold leading-snug text-[#001b3f] transition group-hover:text-[#08236f] sm:text-[19px]">
                                        {{ $relatedNewsItem->title }}
                                    </span>
                                    <span class="mt-2 line-clamp-2 block text-[14px] leading-6 text-[#334155] sm:text-[15px]">
                                        {{ $relatedNewsItem->excerpt ?: Str::limit(strip_tags($relatedNewsItem->content), 150) }}
                                    </span>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </article>
@endsection
