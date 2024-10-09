@extends('admin.layout.layout')
@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Table with stripped rows -->
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Address</th>
                                <th scope="col">Order Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @foreach ($order->products as $product)
                                    <tr>
                                        <th scope="row">{{ $order->id }}</th>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $product->pivot->quantity }}</td> <!-- Accessing the pivot table for quantity -->
                                        <td>{{ $order->address }}</td>
                                        <td>${{ number_format($order->total_amount, 2) }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true
            });
        });
    </script>
@endpush
