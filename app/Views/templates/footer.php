    <!-- Main Content -->
    <div class="main-content">
        <?= $this->renderSection('content') ?>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-light mt-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3">
                        <i class="fas fa-store me-2"></i>TokoOnline
                    </h5>
                    <p class="text-light-emphasis">
                        Platform belanja online terpercaya dengan berbagai produk berkualitas dan pelayanan terbaik.
                    </p>
                    <div class="social-links">
                        <a href="#" class="text-light me-3"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-whatsapp fa-lg"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="mb-3">Tautan Cepat</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?= base_url() ?>" class="text-light-emphasis text-decoration-none">Beranda</a></li>
                        <li class="mb-2"><a href="<?= base_url('products') ?>" class="text-light-emphasis text-decoration-none">Produk</a></li>
                        <li class="mb-2"><a href="<?= base_url('categories') ?>" class="text-light-emphasis text-decoration-none">Kategori</a></li>
                        <li class="mb-2"><a href="<?= base_url('about') ?>" class="text-light-emphasis text-decoration-none">Tentang Kami</a></li>
                        <li><a href="<?= base_url('contact') ?>" class="text-light-emphasis text-decoration-none">Kontak</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="mb-3">Bantuan</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?= base_url('faq') ?>" class="text-light-emphasis text-decoration-none">FAQ</a></li>
                        <li class="mb-2"><a href="<?= base_url('shipping') ?>" class="text-light-emphasis text-decoration-none">Pengiriman</a></li>
                        <li class="mb-2"><a href="<?= base_url('returns') ?>" class="text-light-emphasis text-decoration-none">Retur & Refund</a></li>
                        <li class="mb-2"><a href="<?= base_url('terms') ?>" class="text-light-emphasis text-decoration-none">Syarat & Ketentuan</a></li>
                        <li><a href="<?= base_url('privacy') ?>" class="text-light-emphasis text-decoration-none">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="mb-3">Kontak Kami</h6>
                    <ul class="list-unstyled text-light-emphasis">
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            Jl. Contoh No. 123, Jakarta
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-phone me-2"></i>
                            +62 812-3456-7890
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            support@tokoonline.com
                        </li>
                        <li>
                            <i class="fas fa-clock me-2"></i>
                            Senin - Jumat: 09:00 - 18:00
                        </li>
                    </ul>
                </div>
            </div>
            
            <hr class="my-4 bg-light">
            
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-light-emphasis">
                        &copy; <?= date('Y') ?> TokoOnline. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <img src="https://via.placeholder.com/40x25/fff/000?text=VISA" alt="Visa" class="me-2">
                    <img src="https://via.placeholder.com/40x25/fff/000?text=MC" alt="Mastercard" class="me-2">
                    <img src="https://via.placeholder.com/40x25/fff/000?text=PP" alt="PayPal" class="me-2">
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery (optional, for legacy compatibility) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Theme Toggle
        document.getElementById('themeToggle').addEventListener('click', function() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            const icon = this.querySelector('i');
            
            html.setAttribute('data-bs-theme', newTheme);
            icon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            
            // Save preference to localStorage
            localStorage.setItem('theme', newTheme);
        });

        // Load saved theme
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            const html = document.documentElement;
            const toggleBtn = document.getElementById('themeToggle');
            const icon = toggleBtn.querySelector('i');
            
            html.setAttribute('data-bs-theme', savedTheme);
            icon.className = savedTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        });

        // Global loading handler
        function showLoading() {
            document.getElementById('loadingOverlay').style.display = 'flex';
        }

        function hideLoading() {
            document.getElementById('loadingOverlay').style.display = 'none';
        }

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });

        // CSRF token for AJAX requests
        const csrfToken = '<?= csrf_hash() ?>';
        const csrfField = '<?= csrf_token() ?>';

        // Global AJAX setup
        $.ajaxSetup({
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken
            },
            beforeSend: function() {
                showLoading();
            },
            complete: function() {
                hideLoading();
            }
        });

        // Format currency helper
        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount);
        }

        // Toast notification function
        function showToast(message, type = 'success') {
            const toastContainer = document.getElementById('toastContainer') || createToastContainer();
            const toast = document.createElement('div');
            toast.className = `toast align-items-center text-bg-${type} border-0`;
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;
            toastContainer.appendChild(toast);
            
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
            
            toast.addEventListener('hidden.bs.toast', function() {
                toast.remove();
            });
        }

        function createToastContainer() {
            const container = document.createElement('div');
            container.id = 'toastContainer';
            container.className = 'toast-container position-fixed top-0 end-0 p-3';
            container.style.zIndex = '9999';
            document.body.appendChild(container);
            return container;
        }

        // Confirm dialog helper
        function confirmAction(message, callback) {
            if (confirm(message)) {
                callback();
            }
        }

        // Form validation helper
        function validateForm(formId) {
            const form = document.getElementById(formId);
            if (!form) return true;

            const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
            let isValid = true;

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            return isValid;
        }

        // Debounce function for search
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }
    </script>

    <!-- Page-specific JavaScript -->
    <?php if (isset($js)): ?>
        <script><?= $js ?></script>
    <?php endif; ?>
    
    <?= $this->renderSection('scripts') ?>
</body>
</html>