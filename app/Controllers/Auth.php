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
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            if (empty($email) || empty($password)) {
                return redirect()->back()->with('error', 'Email dan password harus diisi')->withInput();
            }

            $user = $this->userModel->where('email', $email)->first();

            if ($user) {
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
        // JIKA FORM SUBMIT
        if ($this->request->getMethod() === 'post') {
            echo "🎯 DEBUG: Form Received!<br>";
            echo "Data dari form:<br>";
            echo "Username: " . $this->request->getPost('username') . "<br>";
            echo "Email: " . $this->request->getPost('email') . "<br>";
            echo "Password: " . $this->request->getPost('password') . "<br>";
            echo "Nama Lengkap: " . $this->request->getPost('nama_lengkap') . "<br>";
            
            // SIMPLE INSERT - tanpa validasi
            $data = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'alamat' => $this->request->getPost('alamat'),
                'telepon' => $this->request->getPost('telepon'),
                'role' => 'user'
            ];
            
            $this->userModel->insert($data);
            echo "🎉 BERHASIL! User created with ID: " . $this->userModel->getInsertID();
            die();
        }

        // JIKA GET REQUEST - tampilkan form
        return view('auth/register', ['title' => 'Register']);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/')->with('success', 'Logout berhasil!');
    }
}