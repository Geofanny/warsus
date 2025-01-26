<x-dashboard.dashboard>
    <x-slot name="link">
        <!-- Custom styles for this page -->
        <link href="assets-admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

        <meta name="csrf-token" content="{{ csrf_token() }}">
    </x-slot>

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products</h1>

    {{-- <a href="" class="btn btn-sm btn-success mb-3">Add products +</a> --}}

    <div class="row">
        <div class="col-xl-8 col-lg-7">
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
                                        <td>{{ $product->dataCategory->name }}</td>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
        {{-- Categories --}}
        <div class="col-xl-4 col-lg-5">
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
                    @foreach ($categories as $category )
                        <span class="badge rounded-pill bg-primary text-white">{{ $category->name }}</span>
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
    </x-slot>
</x-dashboard.dashboard>