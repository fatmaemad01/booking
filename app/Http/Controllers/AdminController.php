<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Models\BookingRequest;
use App\Models\Branch;
use App\Models\Day;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    // Dashboard => show all member booking requests
    public function adminDashboard()
    {
        $requests = BookingRequest::simplePaginate(3);

        return view('admin.dashboard', compact('requests'));
    }

}
