<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">

    <!-- Mobile First -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $title ?? 'BUMDes' ?></title>

    <!-- Font Awesome -->
    <link href="<?= base_url('assets/sbadmin2/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">

    <!-- SB Admin 2 Core CSS -->
    <link href="<?= base_url('assets/sbadmin2/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <script>
(function () {
    const theme = localStorage.getItem('theme');
    if (theme === 'light') {
        document.body.classList.remove('dark-mode');
    } else {
        document.body.classList.add('dark-mode');
    }
})();
</script>

    <style>
        html, body {
            height: 100%;
        }

        body {
            font-size: 14px;
        }

        /* Mobile heading normalization */
        @media (max-width: 767px) {
            h1, h2, h3, h4 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body id="page-top" class="dark-mode">

<div id="wrapper">

    <?php $this->load->view('templates/sidebar'); ?>

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            <?php $this->load->view('templates/topbar'); ?>
