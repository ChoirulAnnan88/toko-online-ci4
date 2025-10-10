<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin - Toko Online' ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Admin Custom CSS -->
    <style>
        :root {
            --sidebar-width: 250px;
            --header-height: 56px;
            --primary-color: #0d6efd;
            --sidebar-bg: #343a40;
            --sidebar-color: #fff;
            --sidebar-hover: #495057;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--sidebar-bg);
            color: var(--sidebar-color);
            transition: all 0.3s;
            z-index: 1000;
        }
        
        #sidebar .sidebar-header {
            padding: 1rem;
            background: rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        #sidebar .sidebar-header h4 {
            margin: 0;
            font-weight: 600;
        }
        
        #sidebar ul.components {
            padding: 1rem 0;
        }
        
        #sidebar ul li a {
            padding: 0.75rem 1.5rem;
            color: var(--sidebar-color);
            text-decoration: none;
            display: block;
            border-left: 3px solid transparent;
            transition: all 0.3s;
        }
        
        #sidebar ul li a:hover {
            background: var(--sidebar-hover);
            border-left-color: var(--primary-color);
            color: #fff;
        }
        
        #sidebar ul li.active > a {
            background: var(--sidebar-hover);
            border-left-color: var(--primary-color);
            color: #fff;
        }
        
        #sidebar ul li a i {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
        }
        
        #sidebar .dropdown-toggle::after {
            float: right;
            margin-top: 0.5rem;
        }
        
        /* Main Content */
        #content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s;
        }
        
        /* Top Navigation */
        .navbar-admin {
            height: var(--header-height);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        /* Cards */
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background: #fff;
            border-bottom: 1px solid #e3e6f0;
            font-weight: 600;
        }
        
        /* Stats Cards */
        .stat-card .card-body {
            padding: 1.25rem;
        }
        
        .stat-card .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .stat-card .stat-label {
            font-size: 0.875rem;
            color: #6c757d;
            text-transform: uppercase;
            font-weight: 600;
        }
        
        .stat-card .stat-icon {
            font-size: 2rem;
            opacity: 0.3;
        }
        
        /* Tables */
        .table th {
            font-weight: 600;
            border-bottom: 2px solid #e3e6f0;
            background: #f8f9fa;
        }
        
        /* Buttons */
        .btn {
            border-radius: 0.375rem;
            font-weight: 500;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        
        /* Badges */
        .badge {
            font-weight: 500;
        }
        
        /* Forms */
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
        
        /* Alerts */
        .alert {
            border: none;
            border-radius: 0.5rem;
        }
        
        /* Loading */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -var(--sidebar-width);
            }
            
            #content {
                margin-left: 0;
            }
            
            #sidebar.active {
                margin-left: 0;
            }
            
            #content.active {
                margin-left: var(--sidebar-width);
            }
        }
        
        /* Dark mode for admin */
        [data-bs-theme="dark"] {
            --sidebar-bg: #1a1d20;
            --sidebar-hover: #2d3338;
        }
        
        [data-bs-theme="dark"] .card {
            background: #2d3338;
            color: #e9ecef;
        }
        
        [data-bs-theme="dark"] .card-header {
            background: #2d3338;
            border-bottom-color: #495057;
        }
        
        [data-bs-theme="dark"] .table {
            --bs-table-bg: #2d3338;
            --bs-table-color: #e9ecef;
            --bs-table-border-color: #495057;
        }
    </style>
    
    <!-- Page-specific CSS -->
    <?php if (isset($css)): ?>
        <style><?= $css ?></style>
    <?php endif; ?>
</head>
<body>
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h4>
                <i class="fas fa-store me-2"></i>
                Admin Panel
            </h4>
        </div>

        <ul class="list-unstyled components">
            <li class="<?= current_url() == base_url('admin/dashboard') ? 'active' : '' ?>">
                <a href="<?= base_url('admin/dashboard') ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </li>
            
            <li class="<?= strpos(current_url(), 'admin/products') !== false ? 'active' : '' ?>">
                <a href="<?= base_url('admin/products') ?>">
                    <i class="fas fa-box"></i>
                    Produk
                </a>
            </li>
            
            <li class="<?= strpos(current_url(), 'admin/categories') !== false ? 'active' : '' ?>">
                <a href="<?= base_url('admin/categories') ?>">
                    <i class="fas fa-tags"></i>
                    Kategori
                </a>
            </li>
            
            <li class="<?= strpos(current_url(), 'admin/orders') !== false ? 'active' : '' ?>">
                <a href="<?= base_url('admin/orders') ?>">
                    <i class="fas fa-shopping-cart"></i>
                    Pesanan
                </a>
            </li>
            
            <li class="<?= strpos(current_url(), 'admin/users') !== false ? 'active' : '' ?>">
                <a href="<?= base_url('admin/users') ?>">
                    <i class="fas fa-users"></i>
                    Customers
                </a>
            </li>
            
            <li>
                <a href="#settingsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-cog"></i>
                    Settings
                </a>
                <ul class="collapse list-unstyled" id="settingsSubmenu">
                    <li>
                        <a href="<?= base_url('admin/settings/general') ?>">General</a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/settings/payment') ?>">Payment</a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/settings/shipping') ?>">Shipping</a>
                    </li>
                </ul>
            </li>
            
            <li class="mt-4">
                <a href="<?= base_url() ?>" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                    View Site
                </a>
            </li>
            
            <li>
                <a href="<?= base_url('auth/logout') ?>" onclick="return confirm('Yakin ingin logout?')">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div id="content">
        <!-- Top Navigation -->
        <nav class="navbar navbar-admin navbar-expand-lg navbar-light bg-white">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-outline-secondary">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="navbar-nav ms-auto">
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>
                            <?= session()->get('nama_lengkap') ?? session()->get('username') ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?= base_url('profile') ?>"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('profile/edit') ?>"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= base_url('auth/logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container-fluid py-4">