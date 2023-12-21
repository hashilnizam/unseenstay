@extends('admin.dashboard.common.app')

@section('content')
    <!-- Table -->
    <table id="myDataTable" class="display" style="width:100%">
        <thead>
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Country</th>
            <!-- Add more table headers if needed -->
        </tr>
        </thead>
        <tbody>
        <!-- Table rows and data will be loaded dynamically -->
        </tbody>
    </table>
    <!-- End of Table -->

    <!-- JavaScript -->
    @section('scripts')
        @parent <!-- Preserve existing scripts if any -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="path/to/datatables.min.js"></script>
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
