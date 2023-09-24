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
        $this->authorize('viewAny' , [Branch::class]);
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


    public function store(BranchRequest $request)
    {

        $this->authorize('create' , [Branch::class]);

        $validatedData = $request->validated();

        $validatedData['user_id'] = Auth::user()->id;

        $branch = Branch::create($validatedData);

        if ($request->has('work_days')) {

            $branch->workDays()->attach($request->input('work_days'));
        }

        return back()->with('success', __('Branch Created Successfully!'));
    }


    public function update(BranchRequest $request, Branch $branch)
    {

        $this->authorize('update', $branch);

        $validatedData = $request->validated();

        $branch->update($validatedData);

        $branch->workDays()->sync($request->input('work_days'));

        return redirect()->route('branch.index')->with('success', __('Branch Updated Successfully!'));
    }

    public function destroy(Branch $branch)
    {

        $this->authorize('delete', $branch);
        
        $branch->workDays()->detach();

        $branch->delete();

        return redirect()->route('branch.index')->with('success', __('Branch Deleted Successfully!'));
    }
}
