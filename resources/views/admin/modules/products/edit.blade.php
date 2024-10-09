@extends('admin.layout.layout')

@section('content')
<div class="row">
    <div class="col-lg-10" >
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Product</h5>
                <!-- General Form Elements -->
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <label for="category_id" class="col-sm-3 col-form-label">Category</label>
                        <div class="col-sm-9">
                            <select id="category_id" name="category_id" class="form-control" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="description" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <textarea id="description" name="description" class="form-control" rows="3" required>{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="price" class="col-sm-3 col-form-label">Price</label>
                        <div class="col-sm-9">
                            <input type="number" id="price" name="price" class="form-control" value="{{ old('price', $product->price) }}" step="0.01" required>
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="pictures" class="col-sm-3 col-form-label">Pictures</label>
                        <div class="col-sm-9">
                            <input type="file" id="pictures" name="pictures[]" class="form-control" multiple>
                            @error('pictures.*')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>

    </div>
</div>
@endsection
