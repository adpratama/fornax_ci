<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Fornax</title>
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/logo_bdl.png" />

    <link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/compiled/css/app.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/compiled/css/app-dark.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/compiled/css/auth.css">
</head>

<body>
    <script src="<?= base_url() ?>assets/dashboard/static/js/initTheme.js"></script>
    <div id="auth">

        <div class="row align-items-center">
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <div class="row justify-content-center align-items-center">
                        <img src="<?= base_url() ?>assets/img/logo_bdl.png" alt="Logo" class="w-75 p-5 mt-5">
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <h1 class="auth-title">Fornax</h1>
                    <p class="auth-subtitle mb-5">Please sign-in to your account</p>
                    <?= $this->session->flashdata('message_name'); ?>

                    <form action="<?= base_url('auth') ?>" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" id="username" name="username" placeholder="Enter your username" autofocus>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <!-- <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div> -->
                        <button class="btn btn-primary btn-block btn-lg shadow-lg" type="submit">Log in</button>
                    </form>
                    <div class="text-end mt-3">
                        <p><a class="" href="auth-forgot-password.html">Forgot password?</a></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>