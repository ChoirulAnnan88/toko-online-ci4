<?= $this->include('templates/header') ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card">
                <div class="card-body py-5">
                    <div class="text-success mb-3">
                        <i class="fas fa-check-circle fa-5x"></i>
                    </div>
                    <h2 class="text-success">Pesanan Berhasil!</h2>
                    <p class="lead">Terima kasih telah berbelanja di toko kami.</p>
                    
                    <div class="alert alert-info">
                        <strong>Nomor Pesanan:</strong> <?= $order_number ?>
                    </div>

                    <p>Kami akan memproses pesanan Anda segera. Anda dapat melacak pesanan di halaman <strong>Pesanan Saya</strong>.</p>

                    <div class="d-grid gap-2">
                        <a href="<?= base_url('orders') ?>" class="btn btn-primary">
                            <i class="fas fa-list"></i> Lihat Pesanan Saya
                        </a>
                        <a href="<?= base_url('products') ?>" class="btn btn-outline-primary">
                            <i class="fas fa-shopping-bag"></i> Lanjutkan Belanja
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>