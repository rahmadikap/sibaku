<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
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
    }

    .main-header .navbar-brand {
        font-weight: bold;
        font-size: 24px;
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
    }
</style>
<body>
<!-- Header -->
<header class="main-header">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">PERPUSDA</a>
                <div class="ms-auto">
                    <h5 class="text-white"><?= session()->get('username') ?? 'pengguna' ?></h5>
                </div>
            </div>
        </nav>
    </header>

    <!-- Sidebar -->
    <aside class="main-sidebar">
        <ul class="sidebar-menu">
            <li><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
            <li><a href="<?= base_url('admin/data') ?>">Data Donasi</a></li>
            <li><a href="<?= base_url('admin/users') ?>">Manajemen User</a></li>
            <li><a href="<?= base_url('admin/laporan') ?>">Laporan</a></li>
            <li><a href="<?= base_url('login/logout') ?>">Logout</a></li>
        </ul>
    </aside>
    
    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="container">
            <h1>Dashboard Donasi Buku</h1>

            <div class="row">
                <!-- Chart Jumlah Buku Berdasarkan Bulan -->
                <div class="col-md-6">
                    <canvas id="booksByMonthChart"></canvas>
                </div>

                <!-- Chart Jumlah Buku Berdasarkan Tahun -->
                <div class="col-md-6">
                    <canvas id="booksByYearChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function () {
        // Mengambil data berdasarkan bulan
        $.getJSON("<?= base_url('dashboard/getBooksByMonth') ?>/2023", function (data) {
            let months = [];
            let totals = [];

            data.forEach(function (item) {
                let monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                months.push(monthNames[item.month - 1]);
                totals.push(item.total);
            });

            // Membuat chart untuk data berdasarkan bulan
            let ctxMonth = document.getElementById('booksByMonthChart').getContext('2d');
            let booksByMonthChart = new Chart(ctxMonth, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Jumlah Buku per Bulan',
                        data: totals,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                }
            });
        });

        // Mengambil data berdasarkan tahun
        $.getJSON("<?= base_url('dashboard/getBooksByYear') ?>", function (data) {
            let years = [];
            let totals = [];

            data.forEach(function (item) {
                years.push(item.year);
                totals.push(item.total);
            });

            // Membuat chart untuk data berdasarkan tahun
            let ctxYear = document.getElementById('booksByYearChart').getContext('2d');
            let booksByYearChart = new Chart(ctxYear, {
                type: 'line',
                data: {
                    labels: years,
                    datasets: [{
                        label: 'Jumlah Buku per Tahun',
                        data: totals,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                }
            });
        });
    });
</script>
</body>

</html>
