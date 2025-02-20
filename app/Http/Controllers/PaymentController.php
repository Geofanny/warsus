<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;
use App\Models\cartDetail;
use App\Models\orderDetail;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // public function checkout(Request $request)
    // {
    //     // $user = Auth::user();
    //     $selectedItems = explode(',', $request->selected_items);
    //     if (empty($selectedItems)) {
    //         return redirect()->back()->with('error', 'Tidak ada item yang dipilih.');
    //     }

    //     // Buat pesanan baru
    //     $order = Order::create([
    //         'user_id' => 1,
    //         'order_date' => now(),
    //         'total_payment' => 0,
    //         'status' => 'awaiting_payment'
    //     ]);

    //     $totalPayment = 0;
    //     foreach ($selectedItems as $cartDetailId) {
    //         $cartDetail = cartDetail::find($cartDetailId);
    //         if ($cartDetail) {
    //             orderDetail::create([
    //                 'order_id' => $order->id_order,
    //                 'product_id' => $cartDetail->product_id,
    //                 'quantity' => $cartDetail->quantity,
    //                 'subtotal' => $cartDetail->subtotal,
    //             ]);
    //             $totalPayment += $cartDetail->subtotal;
    //             $cartDetail->delete(); // Hapus item dari keranjang setelah checkout
    //         }
    //     }

    //     // Update total pembayaran
    //     $order->update(['total_payment' => $totalPayment]);

    //     // Konfigurasi Midtrans
    //     Config::$serverKey = config('midtrans.server_key');
    //     Config::$isProduction = config('midtrans.is_production');
    //     Config::$isSanitized = config('midtrans.is_sanitized');
    //     Config::$is3ds = config('midtrans.is_3ds');

    //     $params = [
    //         'transaction_details' => [
    //             'order_id' => $order->id_order,
    //             'gross_amount' => $order->total_payment,
    //         ],
    //         'customer_details' => [
    //             'first_name' => "jamal",
    //             'email' => "jamal@gmail.com",
    //         ]
    //     ];

    //     $snapToken = Snap::getSnapToken($params);

    //     return view('pembayaran', compact('snapToken', 'order'));
    // }

    // public function handleNotification(Request $request)
    // {
    //     // Konfigurasi Midtrans
    //     Config::$serverKey = config('midtrans.server_key');
    //     Config::$isProduction = config('midtrans.is_production');
    //     Config::$isSanitized = config('midtrans.is_sanitized');
    //     Config::$is3ds = config('midtrans.is_3ds');

    //     // Ambil data dari Midtrans
    //     $notif = $request->all();
    //     $orderId = explode("-", $notif['order_id'])[0]; // Ambil ID order dari order_id Midtrans
    //     $transactionStatus = $notif['transaction_status'];
    //     $paymentType = $notif['payment_type'];

    //     // Simpan atau update pembayaran di tabel `payments`
    //     $payment = Payment::updateOrCreate(
    //         ['order_id' => $orderId],
    //         [
    //             'payment_method' => $paymentType,
    //             'payment_status' => $transactionStatus,
    //             'payment_date' => now(),
    //         ]
    //     );

    //     // Update status order jika pembayaran berhasil
    //     if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
    //         Order::where('id_order', $orderId)->update(['status' => 'paid']);
    //     } elseif ($transactionStatus == 'pending') {
    //         Order::where('id_order', $orderId)->update(['status' => 'pending_payment']);
    //     } elseif ($transactionStatus == 'expire' || $transactionStatus == 'cancel') {
    //         Order::where('id_order', $orderId)->update(['status' => 'failed']);
    //     }

    //     return response()->json(['message' => 'Notification processed']);
    // }

    // public function processPayment(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'order_id' => 'required|exists:orders,id_order',
    //         'payment_method' => 'required|string'
    //     ]);

    //     $order = Order::findOrFail($request->order_id);

    //     // Simpan data pembayaran ke tabel `payments`
    //     Payment::create([
    //         'order_id'       => $order->id_order,
    //         'payment_method' => $request->payment_method,
    //         'payment_status' => 'pending',
    //         'payment_date'   => now(),
    //     ]);


    //     // Redirect kembali dengan pesan sukses
    //     return redirect()->back()->with('success', 'Pembayaran berhasil dicatat!');
    // }

    // public function processPayment(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'order_id' => 'required|exists:orders,id_order',
    //         'payment_method' => 'required|string'
    //     ]);

    //     // Ambil data pesanan
    //     $order = Order::findOrFail($request->order_id);

    //     // Simpan data pembayaran ke database
    //     Payment::create([
    //         'order_id'       => $order->id_order,
    //         'payment_method' => $request->payment_method,
    //         'payment_status' => 'pending',
    //         'payment_date'   => now(),
    //     ]);

    //     // Konfigurasi Midtrans
    //     Config::$serverKey = config('midtrans.server_key');
    //     Config::$isProduction = config('midtrans.is_production');
    //     Config::$isSanitized = config('midtrans.is_sanitized');
    //     Config::$is3ds = config('midtrans.is_3ds');

    //     $params = [
    //         'transaction_details' => [
    //             'order_id' => $order->id_order,
    //             'gross_amount' => $order->total_payment,
    //         ],
    //         'customer_details' => [
    //             'first_name' => "jamal",
    //             'email' => "jamal@gmail.com",
    //         ]
    //     ];

    //     $snapToken = Snap::getSnapToken($params);
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'order_id' => 'required|integer',
    //         'payment_method' => 'required|string|in:bank_transfer,e_wallet',
    //     ]);

    //     $paymentMethod = $request->payment_method === 'e_wallet' ? 'e-wallet' : 'bank_transfer';

    //     // Simpan ke database
    //     Payment::create([
    //         'order_id' => $request->order_id,
    //         'payment_method' => "$paymentMethod",
    //         'payment_status' => 'successful',
    //         'payment_date' => now(),
    //     ]);

    //     Order::where('id_order', $request->order_id)->update([
    //         'status' => 'completed',
    //     ]);

    //     return redirect()->back()->with('success', 'Metode pembayaran telah dipilih. Lanjutkan proses pembayaran.');
    // }

    public function processPayment(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'payment_method' => 'required|string|in:bank_transfer,e_wallet',
            'payment_status' => 'required|string',
            'payment_date' => 'required|date',
        ]);
    
        // Jika pembayaran sukses, baru simpan ke database
        if ($request->payment_status == 'settlement') {
            Payment::create([
                'order_id' => $request->order_id,
                'payment_method' => $request->payment_method === 'e_wallet' ? 'e-wallet' : 'bank_transfer',
                'payment_status' => 'successful',
                'payment_date' => $request->payment_date,
            ]);
    
            // Update status order menjadi "completed"
            Order::where('id_order', $request->order_id)->update(['status' => 'completed']);
    
            return response()->json(['success' => true]);
        }
    
        return response()->json(['success' => false]);
        return redirect('/');
    }

    public function handleNotification(Request $request)
    {
        $notif = $request->all();
        
        $orderId = explode('-', $notif['order_id'])[0]; // Ambil order_id asli
        $transactionStatus = $notif['transaction_status'];

        // Update status pembayaran di database
        if ($transactionStatus == 'settlement') {
            Payment::updateOrCreate(
                ['order_id' => $orderId],
                [
                    'payment_status' => 'successful',
                    'payment_date' => now(),
                ]
            );

            Order::where('id_order', $orderId)->update(['status' => 'completed']);
        } elseif ($transactionStatus == 'expire') {
            Order::where('id_order', $orderId)->update(['status' => 'failed']);
        }

        return response()->json(['message' => 'Notifikasi diproses']);
    }

    public function updatePaymentMethod(Request $request)
    {
        $order = Order::with('orderDetails.product')->findOrFail($request->order_id);

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Pilih metode pembayaran berdasarkan input user
        $paymentMethod = $request->payment_method;
        $params = [
            'transaction_details' => [
                'order_id' => $order->id_order . '-' . time(),
                'gross_amount' => $order->total_payment,
            ],
            'customer_details' => [
                'first_name' => "jamal",
                'email' => "jamal@gmail.com",
            ]
        ];

        if ($paymentMethod == "bank_transfer") {
            $params['enabled_payments'] = ["bca_va", "bni_va", "bri_va", "permata_va"];
        } elseif ($paymentMethod == "e_wallet") {
            $params['enabled_payments'] = ["gopay", "shopeepay", "ovo"];
        }

        // Generate Snap Token baru
        $snapToken = Snap::getSnapToken($params);

        return response()->json(['snapToken' => $snapToken]);
    }

}
