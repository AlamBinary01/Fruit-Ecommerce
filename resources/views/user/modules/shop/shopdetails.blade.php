@extends('user.layout.main-layout')

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop Detail</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Home</a></li>
            <li class="breadcrumb-item active text-white">Shop Detail</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        <!-- Enlarged Product Image (taking 8 columns) -->
                        <div class="col-lg-8">
                            <div class="border rounded" style="overflow: hidden; height: 400px;">
                                @if ($product->pictures->isNotEmpty())
                                    <img src="{{ asset($product->pictures->first()->path) }}" class="img-fluid rounded" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <img src="{{ asset('img/default-placeholder.jpg') }}" class="img-fluid rounded" alt="Default Image" style="width: 100%; height: 100%; object-fit: cover;">
                                @endif
                            </div>
                        </div>

                        <!-- Product Information (taking 4 columns) -->
                        <div class="col-lg-4">
                            <div class="mt-4 mt-lg-0">
                                <h4 class="fw-bold mb-3">{{ $product->name }}</h4>
                                <p class="mb-3">Category: {{ $product->category ? $product->category->name : 'No Category' }}</p>

                                <!-- Check if the product has a discount -->
                                @if ($product->discount)
                                    @if ($product->discount->discount_type == 'percentage')
                                        @php
                                            $discountedPrice = $product->price - ($product->price * ($product->discount->discount_value / 100));
                                        @endphp
                                    @else
                                        @php
                                            $discountedPrice = $product->price - $product->discount->discount_value;
                                        @endphp
                                    @endif

                                    <!-- Show original and discounted prices -->
                                    <h5 class="fw-bold mb-3">
                                        <span class="text-decoration-line-through text-muted">${{ number_format($product->price, 2) }}</span> 
                                        <span class="text-danger ms-2">${{ number_format($discountedPrice, 2) }}</span>
                                    </h5>
                                @else
                                    <!-- Show only the original price if no discount -->
                                    <h5 class="fw-bold mb-3">${{ number_format($product->price, 2) }}</h5>
                                @endif

                                <div class="d-flex mb-4">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star {{ $i <= round($product->rating) ? 'text-secondary' : 'text-muted' }}"></i>
                                    @endfor
                                </div>

                                <!-- Add to Cart Form -->
                                <form action="{{ route('user.cart.add', $product->id) }}" method="POST" class="mb-4">
                                    @csrf
                                    <div class="input-group quantity mb-3" style="width: 120px;">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border" type="button">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <input type="number" name="quantity" class="form-control form-control-sm text-center border-0" value="1" min="1" style="width: 40px;">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    
                                    <button type="submit" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary w-100">
                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                    </button>
                                </form>
                            </div>  
                        </div>

                        <!-- Description Tab -->
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button" role="tab" id="nav-description-tab" data-bs-toggle="tab" data-bs-target="#nav-description" aria-controls="nav-description" aria-selected="true">Description</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">
                                    <p>{{ $product->description }}</p> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Related Products Section -->
            <h1 class="fw-bold mb-4">Related Products</h1>
            <div class="vesitable">
                <div class="owl-carousel vegetable-carousel justify-content-center">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="vesitable-item p-2">
                            <div class="border border-primary rounded position-relative" style="height: 400px; overflow: hidden;">
                                <div class="vesitable-img" style="height: 200px; overflow: hidden;">
                                    @if ($relatedProduct->pictures->isNotEmpty())
                                        <img src="{{ asset($relatedProduct->pictures->first()->path) }}" class="img-fluid w-100 h-100" alt="{{ $relatedProduct->name }}" style="object-fit: cover; width: 100%; height: 100%;">
                                    @else
                                        <img src="{{ asset('front/img/default-placeholder.jpg') }}" class="img-fluid w-100 h-100" alt="Default Image" style="object-fit: cover; width: 100%; height: 100%;">
                                    @endif
                                </div>
                                <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">
                                    {{ $relatedProduct->category->name }}
                                </div>
                                <div class="p-4 d-flex flex-column justify-content-between" style="height: 200px;">
                                    <h4>{{ $relatedProduct->name }}</h4>
                                    <p class="mb-2">{{ Str::limit($relatedProduct->description, 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-dark">${{ number_format($relatedProduct->price, 2) }}</span>
                                        <form action="{{ route('user.cart.add', $relatedProduct->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="fa fa-shopping-bag me-1"></i> Add 
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- End Related Products Section -->
        </div>
    </div>
    <!-- Single Product End -->
@endsection
