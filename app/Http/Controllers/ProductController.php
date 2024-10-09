<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Picture;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('pictures', 'category')->get();
        return view('admin.modules.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.modules.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'pictures' => 'nullable|array', // Ensure pictures is an array
            'pictures.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each picture
        ]);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
        $product = Product::create($request->only('category_id', 'name', 'description', 'price'));
        if ($request->hasFile('pictures')) {
            $uploadPath = public_path('uploads');

            foreach ($request->file('pictures') as $picture) {
                $fileName = now()->timestamp . '_' . uniqid() . '.' . $picture->extension();
                $picture->move($uploadPath, $fileName);
                $product->pictures()->create(['path' => 'uploads/' . $fileName]);
            }
        }
        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.modules.products.edit', compact('product', 'categories'));
    }
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'pictures.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $product->update($request->only('category_id', 'name', 'description', 'price'));
        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $picture) {
                $fileName = time() . '_' . uniqid() . '.' . $picture->extension();
                $picture->move(public_path('uploads'), $fileName);
                $product->pictures()->create(['path' => 'uploads/' . $fileName]);
            }
        }
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    public function destroy(Product $product)
    {
        foreach ($product->pictures as $picture) {
            if (file_exists(public_path($picture->path))) {
                unlink(public_path($picture->path));
            }
            $picture->delete();
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    public function showImages(Product $product)
    {
        $pictures = $product->pictures;
        return view('admin.modules.products.images', compact('product', 'pictures'));
    }
    public function deleteImage(Product $product, Picture $picture)
    {
        if (file_exists(public_path($picture->path))) {
            unlink(public_path($picture->path));
        }
        $picture->delete();
        return redirect()->route('products.images', $product->id)->with('success', 'Image deleted successfully.');
    }
}
