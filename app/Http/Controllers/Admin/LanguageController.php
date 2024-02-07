<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Slider;
use App\Models\Sponsors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        return view('Admin.pages.language.index', compact('languages'));
    }

    public function create()
    {
        return view('Admin.pages.language.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp,gif,svg|max:2048',
            'short_name' => 'required'
        ]);

        Language::create([
            'lang' => $request->input('short_name'),
            'image' => $request->file('image')->store('language', 'public'),
        ]);

        return redirect()->route('admin.language.index')->with('success', 'Language Item added successfully!');
    }

    public function edit(Language $language)
    {
        return view('Admin.pages.language.edit', compact('language'));
    }

    public function update(Request $request, Language $language)
    {
//        dd($request->all());
        $request->validate([
            'short_name' => 'required'
        ]);
        if ($request->hasFile('image')) {
            if ($language->image !== null && Storage::disk('public')->exists($language->image)) {
                Storage::disk('public')->delete($language->image);
            }
            $language->image = $request->file('image')->store('language_images', 'public');
        }
        $language->lang = $request->short_name;
        $language->save();
        return redirect()->route('admin.language.index')->with('success', 'Language Item updated successfully!');
    }

    public function destroy(Language $language)
    {
        if (Storage::disk('public')->exists($language->image)) {
            Storage::disk('public')->delete($language->image);

        }
        $language->delete();
        return redirect()->route('admin.language.index')->with('success', 'Language item deleted successfully!');
    }
}
