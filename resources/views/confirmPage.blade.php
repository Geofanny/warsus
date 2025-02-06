<x-home.pesanan>
    <div class="container text-center my-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-success">🎉 Pesanan Berhasil!</h2>
            <p class="mt-3">Terima kasih telah berbelanja dengan kami. Pesanan Anda sedang diproses.</p>
            {{-- <p><b>ID Pesanan:</b> {{ $order->id_order }}</p> --}}
            {{-- <p><b>Total Pembayaran:</b> Rp.{{ number_format($order->total_payment, 0, ',', '.') }}</p> --}}
            
            <div class="d-flex justify-content-center gap-2 mt-4">
                <a href="" class="btn btn-primary mt-3">Lihat Riwayat Pesanan</a>
                <a href="/" class="btn btn-outline-secondary mt-3">Kembali ke Beranda</a>
            </div>
        </div>
    </div>    
</x-home.pesanan>