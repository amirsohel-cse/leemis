<div id="left-sidebar" class="sidebar">
    <a href="#" class="menu_toggle"><i class="fa fa-angle-left"></i></a>
    <div class="navbar-brand">
        <?php
        $file=App\Model\Logo::where('type','sidebar')->first();
        $file2=App\Model\Logo::where('type','barText')->first();
        ?>
        <?php if($file): ?>
            <a href="/vendor/dashboard"><img src="<?php echo e(asset('/storage/storeLogo')); ?>/<?php echo e($file->file); ?>" alt="Logo" class="img-fluid logo"></a>
            <?php else: ?>
            <p>Company Logo</p>    
          <?php endif; ?>
        <?php if($file2): ?>
            <span><?php echo e($file2->file); ?></span>
            <?php else: ?>
            <span>Company Name</span>
        <?php endif; ?>
        <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i class="fa fa-close"></i></button>

    </div>
    <div class="sidebar-scroll">
        <div class="user-account">
            <div class="user_div">
                <img src="<?php echo e(asset('uploads/vendors/'.Auth::user()->shop_image)); ?>"  class="user-photo" alt="Profile Picture">
            </div>
            <div class="dropdown">
                <span>Vendor</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong><?php echo e(Auth::user()->name); ?></strong></a>
                <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
                    <li><a href="<?php echo e(route('vendor.vprofile')); ?>"><i class="fa fa-user"></i>My Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo e(route('vendor.logout')); ?>"><i class="fa fa-power-off"></i>Logout</a></li>
                </ul>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu animation-li-delay">
                
                <li class="<?php echo e(Request::is('vendor/dashboard') ? 'active' : ''); ?>"><a href="<?php echo e(route('vendor.dashboard')); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                <li class="<?php echo e(Request::is('vendor/orders/view') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('vendorOrders.view')); ?>"><i class="fa fa-anchor"></i><span>Orders</span></a>
                </li>

                


                <li  class="<?php echo e(Request::is('vendor/product/*') ? 'active' : ''); ?>">
                    <a href="#product" class="has-arrow"><i class="fa fa-cart-plus"></i><span>Products</span></a>
                    <ul class="metismenu">
                        <li class="<?php echo e(Request::is('vendor/product/addProduct') ? 'active' : ''); ?>"><a href="<?php echo e(route('vendor.addproduct')); ?>" id= button>Add New Product</a></li>
                        <li class="<?php echo e(Request::is('vendor/product/allProducts') ? 'active' : ''); ?>"><a href="<?php echo e(route('vendor.allProducts')); ?>">All Products</a></li>
                        <li class="<?php echo e(Request::is('vendor/product/deActivatedProducts') ? 'active' : ''); ?>"><a href="<?php echo e(route('vendor.deActivatedProducts')); ?>">Deactivated Products</a></li>
                        

                    </ul>
                </li>

                <li class="<?php echo e(Request::is('vendor/profile', 'vendor/setting/banner') ? 'active' : ''); ?>">
                    <a href="#" class="has-arrow"><i class="fa fa-anchor"></i><span>Setting</span></a>
                    <ul class="metismenu">
                        <li class="<?php echo e(Request::is('vendor/profile') ? 'active' : ''); ?>"><a href="<?php echo e(route('vendor.profile')); ?>">Shop Setting</a></li>
                        <li class="<?php echo e(Request::is('vendor/setting/banner') ? 'active' : ''); ?>"><a href="<?php echo e(route('vendor.banner')); ?>">Shop Logo & Banner</a></li>
                    </ul>
                </li>

                <li class="<?php echo e(Request::is('vendor/vendorWithdraws') ? 'active' : ''); ?>">
                    <a href="/vendor/vendorWithdraws"><i class="fa fa-anchor"></i><span>Withdraws</span></a>
                    
                </li>
                
                <li class="<?php echo e(Request::is('vendor/review') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('vendor.review')); ?>"><i class="fa fa-anchor"></i><span>Review</span></a>
                </li>
             
            </ul>
        </nav>
    </div>
</div>


<?php /**PATH D:\My Workspace\Web\Laravel\Work\leemis\resources\views/vendor/layout/header/left-sidebar.blade.php ENDPATH**/ ?>