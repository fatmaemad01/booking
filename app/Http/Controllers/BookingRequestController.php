<?php

namespace App\Http\Controllers;

use App\Rules\ValidSpace;
use App\Models\Availability;
use App\Rules\AcceptRequest;
use Illuminate\Http\Request;
use App\Models\BookingRequest;
use App\Rules\CheckRequestConflicts;
use Illuminate\Support\Facades\Auth;
use App\Listeners\CreateAvailability;
use App\Listeners\NewSpaceAvailability;
use App\Http\Requests\CustomBookingRequest;
use Illuminate\Validation\ValidationException;
use App\Rules\AcceptRequest as RulesAcceptRequest;

class BookingRequestController extends Controller
{

    // public function index()
    // {
    //     $requests = BookingRequest::where('id' ,'=' , Auth::id());


    // }

    public function store(CustomBookingRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['user_id'] = Auth::id();

        $bookingRequest = BookingRequest::create($validatedData);

        if ($request->has('days')) {

            $bookingRequest->days()->attach($request->input('days'));
        }

        return redirect()->route('member.dashboard')->with('success', __('Request Created Successfully!'));
    }


    // public function accept(AcceptRequest $request, BookingRequest $bookingRequest)
    // {
    //     // dd('test');
    //           $validatedData = $request->validated();

    //           $validatedData['space_id']  = request('space_id');


    //     $validatedData['status'] = 'accepted';
    //     // dd($validatedData);
    //     $bookingRequest->update($validatedData);

    //     return back();
    // }



    public function show(BookingRequest $bookRequest)
    {
    }

    public function update(CustomBookingRequest $request, BookingRequest $bookRequest)
    {
    }

    public function destroy(BookingRequest $bookRequest)
    {
    }
}
