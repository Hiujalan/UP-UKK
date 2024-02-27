<!DOCTYPE html>
<?= $this->renderSection('page-html') ?>

<!-- <html lang="en"> -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="<?= base_url() ?>/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/images/favicon.png" type="image/x-icon">
    <title>Cuba - Premium Admin Template</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <!-- css -->
    <?= $this->include('Admin/layout/css') ?>
</head>
<?= $this->renderSection('page-body') ?>

<!-- tap on top starts-->
<div class="tap-top"><i data-feather="chevrons-up"></i></div>
<!-- tap on tap ends-->

<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper box-layout" id="pageWrapper">

    <!-- Page Header Start-->
    <?= $this->include('Admin/layout/header') ?>
    <!-- Page Header Ends-->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        <?= $this->include('Admin/layout/sidebar') ?>
        <!-- Page Sidebar Ends-->

        <div class="page-body">

            <?= $this->renderSection('page-content') ?>

        </div>
        <!-- footer start-->
        <?= $this->renderSection('page-footer') ?>

    </div>
</div>
<?= $this->include('Admin/layout/script') ?>

</body>

</html>