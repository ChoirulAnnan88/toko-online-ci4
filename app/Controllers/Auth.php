<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        $data = [
            'title' => 'Login - Toko Online'
        ];
        return view('auth/login', $data);
    }

    public function register()
    {
    if ($this->request->getMethod() === 'post') {
        // DEBUG: Tampilkan data yang dikirim
        // echo "<pre>";
        // print_r($this->request->getPost());
        // echo "</pre>";
        // die();

        $userData = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon')
        ];

        // Validasi manual
        if (empty($userData['username'])) {
            return redirect()->back()->withInput()->with('error', 'Username harus diisi');
        }

        if (empty($userData['email'])) {
            return redirect()->back()->withInput()->with('error', 'Email harus diisi');
        }

        if (empty($userData['password'])) {
            return redirect()->back()->withInput()->with('error', 'Password harus diisi');
        }

        if (strlen($userData['password']) < 8) {
            return redirect()->back()->withInput()->with('error', 'Password minimal 8 karakter');
        }

        try {
            if ($this->userModel->save($userData)) {
                return redirect()->to('/auth/login')->with('success', 'Registrasi berhasil! Silakan login.');
            } else {
                $errors = $this->userModel->errors();
                return redirect()->back()->withInput()->with('errors', $errors);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi error: ' . $e->getMessage());
        }
    }

    $data = [
        'title' => 'Register - Toko Online'
    ];

    return view('auth/register', $data);
    }

    public function logout()
    {
        return redirect()->to('/');
    }
}