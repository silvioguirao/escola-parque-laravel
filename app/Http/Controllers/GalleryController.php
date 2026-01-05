<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = Album::published()
            ->withCount('photos')
            ->latest('event_date')
            ->paginate(12);

        return view('gallery.index', compact('albums'));
    }

    public function show($id)
    {
        $album = Album::with('photos')
            ->where('id', $id)
            ->published()
            ->firstOrFail();

        return view('gallery.show', compact('album'));
    }
}
