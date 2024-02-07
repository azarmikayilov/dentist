<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Team;
use App\Models\TeamTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->get('lang', config('app.fallback_locale'));
        $teams = Team::with('translations')->get();

        return view('Admin.pages.teams.index', compact('teams', 'lang'));
    }



//    public function index(Request $request)
//    {
//        $languageCode = $request->input('language', config('app.locale'));
//
//        $teams = Team::whereHas('translations', function ($query) use ($languageCode) {
//            $query->where('language_id', function ($subQuery) use ($languageCode) {
//                $subQuery->select('id')
//                    ->from('languages')  // Assuming the table name is 'languages'
//                    ->where('lang', $languageCode);
//            });
//        })->get();
//
//        return view('Admin.pages.teams.index', compact('teams', 'languageCode'));
//    }


    public function create()
    {
        return view('Admin.pages.teams.create');
    }

    public function store(Request $request)
    {
        $validationRules = [
            'image' => 'required',
            'firstName' => 'required',
        ];

        foreach (config('app.languages') as $lang) {
            $validationRules["$lang.title"] = 'required';
        }

        $request->validate($validationRules);

//        dd($request->all());
        // Create team member
        $team = new Team();
        $team->image = $request->file('image')->store('team_images', 'public');
        $team->title = $request->input('firstName');
        $team->save();

//        dd($team->id);
        // Save translations
        foreach (config('app.languages') as $lang) {

            $language =Language::where('lang',$lang)->first();
            $langId=$language->id;
//            dd($langId);
            TeamTranslation::create([
                'teams_id' => $team->id,
                'language_id' => $langId,
                'position' => $request->input("$lang.title"),
            ]);
        }

        return redirect()->route('admin.teams.index')->with('success', 'Team member created successfully');
    }

    public function edit(Team $team)
    {
//        $teamPosition = Team::with('translations')->first();
//        return view('Admin.pages.teams.edit', compact('team', 'teamPosition'));

//        $teamPosition = Team::with('translations')->first();

//        dd($team);

        return view('Admin.pages.teams.edit', compact('team'));

    }


    public function update(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
        ]);

        $team = Team::find($request->input('team_id'));

        if ($request->hasFile('image')) {
            $team->image = $request->file('image')->store('team_images', 'public');
        }

        $team->title = $request->input('firstName');
        $team->save();

        foreach (config('app.languages') as $lang) {
            $language = Language::where('lang', $lang)->first();
            $langId = $language->id;

            // Eğer dil çevirisi zaten varsa, güncelle; yoksa oluştur
            $teamTranslation = TeamTranslation::updateOrCreate(
                ['teams_id' => $team->id, 'language_id' => $langId],
                ['position' => $request->input("$lang.title")]
            );
        }

        return redirect()->route('admin.teams.index', ['lang' => 'en'])->with('success', 'Team member created or updated successfully');
    }


    public function delete(Team $team)
    {
//        dd( $team->translations()->get());
        if ($team) {
            // İlgili çevirileri sil
            $team->translations()->delete();
//          Takım resmini storage'dan sil
            if (Storage::disk('public')->exists($team->image)) {
                Storage::disk('public')->delete($team->image);
            }
            // Takımı sil
            $team->delete();

            return redirect()->back()->with('success', 'Team deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Team not found.');
        }

    }

}
