<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom right, #1e3c72, #2a5298);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #fff;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            font-size: 14px;
            color: #bbb;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            font-size: 14px;
            outline: none;
        }

        .form-group input:focus {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        }

        .form-group .invalid-feedback {
            font-size: 12px;
            color: #f88;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            background: linear-gradient(to right, #00b09b, #96c93d);
            color: #fff;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #96c93d, #00b09b);
        }

        p {
            font-size: 14px;
            margin-top: 20px;
        }

        p a {
            color: #00c9ff;
            text-decoration: none;
            font-weight: bold;
        }

        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2><?= lang('Auth.register') ?></h2>
        <?= view('App\Views\Auth\_message_block') ?>

        <form action="<?= url_to('register') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="email"><?= lang('Auth.email') ?></label>
                <input type="email" name="email" class="<?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                    placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                <?php if (session('errors.email')) : ?>
                    <div class="invalid-feedback"><?= session('errors.email') ?></div>
                <?php endif ?>
            </div>

            <div class="form-group">
                <label for="username"><?= lang('Auth.username') ?></label>
                <input type="text" name="username" class="<?php if (session('errors.username')) : ?>is-invalid<?php endif ?>"
                    placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" required>
                <?php if (session('errors.username')) : ?>
                    <div class="invalid-feedback"><?= session('errors.username') ?></div>
                <?php endif ?>
            </div>

            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" name="nim" class="<?php if (session('errors.nim')) : ?>is-invalid<?php endif ?>"
                    placeholder="NIM" value="<?= old('nim') ?>" required>
                <?php if (session('errors.nim')) : ?>
                    <div class="invalid-feedback"><?= session('errors.nim') ?></div>
                <?php endif ?>
            </div>
            <div class="form-group">
                <label for="password"><?= lang('Auth.password') ?></label>
                <input type="password" name="password" class="<?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
                    placeholder="<?= lang('Auth.password') ?>" autocomplete="off" required>
                <?php if (session('errors.password')) : ?>
                    <div class="invalid-feedback"><?= session('errors.password') ?></div>
                <?php endif ?>
            </div>

            <div class="form-group">
                <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                <input type="password" name="pass_confirm" class="<?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>"
                    placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off" required>
                <?php if (session('errors.pass_confirm')) : ?>
                    <div class="invalid-feedback"><?= session('errors.pass_confirm') ?></div>
                <?php endif ?>
            </div>

            <button type="submit" class="btn-primary"><?= lang('Auth.register') ?></button>
        </form>

        <p><?= lang('Auth.alreadyRegistered') ?> <a href="<?= url_to('login') ?>"><?= lang('Auth.signIn') ?></a></p>
    </div>
</body>

</html>

<?= $this->endSection() ?>