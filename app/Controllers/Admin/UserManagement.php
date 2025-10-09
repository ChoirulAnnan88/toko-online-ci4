<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserManagement extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        
        // Cek jika bukan admin, redirect ke homepage
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/')->with('error', 'Akses ditolak! Halaman untuk admin saja.');
        }
    }

    /**
     * List semua users (Admin only)
     */
    public function users()
    {
        $data = [
            'title' => 'Management User - Admin',
            'users' => $this->userModel->findAll()
        ];

        return view('admin/users/list', $data);
    }

    /**
     * Form edit user (Admin only)
     */
    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'User tidak ditemukan');
        }

        $data = [
            'title' => 'Edit User - Admin',
            'user' => $user
        ];

        return view('admin/users/edit', $data);
    }

    /**
     * Process update user (Admin only)
     */
    public function update($id)
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->with('error', 'Method tidak diizinkan');
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'User tidak ditemukan');
        }

        // Data dari form
        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'alamat'   => $this->request->getPost('alamat'),
            'telepon'  => $this->request->getPost('telepon'),
            'role'     => $this->request->getPost('role')
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
            if ($this->userModel->update($id, $data)) {
                return redirect()->to('/admin/users')->with('success', 'User berhasil diupdate!');
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal mengupdate user.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Delete user (Admin only)
     */
    public function delete($id)
    {
        // Prevent admin from deleting themselves
        if ($id == session()->get('user_id')) {
            return redirect()->to('/admin/users')->with('error', 'Tidak bisa menghapus akun sendiri!');
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'User tidak ditemukan');
        }

        if ($this->userModel->delete($id)) {
            return redirect()->to('/admin/users')->with('success', 'User berhasil dihapus!');
        } else {
            return redirect()->to('/admin/users')->with('error', 'Gagal menghapus user');
        }
    }
}