<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {

        return view('admin.branch.index');

    }

    public function store(BranchRequest $request)
    {

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
