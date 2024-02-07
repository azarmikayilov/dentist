<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutMenu;
use App\Models\AboutMenuTranslation;
use App\Models\Language;
use App\Models\Quotes;
use App\Models\QuotesTranslation;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\CommonMark\Extension\SmartPunct\Quote;

class AboutMenuController extends Controller
{
    public function index(Request $request)
    {
//        $lang = $request->get('lang', config('app.fallback_locale'));
        $lang='tr';
        $menus = AboutMenu::with(['translations' => function ($query) use ($lang) {
            $query->whereHas('language', function ($subquery) use ($lang) {
                $subquery->where('lang', $lang);
            });
        }])->get();
        $rowCount = AboutMenu::query()->count();

        return view('Admin.pages.about_menu.index', compact('menus', 'lang', 'rowCount'));
    }

    public function create()
    {
        return view('Admin.pages.about_menu.create');
    }

    public function store(Request $request)
    {
        $validationRules = [];

        foreach (config('app.languages') as $lang) {
            $validationRules["$lang.title"] = 'required';
        }

        $request->validate($validationRules);

        $slug = Str::slug($request->input('tr.title'));
        $menus = new AboutMenu();
        $menus->slug =$slug;
        $menus->save();

        foreach (config('app.languages') as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            AboutMenuTranslation::create([
                'about_menu_id' => $menus->id,
                'language_id' => $langId,
                'title' => $request->input("$lang.title"),
            ]);
        }

        return redirect()->route('admin.menu.index')->with('success', 'Quote created successfully');
    }


    public function edit(AboutMenu $menu)
    {
        return view('Admin.pages.about_menu.edit', compact('menu'));
    }


    public function update(Request $request, $menuId)
    {
        $request->validate([
            'tr.title' => 'required',
            'en.title' => 'required',
            'ru.title' => 'required'
        ]);

        $slug = Str::slug($request->input('tr.title'));

        // Retrieve the existing quote
        $menu = AboutMenu::findOrFail($menuId);
        $menu->slug = $slug;
        $menu->save();

        // Update translations
        foreach (config('app.languages') as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            $translation = AboutMenuTranslation::where('about_menu_id', $menu->id)
                ->where('language_id', $langId)
                ->first();

            if (!$translation) {
                // If translation doesn't exist, create a new one
                AboutMenuTranslation::create([
                    'about_menu_id' => $menu->id,
                    'language_id' => $langId,
                    'title' => $request->input("$lang.title"),
                ]);
            } else {
                // If translation exists, update it
                $translation->update([
                    'title' => $request->input("$lang.title"),
                    'description' => $request->input("$lang.description"), // Update to use description field
                ]);
            }
        }

        return redirect()->route('admin.menu.index', ['menu' => $menu->id])->with('success', 'Quote updated successfully');
    }


    public function delete(AboutMenu $menu)
    {
        if ($menu) {
            // İlgili çevirileri sil
            $menu->translations()->delete();

            // Quote'yi sil
            $menu->delete();

            return redirect()->back()->with('success', 'Quote deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Quote not found.');
        }
    }




}
