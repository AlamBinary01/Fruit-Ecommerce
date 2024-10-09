@extends('user.layout.main-layout')

@section('content')
    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <br><br>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $productId => $item)
                            <!-- Loop through cart items -->
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($item['product']->pictures->first()->path) }}"
                                            class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                            alt="{{ $item['name'] }}">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $item['name'] }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">${{ number_format($item['price'], 2) }}</p>
                                </td>
                                <td>
                                    <br>
                                    <form action="{{ route('user.cart.update', $productId) }}" method="POST">
                                        <!-- Update quantity form -->
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                            style="width: 60px;" required>
                                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                    </form>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                    <!-- Total price -->
                                </td>
                                <td>
                                    <form action="{{ route('user.cart.remove', $productId) }}" method="POST">
                                        <!-- Remove item form -->
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-md rounded-circle bg-light border mt-4">
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0">${{ number_format($cartTotal, 2) }}</p>
                            </div>
                           
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4">${{ number_format($cartTotal, 2) }}</p> <!-- Total with shipping -->
                        </div>
                        <a href="{{ route('checkout.form') }}"
                            class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4">
                            Proceed Checkout
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->
@endsection
