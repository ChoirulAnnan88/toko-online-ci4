<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class Home extends BaseController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();

        helper(['text', 'form', 'url']);
    }

    public function index()
    {
        try {
            // DIRECT QUERY - No models
            $db = \Config\Database::connect();
            
            // Debug: Test connection
            if (!$db->connect()) {
                throw new \Exception('Database connection failed - Cannot connect to MySQL');
            }
            
            // Debug: Check if tables exist
            $tables = $db->listTables();
            
            // Products with categories
            $builder = $db->table('products p');
            $builder->select('p.*, c.nama_kategori');
            $builder->join('categories c', 'c.id = p.kategori_id', 'left');
            $builder->where('p.is_active', 1);
            $builder->limit(8);
            $products = $builder->get()->getResultArray();
            
            // Categories
            $categories = $db->table('categories')->get()->getResultArray();
            
            $data = [
                'title' => 'Toko Online - Beranda',
                'products' => $products,
                'categories' => $categories,
                'debug_info' => [ // Hapus ini di production
                    'tables_count' => count($tables),
                    'products_count' => count($products),
                    'categories_count' => count($categories)
                ]
            ];

            return view('home/index', $data);
            
        } catch (\Exception $e) {
            // Fallback with error info
            $data = [
                'title' => 'Toko Online - Beranda',
                'products' => [],
                'categories' => [],
                'error' => $e->getMessage()
            ];
            return view('home/index', $data);
        }
    }

    public function products()
    {
        try {
            $categoryId = $this->request->getGet('category');
            $search = $this->request->getGet('search');

            $db = \Config\Database::connect();
            $builder = $db->table('products p');
            $builder->select('p.*, c.nama_kategori');
            $builder->join('categories c', 'c.id = p.kategori_id', 'left');
            $builder->where('p.is_active', 1);
            
            if (!empty($categoryId)) {
                $builder->where('p.kategori_id', $categoryId);
            }
            
            if (!empty($search)) {
                $builder->groupStart()
                        ->like('p.nama_produk', $search)
                        ->orLike('p.deskripsi', $search)
                        ->groupEnd();
            }
            
            $products = $builder->get()->getResultArray();
            
            // Categories for filter
            $categories = $db->table('categories')->get()->getResultArray();

            $data = [
                'title' => 'Toko Online - Produk',
                'products' => $products,
                'categories' => $categories,
                'categoryId' => $categoryId,
                'search' => $search
            ];

            return view('home/products', $data);
            
        } catch (\Exception $e) {
            $data = [
                'title' => 'Toko Online - Produk',
                'products' => [],
                'categories' => [],
                'categoryId' => null,
                'search' => null,
                'error' => $e->getMessage()
            ];
            return view('home/products', $data);
        }
    }

    public function productDetail($slug)
    {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('products p');
            $builder->select('p.*, c.nama_kategori');
            $builder->join('categories c', 'c.id = p.kategori_id', 'left');
            $builder->where('p.slug', $slug);
            $builder->where('p.is_active', 1);
            
            $product = $builder->get()->getRowArray();
            
            if (!$product) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            $data = [
                'title' => $product['nama_produk'],
                'product' => $product
            ];

            return view('home/product_detail', $data);
            
        } catch (\Exception $e) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}