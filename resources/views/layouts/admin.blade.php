<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - Sea Voyage</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom Admin CSS -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
        }
        
        #wrapper {
            display: flex;
        }
        
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            min-height: 100vh;
            background: #4e73df;
            color: #fff;
            transition: all 0.3s;
        }
        
        #sidebar .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
            font-weight: 700;
        }
        
        #sidebar .list-group {
            width: 15rem;
        }
        
        #sidebar .list-group-item {
            border: none;
            padding: 1rem 1.25rem;
            color: rgba(255, 255, 255, 0.8);
            background: transparent;
        }
        
        #sidebar .list-group-item:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }
        
        #sidebar .list-group-item.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
            border-left: 4px solid #fff;
        }
        
        #content {
            width: 100%;
            min-height: 100vh;
        }
        
        .topbar {
            height: 4.375rem;
            background-color: #fff;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        .dropdown-menu {
            position: absolute;
        }
        
        .border-left-primary {
            border-left: 0.25rem solid #4e73df !important;
        }
        
        .border-left-success {
            border-left: 0.25rem solid #1cc88a !important;
        }
        
        .border-left-info {
            border-left: 0.25rem solid #36b9cc !important;
        }
        
        .border-left-warning {
            border-left: 0.25rem solid #f6c23e !important;
        }
        
        .border-left-danger {
            border-left: 0.25rem solid #e74a3b !important;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar">
            <div class="sidebar-heading py-4 text-center">
                <h4>Sea Voyage</h4>
                <p class="mb-0">Admin Portal</p>
            </div>
            
            <div class="list-group list-group-flush">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-fw fa-tachometer-alt mr-2"></i> Dashboard
                </a>
                <a href="{{ route('admin.ships.index') }}" class="list-group-item {{ request()->routeIs('admin.ships.*') ? 'active' : '' }}">
                    <i class="fas fa-fw fa-ship mr-2"></i> Ship Management
                </a>
                <a href="{{ route('admin.bookings.index') }}" class="list-group-item {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                    <i class="fas fa-fw fa-calendar-check mr-2"></i> Booking Approval
                </a>
                <a href="{{ route('admin.users.index') }}" class="list-group-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-fw fa-users mr-2"></i> User Management
                </a>
                <a href="{{ route('admin.reports.index') }}" class="list-group-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                    <i class="fas fa-fw fa-file-invoice mr-2"></i> Invoices
                </a>
            </div>
        </div>
        
        <!-- Content Wrapper -->
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Sidebar Toggle -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <div class="topbar-divider d-none d-sm-block"></div>
                    
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                            <img class="img-profile rounded-circle" src="https://placehold.co/60x60">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            
            <!-- Main Content -->
            @yield('content')
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Admin JS -->
    <script>
        // Toggle sidebar
        document.getElementById('sidebarToggleTop').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('d-none');
        });
    </script>
</body>
</html>