<?php

// app/Http/Controllers/Admin/YoutubeController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Icon;
use App\Models\Quotes;
use App\Models\Youtubes;
use Illuminate\Http\Request;

class IconController extends Controller
{
    public function index()
    {
        $item = Icon::all();
        $rowCount = Icon::query()->count();

        return view('Admin.pages.icon.index', compact('item', 'rowCount'));
    }

    public function create()
    {
        return view('Admin.pages.icon.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'image' => 'required|image'
        ]);

        $imagePath = $request->file('image')->store('icon_images', 'public');

        // Yeni bir Icon öğesi oluştur ve veritabanına kaydet
        $icon = new Icon();
        $icon->url = $request->url;
        $icon->image = $imagePath;
        $icon->save();

        return redirect()->route('admin.icon.index')->with('success', 'YouTube video added successfully.');
    }

    public function edit(Icon $item)
    {
        return view('Admin.pages.icon.edit', compact('item'));
    }

    public function update(Request $request, Icon $item)
    {
        $request->validate([
            'url' => 'url',
            'image' => 'image'
        ]);

        $item->update($request->all());

        return redirect()->route('admin.icon.index')->with('success', 'Icon updated successfully.');
    }

    public function destroy(Icon $item)
    {
        $item->delete();

        return redirect()->route('admin.icon.index')->with('success', 'Icon deleted successfully.');
    }
}
