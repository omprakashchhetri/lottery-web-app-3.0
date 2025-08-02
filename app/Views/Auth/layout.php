<!DOCTYPE html>
<html lang="en">

<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Multipurpose, super flexible, powerful, clean modern responsive bootstrap 5 admin template"
        name="description" />
    <meta
        content="admin template, axelit admin template, dashboard template, flat admin template, responsive admin template, web app"
        name="keywords" />
    <meta content="la-themes" name="author" />
    <link href="<?= base_url('assets/images/logo/favicon.png') ?>" rel="icon" type="image/x-icon" />
    <link href="<?= base_url('assets/images/logo/favicon.png') ?>" rel="shortcut icon" type="image/x-icon" />

    <title><?= $this->renderSection('title') ?></title>

    <!--font-awesome-css-->
    <link href="<?= base_url('assets/vendor-assets/fontawesome/css/all.css') ?>" rel="stylesheet" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />

    <!-- iconoir icon css  -->
    <link href="<?= base_url('assets/vendor-assets/ionio-icon/css/iconoir.css') ?>" rel="stylesheet" />

    <!-- tabler icons-->
    <link href="<?= base_url('assets/vendor-assets/tabler-icons/tabler-icons.css') ?>" rel="stylesheet"
        type="text/css" />

    <!-- Bootstrap css-->
    <link href="<?= base_url('assets/vendor-assets/bootstrap/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />

    <!-- App css-->
    <link href="<?= base_url('assets/css/main-style.css') ?>" rel="stylesheet" type="text/css" />

    <!-- Responsive css-->
    <link href="<?= base_url('assets/css/responsive.css') ?>" rel="stylesheet" type="text/css" />

    <?= $this->renderSection('pageStyles') ?>
</head>

<body class="sign-in-bg">
    <main role="main">
        <?= $this->renderSection('main') ?>
    </main>

    <!-- latest jquery-->
    <script src="<?= base_url('assets/js/jquery-3.6.3.min.js') ?>"></script>

    <!-- Bootstrap js-->
    <script src="<?= base_url('assets/vendor-assets/bootstrap/bootstrap.bundle.min.js') ?>"></script>

    <?= $this->renderSection('pageScripts') ?>
</body>

</html>