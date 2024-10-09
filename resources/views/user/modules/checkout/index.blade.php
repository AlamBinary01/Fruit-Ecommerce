@extends('user.layout.main-layout')

@section('content')
    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->

    <!-- Single Page Header Start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="">Pages</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Billing details</h1>
            <form action="{{ route('checkout.placeOrder') }}" method="POST" id="payment-form">
                @csrf
                <div class="row g-5">
                    <!-- Billing Information -->
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">First Name<sup>*</sup></label>
                                    <input type="text" class="form-control" name="first_name" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Last Name<sup>*</sup></label>
                                    <input type="text" class="form-control" name="last_name" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Address <sup>*</sup></label>
                            <input type="text" class="form-control" name="address" placeholder="House Number Street Name" required>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Town/City<sup>*</sup></label>
                            <input type="text" class="form-control" name="town_city" required>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Country<sup>*</sup></label>
                            <input type="text" class="form-control" name="country" required>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                            <input type="text" class="form-control" name="postcode_zip" required>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Mobile<sup>*</sup></label>
                            <input type="tel" class="form-control" name="mobile" required>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email Address<sup>*</sup></label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </div>

                    <!-- Products and Payment Methods -->
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Products</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $totalAmount = 0; @endphp
                                    @foreach ($cart as $item)
                                        @php $totalAmount += $item['price'] * $item['quantity']; @endphp
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center mt-2">
                                                    @if($item['product']->pictures->isNotEmpty())
                                                        <img src="{{ asset($item['product']->pictures->first()->path) }}" class="img-fluid me-5 rounded-circle"
                                                            style="width: 80px; height: 80px;" alt="{{ $item['name'] }}">
                                                    @else
                                                        <img src="{{ asset('img/default-placeholder.jpg') }}" class="img-fluid me-5 rounded-circle"
                                                            style="width: 80px; height: 80px;" alt="Default Image">
                                                    @endif
                                                </div>
                                            </th>
                                            <td class="py-5">{{ $item['name'] }}</td>
                                            <td class="py-5">${{ number_format($item['price'], 2) }}</td>
                                            <td class="py-5">{{ $item['quantity'] }}</td>
                                            <td class="py-5">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row g-4 text-center align-items-center justify-content-center py-3">
                            <h4>Total: ${{ number_format($totalAmount, 2) }}</h4>
                        </div>

                        <!-- Payment Method Options -->
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <!-- Cash on Delivery -->
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="Delivery-1" name="payment_method"
                                        value="cash_on_delivery">
                                    <label class="form-check-label" for="Delivery-1">Cash On Delivery</label>
                                </div>
                            </div>

                            <!-- Square Payment Option (default selected) -->
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="square_payment" name="payment_method"
                                        value="square_payment" checked>
                                    <label class="form-check-label" for="square_payment">Pay with Card (Square)</label>
                                </div>
                            </div>
                        </div>

                        <!-- Square Payment Form (shown by default) -->
                        <div class="row mt-4" id="square-payment-form">
                            <div id="card-container"></div>
                            <input type="hidden" name="nonce" id="nonce">
                            <button type="submit" class="btn btn-primary mt-3" id="card-button">Pay Now</button>
                        </div>

                        <!-- Submit Button for Cash on Delivery -->
                        <div class="row g-4 text-center align-items-center justify-content-center pt-4" id="cod-submit-button" style="display: none;">
                            <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Page End -->

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">Order Placed Successfully!</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Thank you for your purchase. Your order has been placed successfully.</p>
                    <p>You will receive a confirmation email shortly.</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('user.home') }}" class="btn btn-primary">Continue Shopping</a>
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">View Orders</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="errorModalLabel">Order Failed</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>There was an issue processing your order. Please try again.</p>
                    <p>If the problem persists, contact our support team.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
    <script type="module">
        document.addEventListener('DOMContentLoaded', function () {
            const cardContainer = document.getElementById('square-payment-form');
            const cardButton = document.getElementById('card-button');
            const squarePaymentRadio = document.getElementById('square_payment');
            const cashOnDeliveryRadio = document.getElementById('Delivery-1');
            const codSubmitButton = document.getElementById('cod-submit-button');
            const nonceInput = document.getElementById('nonce');

            // Toggle payment forms based on selected payment method
            function togglePaymentForms() {
                if (squarePaymentRadio.checked) {
                    cardContainer.style.display = 'block';
                    codSubmitButton.style.display = 'none';
                } else if (cashOnDeliveryRadio.checked) {
                    cardContainer.style.display = 'none';
                    codSubmitButton.style.display = 'block';
                }
            }

            // Initial toggle on page load
            togglePaymentForms();

            // Event listeners for payment method changes
            squarePaymentRadio.addEventListener('change', togglePaymentForms);
            cashOnDeliveryRadio.addEventListener('change', togglePaymentForms);

            // Initialize Square Payment
            (async function () {
                const payments = Square.payments("{{ env('SQUARE_APPLICATION_ID') }}", "{{ env('SQUARE_LOCATION_ID') }}");
                const card = await payments.card();
                await card.attach('#card-container');

                // Handle form submission for Square Payment
                cardButton.addEventListener('click', async (event) => {
                    event.preventDefault();
                    cardButton.disabled = true;

                    try {
                        const result = await card.tokenize();
                        if (result.status === 'OK') {
                            // Set the nonce value in the hidden input
                            nonceInput.value = result.token;

                            // Submit the form
                            document.getElementById('payment-form').submit();
                        } else {
                            alert('Payment failed: ' + result.errors.map(e => e.detail).join(', '));
                        }
                    } catch (error) {
                        console.error(error);
                        alert('An error occurred. Please try again.');
                    } finally {
                        cardButton.disabled = false;
                    }
                });
            })();
        });
    </script>
@endsection
