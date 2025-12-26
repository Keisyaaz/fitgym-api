<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitGym Admin - @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #2d7a92;
            --primary-light: #489fb5;
            --sidebar-bg-start: #1e293b;
            --sidebar-bg-end: #0f172a;
            --light-bg: #f1f5f9;
            --text-color: #334155;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-color);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* --- PRELOADER --- */
        #preloader {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: #fff; z-index: 9999;
            display: flex; justify-content: center; align-items: center;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }
        .spinner {
            width: 40px; height: 40px; border: 4px solid var(--light-bg);
            border-top: 4px solid var(--primary-color); border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

        /* --- SIDEBAR --- */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed; top: 0; left: 0;
            background: linear-gradient(180deg, var(--sidebar-bg-start) 0%, var(--sidebar-bg-end) 100%);
            color: white;
            transition: all 0.3s ease-in-out;
            z-index: 1050;
            display: flex; flex-direction: column;
            box-shadow: 4px 0 20px rgba(0,0,0,0.15);
        }

        .sidebar-brand {
            padding: 25px 20px;
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
            display: flex; align-items: center;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            background: rgba(0,0,0,0.1);
        }

        .sidebar-menu {
            padding: 20px 15px;
            flex-grow: 1;
            overflow-y: auto;
            /* Custom Scrollbar for Sidebar */
            scrollbar-width: thin;
            scrollbar-color: #475569 transparent;
        }
        
        .sidebar-menu::-webkit-scrollbar { width: 5px; }
        .sidebar-menu::-webkit-scrollbar-track { background: transparent; }
        .sidebar-menu::-webkit-scrollbar-thumb { background-color: #475569; border-radius: 20px; }

        .menu-header {
            font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px;
            color: #64748b; margin: 20px 0 10px 12px; font-weight: 700;
        }

        .sidebar-link {
            display: flex; align-items: center;
            padding: 12px 18px;
            color: #94a3b8; text-decoration: none;
            border-radius: 12px; margin-bottom: 5px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500; font-size: 14px;
            border-left: 3px solid transparent;
        }

        .sidebar-link i {
            width: 24px; font-size: 18px; margin-right: 12px;
            text-align: center; transition: transform 0.2s;
        }

        .sidebar-link:hover {
            color: #fff; background: rgba(255,255,255,0.05);
            transform: translateX(4px);
        }

        .sidebar-link.active {
            background: linear-gradient(90deg, rgba(45, 122, 146, 0.2) 0%, rgba(45, 122, 146, 0.05) 100%);
            color: #38bdf8;
            border-left: 3px solid var(--primary-color);
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.05);
            background: rgba(0,0,0,0.2);
        }

        /* --- MAIN CONTENT & NAVBAR --- */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 0; transition: all 0.3s ease-in-out;
            min-height: 100vh; display: flex; flex-direction: column;
        }

        .top-navbar {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 15px 30px;
            border-bottom: 1px solid #e2e8f0;
            display: flex; justify-content: space-between; align-items: center;
            position: sticky; top: 0; z-index: 1000;
        }

        /* Search Bar di Navbar */
        .navbar-search {
            position: relative;
            display: none;
        }
        @media(min-width: 768px) { .navbar-search { display: block; width: 300px; } }
        
        .navbar-search input {
            width: 100%; border-radius: 20px; border: 1px solid #e2e8f0;
            padding: 8px 15px 8px 40px; background: #f8fafc; font-size: 14px;
            transition: all 0.3s;
        }
        .navbar-search input:focus {
            outline: none; border-color: var(--primary-color); background: #fff;
            box-shadow: 0 0 0 3px rgba(45, 122, 146, 0.1);
        }
        .navbar-search i {
            position: absolute; left: 15px; top: 50%; transform: translateY(-50%);
            color: #94a3b8; font-size: 14px;
        }

        /* Breadcrumb Area */
        .breadcrumb-area {
            margin-bottom: 25px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .breadcrumb-title { font-size: 20px; font-weight: 700; color: #1e293b; margin: 0; }
        .breadcrumb-path { font-size: 12px; color: #64748b; }

        .toggle-sidebar-btn {
            background: none; border: none; font-size: 20px;
            color: var(--primary-color); cursor: pointer; margin-right: 15px;
            display: none;
        }

        .admin-profile { display: flex; align-items: center; cursor: pointer; }
        .admin-profile img {
            width: 40px; height: 40px; border-radius: 50%;
            object-fit: cover; border: 2px solid #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .content-body { padding: 30px; flex-grow: 1; }

        /* Icon Notifikasi */
        .nav-icon-btn {
            position: relative; margin-right: 20px; color: #64748b;
            font-size: 18px; cursor: pointer; transition: color 0.3s;
        }
        .nav-icon-btn:hover { color: var(--primary-color); }
        .nav-icon-btn .badge-dot {
            position: absolute; top: -2px; right: -2px;
            width: 8px; height: 8px; background: #ef4444;
            border-radius: 50%; border: 1px solid #fff;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); box-shadow: none; }
            .sidebar.show { transform: translateX(0); box-shadow: 4px 0 20px rgba(0,0,0,0.25); }
            .main-content { margin-left: 0; }
            .toggle-sidebar-btn { display: block; }
            .sidebar-overlay {
                position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                background: rgba(15, 23, 42, 0.6); z-index: 1040;
                display: none; opacity: 0; transition: opacity 0.3s;
                backdrop-filter: blur(2px);
            }
            .sidebar-overlay.show { display: block; opacity: 1; }
        }
    </style>
</head>
<body>

    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="sidebar" id="sidebar">
        <a href="#" class="sidebar-brand">
            <i class="fas fa-dumbbell me-2" style="color: #38bdf8;"></i> 
            <div>
                FitGym <span class="d-block text-uppercase" style="font-size: 10px; font-weight: 500; opacity: 0.5; letter-spacing: 1px; margin-top: -3px;">Panel Admin</span>
            </div>
        </a>

        <div class="sidebar-menu">
            <div class="menu-header">Overview</div>
            
            <a href="{{ url('/admin/dashboard') }}" class="sidebar-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i> Dashboard
            </a>

            <div class="menu-header">Master Data</div>

            <a href="{{ url('/admin/produk') }}" class="sidebar-link {{ request()->is('admin/produk*') ? 'active' : '' }}">
                <i class="fas fa-box"></i> Produk
            </a>

            <a href="{{ url('/admin/pesanan') }}" class="sidebar-link {{ request()->is('admin/pesanan*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i> Pesanan
                <span class="badge bg-danger ms-auto rounded-pill" style="font-size: 10px; padding: 4px 8px;">3 New</span>
            </a>
            
            <a href="#" class="sidebar-link">
                <i class="fas fa-tag"></i> Kategori
            </a>
            
            <div class="menu-header">System</div>
            
            <a href="#" class="sidebar-link">
                <i class="fas fa-users-cog"></i> User Management
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-cog"></i> Settings
            </a>
        </div>

        <div class="sidebar-footer">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            <a href="#" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center btn-sm"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </a>
        </div>
    </div>

    <div class="main-content">
        
        <nav class="top-navbar">
            <div class="d-flex align-items-center">
                <button class="toggle-sidebar-btn" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="navbar-search">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari data produk, pesanan...">
                </div>
            </div>
            
            <div class="d-flex align-items-center">
                <div class="nav-icon-btn me-3">
                    <i class="far fa-bell"></i>
                    <span class="badge-dot"></span>
                </div>

                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" data-bs-toggle="dropdown">
                        <div class="text-end me-3 d-none d-sm-block">
                            <span class="d-block fw-bold text-dark" style="font-size: 14px; line-height: 1;">{{ Auth::user()->name ?? 'Administrator' }}</span>
                            <small class="text-muted" style="font-size: 11px;">Super Admin</small>
                        </div>
                        <div class="admin-profile">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=2d7a92&color=fff&size=128" alt="Admin">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3 mt-3 animate slideIn">
                        <li><h6 class="dropdown-header text-uppercase small text-muted">Akun Saya</h6></li>
                        <li><a class="dropdown-item py-2" href="#"><i class="fas fa-user me-2 text-secondary"></i> Profile</a></li>
                        <li><a class="dropdown-item py-2" href="#"><i class="fas fa-key me-2 text-secondary"></i> Ubah Password</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item py-2 text-danger fw-medium" href="#" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content-body">
            <div class="breadcrumb-area">
                <h4 class="breadcrumb-title">@yield('title')</h4>
                <div class="breadcrumb-path">
                    <span class="text-muted"><i class="fas fa-home me-1"></i> Admin</span> / <span class="text-primary fw-medium">@yield('title')</span>
                </div>
            </div>

            @yield('content')
        </div>
        
        <div class="text-center py-4 text-muted small border-top mt-auto">
            &copy; {{ date('Y') }} <strong>FitGym</strong>. All rights reserved.
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Preloader Logic
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            preloader.style.opacity = '0';
            preloader.style.visibility = 'hidden';
        });

        // Sidebar Logic
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        function toggleSidebar() {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }

        toggleBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    </script>
</body>
</html>