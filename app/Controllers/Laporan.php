<?php

namespace App\Controllers;

use App\Models\DonasiModel;
use CodeIgniter\Controller;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends Controller
{
    protected $donasiModel;

    public function __construct()
    {
        $this->donasiModel = new DonasiModel();
    }

    // Menampilkan halaman laporan dengan filter tahun dan bulan
    public function index()
    {
        $year = $this->request->getVar('year');
        $month = $this->request->getVar('month'); // Mendapatkan input bulan dari query string
        
        $donasiQuery = $this->donasiModel;

        // Filter data berdasarkan tahun
        if ($year) {
            $donasiQuery = $donasiQuery->where('YEAR(created_at)', $year);
        }

        // Filter data berdasarkan bulan
        if ($month) {
            $donasiQuery = $donasiQuery->where('MONTH(created_at)', $month);
        }

        $data['donasi'] = $donasiQuery->findAll();
        $data['selected_year'] = $year;
        $data['selected_month'] = $month; // Simpan bulan yang dipilih

        return view('admin/laporan', $data);
    }

    // Fungsi laporan format PDF
    public function downloadLaporanPdf()
    {
        $year = $this->request->getVar('year');
        $month = $this->request->getVar('month'); // Mendapatkan input bulan dari query string
        
        $donasiQuery = $this->donasiModel;

        // Filter data berdasarkan tahun
        if ($year) {
            $donasiQuery = $donasiQuery->where('YEAR(created_at)', $year);
        }

        // Filter data berdasarkan bulan
        if ($month) {
            $donasiQuery = $donasiQuery->where('MONTH(created_at)', $month);
        }

        $donasi = $donasiQuery->findAll();

        // Menyiapkan konten HTML untuk PDF
        $html = '<h2>Laporan Donasi Buku ' . ($year ? 'Tahun ' . $year : 'Semua Tahun');
        if ($month) {
            $bulanArray = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];
            $html .= ' Bulan ' . $bulanArray[(int)$month];
        }
        $html .= '</h2>';
        $html .= '<table border="1" cellpadding="5" cellspacing="0" width="100%">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>No</th>';
        $html .= '<th>Identitas</th>';
        $html .= '<th>Nama</th>';
        $html .= '<th>Alamat</th>';
        $html .= '<th>Email</th>';
        $html .= '<th>No Telepon</th>';
        $html .= '<th>Jumlah Donasi</th>';
        $html .= '<th>Jumlah Eksemplar</th>';
        $html .= '<th>Keterangan</th>';
        $html .= '<th>Tanggal Donasi</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $index = 1;
        foreach ($donasi as $row) {
            $html .= '<tr>';
            $html .= '<td>' . $index++ . '</td>';
            $html .= '<td>' . $row['identitas'] . '</td>';
            $html .= '<td>' . $row['nama_pendonasi'] . '</td>';
            $html .= '<td>' . $row['alamat_pendonasi'] . '</td>';
            $html .= '<td>' . $row['email'] . '</td>';
            $html .= '<td>' . $row['nomortelepon'] . '</td>';
            $html .= '<td>' . $row['jumlah'] . '</td>';
            $html .= '<td>' . $row['jumlah_eksemlar'] . '</td>';
            $html .= '<td>' . $row['keterangan'] . '</td>';
            $html .= '<td>' . date('Y-m-d', strtotime($row['created_at'])) . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';

        // Menginisialisasi dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // Mengatur ukuran dan orientasi halaman PDF
        $dompdf->setPaper('A4', 'landscape');

        // Render HTML menjadi PDF
        $dompdf->render();

        // Output file PDF untuk diunduh
        $dompdf->stream("laporan_donasi_buku_" . ($year ? $year : 'semua') . ($month ? 'bulan' . $month : '') . ".pdf", array("Attachment" => 1));
    }

    // Fungsi download laporan Excel
    public function downloadLaporanExcel()
    {
        $year = $this->request->getVar('year');
        $month = $this->request->getVar('month');

        $donasiQuery = $this->donasiModel;

        // Filter data berdasarkan tahun
        if ($year) {
            $donasiQuery = $donasiQuery->where('YEAR(created_at)', $year);
        }

        // Filter data berdasarkan bulan
        if ($month) {
            $donasiQuery = $donasiQuery->where('MONTH(created_at)', $month);
        }

        $donasi = $donasiQuery->findAll();

        // Inisialisasi Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul sheet
        $sheet->setCellValue('A1', 'LAPORAN DONASI BUKU'); // Set title in uppercase

        // Apply styling for title
        $titleStyleArray = [
            'font' => [
                'bold' => true,
                'size' => 16, // Optional: Change font size as needed
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Center alignment
            ],
        ];

        // Apply title style to the title cell
        $sheet->getStyle('A1')->applyFromArray($titleStyleArray);
        $sheet->mergeCells('A1:J1'); // Merge cells for title spanning across multiple columns

        // Style for header
        $headerStyleArray = [
            'font' => [
                'bold' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '5DADE2', // Color for header background
                ],
            ],
        ];

        // Style for data
        $dataStyleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        // Set header
        $headers = ['No', 'Identitas', 'Nama', 'Alamat', 'Email', 'No Telepon', 'Jumlah Donasi', 'Jumlah Eksemplar', 'Keterangan', 'Tanggal Donasi'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '3', $header);
            $sheet->getStyle($col . '3')->applyFromArray($headerStyleArray);
            $sheet->getColumnDimension($col)->setAutoSize(true); // Set column width to auto
            $col++;
        }

        // Set header
        $headers = ['No', 'Identitas', 'Nama', 'Alamat', 'Email', 'No Telepon', 'Jumlah Donasi', 'Jumlah Eksemplar', 'Keterangan', 'Tanggal Donasi'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '3', $header);
            $sheet->getStyle($col . '3')->applyFromArray($headerStyleArray);
            $sheet->getColumnDimension($col)->setAutoSize(true); // Set lebar kolom otomatis
            $col++;
        }

        // Memasukkan data ke dalam file Excel
        $rowNumber = 4;
        $index = 1;

        foreach ($donasi as $row) {
            $sheet->setCellValue('A' . $rowNumber, $index++);
            $sheet->setCellValue('B' . $rowNumber, $row['identitas']);
            $sheet->setCellValue('C' . $rowNumber, $row['nama_pendonasi']);
            $sheet->setCellValue('D' . $rowNumber, $row['alamat_pendonasi']);
            $sheet->setCellValue('E' . $rowNumber, $row['email']);
            $sheet->setCellValue('F' . $rowNumber, $row['nomortelepon']);
            $sheet->setCellValue('G' . $rowNumber, $row['jumlah']);
            $sheet->setCellValue('H' . $rowNumber, $row['jumlah_eksemlar']);
            $sheet->setCellValue('I' . $rowNumber, $row['keterangan']);
            $sheet->setCellValue('J' . $rowNumber, date('Y-m-d', strtotime($row['created_at'])));

            // Terapkan style pada baris data
            $sheet->getStyle('A' . $rowNumber . ':J' . $rowNumber)->applyFromArray($dataStyleArray);

            $rowNumber++;
        }

        // Menyimpan file Excel ke output
        $writer = new Xlsx($spreadsheet);
        $fileName = 'laporan_donasi_buku_' . ($year ? $year : 'semua') . ($month ? 'bulan' . $month : '') . ".xlsx";

        // Mengirim file untuk di-download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}