<!-- app/Views/errors/forbidden.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden - Akses Ditolak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJv6f+z9enQ9EPrq9rbUp9+dGZf6z1eROslxL+0eX5v0BxI24LTx0ggu4Jpf" crossorigin="anonymous">
    <style>
        body {
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .error-code {
            font-size: 6rem;
            color: #ff6f61;
            font-weight: bold;
        }
        .error-message {
            font-size: 1.5rem;
            margin-top: 20px;
            color: #333;
        }
        .btn-back {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-code">403</div>
        <div class="error-message">
            <h3>Oops! Akses Ditolak</h3>
            <p><?= lang('Auth.notEnoughPrivilege'); ?></p>
            <a href="<?= base_url('/'); ?>" class="btn btn-primary btn-back">Kembali ke Beranda</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@sweetalert2@11.0.22/dist/sweetalert2.min.js"></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Forbidden',
            text: '<?= lang('Auth.notEnoughPrivilege'); ?>',
            showConfirmButton: true,
        });
    </script>
</body>
</html>
