<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTranslation;
use App\Models\QuotesTranslation;
use App\Models\Slider;
use App\Models\Sponsors;
use App\Models\Team;
use App\Models\TvProgram;
use App\Models\Youtubes;

class MainPageController extends Controller
{
    public function index()
    {
        $locale = session()->get('locale');

//        if ($locale === null) {
//            $locale = 'tr';
//            session()->put('locale', $locale);
//        }


        $blogForSlider = Slider::get();


//        dd($blogForSlider);

        $blogsForQuotes = Blog::with('translations')->get();

        $quotesTranslations = QuotesTranslation::whereHas('language', function ($query) use ($locale) {
            $query->where('lang', $locale);
        })->with('quote')->get();


        $sponsors = Sponsors::all();
        $youtube = Youtubes::first();

        $teams = Team::with(['translations' => function ($query) use ($locale) {
            $query->whereHas('language', function ($subquery) use ($locale) {
                $subquery->where('lang', $locale);
            });
        }])->get();
//        dd($teams);

        $blogs = Blog::with(['translations'])->limit(9)->get();

        return view('Front.pages.main', compact(['locale', 'quotesTranslations', 'sponsors', 'youtube', 'teams', 'blogs', 'blogForSlider']));
    }
}
