

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
                <h2>Add Property Details</h2>
                <form method="POST" action="{{ route('property_store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Property Details -->
                    <div class="form-group">
                        <label class="form-label">Name:</label>
                        <input type="text" name="name" class="form-control" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
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
                        <label class="form-label">Image 1:</label>
                        <input type="file" class="form-control-file" name="image1" accept="image/jpeg, image/png, image/jpg, image/gif" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please select an image.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image 2:</label>
                        <input type="file" class="form-control-file" name="image2" accept="image/jpeg, image/png, image/jpg, image/gif" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please select an image.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image 3:</label>
                        <input type="file" class="form-control-file" name="image3" accept="image/jpeg, image/png, image/jpg, image/gif" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please select an image.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image 4:</label>
                        <input type="file" class="form-control-file" name="image4" accept="image/jpeg, image/png, image/jpg, image/gif" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please select an image.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image 5:</label>
                        <input type="file" class="form-control-file" name="image5" accept="image/jpeg, image/png, image/jpg, image/gif" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please select an image.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image 6:</label>
                        <input type="file" class="form-control-file" name="image6" accept="image/jpeg, image/png, image/jpg, image/gif" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please select an image.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image 7:</label>
                        <input type="file" class="form-control-file" name="image7" accept="image/jpeg, image/png, image/jpg, image/gif" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please select an image.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image 8:</label>
                        <input type="file" class="form-control-file" name="image8" accept="image/jpeg, image/png, image/jpg, image/gif" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please select an image.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image 9:</label>
                        <input type="file" class="form-control-file" name="image9" accept="image/jpeg, image/png, image/jpg, image/gif" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please select an image.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image 10:</label>
                        <input type="file" class="form-control-file" name="image10" accept="image/jpeg, image/png, image/jpg, image/gif" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please select an image.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description:</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Location:</label>
                        <input type="text" name="location" class="form-control" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Mobile:</label>
                        <input type="text" name="mobile" class="form-control" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Address:</label>
                        <textarea class="form-control" name="address" rows="3" required></textarea>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <button type="submit" class="btn btn-primary">Next</button>
                </form>

            </div>
        </div>
    </div>
@endsection
