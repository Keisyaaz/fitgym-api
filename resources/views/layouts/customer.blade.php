<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitGym - @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #2d7a92; /* Teal konsisten dengan Login */
            --primary-hover: #246073;
            --secondary-color: #185a9d;
            --bg-light: #f4f7f6;
            --text-dark: #333;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Agar footer selalu di bawah */
        }

        /* --- Navbar Styling --- */
        .navbar-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 24px;
            color: #fff !important;
            letter-spacing: 1px;
            transition: transform 0.3s;
        }
        
        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            font-size: 15px;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: #fff !important;
            transform: translateY(-2px);
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        /* Dropdown Profile */
        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            border-radius: 12px;
            margin-top: 10px;
        }
        
        .dropdown-item {
            padding: 10px 20px;
            font-size: 14px;
        }

        .dropdown-item:hover {
            background-color: #eef2f3;
            color: var(--primary-color);
        }

        /* --- Footer --- */
        footer {
            margin-top: auto; 
            background-color: #1e272e;
            color: #bbb;
            padding: 40px 0;
            text-align: center;
            font-size: 14px;
        }
        
        footer a:hover {
            color: #fff !important;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('customer.produk') }}">
                <i class="fas fa-dumbbell me-2"></i> FitGym
            </a>
            
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCustomer">
                <span class="text-white"><i class="fas fa-bars fa-lg"></i></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCustomer">
                
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link px-3" href="{{ route('customer.produk') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="#">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="#">My Orders</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto align-items-center d-flex flex-row">
                    
                    <li class="nav-item me-4">
                        <a href="{{ route('cart.index') }}" class="nav-link position-relative pt-2">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light" style="font-size: 10px;">
                                0
                            </span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <div class="bg-white text-primary rounded-circle d-flex justify-content-center align-items-center me-2 shadow-sm" style="width: 35px; height: 35px;">
                                <i class="fas fa-user"></i>
                            </div>
                            <span class="d-none d-lg-inline">{{ Auth::user()->name ?? 'Guest' }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end animate slideIn">
                            <li class="px-3 py-2 text-muted border-bottom mb-2 d-block d-lg-none">
                                Signed in as <br><strong>{{ Auth::user()->name ?? 'Guest' }}</strong>
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle me-2 text-secondary"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2 text-secondary"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger fw-bold" type="submit">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('hero') 
    
    <main class="container my-5">
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <h5 class="fw-bold text-white mb-3"><i class="fas fa-dumbbell me-2"></i>FitGym</h5>
            <p class="mb-3">&copy; {{ date('Y') }} FitGym Store. Build your body, build your life.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#" class="text-decoration-none text-muted transition">Privacy Policy</a>
                <span class="text-muted">|</span>
                <a href="#" class="text-decoration-none text-muted transition">Terms of Service</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>