<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Navigation (sama seperti products.php) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <i class="fas fa-store"></i> TokoOnline
            </a>
            <!-- ... sama seperti sebelumnya ... -->
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Kategori Produk</h2>
        
        <?php if (!empty($categories)): ?>
            <div class="row">
                <?php foreach($categories as $category): ?>
                <div class="col-md-4 mb-4">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= $category['nama'] ?? 'Kategori' ?></h5>
                            <p class="card-text text-muted"><?= $category['jumlah'] ?? 0 ?> produk</p>
                            <a href="<?= base_url('products?kategori=' . ($category['nama'] ?? '#')) ?>" class="btn btn-primary">
                                Lihat Produk
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-tags fa-4x text-muted mb-3"></i>
                <h4>Belum Ada Kategori</h4>
                <p class="text-muted">Kategori akan ditampilkan di sini setelah database diisi</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer (sama seperti sebelumnya) -->
</body>
</html>