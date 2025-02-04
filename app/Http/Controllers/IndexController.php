<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use App\Models\cartDetail;
use App\Models\Categories;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::get();
        $categories = Categories::with('products')->get();

        return view("index",[
            "products" => $products,
            "categories" => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($name)
    {
        $product = Products::where("name", $name)->firstOrFail();
        return view('detail_produk',["product" => $product]);
    }

    public function addToCart(Request $request, $productId)
    {
        $product = Products::findOrFail($productId);
        
        // Cek apakah user sudah memiliki cart
        $cart = Cart::where('user_id', 1)->first();

        // dd($cart);

        if (!$cart) {
            // Buat cart baru jika belum ada
            $cart = Cart::create([
                'user_id' => 1,
                'total_price' => 0
            ]);
        }

        // Cek apakah produk sudah ada di cart_details
        $cartDetail = cartDetail::where('cart_id', $cart->id_cart)
        ->where('product_id', $productId)
        ->first();

        if ($cartDetail) {
            // Jika sudah ada, tambahkan quantity
            $cartDetail->quantity += $request->quantity;
            $cartDetail->subtotal = $cartDetail->quantity * $product->price;
            $cartDetail->save();
        } else {
            // Jika belum ada, buat baru
            cartDetail::create([
                'cart_id' => $cart->id_cart,
                'product_id' => $productId,
                'quantity' => $request->quantity,
                'subtotal' => $request->quantity * $product->price
            ]);
        }

        // Update total_price di carts
        $cart->total_price = cartDetail::where('cart_id', $cart->id_cart)->sum('subtotal');
        $cart->save();

        return redirect('/index');
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
