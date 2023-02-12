<nav class="navbar navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-left">
            <div class="navbar-btn">
                <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-align-left"></i></button>
            </div>
<a href="/" class="btn btn-info" target="_blank"><i class="fa fa-eye"></i> Visit Home</a> <a href="<?php echo e(route('admin.profile')); ?>" class="btn btn-info"><i class="fa fa-user"></i> My Profile</a>
        </div>
        <div class="navbar-right" >
          
            <div id="navbar-menu">
                 <a href="<?php echo e(route('admin.logout')); ?>" class="btn btn-danger"><i class="fa fa-power-off"></i> Logout</a>
                <ul class="nav navbar-nav">

                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu"  data-toggle="dropdown">
                            <i class="fa fa-address-book"></i>                           <?php
                                $i = 0;
                                $j = 0;
                                $k = 0;
                                foreach (Auth::user()->unreadNotifications as $notification){
                                    if ($notification->data['type'] == 'vendor' || $notification->data['type'] == 'user'){
                                        $i = $i + 1;
                                    }
                                    else if ($notification->data['type'] == 'order'){
                                        $j = $j + 1;
                                    }else if ($notification->data['type'] == 'withdraw'){
                                        $k = $k + 1;
                                    }
                                }
                            ?>
                            <span class="notification-dot info" id="vendorCount"><?=$i?></span>
                        </a>
                        <ul class="dropdown-menu feeds_widget mt-0 animation-li-delay overflow-auto" id="vendorSignupNotification">

                            <li class="header theme-bg gradient mt-0 py-0 text-light"><a class="text-white" href="<?php echo e(route('vendor.markAllAsRead')); ?>">Mark all as Read</a></li>

                            <?php $__currentLoopData = Auth::user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($notification->data['type'] == 'vendor'): ?>
                                    <li>
                                        <a href="<?php echo e(url('/admin/notify/vendor-list/'.$notification->id)); ?>">
                                            <div class="mr-4"><i class="fa fa-check text-green"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-danger">#<?php echo e($notification->data['name']); ?> <small class="float-right text-muted font-12"><?php echo e($notification->created_at); ?></small></h4>
                                                <small><?php echo e($notification->data['text']); ?></small>
                                            </div>
                                        </a>
                                    </li>
                                <?php elseif($notification->data['type'] == 'user'): ?>
                                    <li>
                                        <a href="<?php echo e(url('/admin/notify/user-list/'.$notification->id)); ?>">
                                            <div class="mr-4"><i class="fa fa-check text-green"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-danger">#<?php echo e($notification->data['name']); ?> <small class="float-right text-muted font-12"><?php echo e($notification->created_at); ?></small></h4>
                                                <small><?php echo e($notification->data['text']); ?></small>
                                            </div>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                    <li class="dropdown" >
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu"  data-toggle="dropdown">
                            <i class="fa fa-bank"></i>
                           <span class="notification-dot info" id="withdrawNotificationCount"><?=$k?></span>
                        </a>
                        <ul class="dropdown-menu feeds_widget mt-0 animation-li-delay overflow-auto" id="withdrawNotificationList">

                            <li class="header theme-bg gradient mt-0 py-0 text-light"><a class="text-white" href="<?php echo e(route('withdraw.markAllAsRead')); ?>">Mark all as Read</a></li>

                            <?php $__currentLoopData = Auth::user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($notification->data['type'] == 'withdraw'): ?>
                                    <li>
                                        <a href="<?php echo e(route('notify.withdraw',$notification->id)); ?>">
                                            <div class="mr-4"><i class="fa fa-check text-green"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-danger">Tk. <?php echo e($notification->data['amount']); ?> <small class="float-right text-muted font-12"><?php echo e($notification->created_at); ?></small></h4>
                                                <small><?php echo e($notification->data['name']); ?> <?php echo e($notification->data['text']); ?></small>
                                            </div>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                    <li class="dropdown" >
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu"  data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="notification-dot info" id="orderCount"><?=$j?></span>
                        </a>
                        <ul class="dropdown-menu feeds_widget mt-0 animation-li-delay overflow-auto" id="notificationList">

                            <li class="header theme-bg gradient mt-0 py-0 text-light"><a class="text-white" href="<?php echo e(route('markAllAsRead')); ?>">Mark all as Read</a></li>

                            <?php $__currentLoopData = Auth::user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($notification->data['type'] == 'order'): ?>
                                    <li>
                                        <a href="<?php echo e(route('notify.order.details', $notification->data['order_id'] )); ?>">
                                            <div class="mr-4"><i class="fa fa-check text-green"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-danger">#<?php echo e($notification->data['order_code']); ?> <small class="float-right text-muted font-12"><?php echo e($notification->created_at); ?></small></h4>
                                                <small><?php echo e($notification->data['name']); ?> <?php echo e($notification->data['text']); ?></small>
                                            </div>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                    <li class="dropdown" >
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu"  data-toggle="dropdown">
                            <i class="fa fa-comments"></i>
                            <span class="notification-dot info" id="orderCount"><?php echo count(@$ratings_all ?? []) ?></span>
                        </a>
                        <ul class="dropdown-menu feeds_widget mt-0 animation-li-delay overflow-auto" id="notificationList">

                            <li class="header theme-bg gradient mt-0 py-0 text-light"><a class="text-white" href="<?php echo e(route('admin.reviewMarkedAll')); ?>">Mark all as Read</a></li>

                            <?php $__currentLoopData = @$ratings_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('admin.reviewView', $rating->id)); ?>">
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
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>

                    <li class="hidden-xs"><a href="javascript:void(0);" id="btnFullscreen" class="icon-menu"><i class="fa fa-arrows-alt"></i></a></li>
                    <!-- <li><a href="<?php echo e(route('admin.logout')); ?>" class="icon-menu"><i class="fa fa-power-off"></i></a></li> -->
                </ul>
            </div>
        </div>

    </div>
</nav>


<?php /**PATH C:\xampp\htdocs\hypershop\resources\views/admin/layout/header/page-topbar.blade.php ENDPATH**/ ?>