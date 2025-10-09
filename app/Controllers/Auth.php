<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
        helper(['form', 'url']);
    }

    public function login()
    {
        // DEBUG: Check if method is POST
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // Cek jika field kosong
            if (empty($email) || empty($password)) {
                return redirect()->back()->with('error', 'Email dan password harus diisi')->withInput();
            }

            $user = $this->userModel->where('email', $email)->first();

            if ($user) {
                // Debug password
                // echo "Input Password: " . $password . "<br>";
                // echo "Stored Hash: " . $user['password'] . "<br>";
                // echo "Password Verify: " . ($this->userModel->verifyPassword($password, $user['password']) ? 'true' : 'false');
                // die();

                if ($this->userModel->verifyPassword($password, $user['password'])) {
                    $sessionData = [
                        'user_id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role' => $user['role'],
                        'logged_in' => true
                    ];
                    $this->session->set($sessionData);

                    return redirect()->to('/')->with('success', 'Login berhasil!');
                }
            }

            return redirect()->back()->with('error', 'Email atau password salah')->withInput();
        }

        $data = [
            'title' => 'Login - Toko Online'
        ];

        return view('auth/login', $data);
    }

    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            // Validasi manual sederhana
            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $nama_lengkap = $this->request->getPost('nama_lengkap');

            // Validasi required fields
            if (empty($username) || empty($email) || empty($password) || empty($nama_lengkap)) {
                return redirect()->back()->with('error', 'Semua field wajib diisi')->withInput();
            }

            // Validasi password length
            if (strlen($password) < 8) {
                return redirect()->back()->with('error', 'Password minimal 8 karakter')->withInput();
            }

            // Cek email unique
            $existingEmail = $this->userModel->where('email', $email)->first();
            if ($existingEmail) {
                return redirect()->back()->with('error', 'Email sudah terdaftar')->withInput();
            }

            // Cek username unique
            $existingUsername = $this->userModel->where('username', $username)->first();
            if ($existingUsername) {
                return redirect()->back()->with('error', 'Username sudah terdaftar')->withInput();
            }

            $userData = [
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'nama_lengkap' => $nama_lengkap,
                'alamat' => $this->request->getPost('alamat'),
                'telepon' => $this->request->getPost('telepon')
            ];

            try {
                if ($this->userModel->save($userData)) {
                    return redirect()->to('/auth/login')->with('success', 'Registrasi berhasil! Silakan login.');
                } else {
                    $errors = $this->userModel->errors();
                    return redirect()->back()->with('errors', $errors)->withInput();
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
            }
        }

        $data = [
            'title' => 'Register - Toko Online'
        ];

        return view('auth/register', $data);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/')->with('success', 'Logout berhasil!');
    }
}