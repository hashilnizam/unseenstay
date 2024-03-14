@extends('admin.dashboard.common.app')
@section('content')

    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="text-center mb-2">
                    {{--                    <a href="#" class="btn btn-primary">Add Orders</a>--}}
                </div>
                <div>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session(('success'))}}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <h1>Bookings</h1>
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Booking Id</th>
                            <th>Property Name</th>
                            <th>Room Category</th>
                            <th>Room Image</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                            <!-- Add more table headers if needed -->
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($userBookings as $userBooking)
                            <tr>
                                <td>{{ $userBooking->userOrder->username }}</td>
                                <td>{{ $userBooking->order_id }}</td>
                                <td>{{ $userBooking->room->property->name }}</td>
                                <td>{{ $userBooking->room->description }}</td>
                                <td>
                                    @if($userBooking->room->image)
                                        <img src="{{ asset('images/'. $userBooking->room->image) }}" alt="property"
                                             class="img-thumbnail" width="80" height="50"/>
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $userBooking->check_in }}</td>
                                <td>{{ $userBooking->check_out }}</td>
                                <td>{{ $userBooking->room->price }}</td>
                                <td>{{ $userBooking->room->status }}</td>
                                <!-- Add more table cells for other user details if needed -->
                                <td>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
@endsection
