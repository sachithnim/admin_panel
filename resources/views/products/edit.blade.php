<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<div class="container">
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
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
   
  </form>
</div>