@extends('user.common.app')

@section('content')

    <div id="booking" class="section">
        <div class="section-center">
            <div class="container">
                <div class="row">
                    <div class="booking-form">
                        <div class="booking-bg">
                            <div class="form-header">
                                <h2>Make your reservation</h2>
                                <br>
                            </div>
                        </div>

                        <form>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="form-label">Check In</span>
                                        <input class="form-control" type="date" name="check_in" id="check_in" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="form-label">Check Out</span>
                                        <input class="form-control" type="date" name="check_out" id="check_out"
                                               required>
                                        @if($errors->has('check_out'))
                                            <span class="text-danger">{{$errors->first('check_out')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-12" id="check_error" style="color:#ba4343">
                                    <span></span>
                                </div>

                            </div>

                            <input type="hidden" name="order_id">
                            <input type="hidden" name="room_id" value="{{$room->id}}">
                            <input type="hidden" name="user_id" value="{{ auth()->check() ? auth()->user()->id : '' }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="price" value="{{$room->price}}">


                            <div class="form-btn">
                                <button type="button" class="submit-btn proceed-btn" id="proceedReservation"
                                        style="display: none;">Proceed
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <!-- Your other scripts -->

    <script>
        $(document).ready(function () {
            $("#check_out").change(function () {
                var checkInDateTime = new Date($('input[name="check_in"]').val());
                var checkOutDateTime = new Date($('input[name="check_out"]').val());

                if (checkInDateTime >= new Date() && checkOutDateTime > checkInDateTime) {
                    $('#proceedReservation').show();
                    $('#check_error').hide();
                    submitReservation();
                } else {
                    $('#check_error').text('Invalid date and time selection. Please choose a future date and time.');
                    $('#proceedReservation').hide();

                }


                if (checkInDateTime != null) {
                    $('#check_error').text('Kindly choose the check-in date.');
                    $('#proceedReservation').hide();
                } else {
                    $('#proceedReservation').show();
                    submitReservation();
                }
            });

            function submitReservation() {
                $.ajax({
                    url: '/check-availability',
                    dataType: 'json',
                    type: 'POST',
                    data: {
                        check_in: $('input[name="check_in"]').val(),
                        check_out: $('input[name="check_out"]').val(),
                        room_id: $('input[name="room_id"]').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.status === 'true') {
                            // Set order_id here
                            $('input[name="order_id"]').val(response.order_id);
                            $('#proceedReservation').show();
                        } else {
                            alert(response.message);
                            $('#proceedReservation').hide();
                        }
                    },
                    error: function () {
                        $('#check_error').text('An error occurred while checking availability. Please try again..');

                    }
                });
            }


            $("#proceedReservation").click(function () {
                var checkInDate = $('input[name="check_in"]').val();
                var checkOutDate = $('input[name="check_out"]').val();
                var roomId = $('input[name="room_id"]').val();
                var userId = $('input[name="user_id"]').val();
                var price = $('input[name="price"]').val();

                saveDataToDataTable(checkInDate, checkOutDate, roomId, userId, price);

                // Retrieving values from input fields with IDs "check_in" and "check_Out"

            });


            function saveDataToDataTable(checkInDate, checkOutDate, roomId, userId, price) {
                $.ajax({
                    url: '/bookings_store',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        check_in: checkInDate,
                        check_out: checkOutDate,
                        room_id: roomId,
                        user_id: userId,
                        _token: '{{ csrf_token() }}',
                        price: price,
                    },

                    success: function (response) {


                        console.log('Success Response:', response);
                        $('#successMessage').text(response.message).show().delay(3000).fadeOut();

                        if (response.bookingId && response.razorpayOrderId) {
                            initializeRazorpay(response.razorpayOrderId, response.bookingId);
                        } else {
                            // console.error('Invalid response format. Missing bookingId or razorpayOrderId.');
                        }
                    },
                    error: function (xhr) {
                        // console.error('Error placing order:', xhr);
                        //
                        // alert('Error placing order. Please try again.');
                    }

                });


            }

            function initializeRazorpay(razorpay_order_id, bookingId) {
                var options = {
                    "key": "{{ env('RZR_KEY') }}",
                    "amount": "{{$room->price* 100}}",
                    "order_id": razorpay_order_id,
                    "currency": "INR",
                    "name": "Unseenstay",
                    "description": "Test Transaction",
                    "image": "{{ asset('/user/images/icon.png') }}",
                    "handler": function (response) {
                        // alert("Payment Successful");
                        // alert("all: " + JSON.stringify(response));
                        $.ajax({
                            url: '/handle-payment',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_order_id: response.razorpay_order_id,
                                bookingId: bookingId,
                                status: 2,
                            },

                            success: function (serverResponse) {
                                // console.log('Payment details saved successfully');
                                window.location.href = '/bookings';
                            },
                            error: function (xhr) {
                                // console.error('Error saving payment details:', xhr);
                            }
                        });
                    },
                    "prefill": {
                        "name": "{{$user->username}}",
                        "email": "{{$user->email}}",
                        "mobile": "{{$user->mobile}}"
                    },
                    "notes": {
                        "address": "Razorpay Corporate Office"
                    },
                    "theme": {
                        "color": "#3498db"
                    }
                };

                var rzp1 = new Razorpay(options);

                rzp1.on('payment.failed', function (response) {
                    alert("Payment Failed");
                    alert("Error Code: " + response.error.code);
                    alert("Error Description: " + response.error.description);
                    // Additional error information if needed
                });

                rzp1.open();
            }
        });


    </script>

@endsection
