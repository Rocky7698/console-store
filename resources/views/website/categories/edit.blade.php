@extends('website.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Category</h2>

    <form action="{{ route('website.categories.update', $category->id) }}" method="POST">
        @csrf @method('PUT')

        @include('website.categories.form')

        <button class="btn btn-primary mt-3">Update Category</button>
    </form>
</div>
@endsection
