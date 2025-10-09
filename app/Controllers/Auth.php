<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        echo "🔧 Auth Controller LOADED!<br>";
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
    // JIKA ADA POST DATA
    if (!empty($_POST) || $this->request->getPost('username')) {
        echo "🎯 POST DATA DITERIMA!<br>";
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        
        $data = [
            'username' => $_POST['username'] ?? 'test_user',
            'email' => $_POST['email'] ?? 'test@test.com', 
            'password' => password_hash($_POST['password'] ?? '12345678', PASSWORD_DEFAULT),
            'nama_lengkap' => $_POST['nama_lengkap'] ?? 'Test User',
            'role' => 'user'
        ];
        
        $this->userModel->insert($data);
        echo "🎉 BERHASIL! ID: " . $this->userModel->getInsertID();
        die();
    }

    // TAMPILKAN FORM TEST SEDERHANA
    echo '
    <!DOCTYPE html>
    <html>
    <head><title>TEST FORM</title></head>
    <body>
        <h1>TEST FORM SEDERHANA</h1>
        <form method="POST" action="">
            <input type="text" name="username" value="testuser" required><br>
            <input type="email" name="email" value="test@test.com" required><br>
            <input type="password" name="password" value="12345678" required><br>
            <input type="text" name="nama_lengkap" value="Test User" required><br>
            <button type="submit">SUBMIT TEST</button>
        </form>
        <p>Form ini menggunakan method POST langsung</p>
    </body>
    </html>
    ';
    die();
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/')->with('success', 'Logout berhasil!');
    }
}