<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutMenu;
use App\Models\AboutMenuTranslation;
use App\Models\AboutUs;
use App\Models\AboutUsTranslation;
use App\Models\Language;
use App\Models\Quotes;
use App\Models\QuotesTranslation;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\CommonMark\Extension\SmartPunct\Quote;

class AboutUsController extends Controller
{
    public function index(Request $request)
    {
//        $lang = $request->get('lang', config('app.fallback_locale'));
        $lang='tr';
        $aboutus = AboutUs::with(['translations' => function ($query) use ($lang) {
            $query->whereHas('language', function ($subquery) use ($lang) {
                $subquery->where('lang', $lang);
            });
        }])->get();
//        dd($abouts);
        $rowCount = AboutUs::query()->count();

        return view('Admin.pages.about_us.index', compact('aboutus', 'lang', 'rowCount'));
    }

    public function create()
    {
        return view('Admin.pages.about_us.create');
    }

    public function store(Request $request)
    {
        $validationRules = [];

        foreach (config('app.languages') as $lang) {
            $validationRules["$lang.description"] = 'required';
        }

        $request->validate($validationRules);

        $abouts = new AboutUs();
        $abouts->save();


        foreach (config('app.languages') as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            AboutUsTranslation::create([
                'about_us_id' => $abouts->id,
                'language_id' => $langId,
                'description' => $request->input("$lang.description"),
            ]);
        }

        return redirect()->route('admin.about-us.index')->with('success', 'Quote created successfully');
    }


    public function edit(AboutUs $aboutus)
    {
        return view('Admin.pages.about_us.edit', compact('aboutus'));
    }


    public function update(Request $request, $aboutId)
    {
        $request->validate([
            'tr.description' => 'required',
            'en.description' => 'required',
            'ru.description' => 'required'
        ]);

        // Retrieve the existing quote
        $aboutus = AboutUs::findOrFail($aboutId);

        $aboutus->save();

        // Update translations
        foreach (config('app.languages') as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            $translation = AboutUsTranslation::where('about_us_id', $aboutus->id)
                ->where('language_id', $langId)
                ->first();

            if (!$translation) {
                // If translation doesn't exist, create a new one
                AboutUsTranslation::create([
                    'about_us_id' => $aboutus->id,
                    'language_id' => $langId,
                    'description' => $request->input("$lang.title"),
                ]);
            } else {
                // If translation exists, update it
                $translation->update([
                    'description' => $request->input("$lang.description"), // Update to use description field
                ]);
            }
        }

        return redirect()->route('admin.about-us.index', ['menu' => $aboutus->id])->with('success', 'Quote updated successfully');
    }


    public function delete(AboutUs $aboutus)
    {
        if ($aboutus) {
            // İlgili çevirileri sil
            $aboutus->translations()->delete();

            // Quote'yi sil
            $aboutus->delete();

            return redirect()->back()->with('success', 'Quote deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Quote not found.');
        }
    }




}

