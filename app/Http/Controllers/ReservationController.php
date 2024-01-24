<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
        public function checkAvailability(Request $request)
        {
                $min = 1000000;
                $max = 9999999;

                $order_id = random_int($min, $max);

                $validatedData = $request->validate([
                    'check_in' => 'required|date',
                    'check_out' => 'required|date|after:check_in',
                ]);
                $existingBookings = Booking::where('room_id', $request->input('room_id'))
                    ->where(function ($query) use ($request) {
                        $query->where('check_in', '<', $request->input('check_out'))
                            ->where('check_out', '>', $request->input('check_in'));
                    })
                    ->get();

                // If there are existing bookings, inform the user
                if ($existingBookings->isNotEmpty()) {
                    $return['message']="Booking not allowed for this date range";
                    $return['status']='false';
                }else {
                    $return['message'] = "can be booked";
                    $return['status'] = 'true';
                }
                return response()->json($return);

        }

    public function bookings_store(Request $request)
    {

        $min = 1000000;
        $max = 9999999;

        $order_id = random_int($min, $max);

        $validatedData = $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date',
        ]);


        $bookings = new Booking();

        $bookings->check_in = $validatedData['check_in'];
        $bookings->room_id = $request->room_id;
        $bookings->user_id = $request->user_id;
        $bookings->order_id = $order_id;
        $bookings->check_out = $validatedData['check_out'];
        $bookings->status = 1;
        $bookings->save();

        // Debug statements
        error_log('Booking saved successfully: ' . json_encode($bookings));

        return response()->json(['success' => true]);
    }



}
