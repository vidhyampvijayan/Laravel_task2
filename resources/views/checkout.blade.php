<!-- resources/views/checkout.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <style>
        .logout-link {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
    <!-- Logout link -->
    <div class="logout-link">
            <a href="{{ route('logout') }}">Logout</a>
 
    </div>

    <h1>Checkout</h1>
    
    <h2>Cart:</h2>
    <pre>{{ print_r(session('cart'), true) }}</pre>

    <h2>Order:</h2>
    <pre>{{ print_r(session('order'), true) }}</pre>

</body>
</html>
