<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<x-app-layout>
    <div class="container">
    <h3 class="mb-4 mt-4 font-extrabold">List of products</h3>
    <a class="btn btn-primary float-right mb-4" href="{{ url('/add-product') }}"> Add Product</a>
    <table class="table">
    <thead class="table-dark">
        <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Price</th>
        <th scope="col">Category</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
        <th scope="row">{{$product->id}}</th>
        <td>{{$product->title}}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->category->name}}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
    </div>
        
</x-app-layout> 


