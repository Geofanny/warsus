<x-dashboard.dashboard>
    <x-slot name="link">
        <!-- Custom styles for this page -->
        <link href="assets-admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    </x-slot>

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Category</h1>

    {{-- <a href="" class="btn btn-sm btn-success mb-3">Add products +</a> --}}

    <div class="row">
        {{-- Categories --}}
        <div class="col">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="/category/{{$category->id_category}}/update" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="name" class="form-label">Name Category</label>
                                <input type="text" class="form-control" value="{{ $category->name }}" id="name" name="name" required>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="/dashboard-categories" class="btn btn-danger">Back</a>
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
        <!-- Page level plugins -->
        <script src="{{ asset('assets-admin') }}/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="{{ asset('assets-admin') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('assets-admin') }}/js/demo/datatables-demo.js"></script>
    </x-slot>
</x-dashboard.dashboard>