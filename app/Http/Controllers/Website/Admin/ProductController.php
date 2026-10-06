<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(12);
        return view('website.admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('website.admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'nullable|image|max:2048',
        ]);

        // STEP 1: Create MAIN product first
        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name . '-' . time()),
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price ?: null,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            // set later
        ]);


        // 2️⃣ Ab multiple images save karo
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {

                $imageName = time() . rand(1000, 9999) . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('uploads/products'), $imageName);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'uploads/products/' . $imageName,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product added with images!');
    }


    public function destroy(Product $product)
    {
        if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
            @unlink(public_path('uploads/products/' . $product->image));
        }

        // Delete Multiple Images
        foreach ($product->images as $img) {
            if (file_exists(public_path($img->image))) {
                @unlink(public_path($img->image));
            }
            $img->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
