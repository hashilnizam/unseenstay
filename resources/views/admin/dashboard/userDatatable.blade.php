@extends('admin.dashboard.common.app')

@section('content')


    <div class="text-left mb-2">
        <a href="{{ route('table_user_add') }}" class="btn btn-primary">Add User</a>
    </div>

    <!-- Table -->
    <table id="myDataTable" class="display" style="width:100%">
        <thead>
        <tr>
            <th>User Name</th>
            <th>Email</th>
            <th>User Type</th>
            <th>Action</th>
            <!-- Add more table headers if needed -->
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->user_type}}</td>
                <td>
                <form  method="POST" action="{{ url('user/' . $user->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <!-- End of Table -->

    <!-- JavaScript -->
    @section('scripts')
        @parent <!-- Preserve existing scripts if any -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#myDataTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    // Add more options as needed
                    "ajax": "data.json" // Example: Load data from a JSON file
                });
            });
        </script>
    @endsection
    <!-- End of JavaScript -->
@endsection
