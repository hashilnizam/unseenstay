@extends('admin.dashboard.common.app')

@section('content')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .page-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .wrapper {
            width: 100%;
            max-width: 680px;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 30px;
        }

        .title {
            text-align: center;
            color: #333;
        }

        .row {
            display: flex;
            margin-bottom: 20px;
        }

        .col-2 {
            flex: 1;
            margin-right: 20px;
        }

        .input-group {
            width: 100%;
        }

        .label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        .input--style-4 {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            color: #555;
        }

        .form-group {
            margin-bottom: 20px;
        }

        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            color: #555;
        }

        .btn--radius-2 {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #1b5dd1;
            border-radius: 5px;
            transition: background 0.3s ease-in-out;
            cursor: pointer;
        }

        .btn--blue:hover {
            background-color: #154aa3;
        }
    </style>

    <div class="page-wrapper">
        <div class="wrapper">
            <div class="card">
                <div class="card-body">
                    <h2 class="title">Sign Up</h2>
                    <form method="post" action="{{ route('add_User') }}">
                        @csrf
                        <div class="row">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Username</label>
                                    <input class="input--style-4" type="text" name="username" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-4" type="email" name="email" required>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Mobile Number</label>
                                    <input class="input--style-4" type="text" name="mobile" required>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Password</label>
                                    <input class="input--style-4" type="password" name="password" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Confirm Password</label>
                                    <input class="input--style-4" type="password" name="cpassword" required>
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="label">User Type</label>
                            <div class="form-group">
                                <select class="form-control" id="user_type" name="user_type">
                                    <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="accountant" {{ old('user_type') == 'accountant' ? 'selected' : '' }}>Accountant</option>
                                    <option value="user" {{ old('user_type') == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                        </div>
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
