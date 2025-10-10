<?= $this->include('admin/templates/header') ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="<?= base_url('admin/products') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Produk Baru
        </a>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Content Row -->
    <div class="row">
        <!-- Total Products Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Produk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_products ?? 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Categories Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Kategori</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_categories ?? 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tags fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Orders Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Pesanan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_orders ?? 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Users Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Customers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_users ?? 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 🆕 TAMBAHAN: Additional Stats Row -->
    <div class="row">
        <!-- Pending Orders -->
        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Pending</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pending_orders ?? 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today Orders -->
        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $today_orders ?? 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock -->
        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Stok Rendah</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $low_stock_products ?? 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today Revenue -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pendapatan Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($today_revenue ?? 0, 0, ',', '.') ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Total Pendapatan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total_revenue ?? 0, 0, ',', '.') ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Recent Orders -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pesanan Terbaru</h6>
                    <a href="<?= base_url('admin/orders') ?>" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <?php if (!empty($recent_orders)): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Customer</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($recent_orders as $order): ?>
                                    <tr>
                                        <td><?= $order['order_number'] ?? 'N/A' ?></td>
                                        <td>
                                            <?php if (isset($order['username'])): ?>
                                                <?= $order['username'] ?>
                                            <?php else: ?>
                                                User #<?= $order['user_id'] ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>Rp <?= number_format($order['total_amount'] ?? 0, 0, ',', '.') ?></td>
                                        <td>
                                            <span class="badge badge-<?= 
                                                ($order['status'] ?? 'pending') == 'pending' ? 'warning' : 
                                                (($order['status'] ?? 'pending') == 'processing' ? 'info' : 
                                                (($order['status'] ?? 'pending') == 'shipped' ? 'primary' : 
                                                (($order['status'] ?? 'pending') == 'delivered' ? 'success' : 'danger'))) 
                                            ?>">
                                                <?= ucfirst($order['status'] ?? 'pending') ?>
                                            </span>
                                        </td>
                                        <td><?= date('d M Y', strtotime($order['created_at'] ?? date('Y-m-d'))) ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/orders/view/' . ($order['id'] ?? '')) ?>" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center py-4">Belum ada pesanan.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- 🆕 TAMBAHAN: Popular Products -->
            <?php if (!empty($popular_products)): ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Produk Terpopuler</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Total Pesanan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($popular_products as $product): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php if (!empty($product['gambar'])): ?>
                                                <img src="<?= base_url('uploads/products/' . $product['gambar']) ?>" 
                                                     alt="<?= $product['nama_produk'] ?>" 
                                                     class="img-thumbnail mr-3" style="width: 40px; height: 40px; object-fit: cover;">
                                            <?php endif; ?>
                                            <div>
                                                <strong><?= $product['nama_produk'] ?></strong>
                                                <?php if (isset($product['nama_kategori'])): ?>
                                                    <br><small class="text-muted"><?= $product['nama_kategori'] ?></small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Rp <?= number_format($product['harga'] ?? 0, 0, ',', '.') ?></td>
                                    <td>
                                        <span class="badge badge-<?= ($product['stok'] ?? 0) > 10 ? 'success' : (($product['stok'] ?? 0) > 0 ? 'warning' : 'danger') ?>">
                                            <?= $product['stok'] ?? 0 ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-primary"><?= $product['total_orders'] ?? 0 ?></span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Quick Actions & Stats -->
        <div class="col-xl-4 col-lg-5">
            <!-- Quick Actions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?= base_url('admin/products') ?>" class="btn btn-primary btn-block text-left">
                            <i class="fas fa-box me-2"></i> Kelola Produk
                        </a>
                        <a href="<?= base_url('admin/products/create') ?>" class="btn btn-outline-primary btn-block text-left">
                            <i class="fas fa-plus me-2"></i> Tambah Produk
                        </a>
                        <a href="<?= base_url('admin/categories') ?>" class="btn btn-success btn-block text-left">
                            <i class="fas fa-tags me-2"></i> Kelola Kategori
                        </a>
                        <a href="<?= base_url('admin/orders') ?>" class="btn btn-info btn-block text-left">
                            <i class="fas fa-shopping-cart me-2"></i> Kelola Pesanan
                        </a>
                        <a href="<?= base_url('admin/users') ?>" class="btn btn-warning btn-block text-left">
                            <i class="fas fa-users me-2"></i> Kelola Customers
                        </a>
                    </div>
                </div>
            </div>

            <!-- 🆕 TAMBAHAN: System Info -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">System Info</h6>
                </div>
                <div class="card-body">
                    <div class="small">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Server Time:</span>
                            <strong><?= date('d M Y H:i:s') ?></strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>PHP Version:</span>
                            <strong><?= PHP_VERSION ?></strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>CI Version:</span>
                            <strong>4.x</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Environment:</span>
                            <strong class="text-<?= ENVIRONMENT == 'development' ? 'danger' : 'success' ?>">
                                <?= strtoupper(ENVIRONMENT) ?>
                            </strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 🆕 TAMBAHAN: Recent Activities -->
            <?php if (!empty($recent_activities)): ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aktivitas Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="small">
                        <?php foreach($recent_activities as $activity): ?>
                        <div class="mb-3">
                            <div class="font-weight-bold"><?= $activity['username'] ?? 'User' ?></div>
                            <div class="text-muted">
                                Order #<?= $activity['order_number'] ?? 'N/A' ?> - 
                                Rp <?= number_format($activity['total_amount'] ?? 0, 0, ',', '.') ?>
                            </div>
                            <small class="text-muted">
                                <?= date('d M H:i', strtotime($activity['created_at'] ?? date('Y-m-d'))) ?>
                            </small>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- 🆕 TAMBAHAN: JavaScript untuk Auto Refresh Stats -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto refresh stats every 30 seconds
    setInterval(function() {
        fetch('<?= base_url('admin/dashboard/getStats') ?>')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update stats cards here if needed
                    console.log('Stats updated:', data.data);
                }
            })
            .catch(error => console.error('Error fetching stats:', error));
    }, 30000);
});
</script>

<?= $this->include('admin/templates/footer') ?>