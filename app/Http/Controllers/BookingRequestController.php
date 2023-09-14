<?php

namespace App\Http\Controllers;

use App\Rules\ValidSpace;
use App\Models\Availability;
use Illuminate\Http\Request;
use App\Models\BookingRequest;
use App\Rules\CheckRequestConflicts;
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

        // Add custom validation rule
        $validatedData['user_id'] = Auth::id();
        // $request->validate([
        //     'space_id' => [
        //         'required',
        //         'exists:spaces,id',
        //         new ValidSpace($validatedData),
        //         new CheckRequestConflicts($validatedData)
        //     ],
        // ]);
        // $validatedData = $request->validated();

        // $validatedData['user_id'] = Auth::user()->id;

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
