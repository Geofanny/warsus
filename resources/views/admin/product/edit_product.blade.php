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
                            <div class="col-4">
                                <div class="card" style="width: 100%; height: 40vh;">
                                    <div class="card-body" style="overflow: hidden;">
                                        <img src="{{ asset("storage/".$product->product_image ) }}" id="previewImage" alt="image product" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>                                    
                                </div>                                
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <input class="form-control" name="img" id="formFileSm" type="file">
                                    </div>
                                </div>
                            </div>
                            <div class="col-8 border-left border-black">
                                <h5>Edit Product</h5>
                                <hr>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="name" class="form-label">Name Product</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter name product" value="{{ $product->name }}" aria-label="First name" id="name">
                                    </div>
                                    <div class="col">
                                        <label for="category" class="form-label">Category</label>
                                        <select id="category" class="form-control" name="category">
                                        <option selected>Selected Category</option>
                                        @foreach ($categories as $category )
                                            <option value="{{ $category->id_category }}" {{ $category->id_category == $product->category ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" name="price" class="form-control" placeholder="Enter price product" value="{{ $product->price }}" aria-label="First name" id="price">
                                    </div>
                                    <div class="col">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="number" name="stock" class="form-control" placeholder="Enter stock product" value="{{ $product->stock }}" aria-label="Last name" id="stock">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" name="desc" placeholder="Enter description product" id="description" style="height: 100px;">{{ $product->description }}</textarea>
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
    </x-slot>
</x-dashboard.dashboard>