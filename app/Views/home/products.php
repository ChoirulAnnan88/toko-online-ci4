<?= $this->include('templates/header') ?>

<div class="container mt-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col">
            <h1>Daftar Produk</h1>
            <p class="text-muted">Temukan produk yang Anda cari</p>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="row mb-4">
        <div class="col-md-8">
            <form action="<?= base_url('products') ?>" method="get">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="<?= esc($search ?? '') ?>">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <form action="<?= base_url('products') ?>" method="get" id="categoryForm">
                <input type="hidden" name="search" value="<?= esc($search ?? '') ?>">
                <select class="form-select" name="category" onchange="document.getElementById('categoryForm').submit()">
                    <option value="">Semua Kategori</option>
                    <?php foreach($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" 
                            <?= (isset($categoryId) && $categoryId == $cat['id']) ? 'selected' : '' ?>>
                            <?= esc($cat['nama_kategori']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
    </div>

    <!-- Results Info -->
    <?php if(!empty($search) || !empty($categoryId)): ?>
    <div class="row mb-3">
        <div class="col">
            <div class="alert alert-info py-2">
                <small>
                    <i class="fas fa-info-circle"></i>
                    Menampilkan 
                    <?php if(!empty($search)): ?>
                        hasil pencarian untuk "<?= esc($search) ?>"
                    <?php endif; ?>
                    <?php if(!empty($search) && !empty($categoryId)): ?>
                        dan 
                    <?php endif; ?>
                    <?php if(!empty($categoryId)): ?>
                        kategori 
                        <?php 
                        $categoryName = '';
                        foreach($categories as $cat) {
                            if($cat['id'] == $categoryId) {
                                $categoryName = $cat['nama_kategori'];
                                break;
                            }
                        }
                        echo esc($categoryName);
                        ?>
                    <?php endif; ?>
                    <a href="<?= base_url('products') ?>" class="float-end text-decoration-none">
                        <small>Reset filter</small>
                    </a>
                </small>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Products Grid -->
    <div class="row">
        <?php if(!empty($products)): ?>
            <?php foreach($products as $product): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card product-card h-100">
                    <img src="<?= base_url('uploads/products/' . ($product['gambar'] ?? 'default.jpg')) ?>" 
                         class="card-img-top" alt="<?= esc($product['nama_produk']) ?>" 
                         style="height: 200px; object-fit: cover; background: #f8f9fa;"
                         onerror="this.src='https://via.placeholder.com/300x200/6c757d/ffffff?text=No+Image'">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title" style="font-size: 1rem;"><?= esc($product['nama_produk']) ?></h5>
                        <p class="card-text text-muted small mb-2"><?= esc($product['nama_kategori'] ?? 'Uncategorized') ?></p>
                        
                        <?php if(isset($product['deskripsi']) && !empty($product['deskripsi'])): ?>
                            <p class="card-text small text-muted mb-2">
                                <?php 
                                $deskripsi = strip_tags($product['deskripsi']);
                                if (strlen($deskripsi) > 80) {
                                    echo substr($deskripsi, 0, 80) . '...';
                                } else {
                                    echo $deskripsi;
                                }
                                ?>
                            </p>
                        <?php endif; ?>
                        
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <?php if(isset($product['diskon']) && $product['diskon'] > 0): ?>
                                        <span class="text-danger fw-bold">Rp <?= number_format($product['harga'] * (1 - $product['diskon']/100), 0, ',', '.') ?></span>
                                        <small class="text-muted text-decoration-line-through d-block">Rp <?= number_format($product['harga'], 0, ',', '.') ?></small>
                                        <span class="badge bg-danger"><?= $product['diskon'] ?>% OFF</span>
                                    <?php else: ?>
                                        <span class="fw-bold">Rp <?= number_format($product['harga'], 0, ',', '.') ?></span>
                                    <?php endif; ?>
                                </div>
                                <?php if(isset($product['stok'])): ?>
                                    <small class="text-muted">Stok: <?= $product['stok'] ?></small>
                                <?php endif; ?>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <a href="<?= base_url('product/' . $product['slug']) ?>" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <?php if(session()->get('logged_in')): ?>
                                    <form action="<?= base_url('cart/add') ?>" method="post">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-primary btn-sm w-100" 
                                                <?= (isset($product['stok']) && $product['stok'] <= 0) ? 'disabled' : '' ?>>
                                            <i class="fas fa-cart-plus"></i> 
                                            <?= (isset($product['stok']) && $product['stok'] <= 0) ? 'Habis' : 'Tambah' ?>
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <a href="<?= base_url('auth/login') ?>" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-sign-in-alt"></i> Login untuk Beli
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle fa-2x mb-3"></i> 
                    <h5 class="alert-heading">Tidak ada produk ditemukan</h5>
                    <?php if(!empty($search)): ?>
                        <p class="mb-0">Tidak ditemukan produk dengan kata kunci "<strong><?= esc($search) ?></strong>"</p>
                    <?php elseif(!empty($categoryId)): ?>
                        <p class="mb-0">Tidak ada produk dalam kategori ini</p>
                    <?php else: ?>
                        <p class="mb-0">Belum ada produk yang tersedia</p>
                    <?php endif; ?>
                </div>
                <a href="<?= base_url('products') ?>" class="btn btn-primary mt-3">
                    <i class="fas fa-arrow-left"></i> Kembali ke Semua Produk
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Products Count -->
    <?php if(!empty($products)): ?>
    <div class="row mt-4">
        <div class="col">
            <p class="text-muted text-center">
                Menampilkan <strong><?= count($products) ?></strong> produk
                <?php if(!empty($search)): ?>
                    untuk pencarian "<?= esc($search) ?>"
                <?php endif; ?>
            </p>
        </div>
    </div>
    <?php endif; ?>
</div>

<?= $this->include('templates/footer') ?>