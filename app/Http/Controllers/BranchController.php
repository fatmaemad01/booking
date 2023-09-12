<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Models\Branch;
use App\Models\Day;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();

        $days = Day::all();

        $success = session('success');

        return view('admin.branch.index' , compact('branches' , 'days' ,'success'));

    }

    public function store(BranchRequest $request)
    {

        $validatedData = $request->validated();

        $validatedData['user_id'] = Auth::user()->id;

        Branch::create($validatedData);

        return redirect()->route('admin.branch.index')->with('success' , 'the branch created successfully');


    }

    public function show(Branch $branch)
    {

        return view('admin.branch.show' , compact('branch'));

    }

    public function update(BranchRequest $request , Branch $branch)
    {

    }

    public function destroy(Branch $branch)
    {
        
    }
}
