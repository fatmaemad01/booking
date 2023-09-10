<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpaceRequest;
use App\Models\Space;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    public function index()
    {

        return view('admin.space.index');

    }

    public function store(SpaceRequest $request)
    {

    }

    public function show(Space $space)
    {

        return view('admin.space.show' , compact('space'));

    }

    public function update(SpaceRequest $request , Space $space)
    {

    }

    public function destroy(Space $space)
    {
        
    }
}
