@extends('admin.dashboard.common.app')

@section('content')

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>User Feedback</h2>
        </div>

        <div class="table-responsive">
            <table id="myDataTable" class="table table-striped table-bordered" style="width:100%">
                <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user_messages as $user_message)
                    <tr>
                        <td>{{ $user_message->name }}</td>
                        <td>{{ $user_message->email }}</td>
                        <td>{{ $user_message->subject }}</td>
                        <td>{{ $user_message->message }}</td>
                        <td>
                            <form method="POST" action="{{ url('feedback/' . $user_message->id) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('scripts')
    @parent
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
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
