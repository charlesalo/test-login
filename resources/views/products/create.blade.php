@extends('layouts.app')

@section('content')
    <h1>Add New Product</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" step=".01" required>

        <button type="submit">Add Product</button>
    </form>
@endsection
