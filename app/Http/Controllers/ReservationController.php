<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
        public function checkAvailability(Request $request)
        {
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
                        $query->where('check_in', '<=', $request->input('check_out'))
                            ->where('check_out', '>=', $request->input('check_in'));
                    })
                    ->get();

                // If there are existing bookings, inform the user
                if ($existingBookings->isNotEmpty()) {
                    return response()->json(['message' => 'Booking not allowed for this date range'], 400);

                }else{
                    return response()->json(['message' => 'User can book']);

                }
            }
        }

}
