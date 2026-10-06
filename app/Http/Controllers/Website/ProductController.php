<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Product listing page
     */
    public function index()
    {
        // Load products with images & category
        $products = Product::with(['images', 'category'])
            ->latest()
            ->get();

        // Featured products (with images)
        $featuredProducts = Product::with('images')
            ->latest()
            ->take(4)
            ->get();

        return view('website.products.index', compact('products', 'featuredProducts'));
    }

    /**
     * Single product page
     */
    public function show($id)
    {
        // Single product with images & category
        $product = Product::with(['images', 'category'])
            ->findOrFail($id);

        // Featured products for sidebar
        $featuredProducts = Product::with('images')
            ->latest()
            ->take(4)
            ->get();

        return view('website.products.view', compact('product', 'featuredProducts'));
    }
}
