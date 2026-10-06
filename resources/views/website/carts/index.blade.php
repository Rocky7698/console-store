@extends('website.layouts.app')
@section('content')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Cart Page</h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Cart Page</li>
        </ol>
    </div>

    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr>
                                <td scope="row">
                                    <p class="mb-0 py-4"><img src="{{ ($item->product->image) }}" height="80">
                                    </p>
                                </td>
                                <th scope="row">
                                    <p class="mb-0 py-4">{{ $item->product->name }}
                                    </p>
                                </th>
                                <td>
                                    <p class="mb-0 py-4">₹{{ $item->product->price }}</p>
                                </td>
                                <td>
                                    <form action="{{ route('website.carts.update', $item->id) }}" method="POST"
                                        class="mb-0 py-4 d-flex">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $item->quantity }}"
                                            class="form-control w-50">
                                        <button type="submit" class="btn btn-sm btn-primary ms-2"
                                            style="width: 100px;">Update</button>
                                    </form>
                                </td>
                                <td>
                                    <p class="mb-0 py-4">₹{{ $item->product->price * $item->quantity }}</p>
                                </td>
                                <td class="py-4">
                                    <a href="{{ route('website.carts.delete', $item->id) }}"
                                        class="btn btn-md rounded-circle bg-light border">
                                        <i class="fa fa-times text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
                <button class="btn btn-primary rounded-pill px-4 py-3" type="button">Apply Coupon</button>
            </div>
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0">₹{{ $total }}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Shipping</h5>
                                <div>
                                    <p class="mb-0">Flat rate: $3.00</p>
                                </div>
                            </div>
                            <p class="mb-0 text-end">Shipping to UK.</p>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4">₹{{ $total > 0 ? (266 + $total) : 0 }}</p>
                        </div>
                        <a class="btn btn-primary rounded-pill px-4 py-3 text-uppercase mb-4 ms-4"
                            href="{{ route('website.carts.checkout') }}">Proceed Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
