<x-home.pesanan>
    <div class="container text-center">
        <h2>Halaman Pembayaran</h2>
        <p>Order ID: {{ $order->id_order }}</p>
        <p>Total Pembayaran: Rp{{ number_format($order->total_payment, 0, ',', '.') }}</p>

        <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>

        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
        </script>
        <script>
            document.getElementById('pay-button').onclick = function() {
                snap.pay("{{ $snapToken }}", {
                    onSuccess: function(result) {
                        alert("Pembayaran sukses!");
                        // window.location.href = "/";
                    },
                    onPending: function(result) {
                        alert("Menunggu pembayaran...");
                    },
                    onError: function(result) {
                        alert("Pembayaran gagal!");
                    }
                });
            };
        </script>
    </div>
</x-home.pesanan>
