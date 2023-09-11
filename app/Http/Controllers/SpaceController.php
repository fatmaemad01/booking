<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpaceRequest;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpaceController extends Controller
{
    public function index()
    {
        $spaces = Space::all();

        return view('admin.space.index', ['spaces' => $spaces , 'space' => new Space()]);
    }

    // public function create()
    // {
    //     return view('admin.space.index' , [
    //         'space' => new Space()
    //     ]);
    // }

    public function store(SpaceRequest $request)
    {
        $validated = $request->validated();
        // $validated['availabiltiy'] = '';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = Space::uploadImage($file);
            $validated['image'] = $path;
        }

        Space::create($validated);
        return new Space();

        return redirect()->route('space.index')->with('success', 'Space Added Sucessfully.');
    }

    public function show(Space $space)
    {
        if (Auth::user()->role == 'admin') {
            return view('admin.space.show', compact('space'));
        } elseif (Auth::user()->role == 'member') {
            return view('member.dashboard', compact('space'));
        }
    }

    public function update(SpaceRequest $request, Space $space)
    {
        $old_image = $space->image;

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = Space::uploadImage($file);
            $validated['image'] = $path;
        }

        $space->update($validated);

        if ($old_image && $old_image != $space->iamge) {
            Space::deleteImage($old_image);
        }

        return redirect()->route('space.index')->with('success', 'Space Updated Sucessfully.');
    }

    public function destroy(Space $space)
    {
        $space->delete();

        if ($space->image) {
            Space::deleteImage($space->image);
        }

        return back();
    }
}
