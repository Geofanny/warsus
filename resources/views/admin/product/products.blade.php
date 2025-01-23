<x-dashboard.dashboard>
    <x-slot name="link">
        <!-- Custom styles for this page -->
        <link href="assets-admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr>
                                    <td>Shad Decker</td>
                                    <td>Regional Director</td>
                                    <td>Edinburgh</td>
                                    <td>51</td>
                                    <td>2008/11/13</td>
                                    <td>$183,000</td>
                                </tr>
                                <tr>
                                    <td>Michael Bruce</td>
                                    <td>Javascript Developer</td>
                                    <td>Singapore</td>
                                    <td>29</td>
                                    <td>2011/06/27</td>
                                    <td>$183,000</td>
                                </tr>
                                <tr>
                                    <td>Donna Snider</td>
                                    <td>Customer Support</td>
                                    <td>New York</td>
                                    <td>27</td>
                                    <td>2011/01/25</td>
                                    <td>$112,000</td>
                                </tr>
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
    </x-slot>
</x-dashboard.dashboard>