<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Toko Online' ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #0dcaf0;
            --light-color: #f8f9fa;
            --dark-color: #212529;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .main-content {
            flex: 1;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
        }
        
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: box-shadow 0.15s ease-in-out;
        }
        
        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .btn {
            border-radius: 0.375rem;
            font-weight: 500;
        }
        
        .table th {
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
        }
        
        .badge {
            font-weight: 500;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
        
        .alert {
            border: none;
            border-radius: 0.5rem;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
        
        /* Loading spinner */
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }
        
        /* Avatar styles */
        .avatar-sm {
            width: 32px;
            height: 32px;
        }
        
        .avatar-md {
            width: 48px;
            height: 48px;
        }
        
        .avatar-lg {
            width: 64px;
            height: 64px;
        }
        
        /* Product card styles */
        .product-card {
            transition: transform 0.2s ease-in-out;
        }
        
        .product-card:hover {
            transform: translateY(-2px);
        }
        
        /* Price styles */
        .price-original {
            text-decoration: line-through;
            color: var(--secondary-color);
        }
        
        .price-discount {
            color: var(--danger-color);
            font-weight: 600;
        }
        
        /* Status badges */
        .badge-status-pending { background-color: var(--warning-color); color: #000; }
        .badge-status-processing { background-color: var(--info-color); color: #000; }
        .badge-status-shipped { background-color: var(--primary-color); }
        .badge-status-delivered { background-color: var(--success-color); }
        .badge-status-cancelled { background-color: var(--danger-color); }
        
        /* Custom utilities */
        .text-small { font-size: 0.875rem; }
        .text-xsmall { font-size: 0.75rem; }
        .cursor-pointer { cursor: pointer; }
        .min-h-100 { min-height: 100vh; }
        
        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            [data-bs-theme="dark"] {
                --bs-body-bg: #1a1d20;
                --bs-body-color: #e9ecef;
                --bs-light: #2d3338;
                --bs-dark: #f8f9fa;
            }
        }
    </style>
    
    <!-- Page-specific CSS -->
    <?php if (isset($css)): ?>
        <style><?= $css ?></style>
    <?php endif; ?>
</head>
<body>
    <!-- Theme Toggle -->
    <div class="position-fixed bottom-0 end-0 m-3">
        <button class="btn btn-outline-secondary btn-sm rounded-circle" id="themeToggle" style="width: 40px; height: 40px;">
            <i class="fas fa-moon"></i>
        </button>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="position-fixed top-0 start-0 w-100 h-100 bg-white bg-opacity-75 d-flex justify-content-center align-items-center" style="z-index: 9999; display: none !important;">
        <div class="text-center">
            <div class="spinner-border text-primary mb-3" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="text-muted">Memuat...</p>
        </div>
    </div>