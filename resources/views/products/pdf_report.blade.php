<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Products Report</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Price</th>
                <th>Description</th>
                <th>SKU</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->category ? $product->category->name : 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
