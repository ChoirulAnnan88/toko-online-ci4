<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin - Toko Online' ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom styles -->
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
        }
        .sidebar .nav-link {
            color: #fff;
        }
        .sidebar .nav-link:hover {
            background: #495057;
        }
        .sidebar .nav-link.active {
            background: #007bff;
        }
        #content-wrapper {
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="sidebar border-right" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4">
                <h5 class="text-white">
                    <i class="fas fa-store"></i><br>
                    TokoOnline<br>
                    <small class="text-muted">Admin Panel</small>
                </h5>
            </div>
            <div class="list-group list-group-flush">
                <a href="<?= base_url('admin/dashboard') ?>" 
                   class="list-group-item list-group-item-action sidebar-heading <?= current_url() == base_url('admin/dashboard') ? 'active' : '' ?>">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a href="<?= base_url('admin/products') ?>" 
                   class="list-group-item list-group-item-action <?= strpos(current_url(), 'admin/products') !== false ? 'active' : '' ?>">
                    <i class="fas fa-box me-2"></i>Produk
                </a>
                <a href="<?= base_url('admin/categories') ?>" 
                   class="list-group-item list-group-item-action <?= strpos(current_url(), 'admin/categories') !== false ? 'active' : '' ?>">
                    <i class="fas fa-tags me-2"></i>Kategori
                </a>
                <a href="<?= base_url('admin/orders') ?>" 
                   class="list-group-item list-group-item-action <?= strpos(current_url(), 'admin/orders') !== false ? 'active' : '' ?>">
                    <i class="fas fa-shopping-cart me-2"></i>Pesanan
                </a>
                <a href="<?= base_url('admin/users') ?>" 
                   class="list-group-item list-group-item-action <?= strpos(current_url(), 'admin/users') !== false ? 'active' : '' ?>">
                    <i class="fas fa-users me-2"></i>Customers
                </a>
                <a href="<?= base_url('/') ?>" 
                   class="list-group-item list-group-item-action" target="_blank">
                    <i class="fas fa-external-link-alt me-2"></i>Lihat Website
                </a>
                <a href="<?= base_url('auth/logout') ?>" 
                   class="list-group-item list-group-item-action text-danger">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="content-wrapper" class="d-flex flex-column w-100">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?= session()->get('nama_lengkap') ?? session()->get('username') ?>
                                </span>
                                <i class="fas fa-user-circle fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow">
                                <a class="dropdown-item" href="<?= base_url('/') ?>" target="_blank">
                                    <i class="fas fa-store fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Lihat Toko
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('auth/logout') ?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Flash Messages -->
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>