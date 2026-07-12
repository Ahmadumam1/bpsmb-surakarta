@extends('layouts.public')

@section('title', $service->name.' | BPSMB Surakarta')

@section('content')
    <section class="mx-auto grid max-w-7xl gap-8 px-4 py-7 sm:gap-10 sm:px-6 sm:py-12 lg:grid-cols-[1fr_340px] lg:px-8">
        <article>
            <p class="text-[10px] font-semibold uppercase tracking-[0.12em] text-emerald-700 sm:text-sm sm:tracking-wide">Jasa Layanan</p>
            <h1 class="mt-2 text-[25px] font-bold leading-[1.12] text-slate-950 sm:mt-3 sm:text-4xl">{{ $service->name }}</h1>
            <div class="mt-8 max-w-none text-slate-700 leading-7 [&_h2]:mt-7 [&_h2]:font-bold [&_h2]:text-slate-950 [&_h3]:mt-7 [&_h3]:font-bold [&_h3]:text-slate-950 [&_ol]:mt-4 [&_ol]:list-decimal [&_ol]:pl-5 [&_p]:mt-4 [&_ul]:mt-4 [&_ul]:list-disc [&_ul]:pl-5">
                {!! $service->description !!}
            </div>
        </article>
        <aside class="h-fit rounded border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-950">Dokumen terkait</h2>
            <div class="mt-4 grid gap-3">
                @forelse ($service->documents as $document)
                    <a href="{{ \Illuminate\Support\Facades\Storage::url($document->file_path) }}" class="rounded border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 hover:border-emerald-300" target="_blank">
                        {{ $document->title }}
                    </a>
                @empty
                    <p class="text-sm text-slate-600">Belum ada dokumen terkait.</p>
                @endforelse
            </div>
        </aside>
    </section>
@endsection
