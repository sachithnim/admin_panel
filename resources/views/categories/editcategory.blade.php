@extends('layouts.master')

<div class="container">
<a class="btn btn-info float-end mb-4 mt-4" href="{{ url('/category') }}"> Go Back</a> 
<form method="post" action="{{ url('/edit-category/'.$category->id) }}">
    @csrf
    @method('PUT')
      <legend>Edit Category</legend>
      
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Name</label>
        <input type="text" name="name" value="{{ old('name') ?? $category->name }}" class="form-control" placeholder="Enter category name">
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
   
  </form>
</div>