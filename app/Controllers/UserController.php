<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    /**
     * Menampilkan form create user
     */
    public function create()
    {
        return view('user_create');
    }

    /**
     * Menampilkan form edit user
     */
    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }

        return view('user_edit', ['user' => $user]);
    }

    /**
     * PROSES CREATE USER - dengan handling duplicate
     */
    public function store()
    {
        // Cek method harus POST
        if (!$this->request->is('post')) {
            return redirect()->back()->with('error', 'Method tidak diizinkan');
        }

        $userModel = new UserModel();
        $validation = \Config\Services::validation();

        // Data dari form
        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'alamat'   => $this->request->getPost('alamat'),
            'telepon'  => $this->request->getPost('telepon'),
            'role'     => $this->request->getPost('role') ?? 'customer'
        ];

        // Validasi data
        if (!$userModel->validate($data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $userModel->errors());
        }

        try {
            // INSERT data - akan throw exception jika duplicate
            if ($userModel->insert($data)) {
                // REDIRECT setelah sukses - PENTING untuk cegah duplicate on refresh
                return redirect()->to(base_url('user/success'))
                    ->with('success', 'User berhasil dibuat!')
                    ->with('user_id', $userModel->getInsertID());
            } else {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Gagal membuat user, silakan coba lagi.');
            }

        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            // Handle database exception (termasuk duplicate entry)
            $errorMessage = $e->getMessage();

            if (strpos($errorMessage, 'Duplicate entry') !== false) {
                if (strpos($errorMessage, 'username') !== false) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Username sudah digunakan, silakan pilih username lain.');
                } elseif (strpos($errorMessage, 'email') !== false) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Email sudah terdaftar, silakan gunakan email lain.');
                }
            }

            // Generic database error
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan database: ' . $errorMessage);
                
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * PROSES UPDATE USER
     */
    public function update($id)
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->with('error', 'Method tidak diizinkan');
        }

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }

        // Data dari form
        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'alamat'   => $this->request->getPost('alamat'),
            'telepon'  => $this->request->getPost('telepon'),
            'role'     => $this->request->getPost('role') ?? 'customer'
        ];

        // Jika password diisi, update password
        if ($this->request->getPost('password')) {
            $data['password'] = $this->request->getPost('password');
        }

        // Custom validation rules untuk update (exclude current id)
        $rules = [
            'username' => "required|min_length[3]|max_length[100]|is_unique[users.username,id,{$id}]",
            'email'    => "required|valid_email|max_length[255]|is_unique[users.email,id,{$id}]",
            'password' => 'permit_empty|min_length[3]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        try {
            if ($userModel->update($id, $data)) {
                return redirect()->to(base_url('user/success'))
                    ->with('success', 'User berhasil diupdate!');
            } else {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Gagal mengupdate user.');
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * SUCCESS PAGE - untuk redirect setelah operasi sukses
     */
    public function success()
    {
        return view('user_success');
    }

    /**
     * LIST USER (optional)
     */
    public function index()
    {
        $userModel = new UserModel();
        $users = $userModel->findAll();

        return view('user_list', ['users' => $users]);
    }
}