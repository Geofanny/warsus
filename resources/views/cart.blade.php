<x-home.index>
    <style>
        .product-image {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>

    <div class="col-12">
        <div class="card shadow">
            <div class="container my-4">            
                @if ($cart && $cart->cartDetails->count() > 0)
                    <div class="row">
                        @foreach ($cart->cartDetails as $cartDetail)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card shadow-sm border-0">
                                    <div class="row g-0">
                                        <div class="col-4">
                                            <img src="{{ asset("storage/".$cartDetail->product->product_image) }} ?? 'https://via.placeholder.com/150' }}" 
                                                 class="img-fluid rounded-start product-image" 
                                                 alt="Gambar Produk">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $cartDetail->product->name }}</h5>
                                                <p class="card-text text-danger">
                                                    Rp.{{ number_format($cartDetail->product->price ?? 0) }}
                                                </p>
                                                <p class="card-text">
                                                    <small class="text-muted">Jumlah: {{ $cartDetail->quantity }}</small>
                                                </p>
            
                                                <div class="d-flex justify-content-between">
                                                    <p class="card-text">
                                                        <b class="text-success">Total: Rp.{{ number_format($cartDetail->subtotal) }}</b>
                                                    </p>
                                                    <input type="checkbox" name="selected_items[]" value="{{ $cartDetail->id_cart_detail }}" data-subtotal="{{ $cartDetail->subtotal }}" class="item-checkbox">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
            
                    <div class="container-fluid">
                        <div>
                            <h1>
                                <span class="text-danger" id="totPrice"><b><span id="total-price"></span></b></span>
                            </h1>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <form id="delete-form" action="{{ route('cart.delete') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="selected_items" id="selected-items">
                                <button type="submit" id="btn-delete" class="btn btn-outline-danger btn-lg" disabled>Hapus</button>
                            </form>                                                        
    
                            <form action="" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-lg" id="btn-checkout" disabled>Checkout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning text-center">
                        <h5>Keranjang masih kosong 😢</h5>
                        <a href="/" class="btn btn-primary mt-2">Belanja Sekarang</a>
                    </div>
                @endif
            </div>
            
        </div>
    </div>

    <x-slot name="script">
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const checkboxes = document.querySelectorAll(".item-checkbox");
                const totalPriceElement = document.getElementById("total-price");
                const totPrice = document.getElementById("totPrice");
                const btnDelete = document.getElementById("btn-delete");
                const btnCheckout = document.getElementById("btn-checkout");
        
                let totalPrice = 0;

                const deleteForm = document.getElementById("delete-form");
                const selectedItemsInput = document.getElementById("selected-items");

                deleteForm.addEventListener("submit", function (event) {
                    let selectedIds = [];
                    checkboxes.forEach(checkbox => {
                        if (checkbox.checked) {
                            selectedIds.push(checkbox.value);
                        }
                    });

                    selectedItemsInput.value = selectedIds.join(",");

                    if (selectedIds.length === 0) {
                        event.preventDefault();
                    }
                });

        
                function updateTotal() {
                    totalPrice = 0;
                    let selectedCount = 0;
        
                    checkboxes.forEach(checkbox => {
                        if (checkbox.checked) {
                            totalPrice += parseFloat(checkbox.dataset.subtotal);
                            selectedCount++;
                        }
                    });

                    if (selectedCount > 0) {
                        totPrice.style.display = "block";
                        totalPriceElement.textContent = totalPrice.toLocaleString("id-ID");
                    } else {
                        totPrice.style.display = "none";
                    }
        
                    totalPriceElement.textContent = "Rp." + totalPrice.toLocaleString("id-ID");
                    btnDelete.disabled = selectedCount === 0;
                    btnCheckout.disabled = selectedCount === 0;
                }
        
                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener("change", updateTotal);
                });
            });
        </script>
    </x-slot>

</x-home.index>