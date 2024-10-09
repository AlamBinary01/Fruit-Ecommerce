<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use Square\SquareClient;
use Square\Models\CreatePaymentRequest;
use Square\Models\Money;
use Square\Exceptions\ApiException;
use Illuminate\Support\Facades\DB;
use Square\Environment;

class CheckoutController extends Controller
{
    private $squareClient;

    public function __construct()
    {
        $this->squareClient = new SquareClient([
            'accessToken' => env('SQUARE_ACCESS_TOKEN'),
            'environment' => env('SQUARE_ENVIRONMENT', Environment::SANDBOX),
        ]);
    }

    public function showCheckoutForm()
    {
        $cart = session()->get('cart', []);
        $totalAmount = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);
        return view('user.modules.checkout.index', ['cart' => $cart, 'totalAmount' => $totalAmount]);
    }

    public function placeOrder(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to place an order.');
        }

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'town_city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postcode_zip' => 'required|string|max:20',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email',
            'payment_method' => 'required|string|in:cash_on_delivery,square_payment',
            'nonce' => 'nullable|string', // Nullable because COD doesn’t require it
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty. Please add products to your cart before checking out.');
        }

        $totalAmount = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);

        DB::beginTransaction(); // Start the transaction

        try {
            // Create the order
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'address' => $validatedData['address'],
                'town_city' => $validatedData['town_city'],
                'country' => $validatedData['country'],
                'postcode_zip' => $validatedData['postcode_zip'],
                'mobile' => $validatedData['mobile'],
                'email' => $validatedData['email'],
                'total_amount' => $totalAmount,
                'payment_method' => $validatedData['payment_method'],
            ]);

            // Attach order items
            foreach ($cart as $item) {
                $order->products()->attach($item['product']->id, [
                    'quantity' => $item['quantity'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                ]);
            }

            if ($validatedData['payment_method'] === 'square_payment') {
                if (empty($validatedData['nonce'])) {
                    throw new \Exception('Payment nonce is missing.');
                }

                // Process the payment
                $paymentResponse = $this->processPayment($validatedData['nonce'], $totalAmount);

                if (!$paymentResponse['success']) {
                    throw new \Exception('Payment processing failed: ' . implode(', ', $paymentResponse['errors']));
                }

                // Optionally, you can store the payment ID in the order
                $order->payment_id = $paymentResponse['payment_id'];
                $order->save();
            }

            DB::commit(); // Commit the transaction
            session()->forget('cart'); // Clear the cart after successful order and payment

            return redirect()->route('checkout.success')->with('success', 'Your order has been placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction on failure
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Process Square Payment
    private function processPayment($nonce, $amount)
    {
        // Initialize Square Client
        $client = new SquareClient([
            'accessToken' => env('SQUARE_ACCESS_TOKEN'),
            'environment' => env('SQUARE_ENVIRONMENT', Environment::SANDBOX),
        ]);

        // Create the Money object
        $amount_money = new Money();
        $amount_money->setAmount($amount * 100); // Square expects the amount in cents
        $amount_money->setCurrency('USD');

        // Create the Payment Request
        $body = new CreatePaymentRequest($nonce, uniqid());
        $body->setAmountMoney($amount_money);
        $body->setAutocomplete(true);
        $body->setLocationId(env('SQUARE_LOCATION_ID'));

        try {
            $api_response = $client->getPaymentsApi()->createPayment($body);

            if ($api_response->isSuccess()) {
                $result = $api_response->getResult();
                return [
                    'success' => true,
                    'payment_id' => $result->getPayment()->getId(),
                ];
            } else {
                return [
                    'success' => false,
                    'errors' => array_map(function ($error) {
                        return $error->getDetail();
                    }, $api_response->getErrors()),
                ];
            }
        } catch (ApiException $e) {
            return [
                'success' => false,
                'errors' => [$e->getMessage()],
            ];
        }
    }

    public function showSuccess()
    {
        return view('user.modules.thankyou.index');
    }
}
