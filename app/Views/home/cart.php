<?= $this->include('templates/header') ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2><i class="fas fa-shopping-cart"></i> Keranjang Belanja</h2>
                <p class="text-muted">Kelola produk dalam keranjang belanja Anda</p>

                <?php if (!empty($cart_items)): ?>
                    <div class="card">
                        <div class="card-body">
                            <?php foreach($cart_items as $item): ?>
                            <div class="cart-item">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <img src="<?= $item['gambar'] ?? 'https://via.placeholder.com/300x200?text=No+Image' ?>" 
                                             class="product-image" alt="<?= $item['nama_produk'] ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <h5 class="mb-1"><?= $item['nama_produk'] ?></h5>
                                        <p class="text-muted mb-0">Stok: <?= $item['stok'] ?></p>
                                        <a href="<?= base_url('product/' . $item['slug']) ?>" class="text-primary small">
                                            <i class="fas fa-eye"></i> Lihat Detail
                                        </a>
                                    </div>
                                    <div class="col-md-2">
                                        <?php
                                        $harga = $item['diskon'] > 0 ? 
                                                $item['harga'] * (1 - $item['diskon']/100) : 
                                                $item['harga'];
                                        ?>
                                        <h5 class="text-primary">Rp <?= number_format($harga, 0, ',', '.') ?></h5>
                                        <?php if($item['diskon'] > 0): ?>
                                            <small class="text-danger text-decoration-line-through">
                                                Rp <?= number_format($item['harga'], 0, ',', '.') ?>
                                            </small>
                                            <span class="badge bg-danger ms-1">-<?= $item['diskon'] ?>%</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-2">
                                        <form method="post" action="<?= base_url('update-cart') ?>" class="d-flex align-items-center">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                            <div class="input-group">
                                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" 
                                                       min="1" max="<?= $item['stok'] ?>" class="form-control quantity-input">
                                                <button type="submit" class="btn btn-outline-primary" title="Update">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-2">
                                        <h5 class="text-success">Rp <?= number_format($harga * $item['quantity'], 0, ',', '.') ?></h5>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="<?= base_url('remove-from-cart/' . $item['product_id']) ?>" 
                                           class="btn btn-outline-danger btn-sm" 
                                           onclick="return confirm('Hapus produk dari keranjang?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>

                            <div class="row mt-4">
                                <div class="col-md-8">
                                    <a href="<?= base_url('clear-cart') ?>" 
                                       class="btn btn-outline-danger"
                                       onclick="return confirm('Kosongkan seluruh keranjang?')">
                                        <i class="fas fa-trash"></i> Kosongkan Keranjang
                                    </a>
                                    <a href="<?= base_url('products') ?>" class="btn btn-outline-primary">
                                        <i class="fas fa-shopping-bag"></i> Lanjut Belanja
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h5 class="card-title">Ringkasan Belanja</h5>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Total Item:</span>
                                                <span><?= count($cart_items) ?> item</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Subtotal:</span>
                                                <span>Rp <?= number_format($cart_total, 0, ',', '.') ?></span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Ongkos Kirim:</span>
                                                <span class="text-success">Gratis</span>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between fw-bold fs-5">
                                                <span>Total:</span>
                                                <span class="text-success">Rp <?= number_format($cart_total, 0, ',', '.') ?></span>
                                            </div>
                                            <a href="<?= base_url('checkout') ?>" class="btn btn-success w-100 mt-3">
                                                <i class="fas fa-credit-card"></i> Lanjut ke Checkout
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                        <h4>Keranjang Belanja Kosong</h4>
                        <p class="text-muted">Silakan tambahkan produk ke keranjang belanja Anda</p>
                        <a href="<?= base_url('products') ?>" class="btn btn-primary btn-lg">
                            <i class="fas fa-shopping-bag"></i> Mulai Belanja
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?= $this->include('templates/footer') ?>