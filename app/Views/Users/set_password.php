<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title"><?= $title; ?></h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('users/setPassword'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" value="<?= $id; ?>">

                    <div class="form-group row">
                        <div class="col-6">
                            <input type="password" name="password" class="form-control form-control-user <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                        </div>
                    </div>
                                <br>
                    <div class="form-group row">
                        <div class="col-6">
                            <input type="password" name="pass_confirm" class="form-control form-control-user <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">Perbarui Kata Sandi</button>
                    <a href="<?= base_url('/users/index'); ?>" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        <?php if (session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= session()->getFlashdata('success'); ?>',
                showConfirmButton: false,
                timer: 3000
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: '<?= session()->getFlashdata('error'); ?>',
                showConfirmButton: true
            });
        <?php endif; ?>
    </script>

</body>

</html>