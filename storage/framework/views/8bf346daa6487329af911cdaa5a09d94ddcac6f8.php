

<?php $__env->startSection('main-content'); ?>

<link href="<?php echo e(asset('vendor/css/bootstrap-coloroicker.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('vendor/css/common.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('vendor/css/custom.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('vendor/css/dark-side-style.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('vendor/css/jquery.tagit.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('vendor/css/plugin.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('vendor/css/responsive.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('vendor/css/style.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('vendor/css/waves.min.css')); ?>" rel="stylesheet">

<script src="<?php echo e(asset('vendor/js/bootstrap-colorpicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/js/Chart.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/js/ckeditor.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/js/custom.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/js/jquery-1.12.4.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/js/jquery.slimscroll.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/js/jqueryui.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/js/load.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/js/myscript.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/js/nicEdit.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/js/notify.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/js/plugin.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/js/tag-it.js')); ?>"></script>


<div class="content-area">
    <div class="col-lg-4 col-md-12 col-sm-12">
        <h4><strong>Hi, Welcomeback!</strong></h4>
        <span class="text-dark"><?php echo e(Auth::user()->name); ?>,</span>
    </div>
<div class="row row-cards-one">

    <div class="col-md-12 col-lg-6 col-xl-4">
        <div class="mycard bg1">
            <div style="z-index:7" class="left">
                <h5 class="title">Orders Pending! </h5>
                <span class="number"><?php echo e($total->where('vendor_id',Auth::user()->id)->where('vendor_status','=','Pending')->count()); ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-6 col-xl-4">
        <div class="mycard bg2">
            <div style="z-index:7" class="left">
                <h5 class="title">Orders Delivery! </h5>
                <span class="number"><?php echo e($total->where('vendor_id',Auth::user()->id)->where('vendor_status','=','On Delivery')->count()); ?></span>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-lg-6 col-xl-4">
    <div class="mycard bg3">
    <div style="z-index:7" class="left">
    <h5 class="title">Orders Declined!</h5>
    <span class="number"><?php echo e($total->where('vendor_id',Auth::user()->id)->where('vendor_status','=','Declined')->count()); ?></span>
    </div>

    </div>
    </div>

    <div class="col-md-12 col-lg-6 col-xl-4">
    <div class="mycard bg4">
    <div style="z-index:7" class="left">
    <h5 class="title">Total Products!</h5>
   
    <span class="number"><?php echo e($totalProduct); ?></span>
    </div>
    </div>
    </div>


    <div class="col-md-12 col-lg-6 col-xl-4">
    <div class="mycard bg5">
    <div style="z-index:7" class="left">
    <h5 class="title">
    Total Item Sold!

    </h5>
    <span class="number"><?php echo e($total->where('vendor_id',Auth::user()->id)->sum('qty')); ?>

    </span>
    </div>

    </div>
    </div>
    <div class="col-md-12 col-lg-6 col-xl-4">
    <div class="mycard bg6">
    <div style="z-index:7" class="left">
    <h5 class="title">

    Total Income
    </h5>
    <span class="number">
    <?php echo e($total->where('vendor_id',Auth::user()->id)->sum('vendor_income')); ?>

    </span>
    </div>
    <div class="right d-flex align-self-center">

    </div>
    </div>
    </div>
    <div class="col-md-12 col-lg-6 col-xl-4">
    <div class="mycard bg8">
    <div style="z-index:7" class="left">
    <h5 class="title">
    Withdraw Amount
    </h5>
    <span class="number"><?php echo e($withdraw ? $withdraw : 0); ?></span>
    </div>
    <div class="right d-flex align-self-center">

    </div>
    </div>
    </div>
    <div class="col-md-12 col-lg-6 col-xl-4">
    <div class="mycard bg7">
    <div style="z-index:7" class="left">
    <h5 class="title">
    Current Balance
    </h5>
    <span class="number"><?php echo e($total->where('vendor_id',Auth::user()->id)->sum('vendor_income')-$withdraw); ?></span>
    </div>
    <div class="right d-flex align-self-center">

    </div>
    </div>
    </div>

</div>
</div>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('vendor.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/vendor/dashboard/index.blade.php ENDPATH**/ ?>