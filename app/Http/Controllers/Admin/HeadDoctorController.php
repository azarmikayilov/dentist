<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutMenu;
use App\Models\AboutUs;
use App\Models\AboutUsTranslation;
use App\Models\Blog;
use App\Models\BlogTranslation;
use App\Models\Category;
use App\Models\HeadDoctor;
use App\Models\HeadDoctorTranslation;
use App\Models\Language;
use App\Models\Team;
use App\Models\TeamTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HeadDoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $lang='tr';
        $HeadDoctors = HeadDoctor::with(['translations' => function ($query) use ($lang) {
            $query->whereHas('language', function ($subquery) use ($lang) {
                $subquery->where('lang', $lang);
            });
        }])->get();


//        dd($abouts);

        return view('Admin.pages.head_doctor.index', compact('HeadDoctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {

        return view('Admin.pages.head_doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $languages = config('app.languages');
        $validationRules = [ ];

        foreach ($languages as $lang) {
            $validationRules["$lang.description"] = 'required|string';
        }
        $request->validate($validationRules);
//        dd($request->all());
//        dd($slug);

        $about = new HeadDoctor();
        $about->save();
        foreach ($languages as $lang) {

            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;
            HeadDoctorTranslation::create([
                'head_doctor_id' => $about->id,
                'language_id' => $langId,
                'description' => $request->input("$lang.description"),
            ]);
        }
        return redirect()->route('admin.doctor.index', ['lang' => 'en'])->with('success', 'Doctor Item created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HeadDoctor  $doctor)
    {
//        dd($doctor);
        return view('Admin.pages.head_doctor.edit', compact('doctor'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $languages = config('app.languages');
        $validationRules = [];

        foreach ($languages as $lang) {
            $validationRules["$lang.description"] = 'required|string';
        }

        $request->validate($validationRules);

        $about = HeadDoctor::find($id);
        if (!$about) {
            return redirect()->back()->with('error', 'Doctor Item not found.');
        }

        $about->save();

        foreach ($languages as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            HeadDoctorTranslation::updateOrCreate(
                [
                    'head_doctor_id' => $about->id,
                    'language_id' => $langId,
                ],
                [
                    'description' => $request->input("$lang.description"),
                ]
            );
        }

        return redirect()->route('admin.doctor.index', ['lang' => 'en'])->with('success', 'Doctor Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeadDoctor $doctor)
    {
        if ($doctor) {
            $doctor->translations()->delete();

            $doctor->delete();

            return redirect()->back()->with('success', 'Doctor Item deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Doctor Item not found.');
        }
    }
}
