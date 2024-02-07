<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\DoctorImage;
use App\Models\HeadDoctor;
use App\Models\Menu;
use App\Models\MenuBuilder;
use App\Models\TvProgram;

class BlogController extends Controller
{
//    public function index()
//    {
//        return view('Front.pages.main');
//    }

    public function singlePage()
    {
        return view('Front.pages.singlePage');
    }

    public function about()
    {
        $doctorImages = DoctorImage::all();
        $lang = session()->get('locale');
        $aboutUs = AboutUs::query()->with([
            'translations' => function ($query) use ($lang) {
                $query->whereHas('language', function ($subquery) use ($lang) {
                    $subquery->where('lang', $lang);
                });
            }])->get();
//        dd($doctorImages);
        return view('Front.pages.about' ,compact('doctorImages', 'aboutUs'));
    }

    public function contact()
    {
        return view('Front.pages.contact');
    }

    public function tvPrograms()
    {
        $tvPrograms = TvProgram::all();
        return view('Front.pages.tv-programs', compact('tvPrograms'));
    }

    public function article()
    {

        $blogs = Blog::with('translations')->get();

        return view('Front.pages.articles', compact('blogs'));
    }

    public function showPage()
    {

        return view('Front.pages.singlePage');
    }

    public function doctorPageShow()
    {
        $lang = session()->get('locale');
        $about = HeadDoctor::with([
            'translations' => function ($query) use ($lang) {
                $query->whereHas('language', function ($subquery) use ($lang) {
                    $subquery->where('lang', $lang);
                });
        }])->get();
//        dd($about);

        $images = DoctorImage::all();
        return view('Front.pages.doctor_page', compact('about', 'images'));
    }
}
