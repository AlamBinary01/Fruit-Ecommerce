@extends('user.layout.main-layout')

@section('content')
    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active text-white">Shop</li>
        </ol>
    </div>
  
    <div class="container-fluid fruite py-5">
        <div class=" py-5">
            <h1 class="mb-4">Fresh Fruits Shop</h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xl-3">
                         
                        </div>
                        <div class="col-6"></div>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="position-relative">
                                <img src="{{ asset('img/banner-fruits.jpg') }}" class="img-fluid w-100 rounded" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center">
                            <div class="row">
                                @foreach ($products as $product)
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <a href="{{ route('products.show', $product->id) }}"
                                            class="text-decoration-none text-dark">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="{{ asset($product->pictures->first()->path) }}"
                                                        class="img-fluid w-100 rounded-top" alt="{{ $product->name }}">
                                                </div>

                                                <!-- Display Discount -->
                                                @if ($product->discount)
                                                    @if ($product->discount->discount_type == 'percentage')
                                                        <div class="text-white bg-danger px-3 py-1 rounded position-absolute"
                                                            style="top: 10px; right: 10px;">
                                                            {{ $product->discount->discount_value }}% OFF
                                                        </div>
                                                    @else
                                                        @php
                                                            $discountAmount =
                                                                ($product->discount->discount_value / $product->price) *
                                                                100;
                                                        @endphp
                                                        <div class="text-white bg-danger px-3 py-1 rounded position-absolute"
                                                            style="top: 10px; right: 10px;">
                                                            {{ number_format($discountAmount, 2) }}% OFF
                                                        </div>
                                                    @endif
                                                @endif

                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                    style="top: 10px; left: 10px;">
                                                    {{ $product->category->name }}
                                                </div>

                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom"
                                                    style="align-content: center">
                                                    <h4>{{ $product->name }}</h4>

                                                    <!-- Product Description -->
                                                    <p class="text-muted small mb-3">
                                                        {{ \Illuminate\Support\Str::limit($product->description, 100, $end='...') }}
                                                    </p>

                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">
                                                            @if ($product->discount)
                                                                <span
                                                                    class="text-decoration-line-through">${{ $product->price }}</span>
                                                                <span class="text-danger">
                                                                    ${{ number_format($product->price - ($product->discount->discount_type == 'percentage' ? $product->price * ($product->discount->discount_value / 100) : $product->discount->discount_value), 2) }}
                                                                </span>
                                                            @else
                                                                ${{ $product->price }}
                                                            @endif
                                                            / kg
                                                        </p>

                                                        <form action="{{ route('user.cart.add', $product->id) }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="quantity" value="1">
                                                            <button type="submit" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                                <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                                cart
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-12">
                                <div class="pagination d-flex justify-content-center mt-5">
                                    <a href="#" class="rounded">&laquo;</a>
                                    <a href="#" class="active rounded">1</a>
                                    <a href="#" class="rounded">2</a>
                                    <a href="#" class="rounded">3</a>
                                    <a href="#" class="rounded">4</a>
                                    <a href="#" class="rounded">5</a>
                                    <a href="#" class="rounded">6</a>
                                    <a href="#" class="rounded">&raquo;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->
@endsection
