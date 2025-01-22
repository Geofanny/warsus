<x-dashboard.dashboard>
    <x-slot name="link">
        <!-- Custom styles for this page -->
        <link href="assets-admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    </x-slot>

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Category</h1>

    {{-- <a href="" class="btn btn-sm btn-success mb-3">Add products +</a> --}}

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Categories</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Create At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Create At</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($categories as $category )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>
                                        <a href="" class="btn btn-secondary">Edit</a>
                                        <a href="" class="btn btn-danger">Delete</a>
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
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Category</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="/category/post" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="name" class="form-label">Name Category</label>
                                <input type="text" class="form-control" id="name" name="name">
                                <button class="btn btn-success w-100 mt-3">Submit</button>
                            </div>
                        </div>
                    </form>
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
    </x-slot>
</x-dashboard.dashboard>