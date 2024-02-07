<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTranslation;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    //

    public function index(Request $request)
    {
        $lang = 'tr';
//        $blogs = Blog::with('translations')->get();
        $blogs = Blog::with([
            'translations' => function ($query) use ($lang) {
                $query->whereHas('language', function ($subquery) use ($lang) {
                    $subquery->where('lang', $lang);
                });
            },
            'category.translations' => function ($query) use ($lang) {
                $query->whereHas('language', function ($subquery) use ($lang) {
                    $subquery->where('lang', $lang);
                });
            }
        ])->get();


        return view('Admin.pages.blogs.index', compact('blogs', 'lang'));
    }

    public function create()
    {
        $categories = CategoryTranslation::where('language_id', 2)->get();

        // Group categories by language
//        $groupedCategories = [];
//        foreach ($categories as $category) {
//            $langId = $category->language_id; // Assuming language_id is used for language_id
//            $groupedCategories[$langId][] = $category;
//        }

        return view('Admin.pages.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validationRules = [
            'image' => 'required|image|max:2048',
            'category_id' => 'required'
        ];
//dd($request->all());
        foreach (config('app.languages') as $lang) {
            $validationRules["$lang.title"] = 'required';
            $validationRules["$lang.description"] = 'required';
        }

        $request->validate($validationRules);


        $slug = Str::slug($request->input("tr.title"));

        $blog = new Blog();
        $blog->image = $request->file('image')->store('blog_images', 'public');
        $blog->category_id = $request->input('category_id');
//        dd($request->input('category_id'));
        $blog->slug = $slug;

        // Save the blog to get an ID before creating translations

        $blog->save();

        // Generate the base slug from the default language

        // Loop through languages
        foreach (config('app.languages') as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            // Check if 'slug' is present in the request, otherwise, use the default language's title for slug

            // Create BlogTranslation using createMany for better performance
            BlogTranslation::create( [
                'blog_id' => $blog->id,
                'language_id' => $langId,
                'title' => $request->input("$lang.title"),
                'description' => $request->input("$lang.description"),
            ]);
        }

//        BlogTranslation::insert($translations);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully');
    }


    public function edit(Blog $blog)
    {
//        dd($blog);
        return view('Admin.pages.blogs.edit', compact('blog'));
    }

    public function update(Request $request)
    {
        $blogId = $request->input('blog_id');
        $blog = Blog::find($blogId);

        foreach (config('app.languages') as $lang) {
            $language = Language::where('lang', $lang)->first();
            $languageId = $language->id;

            $translationData = [
                'title' => $request->input("$lang.title"),
                'description' => $request->input("$lang.description"),
            ];

            // Sadece yeni bir resim yüklendiğinde
            if ($request->hasFile('image')) {
                // Eğer varsa mevcut resmi sil
                if (Storage::disk('public')->exists($blog->image)) {
                    Storage::disk('public')->delete($blog->image);
                }
                // Yeni resmi yükle
                $translationData['image'] = $request->file('image')->store('blog_images', 'public');
            }
        }

        // Kategoriyi güncelle
        $category_id = $request->input('category');
        $blog->category_id = $category_id;

        // Blog verisini güncelle
        $blog->update($translationData);

        return redirect()->route('admin.blogs.index', ['lang' => 'en'])->with('success', 'Blog updated successfully');
    }




    public function destroy(Blog $blog)
    {
        if ($blog) {
//            dd($blog);
            // Delete related translations
            $blog->translations()->delete();
            // Delete blog image from storage
            if (Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
            // Delete the blog
            $blog->delete();

            return redirect()->back()->with('success', 'Blog deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Blog not found.');
        }
    }
}
