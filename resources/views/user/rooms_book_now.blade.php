@extends('user.common.app')

@section('content')

    <body>
    <div id="booking" class="section">
        <div class="section-center">
            <div class="container">
                <div class="row">
                    <div class="booking-form">
                        <div class="booking-bg">
                            <div class="form-header">
                                <h2>Make your reservation</h2>
                                <p>Book your spot now!</p>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('check-availability', ['id' => $room->id, 'user_id' => $user->id]) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="form-label">Check In</span>
                                        <input class="form-control" type="date" name="check_in" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="form-label">Check Out</span>
                                        <input class="form-control" type="date" name="check_out" required>
                                    </div>
                                </div>
                                @if($errors->has('check_out'))
                                    <span class="text-danger">{{$errors->first('check_out')}}</span>
                                @endif
                            </div>
                            <input type="hidden" name="order_id">
                            <input type="hidden" name="room_id" value="{{$room->id}}">
                            <input type="hidden" name="user_id" value="{{ auth()->check() ? auth()->user()->id : '' }}">

                            <div class="form-btn">
                                <!-- Add a loading spinner div -->
                                <div id="loadingSpinner" style="display: none;">Checking availability...</div>

                                <button type="submit" class="submit-btn" id="checkAvailability">Check Availability</button>
                                <button type="button" class="submit-btn" id="proceedReservation" style="display: none;">Proceed</button>


                                <img id="loadingSpinner" src="/path/to/loading-spinner.gif" alt="Loading..." style="display: none;">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#checkAvailability').click(function () {
                // Show loading spinner
                $('#loadingSpinner').show();

                var checkInDateTime = new Date($('input[name="check_in"]').val());
                var checkOutDateTime = new Date($('input[name="check_out"]').val());

                if (checkInDateTime >= new Date() && checkOutDateTime > checkInDateTime) {
                    // Show the "Proceed" button and hide the "Check Availability" button
                    $('#proceedReservation').show();
                    $('#checkAvailability').hide();

                    // Hide loading spinner
                    $('#loadingSpinner').hide();

                    // You can add additional logic here, such as disabling form fields, etc.

                    // Proceed with the reservation
                    submitReservation();
                } else {
                    // Hide loading spinner
                    $('#loadingSpinner').hide();

                    alert('Invalid date and time selection. Please choose a future date and time.');
                }
            });

            function submitReservation() {
                // Perform the AJAX request to submit the reservation
                $.ajax({
                    url: '/check-availability',
                    type: 'POST',
                    data: {
                        check_in: $('input[name="check_in"]').val(),
                        check_out: $('input[name="check_out"]').val(),
                        room_id: $('input[name="room_id"]').val(),
                        _token: $('input[name="_token"]').val()
                    },
                    success: function (response) {
                        // Handle the success response
                        if (response.message === 'User can book') {
                            $('#proceedReservation').show();
                            $('#checkAvailability').hide();
                        } else {
                            // Handle other scenarios if needed
                            alert(response.message);
                            $('#proceedReservation').hide();
                            $('#checkAvailability').show();
                        }
                    },
                    error: function () {
                        // Handle the error response
                        alert('An error occurred while checking availability. Please try again.');
                    }
                });
            }
        });

    </script>

@endsection
