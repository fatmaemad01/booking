<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomBookingRequest;
use App\Models\BookingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return redirect()->route('member.dashboard')->with('success' , __('Request Created Successfully!'));
    }


    public function accept(BookingRequest $bookingRequest)
    {
        $bookingRequest->update([
            'status' => 'accepted'
        ]);
    }

    public function reject(BookingRequest $bookingRequest)
    {
        $bookingRequest->update([
            'status' => 'denied'
        ]);
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
