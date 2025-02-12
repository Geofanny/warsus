<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;
use App\Models\cartDetail;
use App\Models\orderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    // public function show($id, Request $request)
    // {
    //     $order = Order::with(['orderDetails.product'])->findOrFail($id);

    //     // Konfigurasi Midtrans
    //     Config::$serverKey = config('midtrans.server_key');
    //     Config::$isProduction = config('midtrans.is_production');
    //     Config::$isSanitized = config('midtrans.is_sanitized');
    //     Config::$is3ds = config('midtrans.is_3ds');

    //     // Ambil metode pembayaran dari URL (default: bank_transfer)
    //     $paymentMethod = $request->query('payment_method', 'bank_transfer');
        
    //     // Tentukan metode pembayaran yang diperbolehkan
    //     $paymentOptions = [
    //         'bank_transfer' => ["bni_va", "bri_va", "permata_va","bca_va"],
    //         'e_wallet' => ["gopay", "shopeepay", "ovo"]
    //     ];

    //     // Buat parameter untuk Midtrans
    //     $params = [
    //         'transaction_details' => [
    //             'order_id' => $order->id_order . '-' . time(),
    //             'gross_amount' => $order->total_payment,
    //         ],
    //         'customer_details' => [
    //             'first_name' => "Jamal",
    //             'email' => "jamal@gmail.com",
    //         ],
    //         'enabled_payments' => $paymentOptions[$paymentMethod] ?? $paymentOptions['bank_transfer']
    //     ];

    //     // Dapatkan Snap Token dari Midtrans
    //     $snapToken = Snap::getSnapToken($params);

    //     return view('order', compact('order', 'snapToken', 'paymentMethod'));
    // }

    public function show($id, Request $request)
    {
        $order = Order::with(['orderDetails.product'])->findOrFail($id);

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Ambil metode pembayaran dari query parameter atau session
        $paymentMethod = $request->query('payment_method', session("payment_method_{$id}", 'bank_transfer'));

        // Simpan metode pembayaran di session
        session(["payment_method_{$id}" => $paymentMethod]);

        // Tentukan metode pembayaran yang diperbolehkan berdasarkan pilihan user
        $paymentOptions = [
            'bank_transfer' => ["bni_va", "bri_va", "permata_va", "bca_va"],
            'e_wallet' => ["gopay", "shopeepay", "ovo"]
        ];

        // Jika metode yang dipilih tidak ada di daftar, fallback ke bank_transfer
        if (!array_key_exists($paymentMethod, $paymentOptions)) {
            $paymentMethod = 'bank_transfer';
        }

        // Buat parameter untuk Midtrans dengan filter metode pembayaran berdasarkan pilihan user
        $params = [
            'transaction_details' => [
                'order_id' => $order->id_order . '-' . time(),
                'gross_amount' => $order->total_payment,
            ],
            'customer_details' => [
                'first_name' => "Jamal",
                'email' => "jamal@gmail.com",
            ],
            'enabled_payments' => $paymentOptions[$paymentMethod] ?? $paymentOptions['bank_transfer']
        ];

        // Dapatkan Snap Token dari Midtrans
        $snapToken = Snap::getSnapToken($params);

        // Jika request AJAX, kirim respons tanpa reload halaman
        if ($request->ajax()) {
            return response()->json(['success' => true, 'paymentMethod' => $paymentMethod]);
        }

        return view('order', compact('order', 'snapToken', 'paymentMethod'));
    }

//     public function show($id, Request $request)
// {
//     $order = Order::with(['orderDetails.product'])->findOrFail($id);

//     // Konfigurasi Midtrans
//     Config::$serverKey = config('midtrans.server_key');
//     Config::$isProduction = config('midtrans.is_production');
//     Config::$isSanitized = config('midtrans.is_sanitized');
//     Config::$is3ds = config('midtrans.is_3ds');

//     // Ambil metode pembayaran dari URL (default: bank_transfer)
//     $paymentMethod = $request->query('payment_method', 'bank_transfer');

//     // Tentukan metode pembayaran yang diperbolehkan
//     $paymentOptions = [
//         'bank_transfer' => ["bni_va", "bri_va", "permata_va", "bca_va"],
//         'e_wallet' => ["gopay", "shopeepay", "ovo"]
//     ];

//     // Buat parameter untuk Midtrans
//     $params = [
//         'transaction_details' => [
//             'order_id' => $order->id_order . '-' . time(),
//             'gross_amount' => $order->total_payment,
//         ],
//         'customer_details' => [
//             'first_name' => "Jamal",
//             'email' => "jamal@gmail.com",
//         ],
//         'enabled_payments' => $paymentOptions[$paymentMethod] ?? $paymentOptions['bank_transfer']
//     ];

//     // Dapatkan Snap Token dari Midtrans
//     $snapToken = Snap::getSnapToken($params);

//     // Cek apakah ini permintaan AJAX
//     if ($request->ajax()) {
//         return response()->json([
//             'paymentOptions' => $paymentOptions[$paymentMethod],
//             'snapToken' => $snapToken
//         ]);
//     }

//     // Jika bukan AJAX, tampilkan halaman
//     return view('order', compact('order', 'snapToken', 'paymentMethod'));
// }


}
