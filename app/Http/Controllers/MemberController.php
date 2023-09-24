<?php

namespace App\Http\Controllers;

use App\Models\Space;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {

        $spaces = Space::simplePaginate(3);

        return view('member.dashboard' , [
            'spaces' => $spaces,
        ]);
    }
}
