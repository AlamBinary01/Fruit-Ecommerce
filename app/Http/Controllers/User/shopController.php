<?php

namespace App\Http\Controllers\User;

use App\Models\Category;

use App\Http\Controllers\Controller;


class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('user.modules.shop.index', compact('categories'));
    }
}
