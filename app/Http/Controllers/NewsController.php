<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::published()
            ->with('author')
            ->latest('published_at')
            ->paginate(12);

        return view('news.index', compact('news'));
    }

    public function show($slug)
    {
        $newsItem = News::where('slug', $slug)
            ->published()
            ->with('author')
            ->firstOrFail();

        $relatedNews = News::published()
            ->where('id', '!=', $newsItem->id)
            ->where('category', $newsItem->category)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('news.show', compact('newsItem', 'relatedNews'));
    }
}
