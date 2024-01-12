@extends('admin.dashboard.common.app')

@section('content')
    <style>
        .cen_al {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .shadow-border {
            border: 1px solid #ccc;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
        }
    </style>

    <div class="container mt-5">
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

        <nav class="navbar navbar-expand-sm navbar-dark">
            <div class="container-fluid">
                <a href="/">
                    <img src="{{ asset('user/images/icon.png') }}" alt="Icon" class="icon" width="80px">
                </a>
                <div class="collapse navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="btn btn-primary" href="{{ route('properties_list') }}">Properties List</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Add Resort Form -->
        <div class="row cen_al">
            <div class="col-md-8 offset-md-2 shadow-border">
                <form method="POST" action="{{ route('property_store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Property Details -->
                    <div class="form-group">
                        <label class="form-label">Name:</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Property Type</label>
                        <select name="property_type" id="property_type" class="form-select">
                            @foreach($PropertyTypes as $PropertyType)
                                <option value="{{ $PropertyType->id }}" {{ old('property_type') == $PropertyType->id ? 'selected' : '' }}>
                                    {{ $PropertyType->property_type  }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Logo:</label>
                        <input type="file" class="form-control-file" name="logo" accept="image/jpeg, image/png, image/jpg, image/gif" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image:</label>
                        <input type="file" class="form-control-file" name="image" accept="image/jpeg, image/png, image/jpg, image/gif" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Location:</label>
                        <input type="text" name="location" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Mobile:</label>
                        <input type="text" name="mobile" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Address:</label>
                        <textarea class="form-control" name="address" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Next</button>
                </form>

            </div>
        </div>
    </div>
@endsection
