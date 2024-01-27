<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class ReservationController extends Controller
{
    public function createRazorpayOrder($amount)
    {
        $apiKey = config('services.registration.rzp.key');
        $apiSecret = config('services.registration.rzp.secret');
        $api = new Api($apiKey, $apiSecret);

        $order = $api->order->create([
            'amount' => $amount,
            'currency' => 'INR',
            'payment_capture' => 1,
        ]);


        return $order->id;
    }

    public function checkAvailability(Request $request)
    {

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
            $return['message'] = "Booking not allowed for this date range";
            $return['status'] = 'false';
        } else {
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
            'price' => 'required',

        ]);


        $bookings = new Booking();

        $bookings->check_in = $validatedData['check_in'];
        $bookings->room_id = $request->room_id;
        $bookings->user_id = $request->user_id;
        $bookings->order_id = $order_id;
        $bookings->check_out = $validatedData['check_out'];
        $bookings->price = $validatedData['price'];
        $bookings->status = 1;

        $bookings->save();

        $amount = $bookings->price * 100;
        $razorpayOrderId = $this->createRazorpayOrder($amount);

        $bookingId = $bookings->order_id;

        $payment = new Payment();
        $payment->razorpay_order_id = $razorpayOrderId;
        $payment->order_id = $bookingId;
        $payment->status = 1;

        $payment->save();


        return response()->json(['message' => 'Room Booked Successfully',
            'razorpayOrderId' => $razorpayOrderId,'bookingId'=> $bookingId]);

    }

    public function handlePayment(Request $request)
    {
        $payment = Payment::updateOrCreate(
            ['razorpay_order_id' => $request->razorpay_order_id],
            [
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'status' => $request->status,
            ]
        );

        return response()->json(['message' => 'Payment details saved successfully']);


    }


}
