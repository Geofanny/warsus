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
                            <div class="col-4">
                                <div class="card" style="width: 100%; height: 30vh;">
                                    <div class="card-body">
                                    <img src="#" alt="image product">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <input class="form-control" name="img" id="formFileSm" type="file">
                                    </div>
                                </div>
                            </div>
                            <div class="col-8 border-left border-black">
                                <h5>Data Product</h5>
                                <hr>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="name" class="form-label">Name Product</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter name product" aria-label="First name" id="name">
                                    </div>
                                    <div class="col">
                                        <label for="category" class="form-label">Category</label>
                                        <select id="category" class="form-control" name="category">
                                        <option selected>Selected Category</option>
                                        @foreach ($categories as $category )
                                            <option value="{{ $category->id_category }}">{{ $category->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" name="price" class="form-control" placeholder="Enter price product" aria-label="First name" id="price">
                                    </div>
                                    <div class="col">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="number" name="stock" class="form-control" placeholder="Enter stock product" aria-label="Last name" id="stock">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" name="desc" placeholder="Enter description product" id="description" style="height: 100px"></textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-4">
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
</x-dashboard.dashboard>