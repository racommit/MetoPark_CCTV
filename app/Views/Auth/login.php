<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            padding: 0 15px;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
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

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            h2 {
                font-size: 24px;
            }

            .form-group label {
                font-size: 12px;
            }

            .form-group input {
                font-size: 12px;
            }

            .btn-primary {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            h2 {
                font-size: 20px;
            }

            .container {
                padding: 20px;
            }

            .form-group label {
                font-size: 12px;
            }

            .form-group input {
                font-size: 12px;
                padding: 8px;
            }

            .btn-primary {
                padding: 8px;
                font-size: 14px;
            }

            p {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2><?= lang('Auth.signIn') ?></h2>
        <?= view('App\Views\Auth\_message_block') ?>

        <form action="<?= url_to('login') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="login"><?= lang('Auth.emailOrUsername') ?></label>
                <input type="text" name="login" class="<?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" 
                       placeholder="<?= lang('Auth.emailOrUsername') ?>" value="<?= old('login') ?>" required>
                <?php if (session('errors.login')) : ?>
                    <div class="invalid-feedback"><?= session('errors.login') ?></div>
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

            <!-- <div class="form-group">
                <input type="checkbox" name="remember" class="form-check-input">
                <label class="form-check-label" for="remember"><?= lang('Auth.rememberMe') ?></label>
            </div> -->

            <button type="submit" class="btn-primary"><?= lang('Auth.signIn') ?></button>
        </form>

        <p><?= lang('Auth.needAccount') ?> <a href="<?= url_to('register') ?>"><?= lang('Auth.register') ?></a></p>
        <p><a href="<?= url_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a></p>
    </div>
</body>

</html>

<?= $this->endSection() ?>
