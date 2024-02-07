<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TvProgram;
use Illuminate\Http\Request;

class TvProgramController extends Controller
{
    //
    public function index()
    {
        $shows = TvProgram::all();

        return view('Admin.pages.tv-program.index', compact('shows'));
    }

    public function create()
    {
        return view('Admin.pages.tv-program.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required',
            'title' => 'required'
        ]);

        TvProgram::create($request->all());

        return redirect()->route('admin.tv-program.index')->with('success', 'YouTube video added successfully.');
    }

    public function edit(TvProgram $tv_program)
    {
        return view('Admin.pages.tv-program.edit', compact('tv_program'));
    }

    public function update(Request $request, TvProgram $tv_program)
    {
        $request->validate([
            'url' => 'required',
        ]);

        $tv_program->update($request->all());

        return redirect()->route('admin.tv-program.index')->with('success', 'YouTube video updated successfully.');
    }


    public function destroy(TvProgram $tv_program)
    {
        $tv_program->delete();

        return redirect()->route('admin.tv-program.index')->with('success', 'YouTube video deleted successfully.');
    }
}

