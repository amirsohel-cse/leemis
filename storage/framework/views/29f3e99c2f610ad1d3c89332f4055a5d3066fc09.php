<!doctype html>
<html lang="en">

<head>
    <title>Hypershop||Seller</title>
    <?php
    $data=\App\Model\Favicon::first();
   ?>
    <?php if($data): ?>
        <link rel="icon" type="image/png" href="\storage\storeFavicon\<?php echo e($data->file); ?>">
    <?php else: ?>
        <link rel="icon" type="image/png" href="\storage\storeFavicon\common.png">
    <?php endif; ?>   
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description"
        content="Mooli Bootstrap 4x admin is super flexible, powerful, clean &amp; modern responsive admin dashboard with unlimited possibilities.">
    <meta name="author" content="GetBootstrap, design by: puffintheme.com">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('/backend/assets/vendor/bootstrap/css/bootstrap.min.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('/backend/assets/vendor/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/backend/assets/vendor/animate-css/vivify.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('/backend/assets/vendor/chartist/css/chartist.min.css')); ?>">
    <link rel="stylesheet"
        href="<?php echo e(asset('/backend/assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/backend/assets/vendor/c3/c3.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('/backend/assets/vendor/toastr/toastr.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/backend/assets/vendor/jvectormap/jquery-jvectormap-2.0.3.min.css')); ?>" />

    <link rel="stylesheet" href="<?php echo e(asset('/backend/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/backend/assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/backend/assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/backend/assets/vendor/sweetalert/sweetalert.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('/backend/assets/vendor/dropify/css/dropify.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/backend/assets/vendor/summernote/dist/summernote.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/backend/assets/vendor/summernote/dist/summernote-bs4.min.css')); ?>">

    <?php echo $__env->yieldContent('page-stylesheet'); ?>

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('/backend/assets/css/mooli.min.css')); ?>">

    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            padding: 12px 16px;
            z-index: 1;
        }

    </style>


</head>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<body>

    <div id="body" class="theme-cyan">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                    <div class="spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                      </div>
                      <div class="spinner-grow text-secondary" role="status">
                        <span class="sr-only">Loading...</span>
                      </div>
                      <div class="spinner-grow text-success" role="status">
                        <span class="sr-only">Loading...</span>
                      </div>
            </div>
        </div>

        

        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>

        <div id="wrapper">
<?php /**PATH D:\My Workspace\Web\Laravel\Work\leemis\resources\views/vendor/layout/header/head.blade.php ENDPATH**/ ?>