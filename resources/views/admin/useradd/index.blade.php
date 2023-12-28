@extends('admin.useradd.common.app')

@section('content')
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Sign Up</h2>
                    <form method="post" action="{{ route('add_User') }}">
                        @csrf
                        <div class="row row-space">
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
                        </div>
                        <div class="row row-space">
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
                                <label for="subject">User</label>
                                <select class="form-control" id="user_type" name="user_type">
                                    <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>admin</option>
                                    <option value="accountant" {{ old('user_type') == 'accountant' ? 'selected' : '' }}>accountant</option>
                                    <option value="user" {{ old('user_type') == 'user' ? 'selected' : '' }}>user</option>
                                </select>
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
