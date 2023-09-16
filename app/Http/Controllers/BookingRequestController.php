<?php

namespace App\Http\Controllers;

use App\Events\CreateSpace;
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

        $validatedData['space_id'] = $request->input('space_id');

        $validatedData['user_id'] = Auth::id();

        $bookingRequest = BookingRequest::create($validatedData);

        Availability::create([
            'space_id' => $bookingRequest->space_id,
            'booking_request_id' => $bookingRequest->id,
            'start_date' => $bookingRequest->start_date,
            'end_date' => $bookingRequest->end_date,
            'start_time' => $bookingRequest->start_time,
            'end_time' => $bookingRequest->end_time,
        ]);

        if ($request->has('days')) {
            $bookingRequest->days()->attach($request->input('days'));
        }

        return back()->with('success', __('Request Created Successfully!'));
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
