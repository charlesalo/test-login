<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Include this to use the Product model

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::all(); // Get all products from the database
        return view('products.index', compact('products')); // Pass products to the view
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('products.create'); // Return the view for creating a new product
    }

    /**
     * Store a newly created product in the database.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);

        // Create a new product and save it to the database
        Product::create($request->all());

        // Redirect the user to the products index with a success message
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product')); // Return the view for showing a single product
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product')); // Return the view for editing a product
    }

    /**
     * Update the specified product in the database.
     */
    public function update(Request $request, Product $product)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);

        // Update the product in the database
        $product->update($request->all());

        // Redirect the user with a success message
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from the database.
     */
    public function destroy(Product $product)
    {
        // Delete the product
        $product->delete();

        // Redirect the user with a success message
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
