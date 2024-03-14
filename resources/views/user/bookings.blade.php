@extends('user.common.app')

@section('content')

    <div class="hero-wrap" style="background-image: url('user/images/bg_1.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
                <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                    <div class="text">
                        <h1 class="mb-4 bread">My Bookings</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="overlay-container">
        <div class="container py-5 mt-3">
            @foreach($my_bookings as $booking)
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img src="{{ asset('images/' . $booking->room->image) }}" alt="avatar"
                                     class="rounded-square img-fluid"
                                     style="width: 190px; height: 150px; object-fit: cover;">
                                <h5 class="my-3">{{ $booking->room->property->name }}</h5>
                                <p class="text-muted mb-1"><span></span>{{ $booking->room->description }}</p>
                                <p class="text-muted mb-1"><span></span>{{ $booking->room->property->location }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Booking id :</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $booking->order_id }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Check In :</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $booking->check_in }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Check Out :</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $booking->check_out }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Price :</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $booking->room->price }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Status :</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"></p>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
