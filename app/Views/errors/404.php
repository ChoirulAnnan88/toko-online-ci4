<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan - Toko Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <i class="fas fa-exclamation-triangle fa-5x text-warning mb-4"></i>
                <h1>404</h1>
                <h2>Halaman Tidak Ditemukan</h2>
                <p class="lead">Maaf, halaman yang Anda cari tidak tersedia.</p>
                <div class="d-flex justify-content-center gap-2">
                    <a href="<?= base_url() ?>" class="btn btn-primary">
                        <i class="fas fa-home"></i> Kembali ke Home
                    </a>
                    <a href="<?= base_url('products') ?>" class="btn btn-outline-primary">
                        <i class="fas fa-shopping-bag"></i> Lihat Produk
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>