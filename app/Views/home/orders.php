<?= $this->include('templates/header') ?>

<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active">Pesanan Saya</li>
        </ol>
    </nav>

    <h2>Pesanan Saya</h2>

    <?php if (!empty($orders)): ?>
        <div class="row">
            <?php foreach($orders as $order): ?>
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Order #<?= $order['order_number'] ?></strong>
                            <span class="badge bg-<?= 
                                $order['status'] == 'pending' ? 'warning' : 
                                ($order['status'] == 'processing' ? 'info' : 
                                ($order['status'] == 'shipped' ? 'primary' : 
                                ($order['status'] == 'delivered' ? 'success' : 'danger'))) 
                            ?> ms-2">
                                <?= ucfirst($order['status']) ?>
                            </span>
                        </div>
                        <small class="text-muted"><?= date('d M Y H:i', strtotime($order['created_at'])) ?></small>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Total:</strong> Rp <?= number_format($order['total_amount'], 0, ',', '.') ?></p>
                                <p><strong>Alamat:</strong> <?= $order['alamat_pengiriman'] ?></p>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="<?= base_url('order/' . $order['id']) ?>" class="btn btn-outline-primary">
                                    <i class="fas fa-eye"></i> Detail Pesanan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-5">
            <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
            <h4>Belum Ada Pesanan</h4>
            <p class="text-muted">Anda belum memiliki pesanan.</p>
            <a href="<?= base_url('products') ?>" class="btn btn-primary">
                <i class="fas fa-shopping-bag"></i> Mulai Belanja
            </a>
        </div>
    <?php endif; ?>
</div>

<?= $this->include('templates/footer') ?>