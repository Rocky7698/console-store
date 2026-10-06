<!DOCTYPE html>
<html>

<head>
    <title>Add Product</title>
</head>

<body>

    <h2>Add New Product</h2>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('website.admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Name</label><br>
        <input type="text" name="name"><br><br>

        <label>Category</label><br>
        <select name="category_id">
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
        <br><br>

        <label>Price</label><br>
        <input type="number" name="price"><br><br>

        <label>Discount Price</label><br>
        <input type="number" name="discount_price"><br><br>

        <label>Stock</label><br>
        <input type="number" name="stock"><br><br>

        <label>Description</label><br>
        <textarea name="description"></textarea><br><br>

        <!-- FIXED FIELD (Multiple Images) -->
        <label>Product Images (Multiple)</label><br>
        <input type="file" name="images[]" multiple><br><br>

        <button type="submit">Add Product</button>
    </form>

</body>

</html>
@endsection