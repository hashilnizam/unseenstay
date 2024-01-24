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
                                        <input class="form-control" type="date" name="check_out"  id="check_out" required>
                                        @if($errors->has('check_out'))
                                            <span class="text-danger">{{$errors->first('check_out')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="order_id">
                            <input type="hidden" name="room_id" value="{{$room->id}}">
                            <input type="hidden" name="user_id" value="{{ auth()->check() ? auth()->user()->id : '' }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-btn">
                                <button type="button" class="submit-btn proceed-btn" id="proceedReservation" style="display: none;">Proceed</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#check_out").change(function () {
                var checkInDateTime = new Date($('input[name="check_in"]').val());
                var checkOutDateTime = new Date($('input[name="check_out"]').val());

                if (checkInDateTime >= new Date() && checkOutDateTime > checkInDateTime) {
                    $('#proceedReservation').show();
                    submitReservation();
                } else {
                    alert('Invalid date and time selection. Please choose a future date and time.');
                    $('#proceedReservation').hide();
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
                        alert('An error occurred while checking availability. Please try again.');
                    }
                });
            }
        });

        $("#proceedReservation").click(function () {
            var checkInDate = $('input[name="check_in"]').val();
            var checkOutDate = $('input[name="check_out"]').val();
            var roomId = $('input[name="room_id"]').val();
            var userId = $('input[name="user_id"]').val();

            saveDataToDataTable(checkInDate, checkOutDate, roomId, userId);

 // Retrieving values from input fields with IDs "check_in" and "check_Out"

        });


        function saveDataToDataTable(checkInDate, checkOutDate, roomId, userId) {
            $.ajax({
                url: '/bookings_store',
                method: 'POST',
                dataType: 'json',
                data: {
                    check_in: checkInDate,
                    check_out: checkOutDate,
                    room_id: roomId,
                    user_id: userId,
                    _token: '{{ csrf_token() }}'
                },

                success: function(response) {
                    console.log('Data saved successfully:', response);
                },
                error: function(error) {
                    console.error('Error saving data:', error);
                    console.log('Full error response:', error.responseText);

                    alert('Error saving data. Please try again.');
                }

            });

        }
    </script>

@endsection
