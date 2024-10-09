@extends('admin.layout.layout')

@section('content')
<div class="row">
    <div class="col-lg-10">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Category</h5>

                <!-- General Form Elements -->
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
                    </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>

    </div>
</div>
@endsection
