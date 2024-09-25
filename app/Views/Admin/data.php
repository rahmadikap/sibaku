<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Donasi</title>
    <link rel="shortcut icon" href="<?= base_url('image/logo.png') ?>" />
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>
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

<body>
    <!-- Header -->
    <header class="main-header">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="btn btn-light toggle-sidebar" onclick="toggleSidebar()">☰</button>
                <img src="<?= base_url('image/sibaku.png') ?>" class="navbar-brand"></img>
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

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="container">
            <h1>Data Donasi Buku</h1>
            <!-- Data table for displaying donasi buku -->
            <table id="donasiTable" class="table table-striped table-bordered">
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
                                <td><?= $index++ ?></td>
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
