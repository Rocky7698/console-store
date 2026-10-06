@extends('website.layouts.app')

@section('content')
<div class="container">
    <h2>Add Category</h2>

    <form action="{{ route('website.categories.store') }}" method="POST">
        @csrf

        @include('website.categories.form')

        <button class="btn btn-success mt-3">Save Category</button>
    </form>
</div>
@endsection
