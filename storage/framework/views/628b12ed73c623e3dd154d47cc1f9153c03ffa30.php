<div id="left-sidebar" class="sidebar">
    <?php
        $file=App\Model\Logo::where('type','sidebar')->first();
    ?>
    <a href="#" class="menu_toggle"><i class="fa fa-angle-left"></i></a>
   
    <div class="sidebar-scroll">
        <div class="user-account">
            <div class="user_div">
                <?php if($file): ?>
                    
                    <img src="<?php echo e(asset('/storage/storeLogo')); ?>/<?php echo e($file->file); ?>" class="user-photo" alt="Logo">
                <?php else: ?>
                    <img src="<?php echo e(asset('/storage/storeLogo')); ?>/common.jpg" class="user-photo" alt="Logo">
                <?php endif; ?>
            </div>
            <div class="dropdown">
                <span>Admin</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong><?php echo e(Auth::user()->name); ?></strong></a>
                <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
                    <li><a href="<?php echo e(route('admin.profile')); ?>"><i class="fa fa-user"></i>My Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo e(route('admin.logout')); ?>"><i class="fa fa-power-off"></i>Logout</a></li>
                </ul>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">

            <ul id="main-menu" class="metismenu animation-li-delay">
                
                <!-- admin access only -->

                <?php if(Auth::user()->role_id == '1'): ?>
                    <li class= "<?php echo e(Request::is('admin/dashboard') ? 'active' : ''); ?>"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                <?php endif; ?>
                
                <li class= "<?php echo e(Request::is('admin/2fa') ? 'active' : ''); ?>"><a href="<?php echo e(route('2fa')); ?>"><i class="fa fa-dashboard"></i> <span>2FA </span></a></li>
                <!-- admin and moderator access only -->
                <?php if(Auth::user()->role_id == '1' or Auth::user()->role_id == '4'): ?>

                    <?php if(Auth::user()->role_id == '4'): ?>

                             <li class= "<?php echo e(Request::is('admin/orders/dashboard') ? 'active' : ''); ?>"><a href="<?php echo e(route('orders.dashboard')); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                    
                    <?php endif; ?>

                    <li class= "<?php echo e(Request::is('admin/orders/*') ? 'active' : ''); ?>">
                        <a href="#manageOrders" class="has-arrow"><i class="fa fa-list"></i><span>Orders</span></a>
                        <ul class="metismenu">
                            <li class="<?php echo e(Request::is('admin/orders/view') ? 'active' : ''); ?>"><a href="<?php echo e(route('orders.view')); ?>">All Orders</a></li>

                            <li class="<?php echo e(Request::is('admin/orders/view/on-delivery') ? 'active' : ''); ?>"><a href="<?php echo e(route('orders.ondelivery')); ?>">On Delivery Orders</a></li> 


                            <li class="<?php echo e(Request::is('admin/orders/view/pending') ? 'active' : ''); ?>"><a href="<?php echo e(route('orders.pending')); ?>">Pending Orders</a></li> 
                            
                            
                            
                            <li class="<?php echo e(Request::is('admin/orders/view/processing') ? 'active' : ''); ?>"><a href="<?php echo e(route('orders.processing')); ?>">Processing Orders</a></li> 
                            
                            <li class="<?php echo e(Request::is('admin/orders/view/completed') ? 'active' : ''); ?>"><a href="<?php echo e(route('orders.completed')); ?>">Completed Orders</a></li> 
                            
                            <li class="<?php echo e(Request::is('admin/orders/view/declined') ? 'active' : ''); ?>"><a href="<?php echo e(route('orders.declined')); ?>">Declined Orders</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

               <?php if(Auth::user()->role_id != 4): ?>
                    <li class="<?php echo e(Request::is('admin/product/*') ? 'active' : ''); ?>">
                    <a href="#product" class="has-arrow"><i class="fa fa-cart-plus"></i><span>Products</span></a>
                    <ul class="metismenu">
                      
                        <li class="<?php echo e(Request::is('admin/product/allProducts') ? 'active' : ''); ?>"><a href="/admin/product/allProducts">All Products</a></li>
                        <li class="<?php echo e(Request::is('admin/product/deActivatedProducts') ? 'active' : ''); ?>"><a href="/admin/product/deActivatedProducts">Deactivated Products</a></li>
                        <li class="<?php echo e(Request::is('admin/product/print_barcode') ? 'active' : ''); ?>"><a href="/admin/product/print_barcode">Product BarCode</a></li>
                        

                    </ul>
                </li>
                <li class="<?php echo e(Request::is('admin/brand/*') ? 'active' : ''); ?>">
                    <a href="#allbrand" class="has-arrow"><i class="fa fa-arrows"></i><span>Manage Brand</span></a>
                    <ul class="metismenu">
                        <li class="<?php echo e(Request::is('admin/brand/view') ? 'active' : ''); ?>"><a href="<?php echo e(route('brand.view')); ?>">Brand</a></li>
                    </ul>
                </li>

                <li class="<?php echo e(Request::is('admin/category/view', 'admin/subcategory/view', 'admin/childcategory/view') ? 'active' : ''); ?>">
                    <a href="#manageCategories" class="has-arrow"><i class="fa fa-anchor"></i><span>Manage Categories</span></a>
                    <ul class="metismenu">
                        <li class="<?php echo e(Request::is('admin/category/view') ? 'active' : ''); ?>"><a href="<?php echo e(route('category.view')); ?>">Main Category</a></li>
                        <li class="<?php echo e(Request::is('admin/subcategory/view') ? 'active' : ''); ?>"><a href="<?php echo e(route('subcategory.view')); ?>">Sub Category</a></li>
                        <li class="<?php echo e(Request::is('admin/childcategory/view') ? 'active' : ''); ?>"><a href="<?php echo e(route('childCategory.view')); ?>">Child Category</a></li>
                    </ul>
                </li>
               <?php endif; ?>

                <!-- admin and moderator access only -->
                <?php if(Auth::user()->role_id == '1' or Auth::user()->role_id == '2'): ?>
                    <li class="<?php echo e(Request::is('admin/vendor/vendorsList', 'admin/vendor/withdrawrequest') ? 'active' : ''); ?>">
                        <a href="#" class="has-arrow"><i class=" fa fa-users"></i><span>Vendors</span></a>
                        <ul class="metismenu">
                            <li class="<?php echo e(Request::is('admin/vendor/vendorsList') ? 'active' : ''); ?>"><a href="<?php echo e(route('vendorShow')); ?>" >Vendors List</a></li>
                             <li><a href="<?php echo e(route('vendorDeactivated')); ?>" >Deactivate Vendors List</a></li>
                            <li class="<?php echo e(Request::is('admin/vendor/withdrawrequest') ? 'active' : ''); ?>"><a href="<?php echo e(route('withdraw')); ?>" >Withdraw Request</a></li>
                        </ul>
                    </li>

                    <li class="<?php echo e(Request::is('admin/customer/*') ? 'active' : ''); ?>">
                        <a href="#" class="has-arrow"><i class=" fa fa-users"></i><span>Customer</span></a>
                        <ul class="metismenu">
                            <li class="<?php echo e(Request::is('admin/customer/customerList') ? 'active' : ''); ?>"><a href="<?php echo e(route('customerShow')); ?>" >Customer List</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <!----------- Admin access only  --------->
                <?php if(Auth::user()->role_id == '1'): ?>
                    <li class="<?php echo e(Request::is('admin/admin/view') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.view')); ?>"><i class="fa fa-address-book"></i> <span>Admins</span></a>
                    </li>
                <?php endif; ?>

                <!-- admin and moderator access only -->
                <?php if(Auth::user()->role_id == '1' or Auth::user()->role_id == '2'): ?>
                    <li class="<?php echo e(Request::is('admin/report') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('report')); ?>"><i class="fa fa-file-pdf-o"></i> <span>Report</span></a>
                    </li>

                    <li class="<?php echo e(Request::is('admin/setting/logo', 'admin/setting/footer', 'admin/setting/favicon', 'admin/setting/shipping', 'admin/setting/headerText', 'admin/setting/view-submenu', 'admin/social/topmenu/view' ) ? 'active' : ''); ?>">
                        <a href="#generalSetting" class="has-arrow"><i class="fa fa-cog"></i></i><span>General Setting</span></a>
                        <ul class="metismenu">
                            <li class="<?php echo e(Request::is('admin/setting/logo') ? 'active' : ''); ?>"><a href="<?php echo e(route('logo.view')); ?>">Logo</a></li>
                            <li class="<?php echo e(Request::is('admin/setting/footer') ? 'active' : ''); ?>"><a href="<?php echo e(route('footer.view')); ?>">Footer</a></li>
                            <li class="<?php echo e(Request::is('admin/setting/favicon') ? 'active' : ''); ?>"><a href="<?php echo e(route('favicon.view')); ?>">Fevicon</a></li>
                            <li class="<?php echo e(Request::is('admin/setting/shipping') ? 'active' : ''); ?>"><a href="<?php echo e(route('shipping.view')); ?>">Shipping Method</a></li>
                            <li class="<?php echo e(Request::is('admin/setting/headerText') ? 'active' : ''); ?>"><a href="<?php echo e(route('header.text')); ?>">Product Details </a></li>
                            
                            <li class="<?php echo e(Request::routeIs('frontend.pages.index') ? 'active' : ''); ?>"><a href="<?php echo e(route('frontend.pages')); ?>">Footer Pages</a></li>
                            <li class="<?php echo e(Request::is('admin/social/topmenu/view') ? 'active' : ''); ?>"><a href="<?php echo e(route('topmenu.view')); ?>">Top Menu</a></li> 
                            
                            

                        </ul>
                    </li>
                    <li class="<?php echo e(Request::is('admin/social/socialLinks') ? 'active' : ''); ?>">
                        <a href="#socialSetting" class="has-arrow"><i class=" fa fa-share-alt"></i><span>Social Setting</span></a>
                        <ul class="metismenu">
                            <li class="<?php echo e(Request::is('admin/social/socialLinks') ? 'active' : ''); ?>"><a href="<?php echo e(route('socialLinks.view')); ?>">Social Links</a></li>
                            <li class="<?php echo e(Request::is('admin/setting/pixel/view') ? 'active' : ''); ?>"><a href="<?php echo e(route('pixel.view')); ?>">Pixel Setup</a></li>

                        </ul>
                    </li>
                    <li class="<?php echo e(Request::is('admin/setting/campaign', 'admin/setting/services', 'admin/setting/sliders', 'admin/setting/advertise') ? 'active' : ''); ?>">
                        <a href="#homePageSetting" class="has-arrow"><i class="fa fa-cog"></i><span>Home Page Setting</span></a>
                        <ul class="metismenu">
                            <li class="<?php echo e(Request::is('admin/setting/campaign') ? 'active' : ''); ?>"><a href="<?php echo e(route('campaign.view')); ?>">Campaign</a></li>
                            <li class="<?php echo e(Request::is('admin/setting/services') ? 'active' : ''); ?>"><a href="<?php echo e(route('services.view')); ?>">Services</a></li>
                            <li class="<?php echo e(Request::is('admin/setting/sliders') ? 'active' : ''); ?>"><a href="<?php echo e(route('sliders.view')); ?>">Sliders</a></li>
                            <li class="<?php echo e(Request::is('admin/setting/advertise') ? 'active' : ''); ?>"><a href="<?php echo e(route('advertisements')); ?>">Advertisements</a></li>

                            <li class="<?php echo e(Request::is('admin/setting/product/sliders') ? 'active' : ''); ?>"><a href="<?php echo e(route('product.sliders')); ?>">Category Slider</a></li>
                            <li class="<?php echo e(Request::is('admin/setting/subcategoryslider') ? 'active' : ''); ?>"><a href="<?php echo e(route('subcategoryslider.view')); ?>">subcategory slider</a></li>
                        </ul>
                    </li>

                    <li class="<?php echo e(Request::is('admin/blogs') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('blogs')); ?>"><i class="fa fa-envelope"></i> <span>Blogs</span></a>
                    </li>

                    <li class="<?php echo e(Request::is('admin/subscribers') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('subscribers')); ?>"><i class="fa fa-address-book"></i> <span>Subscribers</span></a></li>
                    <li>
                    <li class="<?php echo e(Request::is('admin/viewgroupmail') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('groupmail')); ?>"><i class="fa fa-envelope"></i> <span>Email</span></a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/vendor/minimum-withdraw') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('minimum.withdraw.view')); ?>"><i class="fa fa-money"></i> <span>Minimum Withdraw</span></a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/vendor/top-vendor') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('topvendor.view')); ?>"><i class="fa fa-money"></i> <span>Top Vendor Min Amount</span></a>
                    </li>  
                    
                    
                    <li>
                        <a href="<?php echo e(route('language.index')); ?>"><i class="fa fa-money"></i> <span>Manage Language</span></a>
                    </li>
                    
                    <li class="<?php echo e(Request::is('admin/manage-language') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.review')); ?>"><i class="fa fa-money"></i> <span>Review</span></a>
                    </li>
                    
                <?php endif; ?>
                
                <li class="">
                    <a href="#help" class="has-arrow"><i class="fa fa-cog"></i></i><span>Help Center</span></a>
                    <ul class="metismenu">
                        <li class=""><a href="<?php echo e(route('help-center.index')); ?>">Categories</a></li>
                        

                    </ul>
                </li>
                

                
               
            </ul>
        </nav>
    </div>
</div>


<?php /**PATH C:\xampp\htdocs\hypershop\resources\views/admin/layout/header/left-sidebar.blade.php ENDPATH**/ ?>