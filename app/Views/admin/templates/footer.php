        </div><!-- /.container-fluid -->
    </div><!-- /#content -->

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Admin Custom JavaScript -->
    <script>
        // Sidebar Toggle
        document.getElementById('sidebarCollapse').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            
            sidebar.classList.toggle('active');
            content.classList.toggle('active');
        });

        // Theme Toggle
        const themeToggle = document.createElement('button');
        themeToggle.className = 'btn btn-outline-secondary btn-sm position-fixed bottom-0 end-0 m-3 rounded-circle';
        themeToggle.style.width = '40px';
        themeToggle.style.height = '40px';
        themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
        themeToggle.addEventListener('click', function() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            const icon = this.querySelector('i');
            
            html.setAttribute('data-bs-theme', newTheme);
            icon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            localStorage.setItem('adminTheme', newTheme);
        });
        document.body.appendChild(themeToggle);

        // Load saved theme
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('adminTheme') || 'light';
            const html = document.documentElement;
            const toggleBtn = document.querySelector('.btn-outline-secondary[style*="40px"]');
            const icon = toggleBtn?.querySelector('i');
            
            html.setAttribute('data-bs-theme', savedTheme);
            if (icon) {
                icon.className = savedTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            }
        });

        // Auto-hide alerts
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });

        // CSRF token for AJAX
        const csrfToken = '<?= csrf_hash() ?>';
        const csrfField = '<?= csrf_token() ?>';

        // Global AJAX setup
        $.ajaxSetup({
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken
            }
        });

        // DataTables initialization
        function initDataTable(tableId, options = {}) {
            const defaultOptions = {
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
                },
                responsive: true,
                pageLength: 25,
                order: [[0, 'desc']]
            };
            
            return $('#' + tableId).DataTable({
                ...defaultOptions,
                ...options
            });
        }

        // Confirm delete
        function confirmDelete(message = 'Apakah Anda yakin ingin menghapus data ini?') {
            return confirm(message);
        }

        // Show loading
        function showLoading(button) {
            const originalText = button.innerHTML;
            button.innerHTML = '<span class="loading"></span> Loading...';
            button.disabled = true;
            return originalText;
        }

        // Hide loading
        function hideLoading(button, originalText) {
            button.innerHTML = originalText;
            button.disabled = false;
        }

        // Update order status
        function updateOrderStatus(orderId, newStatus) {
            if (!confirm('Update status pesanan menjadi: ' + newStatus + '?')) {
                return;
            }

            const button = event.target;
            const originalText = showLoading(button);

            $.ajax({
                url: '<?= base_url('admin/orders/update-status') ?>/' + orderId,
                method: 'POST',
                data: JSON.stringify({ status: newStatus }),
                contentType: 'application/json',
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert(response.message || 'Gagal update status');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat update status');
                },
                complete: function() {
                    hideLoading(button, originalText);
                }
            });
        }

        // Bulk actions
        function handleBulkAction(action, model) {
            const selectedIds = getSelectedIds();
            if (selectedIds.length === 0) {
                alert('Pilih setidaknya satu item!');
                return;
            }

            if (!confirm(`Apakah Anda yakin ingin ${action} ${selectedIds.length} item?`)) {
                return;
            }

            $.ajax({
                url: `<?= base_url('admin/') ?>${model}/bulk-action`,
                method: 'POST',
                data: JSON.stringify({
                    action: action,
                    ids: selectedIds
                }),
                contentType: 'application/json',
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert(response.message || 'Gagal melakukan aksi');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan');
                }
            });
        }

        // Get selected checkbox IDs
        function getSelectedIds() {
            const selected = [];
            document.querySelectorAll('input[type="checkbox"]:checked').forEach(checkbox => {
                if (checkbox.value) {
                    selected.push(checkbox.value);
                }
            });
            return selected;
        }

        // Select all checkboxes
        function selectAll(checkbox) {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(cb => {
                cb.checked = checkbox.checked;
            });
        }

        // Toggle user status
        function toggleUserStatus(userId, currentStatus) {
            const newStatus = currentStatus ? 0 : 1;
            const action = newStatus ? 'activate' : 'deactivate';

            if (!confirm(`Apakah Anda yakin ingin ${action} user ini?`)) {
                return;
            }

            $.ajax({
                url: `<?= base_url('admin/users/toggle-status') ?>/${userId}`,
                method: 'POST',
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert(response.message || 'Gagal update status');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan');
                }
            });
        }

        // Toggle product status
        function toggleProductStatus(productId, currentStatus) {
            const newStatus = currentStatus ? 0 : 1;
            const action = newStatus ? 'activate' : 'deactivate';

            if (!confirm(`Apakah Anda yakin ingin ${action} produk ini?`)) {
                return;
            }

            $.ajax({
                url: `<?= base_url('admin/products/toggle-status') ?>/${productId}`,
                method: 'POST',
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert(response.message || 'Gagal update status');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan');
                }
            });
        }

        // Image preview
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }

        // Format currency
        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount);
        }

        // Show toast notification
        function showToast(message, type = 'success') {
            // Create toast container if not exists
            let container = document.getElementById('toastContainer');
            if (!container) {
                container = document.createElement('div');
                container.id = 'toastContainer';
                container.className = 'toast-container position-fixed top-0 end-0 p-3';
                container.style.zIndex = '9999';
                document.body.appendChild(container);
            }

            // Create toast
            const toast = document.createElement('div');
            toast.className = `toast align-items-center text-bg-${type} border-0`;
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle me-2"></i>
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;
            
            container.appendChild(toast);
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();

            // Remove toast after hide
            toast.addEventListener('hidden.bs.toast', function() {
                toast.remove();
            });
        }

        // Initialize charts
        function initChart(canvasId, config) {
            const ctx = document.getElementById(canvasId).getContext('2d');
            return new Chart(ctx, config);
        }

        // Dashboard stats auto-refresh
        function refreshDashboardStats() {
            $.ajax({
                url: '<?= base_url('admin/dashboard/get-stats') ?>',
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        // Update stats cards here if needed
                        console.log('Stats updated:', response.data);
                    }
                }
            });
        }

        // Auto-refresh every 30 seconds
        setInterval(refreshDashboardStats, 30000);
    </script>

    <!-- Page-specific JavaScript -->
    <?php if (isset($js)): ?>
        <script><?= $js ?></script>
    <?php endif; ?>
    
    <?= $this->renderSection('scripts') ?>
</body>
</html>