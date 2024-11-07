<!-- resources/views/products/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Product</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="product_id">Product ID</label>
            <input type="text" name="product_id" class="form-control" value="{{ $product->product_id }}" required>
        </div>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" value="{{ $product->price }}" required step="0.01">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}">
        </div>

        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="file" name="image" class="form-control-file" accept="image/*">
        </div>

        <!-- Display existing image if available -->
        @if($product->image)
            <div class="form-group">
                <p>Current Image:</p>
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" style="max-width: 150px;">
            </div>
        @endif


        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>
@endsection
