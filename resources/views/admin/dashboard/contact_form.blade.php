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
                            <a class="btn btn-primary" href="{{ route('contact_index') }}">Contact List</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="row cen_al">
            <div class="col-md-8 offset-md-2 shadow-border">
                <h2>Add Contact Details</h2>
                <form method="POST" action="{{ route('contact_store') }}" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                        <label class="form-label">Address:</label>
                        <input type="text" name="address" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Mobile 1:</label>
                        <input type="text" name="mobile_1" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Mobile 2:</label>
                        <input type="text" name="mobile_2" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Website:</label>
                        <input type="text" name="website" class="form-control">
                    </div>


                    <div class="form-group">
                        <label class="form-label">Description:</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
