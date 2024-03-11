<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function show()
    {
        return view('checkout');
    }

    public function checkout_process(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to checkout.');
        }
    
        $cartItems = $request->session()->get('cart.cart_items', []);
        $userInfo = [
            'name' => $user->name,
            'email' => $user->email,
        ];
    
        $cart = [
            'cart_items' => $cartItems,
            'user_info' => $userInfo
        ];
    
        $order = [];
        foreach ($cartItems as $item) {
            $order[$item['title']] = $item;
        }
    
        $orderModel = new Order();
        $orderModel->user_id = $user->id;
        $orderModel->cart_items = json_encode($cartItems); 
        $orderModel->save();
    
        $request->session()->put('cart', $cart);
        $request->session()->put('order', $order);
    
        return redirect()->route('checkout');
    }
    

}
