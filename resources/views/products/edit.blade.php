@extends('layouts.master')

<div class="container mt-5">
    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary rounded-pill shadow-sm mb-4" style="font-size: 16px;">
        <i class="bi bi-arrow-left-circle me-2"></i> Go Back
    </a>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header" style="background-color: #0066cc; color: white; text-align: center; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
            <h3 class="mb-0">Edit Product</h3>
        </div>
        <div class="card-body p-5">
            <form method="post" action="{{ url('/edit-product/'.$product->id) }}" enctype="multipart/form-data" id="product-form">
                @csrf
                @method('PUT')

                <!-- Title & Price -->
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="title" class="form-label fw-bold">Product Title</label>
                        <input type="text" name="title" value="{{ old('title') ?? $product->title }}" class="form-control shadow-lg" placeholder="Enter product title" id="title">
                    </div>

                    <div class="col-md-6">
                        <label for="price" class="form-label fw-bold">Price</label>
                        <input type="text" name="price" value="{{ old('price') ?? $product->price }}" class="form-control shadow-lg" placeholder="Enter price" id="price">
                        <div class="form-text">Provide the price of the product in LKR.</div>
                    </div>
                </div>

                <!-- Description & SKU -->
                <div class="row g-4 mt-3">
                    <div class="col-md-6">
                        <label for="description" class="form-label fw-bold">Product Description</label>
                        <textarea name="description" class="form-control shadow-lg" rows="4" placeholder="Brief description of the product" id="description">{{ old('description') ?? $product->description }}</textarea>
                        <div class="form-text">Provide a detailed description of the product's features and benefits.</div>
                    </div>

                    <div class="col-md-6">
                        <label for="sku" class="form-label fw-bold">SKU (Stock Keeping Unit)</label>
                        <input type="text" name="sku" value="{{ old('sku') ?? $product->sku }}" class="form-control shadow-lg" placeholder="Enter SKU" id="sku">
                        <div class="form-text">SKU helps you identify and track the product in your inventory.</div>
                    </div>
                </div>

                <!-- Category & Image Upload -->
                <div class="row g-4 mt-3">
                    <div class="col-md-6">
                        <label for="category_id" class="form-label fw-bold">Category</label>
                        <select name="category_id" id="category_id" class="form-select shadow-lg">
                            <option selected disabled>Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text">Choose the product category to organize your inventory better.</div>
                    </div>

                    <div class="col-md-6">
                        <label for="image" class="form-label fw-bold">Product Image</label>
                        <input type="file" name="image" class="form-control shadow-lg" id="image">
                        <div class="form-text">Upload a high-quality image (JPG, PNG, or JPEG).</div>
                    </div>
                </div>

                <!-- Image Preview -->
                <div id="image-preview" class="mt-4 d-none">
                    <h5>Image Preview:</h5>
                    <img id="preview-img" src="" alt="Image Preview" class="img-fluid" style="max-width: 300px;">
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-center mt-5">
                    <button type="submit" class="btn btn-success btn-lg px-5 shadow-lg">
                        <i class="bi bi-cloud-upload-fill me-2"></i> Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include Bootstrap and Custom JS for Image Preview -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Image preview functionality
  document.getElementById('image').addEventListener('change', function (event) {
      var reader = new FileReader();
      reader.onload = function () {
          var preview = document.getElementById('image-preview');
          var previewImg = document.getElementById('preview-img');
          previewImg.src = reader.result;
          preview.classList.remove('d-none');
      };
      reader.readAsDataURL(event.target.files[0]);
  });
</script>
