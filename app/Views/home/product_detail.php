<?= $this->include('templates/header') ?>

    <div class="container mt-4">
        <?php if ($product): ?>
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('products') ?>">Produk</a></li>
                    <li class="breadcrumb-item active"><?= $product['nama_produk'] ?></li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-6">
                    <img src="<?= $product['gambar'] ?? 'https://via.placeholder.com/500x400?text=No+Image' ?>" 
                         class="img-fluid rounded" alt="<?= $product['nama_produk'] ?>">
                </div>
                <div class="col-md-6">
                    <h1 class="mb-3"><?= $product['nama_produk'] ?></h1>
                    <p class="text-muted">Kategori: <?= $product['nama_kategori'] ?></p>
                    
                    <div class="mb-3">
                        <?php
                        $harga = $product['diskon'] > 0 ? 
                                $product['harga'] * (1 - $product['diskon']/100) : 
                                $product['harga'];
                        ?>
                        <h2 class="text-primary">Rp <?= number_format($harga, 0, ',', '.') ?></h2>
                        <?php if($product['diskon'] > 0): ?>
                            <p class="text-danger mb-1">
                                <s>Rp <?= number_format($product['harga'], 0, ',', '.') ?></s>
                                <span class="badge bg-danger ms-2">-<?= $product['diskon'] ?>%</span>
                            </p>
                        <?php endif; ?>
                        <p class="<?= $product['stok'] > 0 ? 'text-success' : 'text-danger' ?>">
                            Stok: <?= $product['stok'] > 0 ? $product['stok'] . ' unit' : 'Habis' ?>
                        </p>
                    </div>
                    
                    <p class="mb-4"><?= nl2br($product['deskripsi'] ?? 'Tidak ada deskripsi') ?></p>
                    
                    <?php if(session()->get('logged_in')): ?>
                        <?php if($product['stok'] > 0): ?>
                            <form method="post" action="<?= base_url('add-to-cart') ?>" class="mb-4">
                                <?= csrf_field() ?>
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <label for="quantity" class="form-label">Jumlah:</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="number" class="form-control quantity-input" name="quantity" 
                                               value="1" min="1" max="<?= $product['stok'] ?>">
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary btn-lg w-100">
                                            <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                                        </button>
                                    </div>
                                </div>
                            </form>
                        <?php else: ?>
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i> Stok produk habis
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <i class="fas fa-info-circle"></i> Silakan <a href="<?= base_url('auth/login') ?>" class="alert-link">login</a> untuk membeli produk ini.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Related Products -->
            <?php if (!empty($related_products)): ?>
                <section class="mt-5">
                    <h3 class="mb-4">Produk Terkait</h3>
                    <div class="row">
                        <?php foreach($related_products as $related): ?>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card product-card h-100">
                                <img src="<?= $related['gambar'] ?? 'https://via.placeholder.com/300x200?text=No+Image' ?>" 
                                     class="card-img-top" alt="<?= $related['nama_produk'] ?>" 
                                     style="height: 150px; object-fit: cover;">
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title"><?= $related['nama_produk'] ?></h6>
                                    <div class="mt-auto">
                                        <?php
                                        $related_harga = $related['diskon'] > 0 ? 
                                                        $related['harga'] * (1 - $related['diskon']/100) : 
                                                        $related['harga'];
                                        ?>
                                        <span class="h6 text-primary">Rp <?= number_format($related_harga, 0, ',', '.') ?></span>
                                        <a href="<?= base_url('product/' . $related['slug']) ?>" class="btn btn-outline-primary btn-sm w-100 mt-1">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                <h4>Produk Tidak Ditemukan</h4>
                <p class="text-muted">Produk yang Anda cari tidak tersedia</p>
                <a href="<?= base_url('products') ?>" class="btn btn-primary">Kembali ke Produk</a>
            </div>
        <?php endif; ?>
    </div>

<?= $this->include('templates/footer') ?>