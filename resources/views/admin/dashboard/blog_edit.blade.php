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
                            <a class="btn btn-primary" href="{{ route('blog_form_index') }}">Blog List</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Add Resort Form -->
        <div class="row cen_al">
            <div class="col-md-8 offset-md-2 shadow-border">
                <h2>Edit Blog Details</h2>
                <form method="POST" action="{{ route('blog_edit_store', ['blog_id' => $blog -> id]) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">Heading:</label>
                        <input type="text" name="heading" class="form-control"
                               value="{{ old('heading', $blog -> heading) }}"
                               required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>


                    <div class="form-group">
                        <label class="form-label">Description:</label>
                        <input type="text" name="description" class="form-control"
                               value="{{ old('description', $blog -> description) }}"
                               required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image:</label>
                        <input type="file" class="form-control-file" name="image"
                               accept="image/jpeg, image/png, image/jpg, image/gif">
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please select an image.</div>
                        <td>
                            @if($blog->image)
                                <img src="{{ asset('images/'. $blog->image) }}" alt="property"
                                     class="img-thumbnail" width="80" height="50"/>
                            @else
                                No Image
                            @endif
                        </td>
                        <hr>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
