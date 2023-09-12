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

        return view('admin.branch.index' , [
            'branches' => $branches ,
            'days' => $days ,
            'success' => $success,
            'branch' => new Branch(),
            ]);

    }

    public function store(BranchRequest $request)
    {

        $validatedData = $request->validated();

        $validatedData['user_id'] = Auth::user()->id;
    
        $branch = Branch::create($validatedData);
    
        // Attach workdays to the newly created branch
        if ($request->has('work_days')) {

            $branch->workDays()->attach($request->input('work_days'));

        }
    
        return redirect()->route('branch.index')->with('success' , __('Branch Created Successfully!'));

    }

    public function show(Branch $branch)
    {

        $days = $branch->workDays;

        return view('admin.branch.show' , compact('branch' , 'days'));

    }

    public function update(BranchRequest $request , Branch $branch)
    {

        $validatedData = $request->validated();

        // Update the branch with the validated data
        $branch->update($validatedData);
    
        // Sync workdays for the branch based on the request data
        if ($request->has('work_days')) {
            $branch->workDays()->sync($request->input('work_days'));
        } else {
            // If no workdays are provided, detach all existing workdays
            $branch->workDays()->detach();
        }
    
        return redirect()->route('branch.index')->with('success', __('Branch Updated Successfully!'));

    }

    public function destroy(Branch $branch)
    {
        $branch->workDays()->detach();

        // Delete the branch
        $branch->delete();
    

        return redirect()->route('branch.index')->with('success' , __('Branch Deleted Successfully!'));
    }
}
