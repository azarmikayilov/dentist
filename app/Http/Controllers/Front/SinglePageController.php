<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTranslation;

class SinglePageController extends Controller
{
    public function index(Blog $blog)
    {
        $locale = session()->get('locale',);
        $defaultLocale = config('app.fallback_locale');

        $image = Blog::query()->where('id', $blog->id)->first();

        $blog = $blog->translations->where('language.lang', $locale)
            ->first() ?? $blog->translations
            ->where('language.lang', $defaultLocale)
            ->first();





        $blogsForOthers = BlogTranslation::whereHas('language', function ($query) use ($locale) {
            $query->where('lang', $locale);
        })->with(['language', 'blog'])->get();

        $randomBlogs = $blogsForOthers->count() < 3 ? $blogsForOthers : $blogsForOthers->random(3);


//        dd($randomBlogs);


        return view('Front.pages.singlePage', compact(['blog', 'image', 'randomBlogs']));
    }
}
