<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function index()
    {

        $spaces = Space::simplePaginate(6);
        $uniqueTypes = DB::table('spaces')->select('type')->distinct()->pluck('type');


        return view('member.dashboard' , [
            'spaces' => $spaces,
            'branches' => Branch::all(),
            'uniqueTypes' => $uniqueTypes,
        ]);
    }
}
