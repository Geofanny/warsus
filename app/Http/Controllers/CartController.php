<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\cartDetail;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', 1)->with('cartDetails.product')->first();
        return view('cart',['cart' => $cart]);
    }

    public function delete(Request $request)
    {
        $selectedItems = explode(",", $request->selected_items);
        cartDetail::whereIn('id_cart_detail', $selectedItems)->delete();

        return redirect('/cart');
    }
}
