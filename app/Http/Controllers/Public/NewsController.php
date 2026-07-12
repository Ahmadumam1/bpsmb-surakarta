<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $newsItems = News::query()
            ->with('category')
            ->published()
            ->latest('published_at')
            ->get()
            ->map(fn (News $news): array => [
                'title' => $news->title,
                'url' => route('media.news.show', $news),
                'excerpt' => $news->excerpt ?: str(strip_tags($news->content))->limit(130)->value(),
                'thumbnail_url' => $news->thumbnail_url ?: asset('assets/section1.jpg'),
                'category_name' => $news->category?->name ?? 'Berita',
                'category_slug' => $news->category?->slug ?? '',
                'published_at' => $news->published_at?->format('d M Y') ?? '',
                'search' => str($news->title.' '.$news->excerpt.' '.$news->category?->name)->lower()->value(),
            ]);

        $categories = NewsCategory::query()
            ->where('type', 'news')
            ->whereHas('news', fn ($query) => $query->published())
            ->orderBy('name')
            ->get();

        return view('public.media.news.index', compact('categories', 'newsItems'));
    }

    public function show(News $news)
    {
        abort_unless($news->is_published && $news->published_at?->isPast(), 404);

        $news->load('category');
        $relatedNews = News::query()
            ->with('category')
            ->published()
            ->whereKeyNot($news->getKey())
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('public.media.news.show', compact('news', 'relatedNews'));
    }
}
