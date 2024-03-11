<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
    <style>
    
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
            position: relative; 
        }
        .book {
            border: 1px solid #ccc;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
        }
        .book h2 {
            margin-top: 0;
        }
        .book p {
            margin-top: 5px;
            margin-bottom: 10px;
        }
        .book button {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .book button:hover {
            background-color: #0056b3;
        }
        .auth-links {
            position: absolute; 
            top: -24px;
    right: -123px;
        }
        .auth-links a {
            margin-right: 10px;
            text-decoration: none;
            color: #007bff;
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border-radius: 3px;
        }
        .auth-links a:hover {
            background-color: #0056b3;
        }
        .checkout-link {
            margin-right: 10px;
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bookstore</h1>
  
        <div class="auth-links">
            @auth
                <p>Welcome, {{ Auth::user()->name }}</p>
                <a href="{{ route('logout') }}" class="logout-link">Logout</a>
                <a href="{{ route('cart.view') }}" class="cart-link">View Cart</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Sign Up</a>
            @endauth
        </div>
        @foreach ($books as $book)
            <div class="book">
                <h2>{{ $book->title }}</h2>
                <p><strong>Author:</strong> {{ $book->author }}</p>
                <p><strong>Description:</strong> {{ $book->description }}</p>
                <p><strong>Price:</strong> ${{ $book->price }}</p>
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        @endforeach
    </div>
</body>
</html>
