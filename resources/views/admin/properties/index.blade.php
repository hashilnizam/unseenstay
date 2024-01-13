@extends('admin.dashboard.common.app')

@section('content')
    <div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1 class="m-0 font-weight-bold text-primary" style="text-align: center">Property List</h1>
                <div class="text-right mb-2">
                    <a href="{{ route('property_add') }}" class="btn btn-primary">Add Property</a>
                    <button class="btn btn-secondary buttons-copy buttons-html5">Copy</button>
                    <button class="btn btn-secondary buttons-csv buttons-html5">CSV</button>
                    <button class="btn btn-secondary buttons-excel buttons-html5">Excel</button>
                    <button class="btn btn-secondary buttons-pdf buttons-html5">PDF</button>
                    <button class="btn btn-secondary buttons-print">Print</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                        <tr>
                            <th>S/L No.</th>
                            <th>Name</th>
                            <th>Property Type</th>
                            <th>Logo</th>
                            <th>Image</th>
                            <th>Location</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($properties as $property)
                            <tr>
                                <td>{{ $property->id }}</td>
                                <td>{{ $property->name }}</td>
                                <td>{{ $property->property_types->property_type }}</td>
                                <td>
                                    @if($property->logo)
                                        <img src="{{ asset('images/'. $property->logo) }}" alt="logo" class="img-thumbnail" width="80" height="50"/>
                                    @else
                                        No Logo
                                    @endif
                                </td>
                                <td>
                                    @if($property->image)
                                        <img src="{{ asset('images/'. $property->image) }}" alt="property" class="img-thumbnail" width="80" height="50"/>
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $property->location }}</td>
                                <td>{{ $property->email }}</td>
                                <td>{{ $property->mobile }}</td>
                                <td>{{ $property->address }}</td>
                                <td>
                                    <form method="POST" action="{{ url('/property/' . $property->id) }}" class="d-inline">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Extensions JS (Select, Buttons) -->
    <script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endsection
