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
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header text-center py-4">
                        <h4 class="mb-0"><i class="fas fa-sign-in-alt me-2"></i>Login ke Akun Anda</h4>
                    </div>
                    <div class="card-body p-4">
                        <?php if (session()->has('error')): ?>
                            <div class="alert alert-danger"><?= session('error') ?></div>
                        <?php endif; ?>

                        <?php if (session()->has('success')): ?>
                            <div class="alert alert-success"><?= session('success') ?></div>
                        <?php endif; ?>

                        <form method="post" action="<?= site_url('auth/login') ?>">
                            <?= csrf_field() ?>

                            <div class="mb-3">
                                <label for="username" class="form-label"><i class="fas fa-user me-1"></i>Username atau Email</label>
                                <input type="text" class="form-control" id="username" name="username" 
                                       value="<?= old('username') ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label"><i class="fas fa-lock me-1"></i>Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Ingat saya</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2" id="submit-btn">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <p class="mb-0">Belum punya akun? 
                                <a href="<?= site_url('auth/register') ?>" class="text-decoration-none">
                                    <strong>Daftar di sini</strong>
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
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Logging in...';
        });
    </script>
</body>
</html>