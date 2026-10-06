<?php

namespace App\Http\Controllers\Website;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('website.carts.index', compact('cartItems', 'total'));
    }

    public function show()
    {
        return view('website.carts.view');
    }
    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        $cartItem = Cart::where('product_id', $productId)->where('user_id', Auth::id())->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        $cartTotal = Cart::where('user_id', auth('web')->id())->get()->sum(function ($cartItem) {
            return $cartItem->total_price;
        });
        session()->put('total', $cartTotal);

        return redirect()->route('website.carts.index')->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
    {
        $cartItem = Cart::where('id', $id);
        $cartItem->update(['quantity' => $request->quantity]);

        $cartTotal = Cart::where('user_id', auth('web')->id())->get()->sum(function ($cartItem) {
            return $cartItem->total_price;
        });
        session()->put('total', $cartTotal);
        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    public function remove($id)
    {
        Cart::find($id)->delete();
        $cartTotal = Cart::where('user_id', auth('web')->id())->get()->sum(function ($cartItem) {
            return $cartItem->total_price;
        });
        session()->put('total', $cartTotal);
        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    public function checkout()
    {
        Cart::where('user_id', Auth::id())->delete();

        $cartTotal = Cart::where('user_id', auth('web')->id())->get()->sum(function ($cartItem) {
            return $cartItem->total_price;
        });
        session()->put('total', $cartTotal);
        return redirect()->route('website.products.index')->with('success', 'Order placed successfully!');
    }
}
