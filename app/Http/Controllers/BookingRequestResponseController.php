<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use Illuminate\Http\Request;
use App\Models\BookingRequest;

class BookingRequestResponseController extends Controller
{
    public function accept(Request $request, BookingRequest $bookingRequest)
    {
        $availability =  Availability::where('booking_request_id', $bookingRequest->id)->first();

        $conflictingBooking = BookingRequest::where('space_id', $bookingRequest->space_id)
            ->where('status', 'accepted')
            ->where(function ($query) use ($bookingRequest) {
                $query->whereBetween('start_date', [$bookingRequest->start_date, $bookingRequest->end_date])
                    ->orWhereBetween('end_date', [$bookingRequest->start_date, $bookingRequest->end_date]);
            })->where(function ($query) use ($bookingRequest) {
                $query->whereTime('start_time', '<', $bookingRequest->end_time)
                    ->whereTime('end_time', '>', $bookingRequest->start_time);
            })->first();

        if ($conflictingBooking) {
            // There is a conflict, reject the current booking
            $bookingRequest->update([
                'status' => 'denied',
                'message' => $request->input('message'),
            ]);

            $availability->update([
                'available' => true
            ]);

            return back()->with('error', 'Booking conflicts with an existing accepted booking.');
        }

        // No conflicts, accept the booking
        $bookingRequest->update([
            'status' => 'accepted',
            'message' => $request->input('message'),
        ]);

        $availability->update([
            'available' => false
        ]);

        return back()->with('success', 'Booking accepted.');
    }


    public function reject(Request $request, BookingRequest $bookingRequest)
    {
        $bookingRequest->update([
            'status' => 'denied',
            'message' => $request->input('message'),
        ]);

        $availability =  Availability::where('booking_request_id', $bookingRequest->id)->first();
        $availability->update([
            'available' => true
        ]);
        
        return back()->with('success', 'Booking Denied');
    }
}
