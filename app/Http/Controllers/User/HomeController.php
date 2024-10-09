<?php
namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\Product;
use App\Models\Discount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Eager load the 'category', 'pictures', and 'discount' relationships
        $products = Product::with(['category', 'discount', 'pictures'])->get();
        $categories = Category::all();
        
        return view('user.modules.home.index', compact('categories', 'products'));
    }
 
    public function shop(Request $request)
    {
        $categories = Category::all();
        
        if ($request->has('category')) {
            // Eager load 'pictures', 'category', and 'discount'
            $products = Product::where('category_id', $request->category)
                        ->with(['pictures', 'category', 'discount'])
                        ->get();
        } else {
            // Eager load 'pictures', 'category', and 'discount'
            $products = Product::with(['pictures', 'category', 'discount'])->get(); 
        }

        return view('user.modules.shop.index', compact('categories', 'products'));
    }

    public function shopdetails($id)
    {
        $category = Category::all();
        
        // Eager load the 'pictures', 'category', and 'discount' for the product
        $product = Product::with(['pictures', 'category', 'discount'])->findOrFail($id);
        
        $relatedProducts = Product::with(['pictures', 'discount'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();
        
        return view('user.modules.shop.shopdetails', compact('product', 'category', 'relatedProducts'));
    }

    public function cart()
    {
        return view('user.modules.cart.index');
    }

    public function checkout()
    {
        return view('user.modules.checkout.index');
    }

    public function testimonials()
    {
        return view('user.modules.testimonials.index');
    }

    public function contact()
    {
        return view('user.modules.contact.index');
    }

    public function aboutUs()
    {
        return view('user.modules.aboutus.index');
    }
}
