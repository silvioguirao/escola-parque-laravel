<?php

namespace App\Http\Controllers;

use App\Models\HeroBanner;
use App\Models\Differential;
use App\Models\News;
use App\Models\Partner;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the homepage with all necessary content.
     * 
     * This includes active banners, differentials, latest news, and partners.
     */
    public function index(): View
    {
        // Fetch active banners ordered by position
        $banners = HeroBanner::active()->get();
        
        // Fetch active differentials ordered by position
        $differentials = Differential::active()->get();
        
        // Fetch latest 6 published news with author information
        $latestNews = News::with('author')
            ->published()
            ->latest('published_at')
            ->take(6)
            ->get();
        
        // Fetch active partners ordered by position
        $partners = Partner::active()->get();

        return view('home', compact('banners', 'differentials', 'latestNews', 'partners'));
    }
}
