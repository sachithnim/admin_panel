<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frontend Layout</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

    <!-- Hero Section with Parallax -->
    <section class="hero-section text-white text-center py-5" style="background: url('{{ asset('images/bg_image.jpg') }}') no-repeat center center fixed; background-size: cover; height: 100vh;">
        <div class="container">
            <h1 class="display-4">Welcome to Our Website</h1>
            <p class="lead">Your journey to success begins here.</p>
            <a href="#" class="btn btn-warning btn-lg">Learn More</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Our Key Features</h2>
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <div class="feature-card p-4 border shadow-sm rounded hover-shadow">
                        <i class="fas fa-cogs fa-3x mb-3"></i>
                        <h3>Feature One</h3>
                        <p>Feature description goes here. Improve user experience with dynamic content and more features.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card p-4 border shadow-sm rounded hover-shadow">
                        <i class="fas fa-users fa-3x mb-3"></i>
                        <h3>Feature Two</h3>
                        <p>Feature description goes here. User-friendly interfaces and top-notch performance guaranteed.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card p-4 border shadow-sm rounded hover-shadow">
                        <i class="fas fa-chart-line fa-3x mb-3"></i>
                        <h3>Feature Three</h3>
                        <p>Feature description goes here. Boost productivity and efficiency through advanced solutions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section text-center bg-primary text-white py-5">
        <div class="container">
            <h2>Ready to Get Started?</h2>
            <p class="lead">Join us today and unlock a world of possibilities.</p>
            <a href="{{ route('register') }}" class="btn btn-warning btn-lg">Sign Up Now</a>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials py-5">
        <div class="container">
            <h2 class="text-center mb-5">What Our Clients Say</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card text-center p-4 border shadow-sm rounded">
                        <p>"Amazing service! The team is highly professional and always ready to assist. Highly recommend!"</p>
                        <h5>- John Doe</h5>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card text-center p-4 border shadow-sm rounded">
                        <p>"The product quality is top-notch, and the customer support is fantastic. Couldn't ask for more!"</p>
                        <h5>- Jane Smith</h5>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card text-center p-4 border shadow-sm rounded">
                        <p>"A game-changer! The features have helped us scale our business efficiently. Kudos to the team!"</p>
                        <h5>- Alice Johnson</h5>
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
