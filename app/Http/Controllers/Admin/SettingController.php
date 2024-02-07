<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Youtubes;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::all();
        $rowCount = Setting::query()->count();

        return view('Admin.pages.setting.index', compact('settings', 'rowCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.pages.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'top_logo' => 'required',
            'bottom_logo' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email', // E-postayı zorunlu ve geçerli bir e-posta adresi olmalıdır
        ]);

        $topLogoPath = $request->file('top_logo')->store('page_logos', 'public');

        $bottomLogoPath = $request->file('bottom_logo')->store('page_logos', 'public');


        $setting = new Setting();
        $setting->top_logo = $topLogoPath;
        $setting->bottom_logo = $bottomLogoPath;
        $setting->address = $request->address;
        $setting->phone = $request->phone;
        $setting->email = $request->email;
        $setting->save();

        return redirect()->route('admin.settings.index')->with('success', 'Setting created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('Admin.pages.setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {

        if ($request->hasFile('top_logo')) {
            $topLogoPath = $request->file('top_logo')->store('page_logos', 'public');
            $setting->top_logo = $topLogoPath;
        }

        if ($request->hasFile('bottom_logo')) {
            $bottomLogoPath = $request->file('bottom_logo')->store('page_logos', 'public');
            $setting->bottom_logo = $bottomLogoPath;
        }

        $setting->address = $request->address;
        $setting->phone = $request->phone;
        $setting->email = $request->email;
        $setting->save();

        return redirect()->route('admin.settings.index')->with('success', 'Setting updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();

        return redirect()->route('admin.settings.index')->with('success', 'Setting deleted successfully');
    }
}
