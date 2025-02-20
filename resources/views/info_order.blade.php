<x-home.info-pesanan>
    <div class="container my-4">
        <div id="dateCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($completedPayements as $date => $ordersByDate)
                    <div class="carousel-item @if($loop->first) active @endif">
                        @php
                            setlocale(LC_TIME, 'id_ID.utf8');
                            $subtotal = $ordersByDate->sum(function($order) {
                                return $order->orderDetails->sum('subtotal');
                            });
                        @endphp
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-info">Menunggu Konfirmasi</span>
                                <p class="fw-bold text-danger ms-3 mb-0 flex-grow-1 text-end">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                            </div>                            
                            <div class="row">
                                @foreach ($ordersByDate as $order)
                                    @foreach ($order->orderDetails as $detail)
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="card p-2">
                                                <div class="d-flex flex-row flex-wrap">
                                                    <div class="col-4">
                                                        <img src="{{ asset('storage/' . $detail->product->product_image) }}" class="img-fluid rounded-start" alt="Gambar Produk" style="object-fit: cover; height: 100px;">
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $detail->product->name }}</h5>
                                                            <p class="card-text d-flex justify-content-between">
                                                                Rp {{ number_format($detail->product->price, 0, ',', '.') }}
                                                                <span>({{ $detail->quantity }}x)</span>
                                                            </p>
                                                            <p class="card-text text-muted text-end">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="p-2">
                                                    {{-- <p class="fw-bold">Rincian Pesanan:</p> --}}
                                                    {{-- <div class="d-flex justify-content-between">
                                                        <p class="text-muted">Subtotal:</p>
                                                        <p class="text-muted">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <p class="text-muted">Tanggal Pesanan:</p>
                                                        <p class="text-muted">{{ \Carbon\Carbon::parse($date)->locale('id')->translatedFormat('d F Y') }}</p>
                                                    </div>
                                                    <p class="fw-bold">Rincian Pembayaran:</p>
                                                    <div class="d-flex justify-content-between">
                                                        <p class="text-muted">Metode Pembayaran:</p>
                                                        <p class="text-muted">{{ $order->payment->payment_method }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <p class="text-muted">Tanggal Pembayaran:</p>
                                                        <p class="text-muted">{{ \Carbon\Carbon::parse($order->payment->payment_date)->locale('id')->translatedFormat('d F Y') }}</p>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#dateCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#dateCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</x-home.info-pesanan>
