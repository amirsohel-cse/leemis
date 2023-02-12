<!doctype html>
<html lang="en">

<head>
    <title>Admin</title>
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
    <!-- <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" /> -->
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
 <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightcase/2.5.0/css/lightcase.min.css" />

    <?php echo $__env->yieldContent('page-stylesheet'); ?>

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('/backend/assets/css/mooli.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/backend/assets/css/demo.css')); ?>">

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
    <?php echo $__env->yieldPushContent('custom-style'); ?>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

</head>

<body>

    <div id="body" class="theme-orange">
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

        <!-- Theme Setting -->
        <!-- <div class="themesetting">
            <a href="javascript:void(0);" class="theme_btn"><i class="fa fa-gear fa-spin"></i></a>
            <ul class="list-group">
                <li class="list-group-item">
                    <ul class="choose-skin list-unstyled mb-0">
                        <li data-theme="green">
                            <div class="green"></div>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                        </li>
                        <li data-theme="blush">
                            <div class="blush"></div>
                        </li>
                        <li data-theme="cyan" class="active">
                            <div class="cyan"></div>
                        </li>
                        <li data-theme="timber">
                            <div class="timber"></div>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                        </li>
                        <li data-theme="amethyst">
                            <div class="amethyst"></div>
                        </li>
                    </ul>
                </li>
                <li class="list-group-item d-flex align-items-center justify-content-between">
                    <span>Light Sidebar</span>
                    <label class="switch sidebar_light">
                        <input type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </li>
                <li class="list-group-item d-flex align-items-center justify-content-between">
                    <span>Gradient</span>
                    <label class="switch gradient_mode">
                        <input type="checkbox" checked="">
                        <span class="slider round"></span>
                    </label>
                </li>
                <li class="list-group-item d-flex align-items-center justify-content-between">
                    <span>Dark Mode</span>
                    <label class="switch dark_mode">
                        <input type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </li>
                <li class="list-group-item d-flex align-items-center justify-content-between">
                    <span>RTL version</span>
                    <label class="switch rtl_mode">
                        <input type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </li>
            </ul>
            <hr>
                <h4 class="btn btn-primary theme-bg gradient btn-block">Change Outlook</h4>
        </div> -->

        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>

        <div id="wrapper">
<?php /**PATH C:\xampp\htdocs\clients-project\hypershop_final\resources\views/admin/layout/header/head.blade.php ENDPATH**/ ?>