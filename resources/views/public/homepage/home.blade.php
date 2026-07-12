@extends('layouts.public')

@section('title', 'Beranda | BPSMB Surakarta')


@section('content')
    @include('public.homepage.component.hero', ['section' => $heroSection, 'sections' => $heroSections])
    @include('public.homepage.component.logo-marquee')
    @include('public.homepage.component.commitment', [
        'section' => $commitmentSection,
        'sections' => $commitmentSections,
    ])
    @include('public.homepage.component.news', ['latestNews' => $latestNews])
    @include('public.homepage.component.videos', ['videoSections' => $videoSections])
    @include('public.homepage.component.photos', ['photoSections' => $photoSections])
    @include('public.homepage.component.popup', ['popup' => $popup])

@endsection
