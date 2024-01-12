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
                    <a href="{{ route('property_add') }}" class="btn btn-primary">Add</a>
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
