<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        return view('admin/login');
    }

    public function authenticate()
    {
        $session = session();
        $model = new UserModel();
        // Ambil data dari form login
        $username = $this->request->getPost('login_identity');
        $password = $this->request->getPost('login_password');

        // Cari pengguna berdasarkan username
        $user = $model->getUserByUsername($username);

        // Verifikasi password
        if ($user && password_verify($password, $user['password'])) {
            // Set session dan redirect ke dashboard
            $session->set('logged_in', true);
            $session->set('username', $username);
            return redirect()->to(base_url('admin/data'));
        } else {
            // Jika gagal login, kembalikan ke halaman login dengan pesan error
            $session->setFlashdata('msg', 'Username atau password salah');
            return redirect()->to(base_url('login'));
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('login'));
    }
}
