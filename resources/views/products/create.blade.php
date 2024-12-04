@extends('layouts.master')

<div class="container">
<a class="btn btn-info float-end mb-4 mt-4" href="{{ url('/dashboard') }}"> Go Back</a>
<form method="post" action="{{ url('/add-product') }}" enctype="multipart/form-data">
    @csrf
      <legend>Add Product</legend>
      
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Title</label>
        <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Title">
      </div>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Price</label>
        <input type="number" name="price" value="{{ old('price') }}" class="form-control" placeholder="Price">
      </div>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Description</label>
        <input type="text" name="description" value="{{ old('description') }}" class="form-control" placeholder="description">
      </div>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">SKU</label>
        <input type="text" name="sku" value="{{ old('sku') }}" class="form-control" placeholder="sku">
      </div>
      
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Category</label>
        <select name="category_id" id="disabledSelect" class="form-select">
        @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
        </select>
      </div>

      <div class="form-group mt-4">
        <label for="exampleFormControlFile1" class="form-label">Select product image</label>
        <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
      </div>
      

      <button type="submit" class="btn btn-primary">Submit</button>
   
  </form>
</div>