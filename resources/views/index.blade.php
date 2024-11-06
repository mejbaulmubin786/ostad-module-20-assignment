<!-- resources/views/products/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Product List</h1>

    <a href="{{ route('products.create') }}" class="btn btn-primary">Create New Product</a>

    <!-- Search form -->
    <form action="{{ route('products.index') }}" method="GET" class="mt-3">
        <input type="text" name="search" placeholder="Search by Product ID or Description">
        <button type="submit" class="btn btn-secondary">Search</button>
    </form>

    <!-- Sort links -->
    <div class="mt-3">
        <a href="{{ route('products.index', ['sort' => 'name']) }}">Sort by Name</a> |
        <a href="{{ route('products.index', ['sort' => 'price']) }}">Sort by Price</a>
    </div>

    <!-- Product Table -->
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $products->links() }}
</div>
@endsection
