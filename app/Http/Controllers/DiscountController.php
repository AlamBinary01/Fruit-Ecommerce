<?php
namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::with('product')->get();
        return view('admin.modules.discounts.index', compact('discounts'));
    }
    public function create()
    {
        $products = Product::all(); 
        return view('admin.modules.discounts.create', compact('products'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
        Discount::create($request->all());
        return redirect()->route('discounts.index')->with('success', 'Discount created successfully.');
    }

    public function edit($id)
    {
        $discount = Discount::findOrFail($id);
        $products = Product::all();
        
        return view('admin.modules.discounts.edit', compact('discount', 'products'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
    
        $discount = Discount::findOrFail($id);
        $discount->update($request->all());
    
        return redirect()->route('discounts.index')->with('success', 'Discount updated successfully.');
    }
    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);
        $discount->delete();
    
        return redirect()->route('discounts.index')->with('success', 'Discount deleted successfully.');
    }
}
