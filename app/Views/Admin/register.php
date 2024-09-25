<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('image/logo.png') ?>" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            color: #343a40;
            font-family: 'Open Sans', sans-serif;
        }

        .register-container {
            background: #fff;
            color: #333;
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 400px;
            margin: 50px auto;
        }

        .register-container h2 {
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

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .alert {
            border-radius: 5px;
        }

        .link {
            color: #007bff;
            transition: color 0.3s;
        }

        .link:hover {
            color: #0056b3;
        }

        .text-center {
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="register-container">
            <h2 class="text-center mb-4">Register Admin</h2>

            <!-- Display Flash Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php elseif (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <!-- Registration Form -->
            <form action="<?= base_url('register/create') ?>" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?= old('username') ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block btn-block">Register</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="<?= base_url('js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
</body>
</html>
