@extends('layouts.master')

<x-app-layout>
    <div class="container">

        <div class="container mt-2">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
            @endforeach
            @endif
            </div>
        
            <div class="container mt-2">
                @if (session()->exists('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                @endif
            </div>
    <h3 class="mb-4 mt-4 font-extrabold">List of categories</h3>
    <a class="btn btn-info float-end mb-4" href="{{ url('/add-category') }}"> Add Category</a>


    <!-- Search Form -->
    <form method="GET" action="{{ url('/category') }}" class="mb-4">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search categories..." value="{{ request()->input('search') }}">
            <button class="btn btn-primary" type="submit">Search</button>
            <button type="button" class="btn btn-secondary" onclick="window.location='{{ url('/category') }}'">Clear Filters</button>
        </div>
    </form>

    
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">Category ID</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Date Created</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <th scope="row">{{$category->id}}</th>
                <td>{{$category->name}}</td>
                <td>{{$category->description}}</td>
                <td>{{$category->created_at->diffForHumans()}}</td>
                <td>
                    <a href="{{ url('/edit-category/'.$category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ url('/delete-category/'.$category->id) }}" method="post" style="display:inline;">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $categories->links() }}
    <div style="margin-left:40%">
    {{ $categories->count() }} Total Records
    </div>
   
    <a href="{{ url('/export-categories-excel?search=' . urlencode(request('search'))) }}" class="btn btn-success float-end mb-4">Export Categories Report (Excel)</a>
    <a href="{{ url('/export-categories-pdf?search=' . urlencode(request('search'))) }}" class="btn btn-danger float-end mb-4 me-4">Export Categories Report (PDF)</a>

    </div>
        
</x-app-layout> 


