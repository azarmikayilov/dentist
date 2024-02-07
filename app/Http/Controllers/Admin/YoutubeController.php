<?php

// app/Http/Controllers/Admin/YoutubeController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quotes;
use App\Models\Youtubes;
use Illuminate\Http\Request;

class YoutubeController extends Controller
{
    public function index()
    {
        $youtubes = Youtubes::all();
        $rowCount = Youtubes::query()->count();

        return view('Admin.pages.youtube.index', compact('youtubes', 'rowCount'));
    }

    public function create()
    {
        return view('Admin.pages.youtube.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        Youtubes::create($request->all());

        return redirect()->route('admin.youtube.index')->with('success', 'YouTube video added successfully.');
    }

    public function edit(Youtubes $youtube)
    {
        return view('Admin.pages.youtube.edit', compact('youtube'));
    }

    public function update(Request $request, Youtubes $youtube)
    {
        $request->validate([
            'url' => 'url',
        ]);

        $youtube->update($request->all());

        return redirect()->route('admin.youtube.index')->with('success', 'YouTube video updated successfully.');
    }

    public function destroy(Youtubes $youtube)
    {
        $youtube->delete();

        return redirect()->route('admin.youtube.index')->with('success', 'YouTube video deleted successfully.');
    }
}
