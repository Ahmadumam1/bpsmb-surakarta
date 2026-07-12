<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\HomeCommitment;
use App\Models\HomeHeadline;
use App\Models\HomeMarqueeLogo;
use App\Models\HomePopup;
use App\Models\News;
use App\Models\Photo;
use App\Models\Video;

class HomeController extends Controller
{
    public function __invoke()
    {
        $heroSections = HomeHeadline::query()->active()->latest()->get();
        $commitmentSections = HomeCommitment::query()->active()->latest()->get();

        return view('public.homepage.home', [
            'heroSection' => $heroSections->first(),
            'heroSections' => $heroSections,
            'commitmentSection' => $commitmentSections->first(),
            'commitmentSections' => $commitmentSections,
            'videoSections' => Video::query()->active()->orderByDesc('is_featured')->latest()->get(),
            'photoSections' => Photo::query()->active()->latest()->get(),
            'marqueeLogos' => HomeMarqueeLogo::query()->active()->latest()->get(),
            'popup' => HomePopup::query()->active()->first(),
            'latestNews' => News::query()
                ->with('category')
                ->published()
                ->latest('published_at')
                ->limit(4)
                ->get(),
        ]);
    }
}
