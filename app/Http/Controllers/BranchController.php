<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Models\BookingRequest;
use App\Models\Branch;
use App\Models\Day;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();

        $days = Day::all();

        $success = session('success');

        return view('admin.branch.index', [
            'branches' => $branches,
            'days' => $days,
            'success' => $success,
            'branch' => new Branch(),
        ]);
    }

    public function showSpaces($id)
    {
        $branch = Branch::findOrFail($id);

        // Retrieve the related spaces for the branch using the relationship (e.g., $branch->spaces)
        $spaces = $branch->spaces;
    
        // You can also load any additional data you need for this view
        $books = BookingRequest::all(); // Example: Retrieve booking requests
    
        return view('admin.branch.show_spaces', [
            'branch' => $branch,
            'spaces' => $spaces,
            'books' => $books,
            'space' => new Space(),
            'branches' => Branch::all(),
            'branchId' => $id,

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

        return back();
        // return redirect()->route('branch.index')->with('success', __('Branch Created Successfully!'));
    }

    public function show(Branch $branch)
    {

        $days = Day::all();

        return view('admin.branch.show', compact('branch', 'days'));
    }

    public function update(BranchRequest $request, Branch $branch)
    {

        $validatedData = $request->validated();

        $branch->update($validatedData);

        $branch->workDays()->sync($request->input('work_days'));

        return redirect()->route('branch.index')->with('success', __('Branch Updated Successfully!'));
    }

    public function destroy(Branch $branch)
    {

        $branch->workDays()->detach();

        // Delete the branch
        $branch->delete();


        return redirect()->route('branch.index')->with('success', __('Branch Deleted Successfully!'));
    }
}
