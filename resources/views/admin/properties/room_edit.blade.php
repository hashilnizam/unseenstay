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
                <h2>Edit Room Details</h2>
                <form method="POST" action="{{ route('room_edit_store', ['room_id' => $rooms -> id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')


                    <div class="form-group">
                        <label class="form-label">Room Category:</label>
                        <input type="text" name="description" class="form-control"
                               value="{{ old('description', $rooms -> description) }}"
                               required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>


                    <div class="form-group">
                        <label class="form-label">Person:</label>
                        <input type="text" name="person" class="form-control"
                               value="{{ old('person', $rooms -> person) }}"
                               required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">View:</label>
                        <input type="text" name="view" class="form-control"
                               value="{{ old('view', $rooms -> view) }}"
                               required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Room Type</label>
                        <select class="form-select" id="room_type" name="room_type">
                            @foreach($RoomTypes as $RoomType)
                                <option
                                    value="{{ $RoomType->id }}" {{ old('room_type') == $RoomType->id ? 'selected' : '' }}>
                                    {{ $RoomType->room_type  }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image 1:</label>
                        <input type="file" class="form-control-file" name="image1"
                               accept="image/jpeg, image/png, image/jpg, image/gif" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please select an image.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image 2:</label>
                        <input type="file" class="form-control-file" name="image2"
                               accept="image/jpeg, image/png, image/jpg, image/gif" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please select an image.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image 3:</label>
                        <input type="file" class="form-control-file" name="image3"
                               accept="image/jpeg, image/png, image/jpg, image/gif" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please select an image.</div>
                    </div>

                    <div class="form-group">
                        <label for="price" class="form-label">Price:</label>
                        <input type="text" id="price" name="price" class="form-control"
                               value="{{ old('price', $rooms -> price) }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
