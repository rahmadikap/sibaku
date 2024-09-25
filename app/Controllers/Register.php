<?php

namespace App\Controllers;

use App\Models\UserModel;

class Register extends BaseController
{
    public function index()
    {
        return view('admin/register'); // Sesuaikan dengan lokasi view
    }

    public function create()
    {
        $session = session();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        // Validasi: Pastikan password dan konfirmasi password cocok
        if ($password !== $confirmPassword) {
            $session->setFlashdata('error', 'Password dan konfirmasi password tidak cocok.');
            return redirect()->back()->withInput();
        }

        $data = [
            'username' => $username,
            'password' => $password,
        ];

        $userModel = new UserModel();

        if ($userModel->insert($data)) {
            $session->setFlashdata('success', 'User berhasil dibuat.');
            return redirect()->to(base_url('login')); // Sesuaikan URL redirect jika perlu
        } else {
            $session->setFlashdata('error', 'Gagal membuat user.');
            return redirect()->back()->withInput();
        }
    }
}
