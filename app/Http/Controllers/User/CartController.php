<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Session::get('cart', []);
        $cartTotal = array_reduce($cartItems, function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);

        return view('user.modules.cart.index', compact('cartItems', 'cartTotal'));
    }
    public function addToCart(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
    
        $product = Product::with('discount')->find($productId); 
    
        if (!$product) {
            return redirect()->route('user.modules.cart.index')->with('error', 'Product not found.');
        }
    
        $price = $product->price;
        if ($product->discount) {
            if ($product->discount->discount_type == 'percentage') {
                $price = $product->price - ($product->price * ($product->discount->discount_value / 100));
            } elseif ($product->discount->discount_type == 'fixed') {
                $price = $product->price - $product->discount->discount_value;
            }
        }
        $quantity = $request->input('quantity', 1);
        $cart = Session::get('cart', []);
    
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $price, 
                'quantity' => $quantity,
                'product' => $product,
            ];
        }
    
        Session::put('cart', $cart);
    
        return redirect()->route('user.modules.cart.index')->with('success', 'Product added to cart.');
    }
    

    public function update(Request $request, $productId)
    {
        $quantity = $request->input('quantity');
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            if ($quantity < 1) {
                unset($cart[$productId]);
            } else {
                $cart[$productId]['quantity'] = $quantity;
            }
            Session::put('cart', $cart);
        }

        return redirect()->route('user.modules.cart.index')->with('success', 'Cart updated successfully.');
    }
    public function remove($productId)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
        }

        return redirect()->route('user.modules.cart.index')->with('success', 'Product removed from cart.');
    }
    public function getCartCount()
    {
        $cartCount = session()->has('cart') ? count(session('cart')) : 0;
        return response()->json(['count' => $cartCount]);
    }
}
