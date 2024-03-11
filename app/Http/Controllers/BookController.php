<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Session;
class BookController extends Controller
{
   
    public function index()
    {
        $books = Book::where('status', 'Available')->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.books.create');
    }
    public function store(Request $request)
    {
        $book = new Book();
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->description = $request->input('description');
        $book->price = $request->input('price');
        $book->status = $request->input('status');
        $book->save();

        return response()->json(['success' => true, 'message' => 'Book added successfully'], 200);
    }
    public function addToCart(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        $bookId = $request->input('book_id');
        $book = Book::find($bookId);
    
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }
    
        $cart = Session::get('cart', []);
        $cart['cart_items'][$bookId] = [
            'title' => $book->title,
            'description' => $book->description,
            'price' => $book->price,
            'author' => $book->author
        ];
        Session::put('cart', $cart);  
        return back()->with('success', 'Book added to cart');

    }
}
