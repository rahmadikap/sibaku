<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Donasi</title>
    <link rel="shortcut icon" href="<?= base_url('image/logo.png') ?>" />
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
        body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .main-header {
        background-color: #007bff;
        color: white;
        padding: 10px;
        position: fixed;
        top: 0;
        width: calc(100% - 250px);
        left: 250px;
        z-index: 1000;
        transition: left 0.3s, width 0.3s;
    }

    .main-header .navbar-brand {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .user-profile {
        display: flex;
        align-items: center;
    }

    .user-profile img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .main-sidebar {
        background-color: #343a40;
        color: white;
        height: 100%;
        position: fixed;
        top: 0;
        bottom: 0;
        width: 250px;
        padding-top: 60px;
        z-index: 1000;
        transition: width 0.3s;
    }

    .sidebar-menu {
        padding-left: 0;
        list-style-type: none;
        margin: 0;
    }

    .sidebar-menu li {
        padding: 15px;
        border-bottom: 1px solid #495057;
    }

    .sidebar-menu li a {
        color: #fff;
        text-decoration: none;
        display: block;
    }

    .sidebar-menu li a:hover {
        background-color: #007bff;
        color: #fff;
    }

    .content-wrapper {
        margin-left: 250px;
        padding: 20px;
        margin-top: 60px;
        transition: margin-left 0.3s;
    }

    .minimized .main-sidebar {
        width: 80px;
    }

    .minimized .main-header {
        width: calc(100% - 80px);
        left: 80px;
    }

    .minimized .content-wrapper {
        margin-left: 80px;
    }

    table {
        width: 100%;
        margin-top: 20px;
        background-color: #fff;
        border-collapse: collapse;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    table thead {
        background-color: #f2f2f2;
    }

    table thead th {
        padding: 10px;
        text-align: left;
    }

    table tbody td {
        padding: 10px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .main-header {
            width: 100%;
            left: 0;
        }

        .main-sidebar {
            width: 80px;
        }

        .content-wrapper {
            margin-left: 80px;
        }

        .minimized .main-header,
        .minimized .content-wrapper {
            margin-left: 80px;
        }
    }

    /* Style for the toggle button */
    .toggle-sidebar {
        background-color: transparent;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
        margin-right: 10px;
    }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="main-header">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="btn btn-light toggle-sidebar" onclick="toggleSidebar()">☰</button>
                <img src="<?= base_url('image/logo.png') ?>" class="navbar-brand"></img>
                <div class="ms-auto user-profile">
                    <img src="<?= base_url('image/default_profile.png') ?>" alt="Profile">
                    <h5 class="text-white mb-0"><?= session()->get('username') ?? 'pengguna' ?></h5>
                </div>
            </div>
        </nav>
    </header>

    <!-- Sidebar -->
    <aside class="main-sidebar">
        <ul class="sidebar-menu">
            <li><a href="<?= base_url('admin/data') ?>">Data Donasi</a></li>
            <li><a href="<?= base_url('admin/users') ?>">Manajemen User</a></li>
            <li><a href="<?= base_url('admin/laporan') ?>">Laporan</a></li>
            <li><a href="<?= base_url('login/logout') ?>">Logout</a></li>
        </ul>
    </aside>

    <div class="content-wrapper">
        <div class="container">
            <h1>Laporan Donasi Buku</h1>

            <!-- Filter Tahun -->
            <form method="get" action="">
                <label for="year">Filter berdasarkan tahun:</label>
                <select name="year" id="year">
                    <option value="">Semua Tahun</option>
                    <?php
                    $currentYear = date('Y');
                    for ($i = 2020; $i <= $currentYear; $i++) {
                        echo '<option value="' . $i . '"' . ($selected_year == $i ? ' selected' : '') . '>' . $i . '</option>';
                    }
                    ?>
                </select>
                <label for="month">Filter berdasarkan bulan:</label>
                <select name="month" id="month">
                    <option value="">Semua Bulan</option>
                    <option value="1" <?= $selected_month == 1 ? 'selected' : '' ?>>Januari</option>
                    <option value="2" <?= $selected_month == 2 ? 'selected' : '' ?>>Februari</option>
                    <option value="3" <?= $selected_month == 3 ? 'selected' : '' ?>>Maret</option>
                    <option value="4" <?= $selected_month == 4 ? 'selected' : '' ?>>April</option>
                    <option value="5" <?= $selected_month == 5 ? 'selected' : '' ?>>Mei</option>
                    <option value="6" <?= $selected_month == 6 ? 'selected' : '' ?>>Juni</option>
                    <option value="7" <?= $selected_month == 7 ? 'selected' : '' ?>>Juli</option>
                    <option value="8" <?= $selected_month == 8 ? 'selected' : '' ?>>Agustus</option>
                    <option value="9" <?= $selected_month == 9 ? 'selected' : '' ?>>September</option>
                    <option value="10" <?= $selected_month == 10 ? 'selected' : '' ?>>Oktober</option>
                    <option value="11" <?= $selected_month == 11 ? 'selected' : '' ?>>November</option>
                    <option value="12" <?= $selected_month == 12 ? 'selected' : '' ?>>Desember</option>
                </select>
                <button type="submit">Tampilkan</button>
            </form>

            <!-- Tombol Download Laporan -->
            <div class="mb-4">
                <a href="/admin/laporan/downloadLaporanPdf?year=<?= $selected_year ?>&month=<?= $selected_month ?>" target="_blank" class="btn btn-danger">Download Laporan PDF</a>
                <a href="/admin/laporan/downloadLaporanExcel?year=<?= $selected_year ?>&month=<?= $selected_month ?>" target="_blank" class="btn btn-success">Download Laporan Excel</a>
            </div>

            <!-- Tabel Data Donasi -->
            <table id="donasiTable" class="display table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Identitas</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Nomor HP</th>
                        <th>Jumlah Donasi</th>
                        <th>Jumlah Eksemplar</th>
                        <th>Keterangan</th>
                        <th>Tanggal Donasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($donasi) && !empty($donasi)): ?>
                        <?php $index = 1; ?>
                        <?php foreach ($donasi as $item): ?>
                            <tr>
                                <td><?= $index++; ?></td>
                                <td><?= $item['identitas'] ?></td>
                                <td><?= $item['nama_pendonasi'] ?></td>
                                <td><?= $item['alamat_pendonasi'] ?></td>
                                <td><?= $item['email'] ?></td>
                                <td><?= $item['nomortelepon'] ?></td>
                                <td><?= $item['jumlah'] ?></td>
                                <td><?= $item['jumlah_eksemlar'] ?></td>
                                <td><?= $item['keterangan'] ?></td>
                                <td><?= date('Y-m-d', strtotime($item['created_at'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" class="text-center">Belum ada data donasi.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="<?= base_url('js/jquery.min.js') ?>"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#donasiTable').DataTable();
        });
        
        function toggleSidebar() {
            document.body.classList.toggle('minimized');
        }
    </script>
</body>
</html>
