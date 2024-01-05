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

    <nav class="navbar navbar-expand-sm navbar-dark bg-white">
        <div class="container-fluid">
            <a href="/">
                <img src="{{ asset('user/images/icon.png') }}" alt="Icon" class="icon" width="80px">
            </a>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{ route('properties_update') }}">Properties List</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Add Resort Form -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0" style="text-align: center">Add Resort</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('properties_store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-select" id="category_type" name="category">
                            <option value="resort" {{ old('category') == 'resort' ? 'selected' : '' }}>Resort</option>
                            <option value="homestay" {{ old('category') == 'homestay' ? 'selected' : '' }}>Homestay</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Resort</button>
                </form>
            </div>
        </div>
    </div>

@endsection
