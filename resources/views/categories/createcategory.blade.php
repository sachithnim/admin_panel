@extends('layouts.master')

<div class="container">
<a class="btn btn-info float-end mb-4 mt-4" href="{{ route('category') }}"> Go Back</a> 
<form method="post" action="{{ route('add-category') }}">
    @csrf
      <legend>Add Category</legend>
      
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter category name">
      </div>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Description</label>
        <input type="text" name="description" class="form-control" placeholder="Enter category description">
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
   
  </form>
</div>