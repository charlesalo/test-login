@extends('layouts.app')

@section('content')
    <h1>Edit Product: {{ $product->name }}</h1>

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $product->name }}" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required>{{ $product->description }}</textarea>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" value="{{ $product->price }}" step=".01" required>

        <button type="submit">Update Product</button>
    </form>
@endsection
