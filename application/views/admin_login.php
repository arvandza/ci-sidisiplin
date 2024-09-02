<!DOCTYPE html>
<html lang="en">
    <!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login dan Daftar</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.min.css'); ?>">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
        }
        .header h1 {
            margin: 10px 0 0;
            font-size: 24px;
            color: #007bff;
        }
        .form-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        .toggle-link {
            text-align: center;
            margin-top: 10px;
        }
        .toggle-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .toggle-link a:hover {
            text-decoration: underline;
        }
        @keyframes slideDown {
            0% {
                opacity: 0;
                transform: translateY(-100%);
                max-height: 0;
            }
            100% {
                opacity: 1;
                transform: translateY(0);
                max-height: 100px; /* Adjust this value depending on the content */
            }
        }
        .alert {
            animation: slideDown 0.5s ease-out forwards;
        }
    </style>
</head>
<body>
       
    <div class="container" id="login-container">
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        <div class="header">
            <img src="<?php echo base_url('assets/image/logosma.png'); ?>" alt="Logo SMA">
            <h1>SIDISIPLIN</h1>
        </div>
        <div class="form-header">
            <h2>Login</h2>
        </div>
        <?php echo form_open('master/authadmin'); ?>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Masukkan Password" required>
        </div>
        <div class="form-group">
            <button type="submit">Login</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</body>
</html>
