<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function setLocale($locale)
    {
        app()->setLocale($locale);
        session()->put('locale', $locale);

        if ($locale === null) {
            $locale = 'tr';
            session()->put('locale', $locale);
        }

        return redirect()->back();
    }
}
