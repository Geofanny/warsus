<x-home.index>
    <div class="d-flex justify-content-center align-items-center p-2">
        <div class="container-fluid mb-5">
            <h3 class="mb-4">Daftar Pesanan Belum Dibayar</h3>

            <form action="" method="POST">
                @csrf
                <table style="width: 100%; border-collapse: collapse;" class="">
                    <thead>
                        <tr style="background-color: #f8f9fa;">
                            <th style="padding: 10px; border-bottom: 2px solid #ddd;">✔</th>
                            <th style="padding: 10px; border-bottom: 2px solid #ddd;">Produk</th>
                            <th style="padding: 10px; border-bottom: 2px solid #ddd;">Harga</th>
                            <th style="padding: 10px; border-bottom: 2px solid #ddd;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($waitingPayments as $date => $ordersByDate)
                            <tr style="background-color: #f1f1f1; font-weight: bold;">
                                <td colspan="4" style="padding: 10px;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <input type="checkbox" class="select-date" data-date="{{ $date }}">
                                            Pesanan Tanggal: {{ date('d-m-Y', strtotime($date)) }}
                                        </div>
                                        <a href="#" class="text-danger">Batalkan</a>
                                    </div>
                                </td>
                            </tr>

                            @php $totalHarga = 0; @endphp

                            @foreach ($ordersByDate as $order)
                                @foreach ($order->orderDetails as $detail)
                                    @php $totalHarga += $detail->subtotal; @endphp
                                    <tr>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">
                                            {{-- <input type="checkbox" name="order_ids[]" class="order-checkbox" value="{{ $order->id_order }}" data-date="{{ $date }}"> --}}
                                        </td>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">
                                            <img src="{{ asset('storage/' . $detail->product->product_image) }}"
                                                alt="image product" class="img-fluid"
                                                style="max-height: 5vh; object-fit: cover;">
                                            {{ $detail->product->name ?? 'Produk Tidak Ditemukan' }}
                                            (x{{ $detail->quantity }})
                                        </td>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">
                                            Rp {{ number_format($detail->product->price, 0, ',', '.') }}
                                        </td>
                                        <td style="padding: 10px; border-bottom: 1px solid #ddd;">
                                            Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach

                            <!-- Subtotal untuk tanggal ini -->
                            <tr style="background-color: #f8f9fa; font-weight: bold;">
                                <td colspan="3" style="padding: 10px; text-align: right;">Subtotal:</td>
                                <td style="padding: 10px;">Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-between mt-3">
                    <a href="/order" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn btn-primary" id="bayar-btn" disabled>Bayar Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</x-home.index>