<?php

namespace App\Http\Controllers;

use App\Events\CreateSpace;
use App\Events\RequestCreated;
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
use App\Models\BookingRequestDay;
use App\Models\Day;
use App\Models\Space;
use Illuminate\Validation\ValidationException;
use App\Rules\AcceptRequest as RulesAcceptRequest;
use Exception;
use Illuminate\Support\Facades\DB;

class BookingRequestController extends Controller
{

    public function index()
    {
        $requests = BookingRequest::where('user_id', '=', Auth::id())->simplePaginate(3);
        
        $days = Day::all();

        // dd($requests);
        return view('member.request.index', [
            'requests' => $requests,
            'days' => $days,

            'bookingRequest' => new BookingRequest(),

        ]);
    }

    public function store(CustomBookingRequest $request)
    {
        $this->authorize('create' , [BookingRequest::class]);
        try {
            DB::beginTransaction();
            $validatedData = $request->validated();


            $validatedData['space_id'] = $request->input('space_id');
            $validatedData['user_id'] = Auth::id();

            $validatedData['days'] = $request->input('days');

            $bookingRequest = BookingRequest::create($validatedData);

            $spaceId = $request->input('space_id');
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            $dateRange = \Carbon\CarbonPeriod::create($startDate, $endDate);
            $daysToBook = request('days');

            foreach ($dateRange as $date) {
                if (in_array($date->format('l'), $daysToBook)) {
                    BookingRequestDay::create([
                        'booking_request_id' => $bookingRequest->id,
                        'space_id' => $spaceId,
                        'user_id' => Auth::id(),
                        'booking_date' => $date,
                        'status' => 'pending',
                        'start_time' => $bookingRequest->start_time,
                        'end_time' => $bookingRequest->end_time,
                    ]);
                }
            }
            DB::commit();
             event(new RequestCreated($bookingRequest));
            return back()->with('success', __('Request Created Successfully!'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function show(BookingRequest $bookRequest)
    {
    }


}
