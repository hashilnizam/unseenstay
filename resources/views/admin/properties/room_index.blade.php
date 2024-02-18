@extends('admin.dashboard.common.app')

@section('content')
    <style>
        /* Your existing styles here */

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px; /* Add margin to separate table from form */
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>

    <div class="container mt-5">
        <div class="row cen_al">
            <h1 class="m-0 font-weight-bold text-primary" style="text-align: center">Room List</h1>
            <div class="text-right">
            <a href="{{ route('room_Add') }}" class="btn btn-primary">Add Room</a>
            </div>
            <div class="col-md-8 offset-md-2 shadow-border">
                <div class="table-responsive">
                    <table id="roomDataTable" class="display">
                        <thead>
                        <tr>
                            <th>Property</th>
                            <th>Room Type</th>
                            <th>Image 1</th>
                            <th>Image 2</th>
                            <th>Image 3</th>
                            <th>Image 4</th>
                            <th>Image 5</th>
                            <th>Image 6</th>
                            <th>Image 7</th>
                            <th>Image 8</th>
                            <th>Price</th>
                            <th>Room Category</th>
                            <th>Person</th>
                            <th>View</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rooms as $room)
                            <tr>
                                <td>{{ $room->property->name }}</td>
                                <td>{{ $room->room_types->room_type }}</td>
                                <td>
                                    @if($room->image1)
                                        <img src="{{ asset('images/'. $room->image1) }}" alt="property" class="img-thumbnail" width="80" height="50"/>
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    @if($room->image2)
                                        <img src="{{ asset('images/'. $room->image2) }}" alt="property" class="img-thumbnail" width="80" height="50"/>
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    @if($room->image3)
                                        <img src="{{ asset('images/'. $room->image3) }}" alt="property" class="img-thumbnail" width="80" height="50"/>
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    @if($room->image4)
                                        <img src="{{ asset('images/'. $room->image4) }}" alt="property" class="img-thumbnail" width="80" height="50"/>
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    @if($room->image5)
                                        <img src="{{ asset('images/'. $room->image5) }}" alt="property" class="img-thumbnail" width="80" height="50"/>
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    @if($room->image6)
                                        <img src="{{ asset('images/'. $room->image6) }}" alt="property" class="img-thumbnail" width="80" height="50"/>
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    @if($room->image7)
                                        <img src="{{ asset('images/'. $room->image7) }}" alt="property" class="img-thumbnail" width="80" height="50"/>
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    @if($room->image8)
                                        <img src="{{ asset('images/'. $room->image8) }}" alt="property" class="img-thumbnail" width="80" height="50"/>
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $room->price }}</td>
                                <td>{{ $room->description }}</td>
                                <td>{{ $room->person }}</td>
                                <td>{{ $room->view }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/room/' . $room->id) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this room?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>

    <script>
        jQuery(document).ready(function ($) {
            $('#roomDataTable').DataTable({
                dom: 'Bfrtip', // Add 'B' to enable buttons
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'pdfHtml5'
                ]
            });
        });
    </script>
@endsection
