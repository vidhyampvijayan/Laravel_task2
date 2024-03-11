<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function view()
    {
        $cart = Session::get('cart', []);

        return view('cart.view', compact('cart'));
    }
}
