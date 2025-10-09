<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\OrderModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $orderModel;
    protected $userModel;

    public function __construct()
    {
        // Initialize models
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->orderModel = new OrderModel();
        $this->userModel = new UserModel();
    }

    /**
     * Check if user is authenticated and has admin role
     */
    private function checkAdminAccess()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu!');
            return redirect()->to('/auth/login');
        }

        // Check if user has admin role
        if (session()->get('role') !== 'admin') {
            session()->setFlashdata('error', 'Akses ditolak! Hanya administrator yang dapat mengakses halaman ini.');
            return redirect()->to('/');
        }

        return true;
    }

    /**
     * Log security event
     */
    private function logSecurityEvent($action, $details = '')
    {
        $userId = session()->get('user_id');
        $username = session()->get('username');
        $ipAddress = $this->request->getIPAddress();
        
        $logMessage = "SECURITY: [{$action}] User: {$username} (ID: {$userId}) | IP: {$ipAddress}";
        if ($details) {
            $logMessage .= " | Details: {$details}";
        }
        
        log_message('info', $logMessage);
    }

    public function dashboard()
    {
        // Check admin access
        $accessCheck = $this->checkAdminAccess();
        if ($accessCheck !== true) return $accessCheck;

        $this->logSecurityEvent('ACCESS_ADMIN_DASHBOARD');

        try {
            $data = [
                'title' => 'Admin Dashboard - Toko Online',
                'total_products' => $this->productModel->countAll(),
                'total_categories' => $this->categoryModel->countAll(),
                'total_orders' => $this->orderModel->countAll(),
                'total_users' => $this->userModel->where('role', 'customer')->countAllResults(),
                'recent_orders' => $this->orderModel->orderBy('created_at', 'DESC')->findAll(5)
            ];
            
            return view('admin/dashboard', $data);
        } catch (\Exception $e) {
            $this->logSecurityEvent('ERROR_DASHBOARD', $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem.');
        }
    }

    public function products()
    {
        // Check admin access
        $accessCheck = $this->checkAdminAccess();
        if ($accessCheck !== true) return $accessCheck;

        $this->logSecurityEvent('ACCESS_ADMIN_PRODUCTS');

        try {
            $data = [
                'title' => 'Kelola Produk - Admin',
                'products' => $this->productModel->getProductsWithCategory()
            ];
            
            return view('admin/products', $data);
        } catch (\Exception $e) {
            $this->logSecurityEvent('ERROR_PRODUCTS', $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data produk.');
        }
    }

    public function categories()
    {
        // Check admin access
        $accessCheck = $this->checkAdminAccess();
        if ($accessCheck !== true) return $accessCheck;

        $this->logSecurityEvent('ACCESS_ADMIN_CATEGORIES');

        try {
            $data = [
                'title' => 'Kelola Kategori - Admin',
                'categories' => $this->categoryModel->getCategoriesWithProductCount()
            ];
            
            return view('admin/categories', $data);
        } catch (\Exception $e) {
            $this->logSecurityEvent('ERROR_CATEGORIES', $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data kategori.');
        }
    }

    public function orders()
    {
        // Check admin access
        $accessCheck = $this->checkAdminAccess();
        if ($accessCheck !== true) return $accessCheck;

        $this->logSecurityEvent('ACCESS_ADMIN_ORDERS');

        try {
            $data = [
                'title' => 'Kelola Pesanan - Admin',
                'orders' => $this->orderModel->orderBy('created_at', 'DESC')->findAll()
            ];
            
            return view('admin/orders', $data);
        } catch (\Exception $e) {
            $this->logSecurityEvent('ERROR_ORDERS', $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data pesanan.');
        }
    }

    public function users()
    {
        // Check admin access
        $accessCheck = $this->checkAdminAccess();
        if ($accessCheck !== true) return $accessCheck;

        $this->logSecurityEvent('ACCESS_ADMIN_USERS');

        try {
            $data = [
                'title' => 'Kelola Users - Admin',
                'users' => $this->userModel->where('role', 'customer')->findAll()
            ];
            
            return view('admin/users', $data);
        } catch (\Exception $e) {
            $this->logSecurityEvent('ERROR_USERS', $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data users.');
        }
    }

    /**
     * Update order status - AJAX endpoint
     */
    public function updateOrderStatus($orderId)
    {
        // Check admin access
        $accessCheck = $this->checkAdminAccess();
        if ($accessCheck !== true) return $this->response->setJSON(['success' => false, 'message' => 'Access denied']);

        // Validate request method
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request method']);
        }

        try {
            $newStatus = $this->request->getJSON()->status;
            $allowedStatus = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
            
            // Validate status
            if (!in_array($newStatus, $allowedStatus)) {
                return $this->response->setJSON(['success' => false, 'message' => 'Status tidak valid']);
            }

            // Update order
            $result = $this->orderModel->update($orderId, ['status' => $newStatus]);
            
            if ($result) {
                $this->logSecurityEvent('UPDATE_ORDER_STATUS', "Order ID: {$orderId} -> Status: {$newStatus}");
                return $this->response->setJSON(['success' => true, 'message' => 'Status berhasil diupdate']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal update status']);
            }
            
        } catch (\Exception $e) {
            $this->logSecurityEvent('ERROR_UPDATE_ORDER', $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Terjadi kesalahan sistem']);
        }
    }

    /**
     * CSRF Protection for forms
     */
    public function getCSRFToken()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['error' => 'Access denied']);
        }

        return $this->response->setJSON([
            'token' => csrf_hash(),
            'field' => csrf_token()
        ]);
    }
}