@extends('admin.layout.layout')

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">All Discounts</h5>
                        <a href="{{ route('discounts.create') }}" class="btn btn-primary">Add New Discount</a>
                    </div>

                    <!-- Table with stripped rows -->
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Discount Type</th>
                                <th scope="col">Discount Value</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($discounts as $discount)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $discount->product->name }}</td>
                                    <td>{{ ucfirst($discount->discount_type) }}</td>
                                    <td>
                                        @if($discount->discount_type == 'percentage')
                                            {{ $discount->discount_value }}%
                                        @else
                                            ${{ number_format($discount->discount_value, 2) }}
                                        @endif
                                    </td>
                                    <td>{{ $discount->start_date ? \Carbon\Carbon::parse($discount->start_date)->format('Y-m-d') : 'N/A' }}</td>
                                    <td>{{ $discount->end_date ? \Carbon\Carbon::parse($discount->end_date)->format('Y-m-d') : 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('discounts.edit', $discount) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('discounts.destroy', $discount) }}" method="POST"
                                            style="display:inline;">
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
