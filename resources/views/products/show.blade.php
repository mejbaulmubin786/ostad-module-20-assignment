<!-- resources/views/products/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Product Details</h1>

    <div>
        <strong>Product ID:</strong> {{ $product->product_id }}
    </div>
    <div>
        <strong>Name:</strong> {{ $product->name }}
    </div>
    <div>
        <strong>Price:</strong> {{ $product->price }}
    </div>
    <div>
        <strong>Description:</strong> {{ $product->description }}
    </div>
    <div>
        <strong>Stock:</strong> {{ $product->stock }}
    </div>

    <!-- Display Product Image if exists -->
    @if($product->image)
        <div>
            <strong>Image:</strong><br>
            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" style="width: 200px; height: auto;">
        </div>
    @else
        <div>
            <strong>Image:</strong> No image available.
        </div>
    @endif

    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
