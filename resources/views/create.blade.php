<!-- resources/views/products/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Create New Product</h1>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <label>Product ID:</label>
        <input type="text" name="product_id" required><br>

        <label>Name:</label>
        <input type="text" name="name" required><br>

        <label>Description:</label>
        <textarea name="description"></textarea><br>

        <label>Price:</label>
        <input type="number" name="price" step="0.01" required><br>

        <label>Stock:</label>
        <input type="number" name="stock"><br>

        <label>Image:</label>
        <input type="file" name="image"><br>

        <button type="submit">Create Product</button>
    </form>
@endsection
