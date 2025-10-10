<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .card { border: none; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
        .card-header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; }
    </style>
</head>
<body>
    <!-- Simple Header untuk Auth Pages -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <i class="fas fa-store"></i> TokoOnline
            </a>
            <div class="navbar-nav">
                <?php if (current_url() == site_url('auth/register')): ?>
                    <a class="nav-link" href="<?= site_url('auth/login') ?>">Login</a>
                <?php else: ?>
                    <a class="nav-link" href="<?= site_url('auth/register') ?>">Daftar</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center py-4">
                        <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i>Daftar Akun Baru</h4>
                    </div>
                    <div class="card-body p-4">
                        <?php if (session()->has('error')): ?>
                            <div class="alert alert-danger"><?= session('error') ?></div>
                        <?php endif; ?>

                        <?php if (session()->has('errors')): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach (session('errors') as $error): ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="<?= site_url('auth/register') ?>">
                            <?= csrf_field() ?>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="username" class="form-label"><i class="fas fa-user me-1"></i>Username *</label>
                                        <input type="text" class="form-control" id="username" name="username" 
                                               value="<?= old('username') ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label"><i class="fas fa-envelope me-1"></i>Email *</label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               value="<?= old('email') ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label"><i class="fas fa-lock me-1"></i>Password *</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label"><i class="fas fa-id-card me-1"></i>Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" 
                                       value="<?= old('nama_lengkap') ?>">
                            </div>

                            <!-- TAMBAH FIELD ROLE -->
                            <div class="mb-3">
                                <label for="role" class="form-label"><i class="fas fa-user-tag me-1"></i>Role *</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="">Pilih Role</option>
                                    <option value="customer" <?= old('role') == 'customer' ? 'selected' : '' ?>>Customer</option>
                                    <option value="admin" <?= old('role') == 'admin' ? 'selected' : '' ?>>Admin</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="telepon" class="form-label"><i class="fas fa-phone me-1"></i>Telepon</label>
                                <input type="text" class="form-control" id="telepon" name="telepon" 
                                       value="<?= old('telepon') ?>">
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label"><i class="fas fa-map-marker-alt me-1"></i>Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="2"><?= old('alamat') ?></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2" id="submit-btn">
                                <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <p class="mb-0">Sudah punya akun? 
                                <a href="<?= site_url('auth/login') ?>" class="text-decoration-none">
                                    <strong>Login di sini</strong>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const btn = document.getElementById('submit-btn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mendaftarkan...';
        });
    </script>
</body>
</html>