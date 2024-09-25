<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('image/logo.png') ?>" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Oxygen', sans-serif;
            background-image: url('<?php echo base_url('image/logo.png'); ?>');
            background-size: 40%;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            color: #ffff;
        }

  .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7); 
        z-index: 1;
   }

    .login-box {
        width: 360px;
        padding: 20px;
        background: rgba(255, 255, 255, 0.5); 
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        margin: 100px auto;
        position: relative;
        z-index: 2;
    }

  .login-logo {
      text-align: center;
      margin-bottom: 20px;
  }

  .login-logo a {
      font-size: 32px;
      font-weight: 700;
      color: #007bff;
      text-decoration: none;
  }

  .login-logo h4 {
      font-size: 16px;
      margin: 5px 0;
      color: #555;
  }
  
  .login-box-body {
      padding: 20px;
      background: rgba(255, 255, 255, 0.5);
  }

   .form-control {
      border-radius: 5px;
      border: 1px solid #ddd;
  }

  .form-group.has-feedback .form-control-feedback {
      color: #007bff;
  }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004494;
        }

        .form-control-feedback {
            position: absolute;
            right: 15px;
            top: 15px;
            color: #6c757d;
        }

        .input-lg {
            height: 45px;
            font-size: 16px;
        }
  

        .text-center {
            text-align: center;
            padding: 10px;
        }
    </style>
</head>

<body>
<div class="overlay"></div>
    <?php if (session()->getFlashdata('msg')) : ?>
        <div id="flash-message" class="alert alert-danger text-center">
            <?= session()->getFlashdata('msg'); ?>
        </div>

        <!-- Option 2: Using JavaScript (more flexible and smoother) -->
        <script>
            setTimeout(function() {
                location.reload();
            }, 3000); // 3000 milliseconds = 3 seconds
        </script>
    <?php endif; ?>

    <div class="login-box">
        <div class="login-logo">
            <h4 class="opensans">Sistem Informasi</h4>
            <h4 class="opensans" style="font-weight:600;">Perpusda</h4>
        </div>

        <div class="login-box-body">
            <form action="<?= base_url('login') ?>" method="post">
                <div class="form-group has-feedback">
                    <input type="text" name="login_identity" id="identity" class="form-control input-lg" placeholder="Username">
                    <span class="fa fa-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" id="password" name="login_password" class="form-control input-lg" placeholder="Password">
                    <span class="fa fa-lock form-control-feedback"></span>
                </div>
                <div class="text-center">
                    <button id="submit" class="btn btn-primary btn-block">Masuk</button>
                </div>
            </form>
        </div>
    </div>
    <!-- jQuery dan Bootstrap JS -->
    <script src="<?= base_url('js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
</body>
</html>