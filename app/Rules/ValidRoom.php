<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\BookingRequest;
use App\Models\BookingRequestDay;

// class ValidRoom implements Rule
// {

//     public function passes($attribute, $value)
//     {
//         $value = request()->all();
//         $spaceId = request('space_id');

//         $acceptedRequests = BookingRequestDay::where('space_id', $spaceId)
//             ->where('status', 'accepted')
//             ->get();

//         foreach ($acceptedRequests as $request) {
//             $conflicts = $request->where('space_id', $value['space_id'])
//                 ->where('status', 'accepted')
//                 ->where(function ($query) use ($value) {
//                     $query->where(function ($query) use ($value) {
//                         $query
//                             ->where('start_date', '<=', $value['end_date'])
//                             ->where('end_date', '>=', $value['start_date'])
//                             ->where('start_time', '<=', $value['end_time'])
//                             ->where('end_time', '>=', $value['start_time']);
//                     });
//                 })->first();

//                 if ($conflicts) {
//                 return false;   // Found conflicts
//             }
//         }

//         return true; // No conflicts
//     }

//     public function message()
//     {
//         return 'The selected space is not available for the specified dates.';
//     }

//     private function isSpaceAvailable($spaceId, $startDate, $endDate)
//     {
//         // Implement your logic to check space availability here
//         // You can query your database for existing bookings and check for overlaps
//         $existingBookings = BookingRequestDay::where('space_id', $spaceId)
//         // ->where('date')
//             ->where(function ($query) use ($startDate, $endDate) {
//                 $query->whereBetween('booking_date', [$startDate, $endDate])
//                     ->orWhere(function ($query) use ($startDate, $endDate) {
//                         $query->where('booking_date', '<', $startDate)
//                             ->where('booking_date', '>', $endDate);
//                     });
//             })
//             ->exists();
//         return $existingBookings ;
//     }
// }
