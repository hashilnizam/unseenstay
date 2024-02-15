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
                            <a class="btn btn-primary" href="{{ route('banner_index') }}">Current Banner</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="row cen_al">
            <div class="col-md-8 offset-md-2 shadow-border">
                <form method="POST" action="{{ route('banner_store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Heading:</label>
                        <input type="text" name="heading" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Sub Heading:</label>
                        <input type="text" name="sub_heading" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image :</label>
                        <input type="file" class="form-control-file" name="image" accept="image/jpeg, image/png, image/jpg, image/gif" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>

@endsection
