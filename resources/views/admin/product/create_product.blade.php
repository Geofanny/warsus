<x-dashboard.dashboard>
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Product</h6>
                </div>
                <div class="card-body">
                    <form action="/product/post" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Bagian Gambar -->
                            <div class="col-md-4 col-12 mb-4">
                                <div class="card">
                                    <div class="card-body d-flex justify-content-center align-items-center" style="height: 250px;">
                                        <img src="" id="previewImage" alt="image product" class="img-fluid" style="max-height: 100%; object-fit: cover;">
                                    </div>
                                </div>
                                <input class="form-control mt-3" name="img" id="formFileSm" type="file" accept=".jpg, .jpeg, .png" required>
                            </div>
                    
                            <!-- Bagian Data Produk -->
                            <div class="col-md-8 col-12 border-md-start border-black">
                                <h5>Data Product</h5>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12">
                                        <label for="name" class="form-label">Name Product</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter name product" id="name" required>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label for="category" class="form-label">Category</label>
                                        <select id="category" class="form-control" name="category" required>
                                            <option selected disabled>Selected Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id_category }}" class="text-capitalize">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                    
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="text" class="form-control" placeholder="Enter price product" id="price" required>
                                        <input type="hidden" name="price" id="price_raw">
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="number" name="stock" class="form-control" placeholder="Enter stock product" id="stock" required>
                                    </div>
                                </div>
                    
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" name="desc" placeholder="Enter description product" id="description" required style="height: 100px"></textarea>
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
        </script>
        
       
        <script>
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
        </script>
    </x-slot>
</x-dashboard.dashboard>