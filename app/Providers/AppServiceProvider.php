<?php

namespace App\Providers;

use App\Models\AboutMenu;
use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Icon;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
//        view()->composer('Front.*', function ($view) {
//            $categories = Category::with(['translations', 'blogs.translations'])->get();
//            $blogs = Blog::with(['translations', 'category.translations'])->get();
//
//            return $view->with(compact('categories', 'blogs'));
//        });

        $languages = Language::pluck('lang')->toArray();
        config([
            'app.languages' => $languages,
        ]);


        view()->composer(['Front.*', 'Admin.*'], function ($view){
            $lang = session()->get('locale');
            App::setLocale($lang);

            if ($lang === null) {
                $lang = 'tr';
                session()->put('locale', $lang);
            }
//            $lang = session()->get('language', 'tr');
//            $lang = 'tr';
            $categoriesBlogEdit = Category::with(['translations', 'blogs.translations'])->get();

            $categories = Category::with([
                'translations' => function ($query) use ($lang) {
                    $query->whereHas('language', function ($subquery) use ($lang) {
                        $subquery->where('lang', $lang);
                    });
                },
                'blogs.translations' => function ($query) use ($lang) {
                    $query->whereHas('language', function ($subquery) use ($lang) {
                        $subquery->where('lang', $lang);
                    });
                },
            ])->get();


            $abouts = AboutMenu::with([
                'translations' => function ($query) use ($lang) {
                    $query->whereHas('language', function ($subquery) use ($lang) {
                        $subquery->where('lang', $lang);
                    });
                },
            ])->get();



            $languageIcon = Language::all();
            $settings = Setting::first();
            $socialIcons = Icon::all();


//            $categories = Category::with(['translations', 'blogs.translations'])->get();
            $blogsGeneral = Blog::with(['translations' => function ($query) use ($lang) {
                $query->whereHas('language', function ($subquery) use ($lang) {
                    $subquery->where('lang', $lang);
                });
            }])->get();
//            dd($lang);
            $view->with(compact('categories', 'lang', 'blogsGeneral', 'abouts' ,'settings', 'socialIcons', 'languageIcon' ,'categoriesBlogEdit'));
        });
    }
}
