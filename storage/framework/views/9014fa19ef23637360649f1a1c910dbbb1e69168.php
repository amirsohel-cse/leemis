<?php
    $orders = \App\Model\VendorNotification::where('vendor_id',\Illuminate\Support\Facades\Auth::id())
                            ->whereNull('read_at')->get();
?>

<!-- Page top navbar -->
<nav class="navbar navbar-fixed-top mb-5">
    <div class="container-fluid">
        <div class="navbar-left">

            <div class="navbar-btn">
                <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-align-left"></i></button>
            </div>


            <a href="<?php echo e(route('shop.product',[Auth::user()->id,  Str::slug(Auth::user()->shop_name)])); ?>" class="mt-2 btn btn-info">
                Visit Store</a>
                <a href="<?php echo e(route('vendor.vprofile')); ?>" class="mt-2 btn btn-info">
                My Profile</a>

        </div>

        

        <div class="navbar-right">
            <div id="navbar-menu">
                <ul class="nav navbar-nav">

                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="notification-dot info" id="vendorOrderCount"><?php echo e(count($orders)); ?></span>
                            <input type="text" id="vendorId" value="<?php echo e(\Illuminate\Support\Facades\Auth::id()); ?>" hidden>
                        </a>
                        <ul class="dropdown-menu feeds_widget mt-0 animation-li-delay overflow-auto" id="vendorOrderNotify">

                            <li class="header theme-bg gradient mt-0 py-0 text-light"><a class="text-white" href="<?php echo e(route('vendor.mark-allRead',\Illuminate\Support\Facades\Auth::id())); ?>">Mark all as Read</a></li>
                            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <li>
                                    <a href="<?php echo e(url('/vendor/notify/'.$row->order_product_id.'/vendorOrder')); ?>">
                                        <div class="mr-4"><i class="fa fa-check text-green"></i></div>
                                        <div class="feeds-body">
                                            <h4 class="title text-danger">#<?php echo e($row->order_code); ?> <small class="float-right text-muted font-12"><?php echo e($row->created_at); ?></small></h4>
                                            <small><?php echo e($row->name); ?> has placed an order</small>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <?php endif; ?>
                        </ul>
                    </li>
                    <li class="dropdown" >
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu"  data-toggle="dropdown">
                            <i class="fa fa-comments"></i>
                            <span class="notification-dot info" id="reviewCount">
                                <?php @$count = 0; ?>
                                <?php $__currentLoopData = @$ratings_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($rating->vendor_id == Auth::user()->id): ?>
                                        <?php @$count++; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php echo @$count; ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu feeds_widget mt-0 animation-li-delay overflow-auto" id="notificationList">

                            <li class="header theme-bg gradient mt-0 py-0 text-light"><a class="text-white" href="<?php echo e(route('vendor.reviewMarkedAll')); ?>">Mark all as Read</a></li>

                            <?php $__currentLoopData = @$ratings_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(@$rating->vendor_id == Auth::user()->id): ?>

                                    <li>
                                        <a href="<?php echo e(route('vendor.reviewView', $rating->id)); ?>">
                                            <div class="mr-4"><i class="fa fa-check text-green"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-danger"># <?php echo e($rating->rating); ?> star. <small class="float-right text-muted font-12"><?php echo e($rating->created_at); ?></small></h4>
                                                <small><?php echo e($rating->name); ?> reviewed a product. </small>
                                            </div>
                                            <?php
                                                $seen=\App\Model\Rating::find(@$rating->id);
                                                $seen->read_status = 1;
                                                $seen->save();
                                            ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>

                    <li class="hidden-xs"><a href="javascript:void(0);" id="btnFullscreen" class="icon-menu"><i class="fa fa-arrows-alt"></i></a></li>
                    <li><a href="<?php echo e(route('vendor.logout')); ?>" class="icon-menu"><i class="fa fa-power-off"></i></a></li>
                </ul>
            </div>
        </div>

    </div>
</nav>

<?php /**PATH /var/www/html/resources/views/vendor/layout/header/page-topbar.blade.php ENDPATH**/ ?>