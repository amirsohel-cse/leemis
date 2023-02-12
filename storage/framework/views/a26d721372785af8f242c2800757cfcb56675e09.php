<!------- for login modal -->
<style>
    .login-popup.login {
        padding: 0;
    }

    .login-popup.login .tab-pane {
        padding-top: 0;
        padding-bottom: 0;
    } 

    .list-item :hover {
        background-color: #E2E8F0;
    }

    @media (max-width: 991.98px) {
        #heart {
            display: none;
        }

        #cart {
            display: none;
        }
    }

    .m-src {
        width: 100%
    }

    #src-mbl {
        left: 200px;
    }

    @media (min-width: 100px) and (max-width: 600px) {

        /*.logo {*/
        /*    display: none;*/
        /*}*/

        .m-src {
            width: 100%;
        }

        .src-btn {
            display: none;
        }

        #src-mbl {
            width: 105% !important;
            left: 8px !important;
        }

    }

    .h-top {
        margin-left: 30px;
    }

    @media (max-width:768px) {
        .h-top {
            margin-left: 5px;
        }
    }
</style>
<!-- ------------------- -->

<!-- Start of Header -->
<header class="header">


    <div class="header-middle">
        <div class="header-container-fluid d-flex align-items-center">
            <div class="header-left">

                <a href="/" class="logo ml-lg-0">
                    <?php
                    $headerLogo = \App\Model\Logo::where('type', 'header')->first();
                    ?>
                    <?php if($headerLogo): ?>
                        <img src="\storage\storeLogo\<?php echo e($headerLogo->file); ?>" alt="logo" width="110"
                            height="30" />
                    <?php else: ?>
                        <img src="\storage\storeLogo\common.png" alt="logo" width="110" height="30" />
                    <?php endif; ?>
                </a>

                <a href="#0" class="header-location" data-toggle="modal" data-target="#locationModal">
                    <span><?php echo e(__('Delivering to')); ?></span>
                    <span class="location-name"><?php echo e(__('Bangladesh')); ?></span>
                </a>

                <div id="smb" style="margin:auto;" class="row col-xl-12 col-lg-10 col-md-8 search-mobile">
                    <div id="smb2" style="margin-right:0px;padding-right:0" class="col-md-9">
                        <div class="header-search-field">
                            <input style="margin-right:0px; type="search"
                            class="form-control header-search-field m-src bg-white rounded-lg" autocomplete="off"
                            name="search" id="search" placeholder="What are you looking for?" required />
                            <button type="button" aria-label="search button" class="header-search-btn"><i class="fas fa-search"></i></button>
                        </div>
                    </div>

                    <div class="row justify-content-center overflow-auto: background-color:white;" id="search-modal"
                        hidden>
                        <div style="z-index:1111; position:absolute;  top:9px;left:12px;width:84%" class=""
                            id="src-mbl">
                            <div class="card  tab-card ml-auto mr-auto overflow-auto">
                                <div style="background-color:white;border:none;" class="card-header tab-card-header">
                                    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" id="one-tab" data-toggle="tab" href="#one"
                                                role="tab" aria-controls="One"
                                                aria-selected="true"><?php echo e(__('Products')); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="two-tab" data-toggle="tab" href="#two"
                                                role="tab" aria-controls="Two"
                                                aria-selected="false"><?php echo e(__('Brands')); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="three-tab" data-toggle="tab" href="#three"
                                                role="tab" aria-controls="Three"
                                                aria-selected="false"><?php echo e(__('Shops')); ?></a>
                                        </li>
                                    </ul>
                                </div>

                                <div style="max-height:400px;overflow:auto;" class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active p-3" id="one" role="tabpanel"
                                        aria-labelledby="one-tab">




                                    </div>
                                    <div class="tab-pane fade p-3" id="two" role="tabpanel"
                                        aria-labelledby="two-tab">

                                    </div>
                                    <div class="tab-pane fade p-3" id="three" role="tabpanel"
                                        aria-labelledby="three-tab">

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>




            </div>

            <?php
            $wishlist = 0;
            if (Auth::id()) {
                $wishlist = \App\Model\Wishlist::where('user_id', Auth::id())->count();
            }
            
            $cart = 0;
            if (Auth::id()) {
                $cart = \App\Model\Cart::whereHas('product')
                    ->where('user_id', Auth::id())
                    ->count();
            }
            ?>


            <div class="header-right">

                <!--<script !src="">
                    -- >
                    <
                    !--document.getElementsByClassName('wishlist')[0].addEventListener("click", () => {
                        -- >
                        <
                        !--
                        const userId = document.getElementById('userId').value;
                        -- >
                        <
                        !--
                        if (userId === '') {
                            -- >
                            <
                            !--alert("You have to login First");
                            -- >
                            <
                            !--
                        }-- >
                        <
                        !--
                    });
                    -- >
                    <
                    !--
                </script>-->

                <!--<script>
                    -- >
                    <
                    !--
                    var wishList = $(".wishlist");
                    -- >

                    <
                    !--wishList.on("click", function() {
                        -- >
                        <
                        !--
                        const userId = $("#userId").value;
                        -- >
                        <
                        !--
                        if (userId === '') {
                            -- >
                            <
                            !--alert("You have to login First");
                            -- >
                            <
                            !--
                        }-- >
                        <
                        !--
                    });
                    -- >
                    <
                    !--
                </script>-->

                <a href="#0" class="header-location" data-toggle="modal" data-target="#locationModal">
                    <span><?php echo e(__('Delivering to')); ?></span>
                    <span class="location-name"><?php echo e(__('Bangladesh')); ?></span>
                </a>


                <?php
                    $language = \App\Model\Language::select('short_code','name')->get()
                ?>
                <select class="header-lang changeLang">
                    <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lang->short_code); ?>" <?php if(session('lang') == $lang->short_code): ?> selected <?php endif; ?>>
                            <?php echo e(__($lang->name)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                </select>

                <?php if(auth()->guard()->guest()): ?>
                    <a class="d-lg-show login compare label-down link d-xs-show ml-4 header-middle-btn" data-toggle="modal"
                        href="#LoginModal">
                        <span class="caption"><?php echo e(__('Sign In')); ?></span>
                        <i class="far fa-user"></i>
                    </a>
                <?php else: ?>
                    <a class="d-lg-show login compare label-down link d-xs-show ml-4 header-middle-btn"
                        href="<?php echo e(route('customer.profile')); ?>">
                        <i class="far fa-user"></i>
                    </a>
                    <form id="logout-form" action="<?php echo e(route('customer.logout')); ?>" method="POST" class="d-none">
                        <?php echo csrf_field(); ?>
                    </form>
                <?php endif; ?>

                <div style="position:relative;" class=" cart-dropdown cart-offcanvas mr-0 mr-lg-2 d-flex">
                    <!--<div class="wish-overlay"></div>-->
                    <!--<a id="heart" class="wishlist label-down wish-dropdown text-decoration-none header-middle-btn"-->
                    <!--    href="<?php echo e(Auth::id() ? route('wishlist.view', Auth::id()) : '#'); ?>">-->
                    <!--    <i class="lar la-heart"></i>-->
                    <!--    <span class="header-count-top"><?= $wishlist ?></span>-->
                    <!--</a>-->

                    <div class="cart-overlay"></div>
                    <a id="cart" href="#"
                        class="cart-toggle label-down link text-decoration-none header-middle-btn">
                        <span class="caption"><?php echo e(__('Cart')); ?></span>
                        <i class="las la-shopping-cart"></i>
                        <span class="header-count-top"><?= $cart ?></span>
                        <span class="cart-label"></span>
                    </a>

                    <div class="dropdown-box">
                        <div class="cart-header">
                            <span><?php echo e(__('Shopping Cart')); ?></span>
                            <a href="#" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
                        </div>

                        <div style="" class="products cart-products p-cart overflow-auto" id="cart_draw">

                        </div>


                    </div>
                    <!-- End of Dropdown Box -->
                </div>
            </div>

        </div>
    </div>
    <!-- End of Header Middle -->



    <div class="modal fade" id="locationModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="locationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="locationModalLabel"><?php echo e(__('Add New Address')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="map" style="width:100%;height:450px"></div>
                    <div id="locationList"></div>
                </div>
                <div class="modal-footer">
                    <form action="<?php echo e(route('save-my-place')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="address" id="form_address"
                            value="<?php echo e(auth()->check() ? auth()->user()->my_place : ''); ?>">
                        <button type="submit" class="btn btn-primary" id="disabtn"><?php echo e(__('Save changes')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    

    <div class="header-bottom sticky-content fix-top sticky-header has-dropdown">
        <div class="header-container-fluid">
            <div class="inner-wrap">
                <div class="header-left">
                    <div class="dropdown category-dropdown has-border" data-visible="true"
                        id="sticky-dropdown-homepage">
                        <a href="#" class="category-toggle" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="fal" data-display="static"
                            title="Browse Categories">
                            <i class="w-icon-category"></i>
                            <span><?php echo e(__('ALL CATEGORIES')); ?></span>
                        </a>

                        <div class="dropdown-box">
                            <ul class="menu vertical-menu category-menu">
                                <?php $i = 0; ?>
                                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php $i++; ?>
                                    <li class="has-submenu">
                                        <a
                                            href="<?php echo e(route('categorize.product', [$category->id, Str::slug($category->name)])); ?>">
                                            <?php echo e($category->name); ?>

                                        </a>

                                        <ul class="megamenu">
                                            <li>

                                                <h4 class="menu-title"><?php echo e($category->name); ?></h4>
                                                <hr class="divider">
                                                <ul>
                                                    <?php $__empty_2 = true; $__currentLoopData = $category->sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                                        <li><a
                                                                href="<?php echo e(route('subCategorize.product', [$subCategory->id, Str::slug($subCategory->name)])); ?>"><?php echo e($subCategory->name); ?></a>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                                    <?php endif; ?>

                                                </ul>
                                            </li>
                                            <li>
                                                <h4 class="menu-title"><?php echo e(__('Top Brand')); ?></h4>
                                                <hr class="divider">
                                                <ul>
                                                    <?php $__empty_2 = true; $__currentLoopData = $category->sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                                        <li>
                                                            <a
                                                                href="<?php echo e(route('brand.product', [$subCategory->top_brand, Str::slug($subCategory->topBrand->name)])); ?>"><?php echo e(@$subCategory->topBrand->name); ?></a>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                                    <?php endif; ?>

                                                </ul>
                                            </li>

                                        </ul>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <li><?php echo e(__('Not Found')); ?></li>
                                <?php endif; ?>

                                <?php
                                            if ($i >= 7){
                                        ?>
                                <li><a class="text-center text-primary text-white"
                                        href="<?php echo e(url('/all-categories')); ?>">
                                        <?php echo e(__('View All Categories')); ?></a></li>
                                <?php }?>

                            </ul>
                        </div>
                    </div>

                    <nav class="main-nav">
                        <ul class="menu active-underline">

                            <?php $__empty_1 = true; $__currentLoopData = $top; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <li class="has-mega-menu has-submenu">
                                    <a class="text-decoration-none"
                                        href="<?php echo e(url($item->url)); ?>"><?php echo e(__($item->name)); ?></a>


                                    <div class="megamenu p-4">
                                        <div class="row g-3">
                                            <div class="col-lg-2">
                                                <h4 class="menu-title"><?php echo e(__('CATEGORIES')); ?></h4>
                                                <ul>

                                                    <?php $__currentLoopData = $item->menuCategories()->whereHas('category')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><a
                                                                href="<?php echo e(route('subCategorize.product', [$menu->category_id, Str::slug($menu->category->name)])); ?>"><?php echo e(@$menu->category->name); ?></a>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </ul>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="row g-3">
                                                    <div class="col-lg-12">
                                                        <h6><?php echo e(__('Top Brands')); ?></h6>
                                                    </div>
                                                    <?php $__currentLoopData = $item->menuBrands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="col-lg-4 mb-3">
                                                            <div class="header-brand">
                                                                <a
                                                                    href="<?php echo e(route('brand.product', [$brand->brand->id, Str::slug($brand->brand->name)])); ?>">
                                                                    <img src="<?php echo e(asset('uploads/brand-images/' . $brand->brand->photo)); ?>"
                                                                        alt="image">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </div>
                                            </div>


                                            <div class="col-lg-5">
                                                <div class="row h-100">
                                                    <?php if($item->images != null): ?>
                                                        <?php $__currentLoopData = $item->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div
                                                                class="<?php if($loop->first): ?> col-lg-7 <?php else: ?> col-md-5 <?php endif; ?>">
                                                                <div class="header-menu-right-promo">
                                                                    <img src="<?php echo e(asset('uploads/top_menu_images/' . $image)); ?>"
                                                                        alt="image">
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <p><?php echo e(__('Not found')); ?></p>
                            <?php endif; ?>
                            <li><a href="<?php echo e(url('allshop')); ?>"><?php echo e(__('All Shop')); ?></a></li>
                            <li><a href="<?php echo e(route('vendor.login')); ?>"><?php echo e(__('Sell on HyperShop')); ?></a></li>
                        </ul>
                    </nav>


                </div>
                <!-- <div class="header-right">
                                <a  class=" text-decoration-none"  href="<?php echo e(route('blogslist')); ?>"></i><?php echo e(__('News Feed')); ?></a>
                                <a  class=" text-decoration-none mr-5" data-toggle="modal" href="#TrackModal"></i><?php echo e(__('Track Order')); ?></a>
                                <a target="_blank" href="<?php echo e(route('vendor.login')); ?>" class="mr-4 text-decoration-none"></i><?php echo e(__('Merchant Zone')); ?></a>
                            </div> -->
            </div>
        </div>
    </div>
</header>
<!-- End of Header -->
<!-- ------------------------------------------------------ -->
<!--  login pop up modal -->
<div class="modal fade " id="LoginModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <!-- Start of Page Header -->
                <div class="container">
                    <h1 class="page-title mb-0"><?php echo e(__('Login')); ?></h1>
                </div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">

                <div class="page-content">
                    <div class="container">
                        <div class="login-popup login">
                            <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">

                                <div class="tab-content">

                                    <!-- login tab -->
                                    <div class="tab-pane active" id="">

                                        <!-- login error msg -->
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert"
                                            style="display: none;">
                                            <strong id="login_error"></strong>
                                            <button type="button" class="close" data-dismiss=""
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!-- reset msg -->
                                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                                            style="display: none;">
                                            <strong id="reset_successful"></strong>
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!-- reg successful msg -->
                                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                                            style="display: none;">
                                            <strong id="reg_successful"></strong>
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="customerLogin" method="POST">

                                            <div class="form-group">
                                                <label><?php echo e(__('Mobile no')); ?>. *</label>
                                                <input placeholder="Enter mobile no" name="phone" type="text"
                                                    class="form-control  <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    value="<?php echo e(old('phone')); ?>" required autofocus>


                                                <div class="alert alert-danger alert-dismissible d-none"
                                                    role="alert" id="isdisabled">
                                                    <strong><?php echo e(__('Your Account Has Been Disabled')); ?>!</strong>

                                                </div>
                                            </div>
                                            <div class="form-group mb-0">
                                                <label><?php echo e(__('Password')); ?> *</label>
                                                <div class="password-field">
                                                    <input type="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Minumum 8 characters" value="<?php echo e(old('password')); ?>" required autocomplete="password" autofocus>
                                                    <button type="button" class="password-toggle">
                                                        <i class="far fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <a href="#" style="color:#fd3d11" class="fp mt-2">
                                                <u><?php echo e(__('Forgot password')); ?>?</u> </a>

                                            <a href="#" id="login" type="submit"
                                                class="btn btn-primary my-4"><?php echo e(__('Sign In')); ?></a>

                                            <span class="font-size-md">
                                                <?php echo e(__('Don\'t have an account')); ?>? </span> <a style="color:#fd3d11;"
                                                class="mb-4  font-size-md"
                                                href="<?php echo e(route('customer.register')); ?>"><u><?php echo e(__('Sign up')); ?></u></a>

                                        </form>
                                    </div>
                                    <hr>
                                </div>

                                <div class="social-icons social-icon-border-color d-flex justify-content-start">
                                    <a href="/login/facebook" class="social-button" id="facebook-connect">
                                        <span><?php echo e(__('Sign In with Facebook')); ?></span></a>
                                    <a href="/login/google" class="social-button" id="google-connect">
                                        <span><?php echo e(__('Sign In with Google')); ?></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </main>
                <!-- End of Main -->
            </div>
        </div>
    </div>
</div>


<!--------- otp modal ----->

<div class="modal fade" style="margin-top: 50px;" id="otp-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content m-auto" id="modal-content" style="width: 50%">
            <div class="modal-header">
                <p class="modal-title" id="exampleModalLabel"><?php echo e(__('Phone Verification')); ?></p>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body m-0">
                <!-- alert start-->
                <div class="alert-success">
                    <span class="text-center mt-2" id="code_sent" style="padding: 10px 0"></span>
                </div>
                <div class="alert-warning">
                    <span class="text-center mt-2" id="code_invalid" style="padding: 10px 0"></span>
                </div>
                <div class="alert-warning">
                    <span class="text-center mt-2" id="verification-error" style="padding: 10px 0"></span>
                </div>
                <!-- alert end-->


                <label for="code"></label>
                <input type="text" class="mb-2 form-control" name="code" id="code"
                    placeholder="verification code" autocomplete="off">

                <button type="button" id="verify" class="btn btn-primary mt-2"><?php echo e(__('Verify')); ?></button>
                <button type="button" id="fp_verify" class="btn btn-primary mt-2"><?php echo e(__('Verify')); ?></button>
                <button type="button" id="resend" class="btn btn-primary mt-2" disabled><?php echo e(__('Resend code')); ?></button>
                <button type="button" id="fp_resend" class="btn btn-primary mt-2" disabled><?php echo e(__('Resend code')); ?>

                    <span class="text-warning timer"></span> </button>
            </div>
            <div class="modal-footer">
                <button type="button" id="closeBtn" class="btn btn-primary"
                    data-dismiss="modal"><?php echo e(__('Close')); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- modal: forgot password -->
<div class="modal fade " style="margin-top: 50px;" id="fp-modal" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content m-auto" id="" style="width: 50%">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">
                    <?php echo e(__('Give phone no to get verification code')); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body m-0">

                <!-- alert start-->
                <div class="alert-warning my-2" style="display: none;">
                    <span class="text-center mt-2" id="fp_phone_invalid" style="padding: 10px"></span>
                </div>
                <div class="alert-warning my-2" style="display: none;">
                    <span class="text-center mt-2" id="fp_sending_error"
                        style="padding: 10px; padding-right: 0"></span><span class="timer"></span>
                </div>
                <!-- alert end-->

                <form id="fp-form" method="post">

                    <input style="border-color:#fd3d11;" name="phone" id="fp-phone" placeholder="Mobile No."
                        type="number" class="form-control" value="<?php echo e(old('phone')); ?>" required
                        autocomplete="phone" autofocus>

                    <strong><span id="fp_phone_error" class="invalid-feedback" role="alert">
                        </span> </strong>

                    <div class="mt-2">
                        <button class="btn-block btn-primary mt-2 mb-2 p-3" style="font-size:12px"
                            type="submit"><?php echo e(__('Send Verification Code')); ?></button>
                        <div class="bottom login-toggle-btn">
                            <span class="helper-text mt-3"><?php echo e(__('Know your password')); ?>? <a id="fp_login_btn"
                                    style="float:none " href="#"> <u><?php echo e(__('Login')); ?>

                                    </u></a></span>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" id="closeBtn" class="btn btn-primary p-1"
                    data-dismiss="modal"><?php echo e(__('Close')); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- modal: reset password -->
<div class="modal fade " id="reset-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content m-auto" id="" style="width: 50%">
            <div class="modal-header">
                <p class="modal-title" id="exampleModalLabel"> <?php echo e(__('Password Reset')); ?></p>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body m-0">

                <!-- alert start-->
                <div class="alert-warning my-2" style="display: none;">
                    <span class="text-center mt-2" id="reset_error" style="padding: 10px"></span>
                </div>
                <!-- alert end-->

                <form id="reset-form" method="post">
                    <input hidden name="uniqid" id="reset_uniqid">
                    <div class="">
                        <input id="reset_password" class="form-control" type="password" name="password"
                            placeholder="Password (minimum 8 characters)" value="<?php echo e(old('password')); ?>" required
                            autocomplete="new-password" autofocus>
                        <br>
                        <strong><span id="reset_password_error" class="invalid-feedback" role="alert">
                            </span> </strong>
                    </div>

                    <input type="password" class="form-control" name="password_confirmation"
                        placeholder="Confirm Password" value="<?php echo e(old('password')); ?>" required
                        autocomplete="new-password" autofocus>

                    <div class="button-box">
                        <div class="login-toggle-btn">
                            <button class="btn btn-primary btn-sm mt-3"
                                type="submit"><?php echo e(__('Reset Password')); ?></button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" id="closeBtn" class="btn btn-primary"
                    data-dismiss="modal"><?php echo e(__('Close')); ?></button>
            </div>
        </div>
    </div>
</div>
<!-- modal: track order -->
<div style="margin-top:50px;" class="modal fade " id="TrackModal" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content m-auto" id="">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><?php echo e(__('Track Order')); ?></h4>
                <button type="button" id="trackXCloseBtn" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <form id="track_form" method="post">

                    <input style="border-color:#fd3d11;" name="oid" id="oid"
                        placeholder="Enter Order Code" type="" class="form-control mt-5" value=""
                        required>

                    <div class="alert" id="order_status" style="display:none"></div>

                    <div class="mt-2">
                        <button class="btn-block btn-primary" type="submit"><?php echo e(__('Track Order')); ?></button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" id="trackCloseBtn" class="btn btn-primary p-2"
                    data-dismiss="modal"><?php echo e(__('Close')); ?></button>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('script'); ?>
    
<script>
    $(document).ready(function() {

        
        


        $(".password-field").each(function(){
            var passInput = $(this).children(".form-control");
            var passButton  = $(this).children(".password-toggle");
            var passIcon = $(this).children(".password-toggle i");

            passButton.on('click', function(event) {
                event.preventDefault();
                if(passInput.attr("type") == "text"){
                    passInput.attr('type', 'password');
                    passIcon.addClass( "fa-eye-slash" );
                    passIcon.removeClass( "fa-eye" );
                }else if(passInput.attr("type") == "password"){
                    passInput.attr('type', 'text');
                    passIcon.removeClass( "fa-eye-slash" );
                    passIcon.addClass( "fa-eye" );
                }
            });
        });

        $('#search').on('input', function() {
            $(this).val($(this).val() ? $(this).val().trimStart() : '');
        })

        $(document).mouseup(function(e) {
            let container = $('#search-modal');
            let search = $('#search');
            if (!container.is(e.target) && !search.is(e.target) && container.has(e.target).length ===
                0) {
                $(container).attr('hidden', true);
            }
        });

        $('#search').on('keyup', function() {

            var query = $(this).val();

            if ($(this).val() == '') {
                $('#one').html('');
                $('#search-modal').attr('hidden', true);
            } else {
                $('#search-modal').attr('hidden', false);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/searchajax',
                    data: {
                        search: query
                    },
                    success: function(data) {
                        console.log(data)
                        $('#one').html('');
                        if (data[0].length > 0) {
                            for (var i = 0; i < data[0].length; i++) {
                                $('#one').append(`
                        <li class="list-item border-bottom-1 p-3" style=" list-style:none">
                                            <a href="/productdetails/${data[0][i].id}/${convertToSlug(data[0][i].name)}" class="single-item">
                                            <div class="row p-3">
                                                <div class="col-2">
                                                     <div class="product-image">
                                                    <img style="height: 50px; width: 41px" src="/${data[0][i].photo}" alt="product image" class="">
                                                </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="product-info">
                                                        <div class="product-info-top"><h6 class="product-name">${data[0][i].name}</h6></div>
                                                    </div>
                                                    <div class="product-price">Tk. ${data[0][i].price}</div>
                                                </div>
                                            </div>
                                            </a>
                                        </li>

                    `);
                            }
                        } else {

                            $('#one').append(`
                        <li class="list-item border-bottom-1 p-3" style=" list-style:none">
                                            <h6 align="center" class="text-danger">Not Found</h6 >
                                        </li>

                    `);

                        }


                        $('#two').html('');
                        if (data[1].length > 0) {
                            for (var i = 0; i < data[1].length; i++) {
                                $('#two').append(`
                            <li class="list-item border-bottom-1 p-3" style=" list-style:none">
                                            <a href="/brandbyproduct/${data[1][i].id}/${convertToSlug(data[1][i].name)}" class="single-item">
                                            <div class="row p-3">
                                                <div class="col-2">
                                                     <div class="product-image">
                                                    <img style="height: 40px; width: 40px" src="/uploads/brand-images/${data[1][i].photo}" alt="product image" class="">
                                                </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="product-info">
                                                        <div class="product-info-top"><h6 class="product-name">${data[1][i].name}</h6></div>
                                                    </div>

                                                </div>
                                            </div>
                                            </a>
                                        </li>

                    `);
                            }
                        } else {

                            $('#two').append(`
<li class="list-item border-bottom-1 p-3" style=" list-style:none">
    <h6 align="center" class="text-danger">Not Found</h6 >
            </li>

`);

                        }

                        $('#three').html('');
                        if (data[2].length > 0) {
                            for (var i = 0; i < data[2].length; i++) {
                                $('#three').append(`
                            <li class="list-item border-bottom-1 p-3" style=" list-style:none">
                                            <a href="/shopbystore/${data[2][i].id}/${convertToSlug(data[2][i].shop_name)}" class="single-item">
                                            <div class="row p-3">
                                                <div class="col-2">
                                                     <div class="product-image">
                                                    <img style="height: 40px; width: 40px" src="/uploads/vendors/${data[2][i].shop_image}" alt="product image" class="">
                                                </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="product-info">
                                                        <div class="product-info-top"><h6 class="product-name">${data[2][i].shop_name}</h6></div>
                                                    </div>

                                                </div>
                                            </div>
                                            </a>
                                        </li>

                    `);
                            }
                        } else {

                            $('#three').append(`
<li class="list-item border-bottom-1 p-3" style=" list-style:none">
    <h6 align="center" class="text-danger">Not Found</h6 >
            </li>

`);

                        }


                    },
                    error: function(error) {
                        console.log(error)
                    }
                })
            }

        });
    });

    function convertToSlug(Text) {
        return Text
            .toLowerCase()
            .replace(/ /g, '-')
            .replace(/[^\w-]+/g, '');
    }
</script>

<?php if(\Illuminate\Support\Facades\Request::is('/') || \Illuminate\Support\Facades\Request::is('/#')): ?>
    <script>
        $(function() {
            $('#sticky-dropdown-homepage').addClass('show-dropdown');
        });
    </script>
<?php endif; ?>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\hypershop\resources\views/components/frontend/header.blade.php ENDPATH**/ ?>