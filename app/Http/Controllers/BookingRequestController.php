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
use App\Models\Day;
use App\Models\Space;
use Illuminate\Validation\ValidationException;
use App\Rules\AcceptRequest as RulesAcceptRequest;

class BookingRequestController extends Controller
{

    public function index()
    {
        $requests = BookingRequest::where('user_id' , Auth::id())->get();

        $spaces = Space::all();
        return view('member.request.index' , [
            'spaces' => $spaces,
            'days' => Day::all(),
            'request' => new BookingRequest(),
            'requests' => $requests,
        ]);


    }

    public function store(CustomBookingRequest $request)
    {
        $validatedData = $request->validated();
    
        // Set the user_id to the authenticated user's ID
        $validatedData['user_id'] = Auth::id();

        $validatedData['space_id'] = $request->input('space_id');
        $validatedData['branch_id'] = $request->input('branch_id');
    
        // Create a new BookingRequest instance and save it
        $bookingRequest = new BookingRequest($validatedData);
        $bookingRequest->save();
    
        if ($request->has('days')) {
            $selectedDays = $request->input('days');
    
            foreach ($selectedDays as $dayId) {
                // Retrieve start_time and end_time from the request for each day
                $startTime = $request->input('start_time_' . $dayId);
                $endTime = $request->input('end_time_' . $dayId);
            }
        }
    
        return back()->with('success', __('Request Created Successfully!'));
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
