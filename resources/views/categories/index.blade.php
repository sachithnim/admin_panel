@extends('layouts.master')

<x-app-layout>
    <div class="container">
    <h3 class="mb-4 mt-4 font-extrabold">List of categories</h3>
    <a class="btn btn-info float-end mb-4" href="{{ url('/add-category') }}"> Add Category</a>
    <table class="table">
    <thead class="table-dark">
        <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Date Created</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
        <th scope="row">{{$category->id}}</th>
        <td>{{$category->name}}</td>
        <td>{{$category->created_at->diffForHumans()}}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
    </div>
        
</x-app-layout> 


