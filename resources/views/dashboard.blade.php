@extends('layouts.master')

<x-app-layout>
    <div class="container">
    <h3 class="mb-4 mt-4 font-extrabold">List of products</h3>
    <a class="btn btn-info float-end mb-4" href="{{ url('/add-product') }}"> Add Product</a>
    
    <!-- Search Form -->
    <form method="GET" action="{{ url('/dashboard') }}" class="mb-4">
        <div class="input-group">
            <!-- Search Input for Title, SKU, and Description -->
            <input type="text" class="form-control" name="search" placeholder="Search products..." value="{{ request()->input('search') }}">

            <!-- Category Dropdown -->
            <select name="category" class="form-control">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request()->input('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>

            <button class="btn btn-primary" type="submit">Search</button>
            <button type="button" class="btn btn-secondary" onclick="window.location='{{ url('/dashboard') }}'">Clear Filters</button>
        </div>
    </form>


    <table class="table">
    <thead class="table-dark">
        <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Price</th>
        <th scope="col">Description</th>
        <th scope="col">SKU</th>
        <th scope="col">Category</th>
        <th scope="col">Image</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
        <th scope="row">{{$product->id}}</th>
        <td>{{$product->title}}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->description}}</td>
        <td>{{$product->sku}}</td>
        <td>{{$product->category ? $product->category->name : 'N/A' }}</td>
        <td><image src="{{ asset('/storage/images/products/'.$product->image)}}"  style="width: 50px; height: 50px;" /></td>

        <td style="display: flex">
            <div>
            <a href="{{ url('/edit-product/'.$product->id) }}" class="btn btn-primary">Edit</a>
            </div>
            <form action="{{ url('/delete-product/'.$product->id) }}" method="post">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
                <button class="btn btn-danger" type="submit">Delete</button>
            </form> 
        </td>       
        </tr>
        @endforeach
    </tbody>
    </table>
    
    {{ $products->links() }}
    <div style="margin-left:40%">
    {{ $products->count() }} Total Records
    </div>

    <a href="{{ url('/export-products') }}" class="btn btn-success float-end mb-4">Export Products Report (Excel)</a>
    <a href="{{ url('/export-products-pdf') }}" class="btn btn-danger float-end mb-4 me-4">Export Products Report (PDF)</a>
    </div>
        
</x-app-layout> 


