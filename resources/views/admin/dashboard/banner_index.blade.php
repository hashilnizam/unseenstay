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
            <div class="col-md-8 offset-md-2 shadow-border">
                <div class="table-responsive">
                    <table id="roomDataTable" class="display">
                        <thead>
                        <tr>
                            <th>Heading</th>
                            <th>Sub Heading</th>
                            <th>Image 1</th>
                            <th>Image 2</th>
                            <th>Image 3</th>
                            <th>Image 4</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($banners as $banner)
                            <tr>
                                <td>{{ $banner->heading }}</td>
                                <td>{{ $banner->sub_heading }}</td>
                                <td>
                                    @if($banner->image_1)
                                        <img src="{{ asset('images/'. $banner->image_1) }}" alt="property" class="img-thumbnail" width="80" height="50"/>
                                    @else
                                        No Image
                                    @endif
                                </td>

                                <td>
                                    @if($banner->image_2)
                                        <img src="{{ asset('images/'. $banner->image_2) }}" alt="property" class="img-thumbnail" width="80" height="50"/>
                                    @else
                                        No Image
                                    @endif
                                </td>

                                <td>
                                    @if($banner->image_3)
                                        <img src="{{ asset('images/'. $banner->image_3) }}" alt="property" class="img-thumbnail" width="80" height="50"/>
                                    @else
                                        No Image
                                    @endif
                                </td>

                                <td>
                                    @if($banner->image_4)
                                        <img src="{{ asset('images/'. $banner->image_4) }}" alt="property" class="img-thumbnail" width="80" height="50"/>
                                    @else
                                        No Image
                                    @endif
                                </td>

                                <td>
                                    <form method="POST" action="{{ url('admin/banner_delete{id}' . $banner->id) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this banner?')">
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
