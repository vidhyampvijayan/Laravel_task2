<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 93px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative; 
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            font-weight: bold;
            text-align: right;
            margin-top: 10px;
        }
        .checkout-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .checkout-btn:hover {
            background-color: #0056b3;
        }
        .logout-link {
            position: absolute;
            top: -24px;
            right: -123px;
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('logout') }}" class="logout-link">Logout</a> <!-- Logout link -->
        <h1>View Cart</h1>
        
        @if (isset($cart['cart_items']) && count($cart['cart_items']) > 0)
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Description</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart['cart_items'] as $item)
                        <tr>
                            <td>{{ $item['title'] }}</td>
                            <td>{{ $item['author'] }}</td>
                            <td>{{ $item['description'] }}</td>
                            <td>${{ $item['price'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="total">Total: ${{ array_sum(array_column($cart['cart_items'], 'price')) }}</p>
            <button id="checkout-btn" class="checkout-btn">Proceed to Checkout</button>
        @else
            <p>No items in the cart.</p>
        @endif
    </div>
    <a href="{{ route('BookDetails') }}">Back to Book List</a>

   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#checkout-btn').click(function(e) {
                e.preventDefault(); 

                $.ajax({
                    url: "{{ route('checkout.process') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}", 
                    },
                    success: function(response) {
                   
                        window.location.href = "{{ route('checkout') }}";
                    },
                    error: function(xhr, status, error) {
                      
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>
