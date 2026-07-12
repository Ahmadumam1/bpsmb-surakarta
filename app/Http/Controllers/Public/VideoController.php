<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $videos = Video::query()
            ->active()
            ->orderByDesc('is_featured')
            ->orderByDesc('id')
            ->get()
            ->map(fn (Video $video): array => [
                'title' => $video->title,
                'category' => $video->category ?: 'Video',
                'description' => $video->description ?: 'Dokumentasi BPSMB Surakarta',
                'image_url' => $video->image_url ?: asset('assets/section1.jpg'),
                'embed_url' => $video->embed_url ?: '',
                'is_featured' => $video->is_featured,
                'search' => str($video->title.' '.$video->category.' '.$video->description)->lower()->value(),
            ]);

        return view('public.media.video.index', compact('videos'));
    }
}
