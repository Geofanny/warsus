<x-dashboard.dashboard>
    <style>
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -8px;
            background-color: red;
            color: white;
            font-size: 10px;
            font-weight: bold;
            border-radius: 50%;
            padding: 2px 6px;
            min-width: 18px;
            text-align: center;
            line-height: 1;
        }
    </style>

    <x-slot name="link">
        <!-- Custom styles for this page -->
        <link href="assets-admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

        <meta name="csrf-token" content="{{ csrf_token() }}">

    </x-slot>

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products</h1>

    {{-- <a href="" class="btn btn-sm btn-success mb-3">Add products +</a> --}}

    <div class="row">
        <div class="col-xl-9 col-lg-7">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Products</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Print">
                            <i class="fas fa-solid fa-download fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">PDF <i class="fas fa-solid fa-file-pdf"></i></a>
                            <a class="dropdown-item" href="#">Excel <i class="fas fa-regular fa-file-excel"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <a href="/product/create" class="btn btn-sm btn-success mb-3">Add new products +</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>stock</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($products as $product )
                                    <tr class="text-capitalize">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="badge rounded-pill category-badge text-white text-capitalize"
                                                  data-category="{{ $product->dataCategory->name }}">
                                                {{ $product->dataCategory->name }}
                                            </span>
                                        </td>
                                        <td>
                                            {{-- <img src="{{ asset("storage/".$product->product_image ) }}" class="img-fluid rounded mx-auto d-block" alt=""> --}}
                                            <button class="btn btn-dark btn-sm view-image" 
                                                    data-image="{{ asset("storage/".$product->product_image) }}" 
                                                    data-name="{{ $product->description }}">
                                                    View
                                            </button>
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->stock }}</td>
                                        {{-- <td>{{ $product->id_product }}</td> --}}
                                        <td>
                                            <a href="/product/{{ $product->id_product }}/edit" class="btn btn-sm btn-secondary">Edit</a>
                                            <a href="javascript:void(0);" class="btn btn-danger btn-sm delete-product" data-id="{{ $product->id_product }}">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="imageModalLabel">Product Image</h5>
                                                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img id="modalImage" src="" class="img-fluid rounded" style="max-width: 200px; height: auto;" alt="Product Image">
                                                    <p class="mt-2" id="modalProductName" style="font-size: 14px; font-weight: 600;"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
        {{-- Categories --}}
        <div class="col-xl-3 col-lg-5">
            {{-- View Categories --}}
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="/dashboard-categories" title="add new category">
                            <i class="fas fa-plus fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    @foreach ($categories as $category)
                    @php
                        $productCount = $products->where('dataCategory.name', $category->name)->count();
                    @endphp
                    <span class="badge rounded-pill random-badge mr-2 text-white text-capitalize position-relative"
                        data-category="{{ $category->name }}">
                        {{ $category->name }}
                        <span class="notification-badge">{{ $productCount }}</span>
                    </span>
                @endforeach                
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <!-- Page level plugins -->
        <script src="{{ asset('assets-admin') }}/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="{{ asset('assets-admin') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('assets-admin') }}/js/demo/datatables-demo.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const deleteLinks = document.querySelectorAll('.delete-product');

                deleteLinks.forEach(link => {
                    link.addEventListener('click', function () {
                        const id = this.getAttribute('data-id');
                        // console.log(id);

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "This data will be permanently deleted!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Kirim request DELETE menggunakan form tersembunyi
                                const form = document.createElement('form');
                                form.method = 'POST';
                                form.action = `/product/${id}/delete`;

                                // Tambahkan CSRF token
                                const csrfInput = document.createElement('input');
                                csrfInput.type = 'hidden';
                                csrfInput.name = '_token';
                                csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                                form.appendChild(csrfInput);

                                // Tambahkan metode DELETE
                                const methodInput = document.createElement('input');
                                methodInput.type = 'hidden';
                                methodInput.name = '_method';
                                methodInput.value = 'DELETE';
                                form.appendChild(methodInput);

                                document.body.appendChild(form);
                                form.submit();
                            }
                        });
                    });
                });
            });

        </script>

        @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                timer: 10000,
                showConfirmButton: true,
                confirmButtonText: 'OK',
                position: 'center',
            });
        </script>
        @endif

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let categoryColors = {};

                function getRandomColor() {
                    let hue = Math.floor(Math.random() * 360); // Warna acak berbasis HSL
                    let saturation = 60 + Math.random() * 20;
                    let lightness = 50 + Math.random() * 15;
                    return `hsl(${hue}, ${saturation}%, ${lightness}%)`;
                }

                function getTextColor(bgColor) {
                    let rgb = bgColor
                        .replace(/[^\d,]/g, "")
                        .split(",")
                        .map(Number);
                    let brightness = (rgb[0] * 299 + rgb[1] * 587 + rgb[2] * 114) / 1000;
                    return brightness > 150 ? "#000" : "#fff"; // Gunakan hitam jika terang, putih jika gelap
                }

                // Atur warna untuk kategori di daftar Categories
                document.querySelectorAll(".random-badge").forEach(function (badge) {
                    let categoryName = badge.dataset.category;
                    if (!categoryColors[categoryName]) {
                        let bgColor = getRandomColor();
                        categoryColors[categoryName] = bgColor;
                    }

                    badge.style.backgroundColor = categoryColors[categoryName];

                    // Konversi warna HSL ke RGB untuk perhitungan kecerahan teks
                    let tempDiv = document.createElement("div");
                    tempDiv.style.color = categoryColors[categoryName];
                    document.body.appendChild(tempDiv);
                    let computedColor = window.getComputedStyle(tempDiv).color;
                    document.body.removeChild(tempDiv);

                    badge.style.color = getTextColor(computedColor);
                });

                // Terapkan warna kategori yang sama ke tabel produk
                document.querySelectorAll(".category-badge").forEach(function (badge) {
                    let categoryName = badge.dataset.category;
                    if (categoryColors[categoryName]) {
                        badge.style.backgroundColor = categoryColors[categoryName];

                        let tempDiv = document.createElement("div");
                        tempDiv.style.color = categoryColors[categoryName];
                        document.body.appendChild(tempDiv);
                        let computedColor = window.getComputedStyle(tempDiv).color;
                        document.body.removeChild(tempDiv);

                        badge.style.color = getTextColor(computedColor);
                    }
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function(){
                $(".view-image").click(function(){
                    let imageSrc = $(this).data("image");
                    let productName = $(this).data("name");
                    
                    $("#modalImage").attr("src", imageSrc);
                    $("#modalProductName").text(productName);
                    
                    $("#imageModal").modal("show");
                });
            });
        </script>
    </x-slot>
</x-dashboard.dashboard>