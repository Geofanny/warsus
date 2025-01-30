<x-dashboard.dashboard>
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Product</h6>
                </div>
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
                                <input class="form-control mt-3" name="img" id="formFileSm" type="file">
                            </div>
                    
                            <!-- Bagian Data Produk -->
                            <div class="col-md-8 col-12 border-md-start border-black">
                                <h5>Edit Product</h5>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12">
                                        <label for="name" class="form-label">Name Product</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter name product" value="{{ $product->name }}" id="name">
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label for="category" class="form-label">Category</label>
                                        <select id="category" class="form-control" name="category">
                                            <option selected disabled>Selected Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id_category }}" class="text-capitalize" {{ $category->id_category == $product->category ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                    
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="text" class="form-control" placeholder="Enter price product" value="{{ $product->price }}" id="price">
                                        <input type="hidden" name="price" id="price_raw">
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="number" name="stock" class="form-control" placeholder="Enter stock product" value="{{ $product->stock }}" id="stock">
                                    </div>
                                </div>
                    
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" name="desc" placeholder="Enter description product" id="description" style="height: 100px;">{{ $product->description }}</textarea>
                                </div>
                    
                                <div class="d-flex justify-content-between">
                                    <a href="/dashboard-products" class="btn btn-danger">Back</a>
                                    <button class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>    

    <x-slot name="script">
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.getElementById('formFileSm');
                const previewImage = document.getElementById('previewImage');

                fileInput.addEventListener('change', function() {
                    const file = fileInput.files[0];

                    if (file) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            previewImage.src = e.target.result;
                        }

                        reader.readAsDataURL(file);
                    }
                });
            });

            document.getElementById('stock').addEventListener('input', function (e) {
                let value = parseInt(e.target.value, 10);

                // Jika input kosong, biarkan kosong
                if (e.target.value === '') {
                    return;
                }

                // Jika input lebih kecil dari 1 atau tidak valid, ubah menjadi 1
                if (value < 1 || isNaN(value)) {
                    e.target.value = 1;
                }
            });

            document.getElementById('price').addEventListener('input', function (e) {
                let rawValue = e.target.value.replace(/\D/g, ''); // Hanya angka

                // Jika input kosong, set ke nilai default '1'
                if (rawValue === '') {
                    e.target.value = ''; // Biarkan kosong
                    document.getElementById('price_raw').value = ''; // Set nilai raw ke kosong
                    return;
                }

                let numericValue = parseInt(rawValue, 10) || 1;
            
                // Format angka dengan pemisah ribuan
                let formattedValue = new Intl.NumberFormat('id-ID').format(numericValue); 
            
                e.target.value = formattedValue; // Tampilkan format harga
                document.getElementById('price_raw').value = numericValue; // Simpan angka asli
            });

            document.addEventListener('DOMContentLoaded', function () {
    // Ambil nilai awal dari input price dan simpan dalam raw (angka murni)
    let initialPrice = document.getElementById('price').value.replace(/\D/g, ''); // Hapus karakter non-angka
    let numericValue = parseInt(initialPrice, 10) || 1;
    document.getElementById('price_raw').value = numericValue; // Simpan dalam hidden input (raw)

    // Format harga dengan pemisah ribuan dan tampilkan di input
    let formattedValue = new Intl.NumberFormat('id-ID').format(numericValue);
    document.getElementById('price').value = formattedValue;

    // Menambahkan event listener untuk menangani perubahan
    document.getElementById('price').addEventListener('input', function (e) {
        let rawValue = e.target.value.replace(/\D/g, ''); // Menghapus semua karakter non-angka
        if (rawValue === '') {
            e.target.value = ''; // Biarkan kosong
            document.getElementById('price_raw').value = ''; // Set nilai raw ke kosong
            return;
        }

        let numericValue = parseInt(rawValue, 10) || 1; // Menghindari nilai 0 atau negatif

        // Format angka dengan pemisah ribuan
        let formattedValue = new Intl.NumberFormat('id-ID').format(numericValue); 

        e.target.value = formattedValue; // Tampilkan format harga
        document.getElementById('price_raw').value = numericValue; // Simpan angka asli
    });

    // Menangani kasus jika tidak ada perubahan, ambil value dari id price
    document.getElementById('price').addEventListener('blur', function () {
        if (this.value === document.getElementById('price_raw').value) {
            // Jika tidak ada perubahan, set ulang value raw ke format angka murni tanpa pemisah ribuan
            let rawValue = this.value.replace(/\D/g, '');
            document.getElementById('price_raw').value = rawValue;
        }
    });
});
        </script>
    </x-slot>
</x-dashboard.dashboard>