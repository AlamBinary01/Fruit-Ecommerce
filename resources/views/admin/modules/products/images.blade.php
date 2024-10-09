@extends('admin.layout.layout')

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Images for {{ $product->name }}</h5>

                    <table class="table" id="imagesTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Image Name</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pictures as $picture)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        <img src="{{ asset($picture->path) }}" alt="" style="width: 100px; height: 100px; object-fit: cover;">
                                    </td>
                                    <td>{{ basename($picture->path) }}</td>
                                    <td>
                                        <form action="{{ route('products.images.delete', [$product->id, $picture->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back to Products</a>
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
            $('#imagesTable').DataTable({
                responsive: true
            });
        });
    </script>
@endpush
