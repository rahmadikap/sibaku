<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class User extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Menampilkan daftar user
    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        return view('admin/users', $data);
    }

    // Menampilkan form untuk tambah user
    public function create()
    {
        return view('admin/create_user');
    }

    // Menyimpan user baru
    public function store()
    {
        $this->userModel->save([
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'), // Password akan otomatis di-hash di model
        ]);

        return redirect()->to('/admin/users')->with('message', 'User berhasil ditambahkan.');
    }

    // Menampilkan form edit user
    public function edit()
    {
        $id = $this->request->getPost('user_id');
        $data['user'] = $this->userModel->find($id);
        return view('admin/edit_user', $data);
    }

    // Memperbarui user
    public function update()
    {
        $id = $this->request->getPost('user_id');
        $this->userModel->update($id, [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
        ]);

        return redirect()->to('/admin/users')->with('message', 'User berhasil diperbarui.');
    }

    // Menghapus user
    public function delete()
    {
        $id = $this->request->getPost('user_id');
        $this->userModel->delete($id);
        return redirect()->to('/admin/users')->with('message', 'User berhasil dihapus.');
    }
}
