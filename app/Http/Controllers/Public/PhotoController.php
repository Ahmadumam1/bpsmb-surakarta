<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index(Request $request)
    {
        $photos = Photo::query()
            ->active()
            ->orderByDesc('id')
            ->get()
            ->map(fn (Photo $photo): array => [
                'title' => $photo->title,
                'category' => $photo->category ?: 'Galeri',
                'image_url' => $photo->image_url ?: asset('assets/section1.jpg'),
                'search' => str($photo->title.' '.$photo->category)->lower()->value(),
            ]);

        return view('public.media.photo.index', compact('photos'));
    }
}
