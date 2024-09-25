<?php

namespace App\Controllers;
use App\Models\DonasiModel;
class Home extends BaseController
{
    public function index(): string
    {
        $donasiModel = new DonasiModel();
        $data['donasi'] = $donasiModel->findAll(); // Mengambil semua data donasi

        return view('Home/index', $data);
    }
    public function save()
    {
        $donasiModel = new DonasiModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'identitas' => 'required|numeric',
            'alamat_pendonasi' => 'required',
            'nama_pendonasi' => 'required',
            'email' => 'required|valid_email',
            'nomortelepon' => 'permit_empty|numeric',
            'jumlah' => 'required|numeric|greater_than[0]',
            'jumlah_eksemlar' => 'required|numeric|greater_than[0]',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Simpan data
        $donasiModel->save([
            'identitas' => $this->request->getPost('identitas'),
            'alamat_pendonasi' => $this->request->getPost('alamat_pendonasi'),
            'nama_pendonasi' => $this->request->getPost('nama_pendonasi'),
            'email' => $this->request->getPost('email'),
            'nomortelepon' => $this->request->getPost('nomortelepon'),
            'jumlah' => $this->request->getPost('jumlah'),
            'jumlah_eksemlar' => $this->request->getPost('jumlah_eksemlar'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);

        // Beri pesan sukses
        return redirect()->to('index')->with('success', 'Donasi berhasil disimpan!');
    }
}
