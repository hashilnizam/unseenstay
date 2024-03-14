@extends('admin.dashboard.common.app')

@section('content')

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Payment Details</h2>
        </div>

        <div class="table-responsive">
            <table id="myDataTable" class="table table-striped table-bordered" style="width:100%">
                <thead class="thead-dark">
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Order Id</th>
                    <th>Razorpay Payment Id</th>
                    <th>Razorpay</th>
                    <th>status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $index => $payment)
                    <tr>
                        <td>{{ $userBookings[$index]->userOrder->username }}</td>
                        <td>{{ $userBookings[$index]->userOrder->email }}</td>
                        <td>{{ $userBookings[$index]->userOrder->mobile }}</td>
                        <td>{{ $payment->order_id }}</td>
                        <td>{{ $payment->razorpay_payment_id }}</td>
                        <td>{{ $payment->razorpay_order_id }}</td>
                        <td>{{ $payment->status }}</td>
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
