<?= $this->include('templates/header') ?>

<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('cart') ?>">Keranjang</a></li>
            <li class="breadcrumb-item active">Checkout</li>
        </ol>
    </nav>

    <h2>Checkout</h2>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Pengiriman</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url('checkout/process') ?>">
                        <?= csrf_field() ?>
                        
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" 
                                   value="<?= $user['nama_lengkap'] ?? '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="alamat_pengiriman" class="form-label">Alamat Pengiriman</label>
                            <textarea class="form-control" id="alamat_pengiriman" name="alamat_pengiriman" 
                                      rows="3" required><?= $user['alamat'] ?? '' ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="telepon" 
                                   value="<?= $user['telepon'] ?? '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan (Opsional)</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="2"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-credit-card"></i> Buat Pesanan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Ringkasan Pesanan</h5>
                </div>
                <div class="card-body">
                    <?php foreach($cart_items as $item): ?>
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <small><?= $item['nama_produk'] ?> x<?= $item['quantity'] ?></small>
                        </div>
                        <div>
                            <small>Rp <?= number_format(($item['diskon'] > 0 ? $item['harga'] * (1 - $item['diskon']/100) : $item['harga']) * $item['quantity'], 0, ',', '.') ?></small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>Total:</strong>
                        <strong>Rp <?= number_format($cart_total, 0, ',', '.') ?></strong>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h6>Metode Pembayaran</h6>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="cod" checked>
                        <label class="form-check-label" for="cod">
                            Cash on Delivery (COD)
                        </label>
                    </div>
                    <small class="text-muted">Bayar ketika pesanan diterima</small>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>