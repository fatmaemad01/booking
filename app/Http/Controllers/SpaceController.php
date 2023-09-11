<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpaceRequest;
use App\Models\Space;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    public function index()
    {
        $spaces = Space::all();

        return view('admin.space.index', compact('spaces'));
    }

    public function store(SpaceRequest $request)
    {
        $validated = $request->validated();
        Space::create($validated);

        return redirect()->route('space.index')->with('success', 'Space Added Sucessfully.');
    }

    public function show(Space $space)
    {
        return view('admin.space.show', compact('space'));
    }

    public function update(SpaceRequest $request, Space $space)
    {
        $validated = $request->validated();
        $space->update($validated);
        
        return redirect()->route('space.index')->with('success', 'Space Updated Sucessfully.');
    }

    public function destroy(Space $space)
    {
        $space->delete();
        return back();
    }
}
