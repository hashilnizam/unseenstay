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

    <nav class="navbar navbar-expand-sm navbar-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{ route('blog_form') }}">Add Blogs</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row cen_al">
            <div class="col-md-8 offset-md-2 shadow-border">
                <div class="table-responsive">
                    <table id="roomDataTable" class="display">
                        <thead>
                        <tr>
                            <th>Heading</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($blogs as $blog)
                            <tr>
                                <td>{{ $blog->heading }}</td>
                                <td>{{ $blog->description }}</td>
                                <td>
                                    @if($blog->image)
                                        <img src="{{ asset('images/'. $blog->image) }}" alt="property" class="img-thumbnail" width="80" height="50"/>
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{ url('/blog/' . $blog->id) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this blog?')">
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
