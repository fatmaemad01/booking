<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Models\BookingRequest;
use App\Models\Branch;
use App\Models\Day;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    // Dashboard => show all member booking requests
    public function adminDashboard(Request $request)
    {
    
        $requests = BookingRequest::where('status' , 'pending')->simplePaginate(5);

        $uniqueTypes = DB::table('spaces')->select('type')->distinct()->pluck('type');


        return view('admin.dashboard' ,[
            'requests' => $requests,
            'spaces' => Space::all(),
            'uniqueTypes' => $uniqueTypes,
        ]);
    }


}
