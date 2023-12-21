<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Add a product to the user's cart.
     */
    public function addToCart(Request $request, $productId)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Find or create a cart for the user
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // Check if the product is already in the cart
        $existingCartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($existingCartItem) {
            // If the product is already in the cart, update its quantity
            $existingCartItem->update([
                'quantity' => $existingCartItem->quantity + 1,
            ]);
        } else {
            // If the product is not in the cart, create a new cart item
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => 1, // You can adjust the quantity as needed
            ]);
        }

        // Return a success response or redirect back
        return redirect()->back()->with('success', 'Product added to cart.');
    }

    /**
     * View the user's cart.
     */
    public function viewCart()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Find the user's cart and retrieve its items
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItems = $cart->cartItems;

        // You can return a view to display the cart items here
        return view('cart.view', compact('cartItems'));
    }

    /**
     * Remove a product from the user's cart.
     */
    public function removeFromCart(Request $request, $cartItemId)
    {
        // Find the cart item and delete it
        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->delete();

        // Return a success response or redirect back
        return redirect()->back()->with('success', 'Product removed from cart.');
    }
}
