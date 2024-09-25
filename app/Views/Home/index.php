<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi Buku</title>
    <link rel="shortcut icon" href="<?= base_url('image/logo.png') ?>" />
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <style>
        body {
            color: #343a40;
            background-image: url('<?= base_url('image/perpusda.jpg') ?>');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
        }


.logo-sibaku {
    width: 30%;
    height: 30%;
    display: block;
    margin: 20px auto 10px auto; /* Atur jarak atas dan bawah */
}

h1 {
    text-align: center;
    margin-top: 10px; /* Kurangi margin atas */
    margin-bottom: 20px; /* Kurangi margin bawah */
    color: #F0F8FF;
}

.main-header .container {
    padding-bottom: 10px; /* Sesuaikan padding bawah untuk header */
}


        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);;
            z-index: -1; /* Turunkan z-index agar tidak menutupi konten */
        }

        /* Navbar & Header */
        .main-header {
            background-color: #003366;
        }

        .navbar {
            background-color: #003366;
        }

        .navbar-brand img {
            height: 50px;
            width: auto;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: white;
            font-weight: bold;
            font-size: 1rem;
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            color: #ffc107;
        }

        /* Form Container */
        .form-container {
            max-width: 800px;
            margin: auto;
            background-color: rgba(240, 248, 255, 0.2);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            font-weight: bold;
            font-size: 16px;
            color: #00FFFF;
        }
        .form-group input {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 12px;
            font-size: 16px;
            width: 100%;
        }

        .form-group input:focus {
            border-color: #80bdff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        /* Button Styling */
        .btn-success,
        .btn-primary {
            padding: 15px 20px;
            font-size: 18px;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        /* Table Styling */
        .table-container {
            max-width: 1000px;
            margin: 50px auto;
            color : #FFFAFA;
            padding: 20px;
        }

        .dataTable-wrapper {
            overflow-x: auto;
        }

        table.dataTable {
            border-collapse: collapse;
            background-color: #fff;
            width: 100%;
        }

        table.dataTable thead {
            background-color: #C0C0C0;
            color: black;
        }

        table.dataTable tbody tr:hover {
            background-color: #f1f1f1;
        }

        table.dataTable tbody td {
            padding: 10px;
        }

        /* Footer */
        .main-footer {
            background-color: rgba(0, 0, 0, 0.7);
            color: #ffffff;
            padding: 10px 0;
            position: relative;
            display: flex;
            flex-wrap: wrap;
            margin: auto;
            bottom: 0;
            width: 100%;
            font-size: 14px;
            z-index: 2;
        }

        .main-footer a {
            color:#00FFFF;
            font-weight: bold;
        }
        
        .box-header {
        font-size: 18px;
        padding: 10px;
        }
    </style>
</head>

<body>
    <div class="overlay"></div>

    <!-- Header -->
    <header class="main-header">
        <div class="container text-center py-3">
            <img src='https://perpus.jatengprov.go.id/asset/logo/Logo_Provinsi_Jawa_Tengah_(PNG-2160p)_-_FileVector69.png' alt="Logo" style="width:70px;">
            <h4 style="color: #fff;">PERPUSDA JATENG</h4>
            <h4 style="color: #fff;">DINAS KEARSIPAN DAN PERPUSTAKAAN PROVINSI JAWA TENGAH</h4>
        </div>
    </header>
    
    <img src="<?= base_url('image/sibaku.png') ?>" alt="Logo Sibaku" class="logo-sibaku"> 

    <!-- Form Donasi -->
    <div class="container mt-5">
        <div class="box-header with-border">
        <h1>Selamat Datang di Sistem Informasi Donasi Buku</h1>
        </div>
    
        <div class="form-container">
            <!-- Menampilkan pesan sukses -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- Menampilkan pesan error -->
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <form role="form" action="<?= base_url('home/save') ?>" method="post" id="formdonasi">
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-lg-6">
            <!-- Kolom pertama dari form -->
            <div class="form-group">
                <label>NO IDENTITAS <em>(Wajib Diisi)</em></label>
                <input type="text" class="form-control input-lg" id="identitas" name="identitas" placeholder="Kartu Tanda Penduduk / SIM / Kartu Pelajar">
                <span class="err" id="invalid-identitas"></span>
            </div>
            <div class="form-group">
                <label>ALAMAT <em>(Wajib Diisi)</em></label>
                <input type="text" class="form-control input-lg" id="alamat_pendonasi" name="alamat_pendonasi" placeholder="Alamat anda">
                <span class="err" id="invalid-alamat"></span>
            </div>
            <div class="form-group">
                <label>NAMA <em>(Wajib Diisi)</em></label>
                <input type="text" class="form-control input-lg" id="nama_pendonasi" name="nama_pendonasi" placeholder="Nama Lengkap Anda">
                <span class="err" id="invalid-nama"></span>
            </div>
            <div class="form-group">
                <label>EMAIL <em>(Wajib Diisi)</em></label>
                <input type="text" class="form-control input-lg" id="email" name="email" placeholder="Email Aktif">
                <span class="err" id="invalid-email"></span>
            </div>
        </div>
        <div class="col-lg-6">
            <!-- Kolom kedua dari form -->
            <div class="form-group">
                <label>NOMOR HP <em>(Data akan kami jaga kerahasiaannya)</em></label>
                <input type="text" class="form-control input-lg" id="nomortelepon" name="nomortelepon" placeholder="Nomor yang bisa dihubungi">
                <span class="err" id="invalid-nomortelepon"></span>
            </div>
            <div class="form-group">
                <label>JUMLAH DONASI <em>(Wajib Diisi)</em></label>
                <input type="text" class="form-control input-lg" id="jumlah" name="jumlah" placeholder="Jumlah Buku">
                <span class="err" id="invalid-jumlah"></span>
            </div>
            <div class="form-group">
                <label>JUMLAH EKSEMLAR <em>(Wajib Diisi)</em></label>
                <input type="text" class="form-control input-lg" id="jumlah_eksemlar" name="jumlah_eksemlar" placeholder="Jumlah Eksemlar">
                <span class="err" id="invalid-eksemlar"></span>
            </div>
            <div class="form-group">
                <label>KETERANGAN</label>
                <input type="text" class="form-control input-lg" placeholder="Boleh tidak diisi" id="keterangan" name="keterangan">
            </div>
        </div>
    </div>

    <!-- Tombol Simpan -->
    <div class="form-group text-center">
        <button type="submit" id="simpan" class="btn btn-lg btn-block btn-success mt-4">Simpan</button>
        <a href="https://perpus.jatengprov.go.id/" class="btn btn-primary btn-lg btn-block mt-4">Kembali</a>
    </div>
</form>
            <!-- Tabel Data Donasi -->
            <div class="table-container mt-4">
                <h2>Data Donasi Buku</h2>
                <div class="dataTable-wrapper">
                    <table id="donasiTable" class="display table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah Donasi</th>
                                <th>Jumlah Eksemlar</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop Data Donasi -->
                            <?php if (isset($donasi) && !empty($donasi)): ?>
                                <?php $index = 1; ?> <!-- Inisialisasi counter untuk nomor urut -->
                                <?php foreach ($donasi as $item): ?>
                                    <tr>
                                        <td><?= $index++; ?></td> <!-- Menampilkan nomor urut -->
                                        <td><?= $item['nama_pendonasi'] ?></td>
                                        <td><?= $item['jumlah'] ?></td>
                                        <td><?= $item['jumlah_eksemlar'] ?></td>
                                        <td><?= $item['keterangan'] ?></td>
                                    </tr>
                            <?php endforeach; ?>

                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada data donasi.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer text-center">
    <div class="container">
        &copy; 2024 <a href="https://perpus.jatengprov.go.id/" target="_blank">Perpustakaan Jawa Tengah</a>. All rights reserved.
    </div>
</footer>

    <!-- Jquery dan Bootsrap JS -->
    <script src="<?= base_url('js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi DataTables pada tabel
        $('#donasiTable').DataTable();

        // Fungsi validasi form
        function validateForm(event) {
            var isValid = true;

            // Reset error messages
            document.querySelectorAll('.err').forEach(function(elem) {
                elem.textContent = '';
            });

            // Validasi input identitas
            var identitas = document.getElementById('identitas');
            var identitasValue = identitas.value.trim();
            var numberPattern = /^[0-9]+$/; // Ekspresi reguler untuk angka saja

            if (identitasValue === '') {
                document.getElementById('invalid-identitas').textContent = 'Identitas wajib diisi';
                isValid = false;
            } else if (!numberPattern.test(identitasValue)) {
                document.getElementById('invalid-identitas').textContent = 'Identitas hanya boleh berisi angka';
                isValid = false;
            }

            // Validasi input alamat pengunjung
            var alamat = document.getElementById('alamat_pendonasi');
            if (alamat.value.trim() === '') {
                document.getElementById('invalid-alamat').textContent = 'Alamat wajib diisi';
                isValid = false;
            }

            // Validasi input nama pengunjung
            var nama = document.getElementById('nama_pendonasi');
            if (nama.value.trim() === '') {
                document.getElementById('invalid-nama').textContent = 'Nama wajib diisi';
                isValid = false;
            }

            // Validasi input email
            var email = document.getElementById('email');
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regex sederhana untuk email
            if (email.value.trim() === '') {
                document.getElementById('invalid-email').textContent = 'Email wajib diisi';
                isValid = false;
            } else if (!emailPattern.test(email.value.trim())) {
                document.getElementById('invalid-email').textContent = 'Format email tidak valid';
                isValid = false;
            }

            // Validasi input nomor telepon
            var nomortelepon = document.getElementById('nomortelepon');
            var phonePattern = /^[0-9]+$/;
            if (nomortelepon.value.trim() !== '' && !phonePattern.test(nomortelepon.value)) {
                document.getElementById('invalid-nomortelepon').textContent = 'Nomor HP harus berupa angka';
                isValid = false;
            }

            // Validasi input jumlah
            var jumlah = document.getElementById('jumlah');
            var jumlahValue = parseInt(jumlah.value.trim(), 10);
            if (jumlah.value.trim() === '') {
                document.getElementById('invalid-jumlah').textContent = 'Jumlah wajib diisi';
                isValid = false;
            } else if (isNaN(jumlahValue) || jumlahValue <= 0) {
                document.getElementById('invalid-jumlah').textContent = 'Jumlah harus berupa angka lebih dari 0';
                isValid = false;
            }

             // Validasi input jumlah eksemlar
             var jumlah_eksemlar = document.getElementById('jumlah_eksemlar');
            var jumlahEksemlarValue = parseInt(jumlah_eksemlar.value.trim(), 10);
            if (jumlah_eksemlar.value.trim() === '') {
                document.getElementById('invalid-eksemlar').textContent = 'Jumlah Eksemlar wajib diisi';
                isValid = false;
            } else if (isNaN(jumlahEksemlarValue) || jumlahEksemlarValue <= 0) {
                document.getElementById('invalid-eksemlar').textContent = 'Jumlah Eksemlar harus berupa angka lebih dari 0';
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault(); // jika ada kesalahan
            }
        }

        // event listener ke tombol submit
        var form = document.getElementById('formdonasi');
        form.addEventListener('submit', validateForm);

        $(document).ready(function() {
            $('#donasiTable').DataTable({
                "paging": true,
                "searching": true,
                "info": true
            });
        });
    });
    </script>
</body>

</html>
