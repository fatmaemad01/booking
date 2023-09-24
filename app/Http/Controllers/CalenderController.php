<?php

namespace App\Http\Controllers;

use App\Models\BookingRequest;
use App\Models\BookingRequestDay;
use Illuminate\Http\Request;

class CalenderController extends Controller
{
    public function index()
    {
        $events = [];
 
        $appointments = BookingRequestDay::where('status' , 'accepted')->get();

        foreach ($appointments as $appointment) {
            $startDateTime = $appointment->booking_date . 'T' . $appointment->start_time; // Combine date and time
            $endDateTime = $appointment->booking_date . 'T' . $appointment->end_time; // Combine date and time
            $space_name = $appointment->request->space->name;
            $branch_start_time = $appointment->request->space->branch->start_time;
            $branch_end_time = $appointment->request->space->branch->end_time;
        
            $events[] = [
                'title' => $space_name,
                'start' => $startDateTime,
                'end' => $endDateTime,
                'branch_start' => $branch_start_time,
                'branch_end' => $branch_end_time,
            ];
        }

        return view('calender', compact('events'));
    }
}
