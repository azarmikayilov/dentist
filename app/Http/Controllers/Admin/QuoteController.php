<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Quotes;
use App\Models\QuotesTranslation;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\SmartPunct\Quote;

class QuoteController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->get('lang', config('app.fallback_locale'));
        $quotes = Quotes::with(['translations' => function ($query) use ($lang) {
            $query->where('language_id', Language::where('lang', $lang)->value('id'));
        }])->get();
        $rowCount = Quotes::query()->count();

        return view('Admin.pages.quotes.index', compact('quotes', 'lang', 'rowCount'));
    }

    public function create()
    {
        return view('Admin.pages.quotes.create');
    }

    public function store(Request $request)
    {
        $validationRules = [
            'image' => 'required', // Örnek kurallar, isteğinize göre düzenleyebilirsiniz.
        ];

        foreach (config('app.languages') as $lang) {
            $validationRules["$lang.title"] = 'required';
            $validationRules["$lang.text"] = 'required';
        }

        $request->validate($validationRules);

        $imagePath = $request->file('image')->store('quote_images', 'public');

        $quote = new Quotes();
        $quote->image = $imagePath; // Resim dosyasının yolu
        $quote->save();

        foreach (config('app.languages') as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            QuotesTranslation::create([
                'quote_id' => $quote->id,
                'language_id' => $langId,
                'title' => $request->input("$lang.title"),
                'description' => $request->input("$lang.text"),
            ]);
        }

        return redirect()->route('admin.quotes.index')->with('success', 'Quote created successfully');
    }


    public function edit(Quotes $quote)
    {
        return view('Admin.pages.quotes.edit', compact('quote'));
    }


    public function update(Request $request, $quoteId)
    {
//        $request->validate([
//            'image' => 'required|image|max:2048', // Adjust image validation rules as needed
//        ]);

        // Retrieve the existing quote
        $quote = Quotes::findOrFail($quoteId);

        // Update quote fields
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $quote->image = $request->file('image')->store('quote_images', 'public');
        }

        $quote->save();

        // Update translations
        foreach (config('app.languages') as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            $translation = QuotesTranslation::where('quote_id', $quote->id)
                ->where('language_id', $langId)
                ->first();

            if (!$translation) {
                // If translation doesn't exist, create a new one
                QuotesTranslation::create([
                    'quote_id' => $quote->id,
                    'language_id' => $langId,
                    'title' => $request->input("$lang.title"),
                    'description' => $request->input("$lang.description"), // Update to use description field
                ]);
            } else {
                // If translation exists, update it
                $translation->update([
                    'title' => $request->input("$lang.title"),
                    'description' => $request->input("$lang.description"), // Update to use description field
                ]);
            }
        }

        return redirect()->route('admin.quotes.index', ['quote' => $quote->id])->with('success', 'Quote updated successfully');
    }


    public function delete(Quotes $quote)
    {
        if ($quote) {
            // İlgili çevirileri sil
            $quote->translations()->delete();

            // Quote resmini storage'dan sil
            if (Storage::disk('public')->exists($quote->image)) {
                Storage::disk('public')->delete($quote->image);
            }

            // Quote'yi sil
            $quote->delete();

            return redirect()->back()->with('success', 'Quote deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Quote not found.');
        }
    }




}
