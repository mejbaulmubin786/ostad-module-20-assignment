<!-- resources/views/products/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>All Products</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('products.index') }}">
        <input type="text" name="search" placeholder="Search by Product ID or Description">
        <button type="submit">Search</button>
    </form>

    <!-- Sorting Links -->
    <a href="{{ route('products.index', ['sort' => 'name']) }}">Sort by Name</a> |
    <a href="{{ route('products.index', ['sort' => 'price']) }}">Sort by Price</a>

    <!-- Products Table -->
    <table>
        <tr>
            <th>ID</th>
            <th>Product ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}">View</a> |
                    <a href="{{ route('products.edit', $product->id) }}">Edit</a> |
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <!-- Pagination -->
    {{ $products->links() }}
@endsection
