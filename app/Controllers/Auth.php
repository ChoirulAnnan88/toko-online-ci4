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