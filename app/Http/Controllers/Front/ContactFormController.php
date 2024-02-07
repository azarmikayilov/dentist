<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContactForm;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'title' => 'required',
            'text' => 'required',
            'is_checked' => 'required'
        ]);

        $validatedData['kvkk_accepted'] = $request->has('is_checked') ? 1 : 0;

        ContactForm::create($validatedData);

//        ContactForm::create($request->all());

        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
}
