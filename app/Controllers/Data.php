<?php

namespace App\Controllers;

use App\Models\DonasiModel;

class Data extends BaseController
{
    protected $donasiModel;

    public function __construct()
    {
        $this->donasiModel = new DonasiModel(); // Inisialisasi model
    }

    public function index()
    {
        // Mengambil semua data donasi
        $data['donasi'] = $this->donasiModel->findAll();

        // Menampilkan view dengan data donasi
        return view('admin/data', $data);
    }
}