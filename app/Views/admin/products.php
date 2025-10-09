<?= $this->include('admin/templates/header') ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Produk</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Produk Baru
        </a>
    </div>

    <!-- Products Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
        </div>
        <div class="card-body">
            <?php if (!empty($products)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $product): ?>
                            <tr>
                                <td>
                                    <img src="<?= base_url('uploads/products/' . ($product['gambar'] ?? 'default.jpg')) ?>" 
                                         alt="<?= $product['nama_produk'] ?>" 
                                         style="width: 50px; height: 50px; object-fit: cover;"
                                         onerror="this.src='https://via.placeholder.com/50x50?text=No+Image'">
                                </td>
                                <td><?= htmlspecialchars($product['nama_produk']) ?></td>
                                <td><?= htmlspecialchars($product['nama_kategori'] ?? 'Tidak ada kategori') ?></td>
                                <td>Rp <?= number_format($product['harga'], 0, ',', '.') ?></td>
                                <td>
                                    <span class="badge <?= $product['stok'] > 0 ? 'bg-success' : 'bg-danger' ?>">
                                        <?= $product['stok'] ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge <?= $product['is_active'] ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= $product['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('product/' . $product['slug']) ?>" 
                                           class="btn btn-sm btn-info" target="_blank">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-4">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada produk</h5>
                    <p class="text-muted">Mulai dengan menambahkan produk pertama Anda.</p>
                    <a href="#" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i> Tambah Produk Pertama
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->include('admin/templates/footer') ?>