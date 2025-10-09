<?= $this->include('templates/header') ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-user-circle me-2"></i>Profile Saya</h4>
                    <small class="opacity-75">Kelola informasi profil Anda</small>
                </div>
                <div class="card-body p-4">

                    <!-- Flash Messages -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- User Information Card -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Akun</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 text-muted">Username:</div>
                                <div class="col-sm-8 fw-bold"><?= esc($user['username']) ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-4 text-muted">Role:</div>
                                <div class="col-sm-8">
                                    <span class="badge bg-<?= $user['role'] === 'admin' ? 'danger' : 'primary' ?>">
                                        <?= ucfirst($user['role']) ?>
                                    </span>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-4 text-muted">Bergabung:</div>
                                <div class="col-sm-8">
                                    <?= date('d F Y', strtotime($user['created_at'])) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Edit Form -->
                    <form method="post" action="<?= base_url('auth/updateProfile') ?>">
                        <?= csrf_field() ?>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_lengkap" class="form-label">
                                        <i class="fas fa-user me-1 text-muted"></i>Nama Lengkap <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control <?= session()->getFlashdata('errors.nama_lengkap') ? 'is-invalid' : '' ?>" 
                                           id="nama_lengkap" name="nama_lengkap" 
                                           value="<?= old('nama_lengkap', $user['nama_lengkap'] ?? '') ?>" 
                                           placeholder="Masukkan nama lengkap"
                                           required>
                                    <?php if (session()->getFlashdata('errors.nama_lengkap')): ?>
                                        <div class="invalid-feedback">
                                            <?= session()->getFlashdata('errors.nama_lengkap') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="telepon" class="form-label">
                                        <i class="fas fa-phone me-1 text-muted"></i>Nomor Telepon <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control <?= session()->getFlashdata('errors.telepon') ? 'is-invalid' : '' ?>" 
                                           id="telepon" name="telepon" 
                                           value="<?= old('telepon', $user['telepon'] ?? '') ?>" 
                                           placeholder="08123456789"
                                           required>
                                    <?php if (session()->getFlashdata('errors.telepon')): ?>
                                        <div class="invalid-feedback">
                                            <?= session()->getFlashdata('errors.telepon') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-1 text-muted"></i>Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control <?= session()->getFlashdata('errors.email') ? 'is-invalid' : '' ?>" 
                                   id="email" name="email" 
                                   value="<?= old('email', $user['email'] ?? '') ?>" 
                                   placeholder="email@example.com"
                                   required>
                            <?php if (session()->getFlashdata('errors.email')): ?>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('errors.email') ?>
                                </div>
                            <?php endif; ?>
                            <div class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Jika mengubah email, Anda perlu verifikasi email baru.
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="alamat" class="form-label">
                                <i class="fas fa-home me-1 text-muted"></i>Alamat Lengkap
                            </label>
                            <textarea class="form-control <?= session()->getFlashdata('errors.alamat') ? 'is-invalid' : '' ?>" 
                                      id="alamat" name="alamat" 
                                      rows="4" 
                                      placeholder="Masukkan alamat lengkap untuk pengiriman"><?= old('alamat', $user['alamat'] ?? '') ?></textarea>
                            <?php if (session()->getFlashdata('errors.alamat')): ?>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('errors.alamat') ?>
                                </div>
                            <?php endif; ?>
                            <div class="form-text text-muted">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                Alamat akan digunakan untuk pengiriman pesanan.
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Update Profile
                            </button>
                            <a href="<?= base_url() ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                            </a>
                        </div>
                    </form>

                    <!-- Additional Actions -->
                    <div class="mt-4 pt-4 border-top">
                        <h6 class="mb-3"><i class="fas fa-cog me-2"></i>Actions</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <a href="<?= base_url('auth/logout') ?>" class="btn btn-outline-danger w-100"
                                   onclick="return confirm('Yakin ingin logout?')">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-outline-warning w-100" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                    <i class="fas fa-key me-2"></i>Ganti Password
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-key me-2"></i>Ganti Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Fitur ganti password akan segera tersedia.
                </div>
                <p class="text-muted">Untuk saat ini, silakan hubungi administrator untuk mengganti password Anda.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?= $this->include('templates/footer') ?>

<script>
// Auto-hide alerts after 5 seconds
setTimeout(function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        const bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
    });
}, 5000);

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const email = document.getElementById('email').value;
    const telepon = document.getElementById('telepon').value;
    
    // Basic email validation
    if (!email.includes('@')) {
        e.preventDefault();
        alert('Format email tidak valid!');
        return false;
    }
    
    // Basic phone number validation
    if (telepon.length < 10) {
        e.preventDefault();
        alert('Nomor telepon harus minimal 10 digit!');
        return false;
    }
});
</script>