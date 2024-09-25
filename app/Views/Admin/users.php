<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna</title>
    <link rel="shortcut icon" href="<?= base_url('image/logo.png') ?>" />
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
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
            <h1>Daftar Pengguna</h1>

            <?php if(session()->getFlashdata('message')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('message') ?>
                </div>
            <?php endif; ?>

            <!-- Tombol untuk membuka modal tambah pengguna -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createUserModal">Tambah Pengguna Baru</button>

            <table id="userTable" class="display table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($users) && !empty($users)): ?>
                        <?php $index = 1; ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $index++ ?></td>
                                <td><?= $user['username'] ?></td>
                                <td>
                                    <!-- Tombol Edit yang membuka modal edit -->
                                    <button type="button" class="btn btn-warning btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editUserModal<?= $user['id'] ?>"
                                            data-id="<?= $user['id'] ?>"
                                            data-username="<?= $user['username'] ?>">
                                        Edit
                                    </button>

                                    <!-- Form Hapus Pengguna -->
                                    <form action="<?= base_url('admin/users/delete') ?>" method="POST" style="display:inline;">
                                        <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Edit Pengguna -->
                            <div class="modal fade" id="editUserModal<?= $user['id'] ?>" tabindex="-1" aria-labelledby="editUserModalLabel<?= $user['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editUserModalLabel<?= $user['id'] ?>">Edit Pengguna</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= base_url('admin/users/update') ?>" method="POST">
                                            <div class="modal-body">
                                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <input type="text" name="username" class="form-control" id="username<?= $user['id'] ?>" value="<?= $user['username'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" class="form-control" id="password<?= $user['id'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data pengguna.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<!-- Modal Tambah Pengguna -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Tambah Pengguna Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/users/store') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('js/jquery.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#userTable').DataTable();
         // Ketika modal edit terbuka, isi dengan data pengguna
         $('#editUserModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Tombol yang membuka modal
            var userId = button.data('id'); // Ambil data id
            var username = button.data('username'); // Ambil data username

            var modal = $(this);
            modal.find('#edit-user-id').val(userId);
            modal.find('#edit-username').val(username);
        });
    });

    function toggleSidebar() {
            document.body.classList.toggle('minimized');
        }
</script>
</body>
</html>
