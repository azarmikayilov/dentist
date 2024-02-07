<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('Admin.pages.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('Admin.pages.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
        ]);

        $imagePath = $request->file('image')->store('sliders', 'public');

        Slider::create([
            'image' => $imagePath, // Dosyanın yolunu veritabanına kaydediyoruz
        ]);

        return redirect()->route('admin.slider.index')->with('success', 'Slider image added successfully!');
    }


    public function edit(Slider $slider)
    {
        return view('Admin.pages.slider.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
//        dd($request->all());
        $request->validate([
            'image' => 'required',
        ]);
        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);

            }
            $slider->update([
                'image' => $request->file('image')->store('slider_images', 'public'),
            ]);
        }



        return redirect()->route('admin.slider.index')->with('success', 'Slider image updated successfully!');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->route('admin.slider.index')->with('success', 'Slider image deleted successfully!');
    }
}

