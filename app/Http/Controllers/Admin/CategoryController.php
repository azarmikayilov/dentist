<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTranslation;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Language;
use App\Models\Quotes;
use App\Models\Team;
use App\Models\TeamTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $lang = $request->get('lang', config('app.fallback_locale'));
        $categories = Category::with(['translations' => function ($query) use ($lang) {
            $query->where('language_id', Language::where('lang', $lang)->value('id'));
        }])->get();
//        dd($categories);

        return view('admin.pages.category.index', compact('categories', 'lang'));
    }

    public function create()
    {
        return view('Admin.pages.category.create');
    }

    public function store(Request $request)
    {
        // Validation
        $validationRules = [];

        foreach (config('app.languages') as $lang) {
            $validationRules["$lang.title"] = 'required';
        }

        $request->validate($validationRules);


        // Create a new Category instance
        $category = new Category();
        $category->save();

        // Loop through languages
        foreach (config('app.languages') as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            // Create CategoryTranslation using createMany for better performance
            CategoryTranslation::create([
                'category_id' => $category->id,
                'language_id' => $langId,
                'name' => $request->input("$lang.title"),
                'slug' => Str::slug($request->input("$lang.title")),
            ]);
        }

        return redirect()->route('admin.category.index')->with('success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
//        dd($blog);
        return view('Admin.pages.category.edit', compact('category'));
    }

//    public function update(Request $request)
//    {
//
//
////        dd($request->all());
//        $categoryId = $request->input('category_id');
//        $category = Category::findOrFail($categoryId);
//
//        foreach (config('app.languages') as $lang) {
//            $language = Language::where('lang', $lang)->first();
//            $langId = $language->id;
//
//            $translationData = [
//                'title' => $request->input("$lang.title"),
//            ];
//
//
//            // Update or create translation
//            BlogTranslation::updateOrCreate(
//                ['blog_id' => $category, 'language_id' => $langId],
//                $translationData
//            );
//        }
//
//
//
//        return redirect()->route('admin.category.index', ['lang' => 'en'])->with('success', 'Blog updated successfully');
//    }

    public function update(Request $request)
    {
        $categoryId = $request->input('category_id');
//        dd($categoryId);
        $category = Category::findOrFail($categoryId);

        foreach (config('app.languages') as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            $translationData = [
                'name' => $request->input("$lang.title"),
            ];

            // Update or create translation
            CategoryTranslation::updateOrCreate(
                ['category_id' => $category->id, 'language_id' => $langId],
                $translationData
            );
        }

        return redirect()->route('admin.category.index', ['lang' => 'tr'])->with('success', 'Category updated successfully');
    }



    public function destroy(Category $category)
    {
        if ($category) {
            // Delete related translations
            $category->translations()->delete();



            // Delete the quote
            $category->delete();

            return redirect()->back()->with('success', 'Quote deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Quote not found.');
        }
    }



}
