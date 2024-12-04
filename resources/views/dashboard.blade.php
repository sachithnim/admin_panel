@extends('layouts.master')

<x-app-layout>
    <div class="container">
    <h3 class="mb-4 mt-4 font-extrabold">List of products</h3>
    <a class="btn btn-info float-end mb-4" href="{{ url('/add-product') }}"> Add Product</a>
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
    </div>
        
</x-app-layout> 


