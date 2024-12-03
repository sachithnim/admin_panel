@extends('layouts.master')

<div class="container">
<a class="btn btn-info float-end mb-4 mt-4" href="{{ url('/dashboard') }}"> Go Back</a>
<form method="post" action="{{ url('/edit-product/'.$product->id) }}">
    @csrf
    @method('PUT')
    
      <legend>Edit Product</legend>
      
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Title</label>
        <input type="text" name="title" value="{{ old('title') ?? $product->title }}" class="form-control" placeholder="Title">
      </div>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Price</label>
        <input type="number" name="price" value="{{ old('price') ?? $product->price }}" class="form-control" placeholder="Price">
      </div>
      
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Category</label>
        <select name="category_id" id="disabledSelect" class="form-select">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" 
                {{ $category->id == $product->category_id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
   
  </form>
</div>