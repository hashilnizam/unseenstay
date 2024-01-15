@extends('user.common.app')

@section('content')

    <body>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div id="booking" class="section">
        <div class="section-center">
            <div class="container">
                <div class="row">
                    <div class="booking-form">
                        <div class="booking-bg">
                            <div class="form-header">
                                <h2>Make your reservation</h2>
                                <p>Lorem ipsum dolor sit amet</p>
                            </div>
                        </div>


                        <form method="POST" action="{{ route('reservation', ['id' => $room->id, 'user_id' => $user->id]) }}">

                        @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="form-label">Check In</span>
                                        <input class="form-control" type="date"  name="check_in" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="form-label">Check Out</span>
                                        <input class="form-control" type="date"  name="check_out" required>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="order_id">
                            <input type="hidden" name="room_id" value="{{$room->id}}">
                            <input type="hidden" name="user_id" value="{{ auth()->check() ? auth()->user()->id : '' }}">

                            <div class="form-btn">
                                <button type="submit" class="submit-btn">Proceed</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>

@endsection
