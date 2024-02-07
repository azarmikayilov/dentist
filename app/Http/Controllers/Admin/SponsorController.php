<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsors;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsors = Sponsors::all();
        return view('Admin.pages.sponsor.index', compact('sponsors'));
    }

    public function create()
    {
        return view('Admin.pages.sponsor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('sponsor_images', 'public');

        $sponsor = new Sponsors();
        $sponsor->image = $imagePath;
        $sponsor->save();

        return redirect()->route('admin.sponsor.index')->with('success', 'Sponsor added successfully.');
    }

    public function edit(Sponsors $sponsor)
    {
        return view('Admin.pages.sponsor.edit', compact('sponsor'));
    }

    public function update(Request $request, Sponsors $sponsor)
    {
//        $request->validate([
//            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
//        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('sponsor_images', 'public');
            $sponsor->image = $imagePath;
        }

        $sponsor->save();

        return redirect()->route('admin.sponsor.index')->with('success', 'Sponsor updated successfully.');
    }

    public function destroy(Sponsors $sponsor)
    {
        $sponsor->delete();
        return redirect()->route('admin.sponsor.index')->with('success', 'Sponsor deleted successfully.');
    }
}
