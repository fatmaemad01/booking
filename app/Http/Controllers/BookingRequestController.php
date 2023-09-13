<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use Illuminate\Http\Request;
use App\Models\BookingRequest;
use Illuminate\Support\Facades\Auth;
use App\Listeners\CreateAvailability;
use App\Listeners\NewSpaceAvailability;
use App\Http\Requests\CustomBookingRequest;

class BookingRequestController extends Controller
{
    
    // public function index()
    // {
    //     $requests = BookingRequest::where('id' ,'=' , Auth::id());


    // }

    public function store(CustomBookingRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['user_id'] = Auth::user()->id;

        $bookingRequest = BookingRequest::create($validatedData);

        if ($request->has('days')) {

            $bookingRequest->days()->attach($request->input('days'));
        }

        return redirect()->route('member.dashboard')->with('success', __('Request Created Successfully!'));
    }


    public function accept(BookingRequest $bookingRequest)
    {
        $bookingRequest->update([
            'status' => 'accepted'
        ]);

        Availability::create([
            'space_id' => $bookingRequest->space_id,
            'start_date' => $bookingRequest->start_date,
            'end_date' => $bookingRequest->end_date,
            'start_time' => $bookingRequest->start_time,
            'end_time' => $bookingRequest->end_time,
            'available' => false
        ]);
                // dd($event);
        return back();
    }

    public function reject(BookingRequest $bookingRequest)
    {
        $bookingRequest->update([
            'status' => 'denied'
        ]);

        return back();
    }

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
