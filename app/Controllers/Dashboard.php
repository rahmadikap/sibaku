<?php

namespace App\Controllers;

use App\Models\DonasiModel;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
    protected $donasiModel;

    public function __construct()
    {
        $this->donasiModel = new DonasiModel();
    }

    // Menampilkan halaman dashboard dengan chart
    public function index()
    {
        return view('admin/dashboard');
    }

    // Mendapatkan data berdasarkan bulan
    public function getBooksByMonth($year)
    {
        $query = $this->donasiModel
            ->select("MONTH(created_at) as month, SUM(jumlah) as total")
            ->where("YEAR(created_at)", $year)
            ->groupBy("MONTH(created_at)")
            ->orderBy("month")
            ->findAll();

        $data = [];

        // Melengkapi data untuk setiap bulan
        for ($i = 1; $i <= 12; $i++) {
            $found = false;
            foreach ($query as $row) {
                if ($row['month'] == $i) {
                    $data[] = [
                        'month' => $i,
                        'total' => $row['total']
                    ];
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $data[] = [
                    'month' => $i,
                    'total' => 0
                ];
            }
        }

        return $this->response->setJSON($data);
    }

    // Mendapatkan data berdasarkan tahun
    public function getBooksByYear()
    {
        $query = $this->donasiModel
            ->select("YEAR(created_at) as year, SUM(jumlah) as total")
            ->groupBy("YEAR(created_at)")
            ->orderBy("year")
            ->findAll();

        return $this->response->setJSON($query);
    }
}
