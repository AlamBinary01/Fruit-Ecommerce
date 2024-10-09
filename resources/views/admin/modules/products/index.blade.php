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
                        <h5 class="card-title mb-0">All Products</h5>
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Add New</a>
                    </div>

                    <!-- Table with stripped rows -->
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category</th>
                                <th scope="col">Price</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $product->category->name }}</td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>{{ Str::limit($product->description, 50) }}</td>
                                    <td>
                                        @if ($product->pictures->isNotEmpty())
                                            @php
                                                $imagePath = asset($product->pictures->first()->path);
                                            @endphp
                                            <img src="{{ $imagePath }}" alt="{{ $product->name }}"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('products.edit', $product) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('products.images', $product->id) }}"
                                            class="btn btn-info btn-sm">Images</a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST"
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
