<x-home.index>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form action="/product/{{ $product->id_product }}/update" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Bagian Gambar -->
                                <div class="col-md-4 col-12 mb-4">
                                    <div class="card">
                                        <div class="card-body d-flex justify-content-center align-items-center" style="height: 250px;">
                                            <img src="{{ asset('storage/'.$product->product_image) }}" id="previewImage" alt="image product" class="img-fluid" style="max-height: 100%; object-fit: cover;">
                                        </div>                                    
                                    </div>                                
                                    <h2 class="text-center mt-3"><b>{{ $product->name }}</b></h2>
                                    {{-- <h3 class="text-center text-danger"><b>Rp.{{ number_format($product->price, 2) }}</b></h3> --}}
                                    <a href="/index" class="btn btn-danger">Kembali</a>
                                </div>
                        
                                <!-- Bagian Data Produk -->
                                <div class="col-md-8 col-12 border-md-start border-black">
                                    <h5 class="text-capitalize">
                                        <b>
                                            Detail {{ $product->name }}
                                        </b>
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
                                        <hr>
                                    </div>

                                    <p>Qty:</p>
                                    <div class="input-group mb-3">
                                        <button class="btn btn-dark btn-sm" type="button" id="btnPlus"><i class="fa-solid fa-minus"></i></button>
                                        <input type="text" class="form-control form-control-sm" readonly value="1" id="formInput">
                                        <button class="btn btn-sm btn-dark" type="button" id="btnMinus"><i class="fa-solid fa-plus"></i></button>
                                    </div>

                                    <div class="mt-4 mb-4">
                                        <h3>Harga :
                                            <span class="text-danger"><b>Rp.{{ number_format($product->price) }}</b></span>
                                        </h3>
                                    </div>

                                    <div class="d-flex justify-content-between mb-3">
                                        <a href="/dashboard-products" class="btn btn-warning">Masukkan Keranjang</a>
                                        <button class="btn btn-success">Checkout</button>
                                    </div>
                                </div>
                            </div>
                        </form>                    
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <x-slot name="script">
        <script>
            let btnMinus = document.getElementById("btnPlus");
            let btnPlus = document.getElementById("btnMinus");
            let inputNumber = document.getElementById("formInput");

            let parseInteger = parseInt(inputNumber.value);

            btnPlus.addEventListener("click", function(){
                parseInteger++
                inputNumber.value = parseInteger;
            })

            btnMinus.addEventListener("click", function(){
                if(parseInteger > 1){
                    parseInteger--
                    inputNumber.value = parseInteger;
                }
            })
        </script>
    </x-slot>
</x-home.index>