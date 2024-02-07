<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Quotes;
use App\Models\QuotesTranslation;
use Illuminate\Http\Request;

class QuotesController extends Controller
{
    //
    public function showQuotes()
    {
//        $quote = Quotes::query()->all();

        $locale = session()->get('locale');
        $quotes = QuotesTranslation::where('language', $locale)
            ->with('quote')
            ->get();

        return view('Front.pages.main', compact('quotes'));

    }
}
