<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

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
    
    <div class="container">
        @yield('content')
    </div>
</body>

</html>
