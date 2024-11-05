<!-- resources/views/products/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>

    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Product ID:</label>
        <input type="text" name="product_id" value="{{ $product->product_id }}" required><br>

        <label>Name:</label>
        <input type="text" name="name" value="{{ $product->name }}" required><br>

        <label>Description:</label>
        <textarea name="description">{{ $product->description }}</textarea><br>

        <label>Price:</label>
        <input type="number" name="price" step="0.01" value="{{ $product->price }}" required><br>

        <label>Stock:</label>
        <input type="number" name="stock" value="{{ $product->stock }}"><br>

        <label>Image:</label>
        <input type="file" name="image"><br>

        <button type="submit">Update Product</button>
    </form>
@endsection
