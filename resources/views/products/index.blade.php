@extends('layouts.app')

@section('content')
    <h1>Products</h1>
    <a href="{{ route('products.create') }}">Add New Product</a>
    <ul>
        @foreach ($products as $product)
            <li>
                {{ $product->name }} - ${{ $product->price }}
                <a href="{{ route('products.show', $product) }}">View</a>
                <a href="{{ route('products.edit', $product) }}">Edit</a>
            </li>
        @endforeach
    </ul>
@endsection
