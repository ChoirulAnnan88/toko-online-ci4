<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    protected $productModel;
    protected $orderModel;
    protected $userModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->orderModel = new OrderModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Check admin role
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }

        $data = [
            'title' => 'Admin Dashboard',
            'totalProducts' => $this->productModel->countAll(),
            'totalOrders' => $this->orderModel->countAll(),
            'totalUsers' => $this->userModel->where('role', 'customer')->countAllResults(),
            'recentOrders' => $this->orderModel->orderBy('created_at', 'DESC')->findAll(5)
        ];

        return view('admin/dashboard', $data);
    }
}