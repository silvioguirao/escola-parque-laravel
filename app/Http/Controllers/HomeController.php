<?php

namespace App\Http\Controllers;

use App\Models\HeroBanner;
use App\Models\Differential;
use App\Models\News;
use App\Models\Partner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = HeroBanner::active()->get();
        $differentials = Differential::active()->get();
        $latestNews = News::published()->latest('published_at')->take(6)->get();
        $partners = Partner::active()->get();

        return view('home', compact('banners', 'differentials', 'latestNews', 'partners'));
    }
}
