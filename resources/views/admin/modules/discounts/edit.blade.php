@extends('admin.layout.layout')

@section('content')
<div class="row">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Discount</h5>
                <!-- General Form Elements -->
                <form action="{{ route('discounts.update', $discount->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- This ensures a PUT request is sent -->

                    <!-- Product Selection -->
                    <div class="row mb-3">
                        <label for="product_id" class="col-sm-3 col-form-label">Product</label>
                        <div class="col-sm-9">
                            <select id="product_id" name="product_id" class="form-control" required>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ $product->id == old('product_id', $discount->product_id) ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Discount Type -->
                    <div class="row mb-3">
                        <label for="discount_type" class="col-sm-3 col-form-label">Discount Type</label>
                        <div class="col-sm-9">
                            <select id="discount_type" name="discount_type" class="form-control" required>
                                <option value="percentage" {{ old('discount_type', $discount->discount_type) == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                <option value="fixed" {{ old('discount_type', $discount->discount_type) == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                            </select>
                            @error('discount_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Discount Value -->
                    <div class="row mb-3">
                        <label for="discount_value" class="col-sm-3 col-form-label">Discount Value</label>
                        <div class="col-sm-9">
                            <input type="number" id="discount_value" name="discount_value" class="form-control" value="{{ old('discount_value', $discount->discount_value) }}" step="0.01" required>
                            @error('discount_value')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Start Date -->
                    <div class="row mb-3">
                        <label for="start_date" class="col-sm-3 col-form-label">Start Date</label>
                        <div class="col-sm-9">
                            <input type="date" id="start_date" name="start_date" class="form-control" 
                                   value="{{ old('start_date', $discount->start_date ? \Carbon\Carbon::parse($discount->start_date)->format('Y-m-d') : '') }}">
                            @error('start_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- End Date -->
                    <div class="row mb-3">
                        <label for="end_date" class="col-sm-3 col-form-label">End Date</label>
                        <div class="col-sm-9">
                            <input type="date" id="end_date" name="end_date" class="form-control" 
                                   value="{{ old('end_date', $discount->end_date ? \Carbon\Carbon::parse($discount->end_date)->format('Y-m-d') : '') }}">
                            @error('end_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('discounts.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>
    </div>
</div>
@endsection
