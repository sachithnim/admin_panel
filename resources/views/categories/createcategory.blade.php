@extends('layouts.master')

<div class="container mt-5">
    <a href="{{ route('category') }}" class="btn btn-outline-primary rounded-pill shadow-sm mb-4" style="font-size: 16px;">
        <i class="bi bi-arrow-left-circle me-2"></i> Go Back
    </a>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header" style="background-color: #0066cc; color: white; text-align: center; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
            <h3 class="mb-0">Add New Category</h3>
        </div>
        <div class="card-body p-5">

            <form method="post" action="{{ route('add-category') }}">
                @csrf
                <!-- Category Name -->
                <div class="row g-4">
                    <div class="col-md-12">
                        <label for="name" class="form-label fw-bold">Category Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control shadow-lg" placeholder="Enter category name" id="name">
                        <div class="form-text">Provide a name that clearly describes the category. E.g., "Electronics", "Furniture".</div>
                    </div>
                </div>

                <!-- Category Description -->
                <div class="row g-4 mt-3">
                    <div class="col-md-12">
                        <label for="description" class="form-label fw-bold">Category Description</label>
                        <textarea name="description" class="form-control shadow-lg" rows="4" placeholder="Enter a description for this category" id="description">{{ old('description') }}</textarea>
                        <div class="form-text">Provide a short description of the category, explaining its contents or features.</div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-center mt-5">
                    <button type="submit" class="btn btn-success btn-lg px-5 shadow-lg">
                        <i class="bi bi-cloud-upload-fill me-2"></i> Add Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
