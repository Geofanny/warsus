<x-dashboard.dashboard>
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Product</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="card" style="width: 100%; height: 30vh;">
                                <div class="card-body">
                                  <img src="#" alt="image product">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <input class="form-control" id="formFileSm" type="file">
                                </div>
                            </div>
                            <a href="/dashboard-categories" class="btn btn-primary">Category</a>
                        </div>
                        <div class="col-8 border-left border-black">
                            <h5>Data Product</h5>
                            <hr>
                            <form action="" method="post">
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="exampleInputEmail1" class="form-label">Name Product</label>
                                        <input type="text" class="form-control" placeholder="First name" aria-label="First name" id="exampleInputEmail1">
                                    </div>
                                    <div class="col">
                                        <label for="inputState" class="form-label">State</label>
                                        <select id="inputState" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="exampleInputEmail1" class="form-label">Price</label>
                                        <input type="text" class="form-control" placeholder="First name" aria-label="First name" id="exampleInputEmail1">
                                    </div>
                                    <div class="col">
                                        <label for="exampleInputEmail11" class="form-label">Stock</label>
                                        <input type="text" class="form-control" placeholder="Last name" aria-label="Last name" id="exampleInputEmail11">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="floatingTextarea2Disabled" class="form-label">Description</label>
                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2Disabled" style="height: 100px"></textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-4">
                                    <a href="/dashboard-product" class="btn btn-danger">Back</a>
                                    <button class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</x-dashboard.dashboard>