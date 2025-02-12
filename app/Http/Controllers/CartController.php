<?php

namespace App\Http\Controllers;

use Exception;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Products;
use App\Models\cartDetail;
use App\Models\orderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function checkout(Request $request)
    {
        $selectedItems = explode(',', $request->selected_items);

        // if (empty($selectedItems)) {
        //     return redirect()->back()->with('error', 'Pilih setidaknya satu produk untuk checkout.');
        // }

        DB::beginTransaction();
        try {
            $totalPayment = 0;
            $order = Order::create([
                'user_id' => 1,
                'order_date' => now(),
                'total_payment' => 0,
                'status' => 'awaiting_payment'
            ]);

            foreach ($selectedItems as $cartDetailId) {
                $cartDetail = cartDetail::findOrFail($cartDetailId);
                $product = $cartDetail->product;
                $quantity = $cartDetail->quantity;
                $subtotal = $product->price * $quantity;

                orderDetail::create([
                    'order_id' => $order->id_order,
                    'product_id' => $product->id_product,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal
                ]);

                $totalPayment += $subtotal;

                $cartDetail->delete();
            }

            $order->update(['total_payment' => $totalPayment]);

            DB::commit();
            // return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat.');
            return redirect('/alert');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat checkout.');
        }
    }

    public function createOrder(Request $request)
    {
        // $user = Auth::user();
        $selectedItems = explode(',', $request->selected_items);
        // if (empty($selectedItems)) {
        //     return redirect()->back()->with('error', 'Silakan pilih item terlebih dahulu.');
        // }

        // Buat pesanan baru
        $order = Order::create([
            'user_id' => 1,
            'order_date' => now(),
            'total_payment' => 0,
            'status' => 'awaiting_payment'
        ]);

        $totalPayment = 0;
        foreach ($selectedItems as $cartDetailId) {
            $cartDetail = cartDetail::find($cartDetailId);
            if ($cartDetail) {
                orderDetail::create([
                    'order_id' => $order->id_order,
                    'product_id' => $cartDetail->product_id,
                    'quantity' => $cartDetail->quantity,
                    'subtotal' => $cartDetail->subtotal,
                ]);
                $totalPayment += $cartDetail->subtotal;
                $cartDetail->delete();
            }
        }

        // Update total pembayaran
        $order->update(['total_payment' => $totalPayment]);

        return redirect()->route('orders.show', $order->id_order);
    }

}
