<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('website.home.index', compact('products'));
    }

    public function bestseller()
    {
        return view('website.home.bestseller');
    }
}
