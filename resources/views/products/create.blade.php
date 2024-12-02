<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<div class="container">
<form>
    <fieldset disabled>
      <legend>Add Product</legend>
      <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Title</label>
        <input type="text" class="form-control" placeholder="Title">
      </div>

      <div class="mb-3">
        <label for="disabledTextInput" class="form-label">Price</label>
        <input type="number" class="form-control" placeholder="Price">
      </div>
      
      <div class="mb-3">
        <label for="disabledSelect" class="form-label">Disabled select menu</label>
        <select id="disabledSelect" class="form-select">
        @foreach ($categories as $category)
          <option value="">{{ $category->name }}</option>
        @endforeach
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </fieldset>
  </form>
</div>