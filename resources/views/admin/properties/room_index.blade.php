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
        <!-- Your existing content here -->

        <!-- Table to display form data -->
        <div class="row cen_al">
            <div class="col-md-8 offset-md-2 shadow-border">
                <table id="roomDataTable"> <!-- Add an id to your table -->
                    <thead>
                    <tr>
                        <th>Property</th>
                        <th>Room Type</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Add a loop here to display multiple rows if needed -->
                    @foreach($rooms as $room)
                        <tr>
                            <td>{{ $room->property->name }}</td>
                            <td>{{ $room->room_types->room_type }}</td>
                            <td>
                                @if($room->image)
                                    <img src="{{ asset('images/'. $room->image) }}" alt="property" class="img-thumbnail" width="80" height="50"/>
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $room->price }}</td>
                            <td>{{ $room->description }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready( function () {
            $('#roomDataTable').DataTable();
        });
    </script>
@endsection
