<x-home.pesanan>
    <div class="container">
        <h2 class="text-center">Detail Pesanan</h2>

        <div class="card">
            <div class="card-body">
                <h4>Order ID: {{ $order->id_order }}</h4>
                <p><strong>Tanggal:</strong> {{ $order->order_date }}</p>
                <p><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $order->status)) }}</p>

                <h4 class="mt-3">Detail Produk</h4>
                <ul class="list-group">
                    @foreach ($order->orderDetails as $detail)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $detail->product->name }} (x{{ $detail->quantity }})</span>
                            <span>Rp. {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                        </li>
                    @endforeach
                </ul>

                <h4 class="mt-3 text-end">Total: Rp. {{ number_format($order->total_payment, 0, ',', '.') }}</h4>


                <h4 class="mt-4">Pilih Metode Pembayaran</h4>
                
                <select id="payment-method" class="form-control mt-2">
                    <option value="bank_transfer" {{ $paymentMethod == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                    <option value="e_wallet" {{ $paymentMethod == 'e_wallet' ? 'selected' : '' }}>E-Wallet</option>
                </select>

                <div class="d-flex justify-content-end mt-4">
                    {{-- <span id="snap-token" style="display: none;">{{ $snapToken }}</span> --}}
                    <button class="btn btn-primary" id="pay-button">Checkout</button>
                </div>

            </div>
        </div>
    </div>

    <x-slot name="script">
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

        <script>
            // document.getElementById('payment-method').addEventListener('change', function () {
            //     let selectedMethod = this.value;
            //     window.location.href = `?payment_method=${selectedMethod}`;
            // });
            
            document.getElementById('payment-method').addEventListener('change', function () {
                let selectedMethod = this.value;
                let orderId = "{{ $order->id_order }}";
                let payButton = document.getElementById('pay-button');
                payButton.disabled = true;

                fetch(`/orders/${orderId}?payment_method=${selectedMethod}`, {
                    method: "GET",
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // alert("Metode pembayaran diperbarui!");
                        location.reload();
                        setTimeout(() => {
                            payButton.disabled = false;
                        }, 10000);
                    } else {
                        // alert("Gagal memperbarui metode pembayaran.");
                    }
                })
                .catch(error => console.error("Error:", error));
            });

            document.getElementById('pay-button').addEventListener('click', function () {
                let selectedMethod = document.getElementById('payment-method').value;

                snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result){
                        // alert("Pembayaran berhasil!");

                        // Kirim data ke server via fetch API
                        fetch("{{ route('payment.process') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                order_id: "{{ $order->id_order }}",
                                payment_method: selectedMethod,
                                payment_status: result.transaction_status, // Status dari Midtrans
                                payment_date: result.transaction_time
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // alert("Data pembayaran disimpan!");
                                window.location.href = "/alert";
                            } else {
                                alert("Gagal menyimpan data!");
                            }
                        })
                        .catch(error => console.error("Error:", error));
                    },

                    onPending: function(result){
                        alert("Menunggu pembayaran.");
                    },

                    onError: function(result){
                        alert("Pembayaran gagal.");
                    }
                });
            });
        </script>
        
    </x-slot>
</x-home.pesanan>
