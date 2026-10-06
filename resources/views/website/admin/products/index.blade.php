@extends('website.layouts.app')
@section('content')

@section('title', 'Products - Admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Products</h3>
            <a href="{{ route('website.admin.products.create') }}" class="btn btn-success">+ Add Product</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card p-3">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th style="width:160px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>
                                @if ($p->image)
                                    <img src="{{ asset('uploads/products/' . $p->image) }}" width="80" alt="">
                                @endif
                            </td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->category->name ?? '-' }}</td>
                            <td>₹{{ number_format($p->price, 2) }}</td>
                            <td>{{ $p->stock }}</td>
                            <td>
                                <a href="{{ route('website.admin.products.edit', $p->id) }}"
                                    class="btn btn-sm btn-primary">Edit</a>

                                <form action="{{ route('website.admin.products.destroy', $p->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete product?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">{{ $products->links() }}</div>
        </div>
    </div>
@endsection
