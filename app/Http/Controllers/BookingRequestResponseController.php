<?php

namespace App\Http\Controllers;

use App\Events\RequestResponse;
use Carbon\Carbon;
use App\Models\Availability;
use Illuminate\Http\Request;
use App\Models\BookingRequest;
use App\Models\BookingRequestDay;

class BookingRequestResponseController extends Controller
{
    public function accept(Request $request, BookingRequest $bookingRequest)
    {

        $startDate = Carbon::parse($bookingRequest->start_date);
        $endDate = Carbon::parse($bookingRequest->end_date);
        $days = $bookingRequest->days;
        $startTime = $bookingRequest->start_time;
        $endTime = $bookingRequest->end_time;

        $dates = [];

        while ($startDate->lte($endDate)) {
            if (in_array($startDate->englishDayOfWeek, $days)) {
                $dates[] = $startDate->toDateString();
            }
            $startDate->addDay();
        }

        foreach ($dates as $date) {
            $conflict = BookingRequestDay::where('space_id', request('space_id'))
                ->where('booking_date', $date)
                ->where('status', 'accepted')
                ->where('start_time', '<=', $endTime)
                ->where('end_time', '>=', $startTime)
                ->exists();

            if ($conflict == true) {
                $bookingRequest->update([
                    'status' => 'denied'
                ]);

                $bookingRequestDays =  $bookingRequest->requests;
                foreach ($bookingRequestDays as $bookingRequestDay) {
                    $bookingRequestDay->update([
                        'status' => 'denied'
                    ]);
                }

                return back()->with('error', 'Space is already booked at this time');
            } else {
                $bookingRequest->update([
                    'status' => 'accepted'
                ]);

                $bookingRequestDays =  $bookingRequest->requests;

                foreach ($bookingRequestDays as $bookingRequestDay) {
                    $bookingRequestDay->update([
                        'status' => 'accepted'
                    ]);
                }

                event(new RequestResponse($bookingRequest));

                return back()->with('success', 'Book Accepted');
            }
        }
    }


    public function reject(Request $request, BookingRequest $bookingRequest)
    {
        $bookingRequest->update([
            'status' => 'denied',
            'message' => $request->input('message'),
        ]);

        $books = BookingRequestDay::where('booking_request_id', $bookingRequest->id)->get();

        foreach ($books as $book) {
            $book->update([
                'status' => 'denied'
            ]);
        }
        event(new RequestResponse($bookingRequest));


        return back()->with('success', 'Booking Denied');
    }
}
