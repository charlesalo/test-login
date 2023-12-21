<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add to Cart</title>
</head>
<body>
    <h1>Add Product to Cart</h1>
    
    <form method="POST" action="{{ route('cart.add') }}">
        @csrf
        <label for="product">Select a product:</label>
        <select name="product" id="product">
            <!-- Populate this select dropdown with your available products -->
            <option value="product1">Product 1</option>
            <option value="product2">Product 2</option>
            <!-- Add more options as needed -->
        </select>

        <button type="submit">Add to Cart</button>
    </form>
</body>
</html>
