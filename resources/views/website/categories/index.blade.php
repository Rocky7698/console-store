@extends('website.layouts.app')

@section('content')
<div class="container">
    <h2>Categories</h2>

    <a href="{{ route('website.categories.create') }}" class="btn btn-primary mb-3">Add Category</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th width="200">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($categories as $cat)
            <tr>
                <td>{{ $cat->name }}</td>
                <td>{{ $cat->slug }}</td>

                <td>
                    <a href="{{ route('website.categories.edit', $cat->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('website.categories.destroy', $cat->id) }}" 
                          style="display:inline-block;" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this category?')">
                            Delete
                        </button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection
