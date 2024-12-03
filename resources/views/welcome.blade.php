<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frontend Layout</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
</head>
<body>

    <!-- Header Section -->
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="max-width: 150px;">
            </div>
            @if (Route::has('login'))
            <nav>
                <ul class="nav">
                    @auth
                    <li class="nav-item"><a class="nav-link text-white" href="{{ url('/dashboard') }}">Dashboard</a></li>
                    @else
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}">Login</a></li>
                    @if (Route::has('register'))
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('register') }}">Register</a></li>
                    @endif
                </ul>
                @endauth
            </nav>
        </div>
        @endif
    </header>

    <!-- Hero Section -->
    <section class="hero-section bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Welcome to Our Website</h1>
            <p class="lead">Your journey to success begins here.</p>
            <a href="#" class="btn btn-warning btn-lg">Learn More</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <div class="feature-card p-4 border shadow-sm rounded">
                        <h3>Feature One</h3>
                        <p>Feature description goes here.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card p-4 border shadow-sm rounded">
                        <h3>Feature Two</h3>
                        <p>Feature description goes here.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card p-4 border shadow-sm rounded">
                        <h3>Feature Three</h3>
                        <p>Feature description goes here.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between">
            <div class="footer-left">
                <p>&copy; 2024 Company Name. All rights reserved.</p>
            </div>
            <div class="footer-right">
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link text-white" href="#">Privacy Policy</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Terms of Service</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
