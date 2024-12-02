<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<x-app-layout>
    <div class="container">
    <table class="table caption-top">
    <caption>List of products</caption>
    <thead>
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
        <td>{{$product->category_id}}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
    </div>
        
</x-app-layout> 


