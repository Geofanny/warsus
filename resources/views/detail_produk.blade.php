<x-home.pesanan>
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <!-- Tombol Kembali di Atas -->
                <div class="mb-3 d-flex justify-content-md-start justify-content-start">
                    <a href="/index" class="btn btn-danger btn-lg px-4 py-2 shadow-sm btn-sm">
                        <i class="fa-solid fa-arrow-left me-2"></i> Kembali
                    </a>
                </div>
                <div class="row">
                    <!-- Bagian Gambar -->
                    <div class="col-md-4 col-12 mb-4">
                        <div class="card">
                            <div class="card-body d-flex justify-content-center align-items-center" style="height: 250px;">
                                <img src="{{ asset('storage/'.$product->product_image) }}" id="previewImage" alt="image product" class="img-fluid" style="max-height: 100%; object-fit: cover;">
                            </div>                                    
                        </div>                                
                        <h2 class="text-center mt-3"><b>{{ $product->name }}</b></h2>
                    </div>
            
                    <!-- Bagian Data Produk -->
                    <div class="col-md-8 col-12 border-md-start border-black">
                        <h5 class="text-capitalize">
                            <b>Detail {{ $product->name }}</b>
                        </h5>
                        <hr>
                        <div class="row text-muted">
                            <div class="col-md-6 col-12">
                                <p>
                                    <b>Stock : {{ $product->stock }}</b>
                                </p>
                                <p>
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>               
            </div>
        </div>
    </div>
    

    <style>
        @media (max-width: 768px) {
            .mobile-center {
                justify-content: center !important;
                text-align: center;
            }
        }
    </style>
    
    <div class="container-fluid fixed-bottom bg-light">
        <form action="/product/{{ $product->id_product }}/post" method="post">
            @csrf
            <div class="row p-3 d-flex align-items-center">
                <!-- Bagian Kiri (Total Harga dan Qty) -->
                <div class="col-12 col-md-5 d-flex align-items-center p-2 flex-wrap mobile-center">
                    <h1 class="mb-0 mx-3">
                        <span class="text-danger" id="subtotal"><b>Rp.{{ number_format($product->price * 1) }}</b></span>
                    </h1>
        
                    <div class="input-group mx-3" style="max-width: 120px;">
                        <button class="btn btn-dark btn-sm" type="button" id="btnMinus"><i class="fa-solid fa-minus"></i></button>
                        <input type="text" class="form-control form-control-sm text-center" readonly value="1" id="formInput" name="quantity" style="border: none;">
                        <button class="btn btn-dark btn-sm" type="button" id="btnPlus"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>
        
                <!-- Bagian Kanan (Tombol Keranjang dan Checkout) -->
                <div class="col-12 col-md-7 d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning w-50 me-3 py-3 text-center">Keranjang</button>
                    <a href="#" class="btn btn-success w-50 py-3">Checkout</a>
                </div>
            </div>
        </form>
    </div>

    <x-slot name="script">
        <script>
            let btnMinus = document.getElementById("btnMinus");
            let btnPlus = document.getElementById("btnPlus");
            let inputNumber = document.getElementById("formInput");
            let subtotal = document.getElementById("subtotal");
        
            let qty = parseInt(inputNumber.value);
            let price = {{ $product->price }};  // harga produk dari
            
            // menghitung harga total
            function updateSubtotal() {
                let total = qty * price;
                subtotal.innerHTML = "<b>Rp." + total.toLocaleString() + "</b>"; // Format angka
            }
        
            // Plus
            btnPlus.addEventListener("click", function(){
                qty++;
                inputNumber.value = qty;
                updateSubtotal();
            });
        
            // Minus
            btnMinus.addEventListener("click", function(){
                if (qty > 1) {
                    qty--;
                    inputNumber.value = qty;
                    updateSubtotal();
                }
            });
        
            updateSubtotal();
        </script>
    </x-slot>
</x-home.pesanan>