<?= $this->include('templates/header') ?>

<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Selamat Datang di TokoOnline</h1>
        <p class="lead">Temukan produk terbaik dengan harga terbaik</p>
        <a href="<?= base_url('products') ?>" class="btn btn-primary btn-lg mt-3">
            <i class="fas fa-shopping-bag"></i> Belanja Sekarang
        </a>
    </div>
</section>

<!-- Featured Products -->
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <h2 class="text-center">Produk Unggulan</h2>
                <p class="text-center text-muted">Produk terbaik pilihan untuk Anda</p>
            </div>
        </div>
        
        <div class="row">
            <?php if(!empty($products)): ?>
                <?php foreach($products as $product): ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card product-card h-100">
                        <img src="<?= base_url('uploads/products/' . ($product['gambar'] ?: 'default.jpg')) ?>" 
                             class="card-img-top" alt="<?= esc($product['nama_produk']) ?>" 
                             style="height: 200px; object-fit: cover;"
                             onerror="this.src='https://via.placeholder.com/300x200?text=No+Image'">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= esc($product['nama_produk']) ?></h5>
                            <p class="card-text text-muted small"><?= esc($product['nama_kategori'] ?? 'Uncategorized') ?></p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <?php if(isset($product['diskon']) && $product['diskon'] > 0): ?>
                                            <span class="text-danger fw-bold">Rp <?= number_format($product['harga'] * (1 - $product['diskon']/100), 0, ',', '.') ?></span>
                                            <small class="text-muted text-decoration-line-through d-block">Rp <?= number_format($product['harga'], 0, ',', '.') ?></small>
                                        <?php else: ?>
                                            <span class="fw-bold">Rp <?= number_format($product['harga'], 0, ',', '.') ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <a href="<?= base_url('product/' . $product['slug']) ?>" class="btn btn-outline-primary btn-sm w-100">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> 
                        Tidak ada produk yang ditemukan.
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="<?= base_url('products') ?>" class="btn btn-primary">
                Lihat Semua Produk <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <h2 class="text-center">Kategori Produk</h2>
                <p class="text-center text-muted">Jelajahi berdasarkan kategori</p>
            </div>
        </div>
        
        <div class="row">
            <?php if(!empty($categories)): ?>
                <?php foreach($categories as $category): ?>
                <div class="col-md-3 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($category['nama_kategori']) ?></h5>
                            <p class="card-text text-muted small"><?= esc($category['deskripsi'] ?? 'Deskripsi kategori') ?></p>
                            <a href="<?= base_url('products?category=' . $category['id']) ?>" class="btn btn-outline-primary btn-sm">
                                Jelajahi <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Belum ada kategori yang tersedia.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->include('templates/footer') ?>