<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class Products extends BaseController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }

        $data = [
            'title' => 'Manage Products',
            'products' => $this->productModel->getProductsWithCategory()
        ];

        return view('admin/products/index', $data);
    }

    public function create()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }

        $data = [
            'title' => 'Tambah Produk',
            'categories' => $this->categoryModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/products/create', $data);
    }

    public function store()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }

        // Validation rules
        $rules = [
            'nama_produk' => 'required|min_length[3]',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'kategori_id' => 'required'
        ];

        if ($this->validate($rules)) {
            // Handle file upload
            $gambar = $this->request->getFile('gambar');
            $gambarName = 'default.jpg';

            if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
                $gambarName = $gambar->getRandomName();
                $gambar->move('uploads/products', $gambarName);
            }

            // Generate slug
            $slug = url_title($this->request->getPost('nama_produk'), '-', true) . '-' . time();

            $productData = [
                'kategori_id' => $this->request->getPost('kategori_id'),
                'nama_produk' => $this->request->getPost('nama_produk'),
                'slug' => $slug,
                'deskripsi' => $this->request->getPost('deskripsi'),
                'harga' => $this->request->getPost('harga'),
                'stok' => $this->request->getPost('stok'),
                'gambar' => $gambarName,
                'berat' => $this->request->getPost('berat') ?? 0,
                'diskon' => $this->request->getPost('diskon') ?? 0
            ];

            if ($this->productModel->save($productData)) {
                return redirect()->to('/admin/products')->with('success', 'Produk berhasil ditambahkan');
            }
        }

        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
}