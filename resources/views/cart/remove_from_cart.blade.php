<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove from Cart</title>
</head>
<body>
    <h1>Remove Items from Cart</h1>
    
    @if(count($cartItems) > 0)
    <ul>
        @foreach($cartItems as $item)
        <li>
            {{ $item->product_name }} (Quantity: {{ $item->quantity }})
            <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Remove</button>
            </form>
        </li>
        @endforeach
    </ul>
    @else
    <p>Your cart is empty.</p>
    @endif
</body>
</html>
