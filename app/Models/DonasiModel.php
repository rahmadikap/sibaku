<?php

namespace App\Models;

use CodeIgniter\Model;

class DonasiModel extends Model
{
    protected $table = 'donasi_buku';
    protected $primaryKey = 'id';
    protected $allowedFields = ['identitas', 'alamat_pendonasi', 'nama_pendonasi', 'email', 'nomortelepon', 'jumlah', 'keterangan', 'jumlah_eksemlar'];
    // Aktifkan fitur timestamps
    protected $useTimestamps = true;
}
