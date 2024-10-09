<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'products')->get();
        return view('admin.modules.orders.index', compact('orders'));
    }
}
