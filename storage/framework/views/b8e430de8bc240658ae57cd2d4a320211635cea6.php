<?php $__env->startSection('content'); ?>

    <Style>
        .btn-product-icon:hover,
        .btn-product-icon:active {
            border-color: #fd3d11 !important;
            color: #fff !important;
            background-color: #fd3d11 !important;
        }
    </Style>

    <main class="main">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-12">
                    <div class="banner-top-promo">
                        <?= advertisements('1440x80') ?>
                    </div>
                </div>
            </div>
            <div class="banner-top-part">
                <div class="banner-slider-part">
                    <div class="banner-slider-left-arrow">
                        <svg width="44" height="502" viewBox="0 0 44 502" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="left-liquid-shape">
                            <path class="wave"
                                d="M0.999973 501C32.9999 301.5 42.9999 308 42.9999 252.5C42.9999 197 29.4999 189 1.00002 0.999996L0.999973 501Z"
                                fill="rgba(255,255,255,.4)"></path>
                        </svg>
                        <i class="las la-angle-left"></i>
                    </div>
                    <div class="banner-slider-right-arrow">
                        <svg width="44" height="501" viewBox="0 0 44 501" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="right-liquid-shape">
                            <path class="wave" d="M42.9999 0.5C11 200 1 193.5 1 249C1 304.5 14.5 312.5 42.9999 500.5V0.5Z"
                                fill="rgba(255,255,255,.4)"></path>
                        </svg>
                        <i class="las la-angle-right"></i>
                    </div>
                    <div class="banner-slider">
                        <?php $__empty_1 = true; $__currentLoopData = $slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="single-slide">
                                <a href="<?php echo e($item->link); ?>" class="banner-item">
                                    <img src="<?php echo e(asset("/storage/storeSliders/$item->image_file")); ?>">
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-danger"><?php echo e(__('Not Found')); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="banner-promo-part">
                    <?= advertisements('356x250') ?>
                </div>
            </div>


            <div class="w-100 text-right my-3">
                <a href="<?php echo e(route('all-categories')); ?>" class="ls-normal all-view-btn"
                    style="font-weight: 600; color:#333"><?php echo e(__('All Categories')); ?><i
                        class="w-icon-long-arrow-right"></i></a>
            </div>
            <div class="banner-category-slider d-flex flex-wrap justify-content-center">
                <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="single-slide">
                        <a href="<?php echo e(route('subCategorize.product', [$category->id, Str::slug($category->name)])); ?>">
                            <img src="<?php echo e(asset('uploads/category-images/' . $category->photo)); ?>" alt="image">
                            <h6 class="banner-category-title"><?php echo e($category->getTranslation('name')); ?></h6>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="banner-promo-wrapper">
                <div class="row mb-none-20">
                    <div class="col-lg-4 col-sm-6 mb-20">
                        <?= advertisements('442x165') ?>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-20">
                        <?= advertisements('442x165') ?>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-20">
                        <?= advertisements('442x165') ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="products-wrapper">
                <div style="background-color: #fff; padding: 15px">
                    <div class="title-link-wrapper mb-4 p-0">
                        <h2 class="title title-link pt-1"><?php echo e(__('Top Selling Products')); ?></h2>
                        <a href="<?php echo e(route('productall', 'top_selling')); ?>"
                            class="ls-normal all-view-btn d-lg-inline-block d-none"><?php echo e(__('More Products')); ?><i
                                class="w-icon-long-arrow-right"></i></a>
                    </div>
                    <div class="row">
                        <?php $__empty_1 = true; $__currentLoopData = $top_selling; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                                <div class="product-wrap mt-3">
                                    <div class="product">
                                        <figure class="product-media product-name">
                                            <a href="<?php echo e(route('product.details', [$item->id, Str::slug($item->name)])); ?>">
                                                <img style="height:200px;width:200;" src="<?php echo e("/$item->photo"); ?>"
                                                    alt="Product" src="<?php echo e("/$item->photo"); ?>" class="lazy-img">
                                                <img style="height:200px;width:200;" src="<?php echo e("/$item->photo"); ?>"
                                                    alt="Product" src="<?php echo e("/$item->photo"); ?>" class="lazy-img">
                                            </a>
                                            <div class="product-action-vertical">
                                                <?php if($item->stock > 0): ?>
                                                    <a href="#" data-id="<?php echo e($item->id); ?>"
                                                        class="btn-product-icon btn-wishlist w-icon-heart"
                                                        title="Add to wishlist"></a>
                                                <?php endif; ?>
                                            </div>


                                            <div class="shopping-action">
                                                <?php if($item->stock > 0): ?>
                                                    <a style="width:100%" data-id="<?php echo e($item->id); ?>"
                                                        class="btn btn-primary btn-cart" href="#"> <i
                                                            class="las la-shopping-cart"></i>&nbsp
                                                        <?php echo e(__('Buy Now')); ?></a>
                                                <?php else: ?>
                                                    <button style="width: 100%; background-color: darkred; color: white"
                                                        type="button" class="btn btn-danger" disabled><i
                                                            class="las la-shopping-cart"></i>&nbsp
                                                        <?php echo e(__('Out of Stock')); ?></button>
                                                <?php endif; ?>
                                            </div>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-title"><a style="font-size: 14px"
                                                    href="<?php echo e(route('product.details', [$item->id, Str::slug($item->getTranslation('name'))])); ?>"><?php echo e($item->getTranslation('name')); ?></a>
                                            </h4>

                                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                                <div class="product-price">
                                                    HK$ <?php if($item->price == 0): ?>
                                                        <ins class="new-price"><?php echo e($item->previous_price); ?></ins>
                                                    <?php else: ?>
                                                        <ins class="new-price"><?php echo e($item->price); ?></ins><del
                                                            class="old-price"><?php echo e($item->previous_price); ?></del>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <?php if(ceil($item->avg_rating) > 0): ?>
                                                            <span class="ratings" style="width: 0%;"></span>
                                                        <?php endif; ?>

                                                        <?php if(ceil($item->avg_rating) == 1): ?>
                                                            <span class="ratings" style="width: 20%;"></span>
                                                        <?php endif; ?>
                                                        <?php if(ceil($item->avg_rating) == 2): ?>
                                                            <span class="ratings" style="width: 40%;"></span>
                                                        <?php endif; ?>
                                                        <?php if(ceil($item->avg_rating) == 3): ?>
                                                            <span class="ratings" style="width: 60%;"></span>
                                                        <?php endif; ?>
                                                        <?php if(ceil($item->avg_rating) == 4): ?>
                                                            <span class="ratings" style="width: 80%;"></span>
                                                        <?php endif; ?>
                                                        <?php if(ceil($item->avg_rating) == 5): ?>
                                                            <span class="ratings" style="width: 100%;"></span>
                                                        <?php endif; ?>
                                                        <!--<span class="tooltiptext tooltip-top"></span>-->
                                                    </div>
                                                    <a href="#" class="rating-reviews">(

                                                        

                                                        <?php echo e($item->ratings_count); ?>


                                                        <?php echo e(__('Reviews')); ?>

                                                        )
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col-lg-12">
                                <p class="text-danger"><?php echo e(__('No Feature Product Available')); ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="col-12 text-center d-lg-none">
                            <a href="<?php echo e(route('productall', 'top_selling')); ?>"
                                class="ls-normal all-view-btn"><?php echo e(__('More Products')); ?><i
                                    class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="common-block-wrapper" style="background-color: #FAF29C;">
                    <div class="row mb-none-20">

                        <div class="col-md-3 col-6 mb-20">
                            <?= advertisements('356x221') ?>
                        </div>
                        <div class="col-md-3 col-6 mb-20">
                            <?= advertisements('356x221') ?>
                        </div>
                        <div class="col-md-3 col-6 mb-20">
                            <?= advertisements('356x221') ?>
                        </div>
                        <div class="col-md-3 col-6 mb-20">
                            <?= advertisements('356x221') ?>
                        </div>
                    </div>
                </div>
                <div class="title-link-wrapper mb-3">
                    <!-- <h2 class="title title-link pt-1"><?php echo e(__('Offer Product')); ?></h2> -->
                    <h2 class="title title-link"><?php echo e(__('Recommended for you')); ?></h2>
                    <a href="<?php echo e(route('product.offer')); ?>"
                        class="ls-normal all-view-btn d-lg-inline-block d-none"><?php echo e(__('More Product')); ?> <i
                            class="w-icon-long-arrow-right"></i></a>
                </div>
                <div class="row">
                    <?php $__empty_1 = true; $__currentLoopData = $offer_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                            <div class="product-wrap">
                                <div class="product">
                                    <figure class="product-media product-name">
                                        <a href="<?php echo e(route('product.details', [$item->id, Str::slug($item->name)])); ?>">
                                            <img style="height:200px; width:100%;" src="<?php echo e("/$item->photo"); ?>"
                                                alt="Product" src="<?php echo e("/$item->photo"); ?>" class="lazy-img">
                                            <img style="height:200px; width:100%;" src="<?php echo e("/$item->photo"); ?>"
                                                alt="Product" src="<?php echo e("/$item->photo"); ?>" class="lazy-img">
                                        </a>
                                        <div class="product-action-vertical">
                                            <?php if($item->stock > 0): ?>
                                                <a href="#" data-id="<?php echo e($item->id); ?>"
                                                    class="btn-product-icon btn-wishlist w-icon-heart"
                                                    title="Add to wishlist"></a>
                                            <?php endif; ?>
                                        </div>

                                        <div class="shopping-action">
                                            <?php if($item->stock > 0): ?>
                                                <a style="width:100%" data-id="<?php echo e($item->id); ?>"
                                                    class="btn btn-primary btn-cart" href="#"><i
                                                        class="las la-shopping-cart"></i> <?php echo e(__('Buy Now')); ?></a>
                                            <?php else: ?>
                                                <button style="width: 100%; background-color: darkred; color: white"
                                                    type="button" class="btn btn-danger" disabled><i
                                                        class="las la-shopping-cart"></i>&nbsp
                                                    <?php echo e(__('Out of Stock')); ?></button>
                                            <?php endif; ?>
                                        </div>
                                    </figure>
                                    <div class="badge-overlay">
                                        <span class="top-left badge pink"><?php echo e(__('SALE')); ?></span>
                                    </div>
                                    <div class="product-details">

                                        <h4 class="product-title"><a style="font-size: 14px"
                                                href="<?php echo e(route('product.details', [$item->id, Str::slug($item->name)])); ?>"><?php echo e($item->getTranslation('name')); ?></a>
                                        </h4>

                                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                                            <div class="product-price">
                                                HK$ <?php if($item->price == 0): ?>
                                                    <ins class="new-price"><?php echo e($item->previous_price); ?></ins>
                                                <?php else: ?>
                                                    <ins class="new-price"><?php echo e($item->price); ?></ins><del
                                                        class="old-price"><?php echo e($item->previous_price); ?></del>
                                                <?php endif; ?>
                                            </div>

                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <?php if(ceil($item->avg_rating) > 0): ?>
                                                        <span class="ratings" style="width: 0%;"></span>
                                                    <?php endif; ?>

                                                    <?php if(ceil($item->avg_rating) == 1): ?>
                                                        <span class="ratings" style="width: 20%;"></span>
                                                    <?php endif; ?>
                                                    <?php if(ceil($item->avg_rating) == 2): ?>
                                                        <span class="ratings" style="width: 40%;"></span>
                                                    <?php endif; ?>
                                                    <?php if(ceil($item->avg_rating) == 3): ?>
                                                        <span class="ratings" style="width: 60%;"></span>
                                                    <?php endif; ?>
                                                    <?php if(ceil($item->avg_rating) == 4): ?>
                                                        <span class="ratings" style="width: 80%;"></span>
                                                    <?php endif; ?>
                                                    <?php if(ceil($item->avg_rating) == 5): ?>
                                                        <span class="ratings" style="width: 100%;"></span>
                                                    <?php endif; ?>

                                                </div>
                                                <a href="#" class="rating-reviews">(

                                                    <?php echo e($item->ratings_count); ?>


                                                    )
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-lg-12 text-center">
                            <p class="text-danger"><?php echo e(__('No Offer Available')); ?></p>
                        </div>
                    <?php endif; ?>
                    <div class="col-xl-12 text-center d-lg-none">
                        <a href="<?php echo e(route('product.offer')); ?>" class="ls-normal all-view-btn"><?php echo e(__('More Product')); ?>

                            <i class="w-icon-long-arrow-right"></i></a>
                    </div>
                </div><!-- offer-slider -->
            </div>
        </div>

        <div class="container">


            <div class="common-block-wrapper" style="background-color: #EBEBEB;">
                <div class="row">
                    <div class="col-sm-4">
                        <?= advertisements('442x165') ?>
                    </div>
                    <div class="col-sm-4">
                        <?= advertisements('442x165') ?>
                    </div>
                    <div class="col-sm-4">
                        <?= advertisements('442x165') ?>
                    </div>
                </div>
            </div>


        </div>


        <div class="container">
            <div class="common-block-wrapper" style="background-color: #fff;">
                <div class="title-link-wrapper mb-4 p-0">
                    <h2 class="title title-link pt-1"><?php echo e(__('Feature Products')); ?></h2>
                    <a href="<?php echo e(route('productall', 'feature')); ?>"
                        class="ls-normal all-view-btn d-lg-inline-block d-none"><?php echo e(__('More Products')); ?><i
                            class="w-icon-long-arrow-right"></i></a>
                </div>

                <div class="row">
                    <?php $__empty_1 = true; $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                            <div class="product-wrap mt-3">
                                <div class="product">
                                    <figure class="product-media product-name">
                                        <a href="<?php echo e(route('product.details', [$item->id, Str::slug($item->name)])); ?>">
                                            <img style="height:200px;width:200;" src="<?php echo e("/$item->photo"); ?>"
                                                alt="Product" src="<?php echo e("/$item->photo"); ?>" class="lazy-img">
                                            <img style="height:200px;width:200;" src="<?php echo e("/$item->photo"); ?>"
                                                alt="Product" src="<?php echo e("/$item->photo"); ?>" class="lazy-img">
                                        </a>
                                        <div class="product-action-vertical">
                                            <?php if($item->stock > 0): ?>
                                                <a href="#" data-id="<?php echo e($item->id); ?>"
                                                    class="btn-product-icon btn-wishlist w-icon-heart"
                                                    title="Add to wishlist"></a>
                                            <?php endif; ?>
                                        </div>


                                        <div class="shopping-action">
                                            <?php if($item->stock > 0): ?>
                                                <a style="width:100%" data-id="<?php echo e($item->id); ?>"
                                                    class="btn btn-primary btn-cart" href="#"> <i
                                                        class="las la-shopping-cart"></i>&nbsp
                                                    <?php echo e(__('Buy Now')); ?></a>
                                            <?php else: ?>
                                                <button style="width: 100%; background-color: darkred; color: white"
                                                    type="button" class="btn btn-danger" disabled><i
                                                        class="las la-shopping-cart"></i>&nbsp
                                                    <?php echo e(__('Out of Stock')); ?></button>
                                            <?php endif; ?>
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <h4 class="product-title"><a style="font-size: 14px"
                                                href="<?php echo e(route('product.details', [$item->id, Str::slug($item->name)])); ?>"><?php echo e($item->getTranslation('name')); ?></a>
                                        </h4>

                                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                                            <div class="product-price">
                                                HK$ <?php if($item->price == 0): ?>
                                                    <ins class="new-price"><?php echo e($item->previous_price); ?></ins>
                                                <?php else: ?>
                                                    <ins class="new-price"><?php echo e($item->price); ?></ins><del
                                                        class="old-price"><?php echo e($item->previous_price); ?></del>
                                                <?php endif; ?>
                                            </div>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <?php if(ceil($item->avg_rating) > 0): ?>
                                                        <span class="ratings" style="width: 0%;"></span>
                                                    <?php endif; ?>

                                                    <?php if(ceil($item->avg_rating) == 1): ?>
                                                        <span class="ratings" style="width: 20%;"></span>
                                                    <?php endif; ?>
                                                    <?php if(ceil($item->avg_rating) == 2): ?>
                                                        <span class="ratings" style="width: 40%;"></span>
                                                    <?php endif; ?>
                                                    <?php if(ceil($item->avg_rating) == 3): ?>
                                                        <span class="ratings" style="width: 60%;"></span>
                                                    <?php endif; ?>
                                                    <?php if(ceil($item->avg_rating) == 4): ?>
                                                        <span class="ratings" style="width: 80%;"></span>
                                                    <?php endif; ?>
                                                    <?php if(ceil($item->avg_rating) == 5): ?>
                                                        <span class="ratings" style="width: 100%;"></span>
                                                    <?php endif; ?>
                                                    <!--<span class="tooltiptext tooltip-top"></span>-->
                                                </div>


                                                <a href="#" class="rating-reviews">(

                                                    <?php echo e($item->ratings_count); ?>

                                                    <?php echo e(__('Reviews')); ?>

                                                    )
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-lg-12 text-center">
                            <p class="text-danger"><?php echo e(__('No Feature Product Available')); ?></p>
                        </div>
                    <?php endif; ?>
                    <div class="col-12 text-center d-lg-none">
                        <a href="<?php echo e(route('productall', 'feature')); ?>"
                            class="ls-normal all-view-btn"><?php echo e(__('More Products')); ?><i
                                class="w-icon-long-arrow-right"></i></a>
                    </div>
                </div>
                <a href="#0" class="d-block mt-4">
                    <?= advertisements('1440x250') ?>
                </a>

                <div class="title-link-wrapper mt-5 mb-4 p-0">
                    <h2 class="title title-link pt-1"><?php echo e(__('Trending Products')); ?></h2>
                    <a href="<?php echo e(route('productall', 'trending')); ?>"
                        class="ls-normal all-view-btn d-lg-inline-block d-none"><?php echo e(__('More Products')); ?><i
                            class="w-icon-long-arrow-right"></i></a>
                </div>
                <div class="row">
                    <?php $__empty_1 = true; $__currentLoopData = $trendings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                            <div class="product-wrap mt-3">
                                <div class="product">
                                    <figure class="product-media product-name">
                                        <a href="<?php echo e(route('product.details', [$item->id, Str::slug($item->name)])); ?>">
                                            <img style="height:200px;width:200;" src="<?php echo e("/$item->photo"); ?>"
                                                alt="Product" src="<?php echo e("/$item->photo"); ?>" class="lazy-img">
                                            <img style="height:200px;width:200;" src="<?php echo e("/$item->photo"); ?>"
                                                alt="Product" src="<?php echo e("/$item->photo"); ?>" class="lazy-img">
                                        </a>
                                        <div class="product-action-vertical">
                                            <?php if($item->stock > 0): ?>
                                                <a href="#" data-id="<?php echo e($item->id); ?>"
                                                    class="btn-product-icon btn-wishlist w-icon-heart"
                                                    title="Add to wishlist"></a>
                                            <?php endif; ?>
                                        </div>
                                        <!-- <div class="product-action-horizontal">
                                                <?php if($item->online_payment == 1): ?>
    <small class="text-primary font-weight-bold text-uppercase"><?php echo e(__('Payment Only')); ?></small>
<?php else: ?>
    <small class="text-success font-weight-bold text-uppercase"><?php echo e(__('Cash On Delivery')); ?></small>
    <?php endif; ?>
                                                </div> -->
                                        <div class="shopping-action">
                                            <?php if($item->stock > 0): ?>
                                                <a style="width:100%" data-id="<?php echo e($item->id); ?>"
                                                    class="btn btn-primary btn-cart" href="#"> <i
                                                        class="las la-shopping-cart"></i>&nbsp
                                                    <?php echo e(__('Buy Now')); ?></a>
                                            <?php else: ?>
                                                <button style="width: 100%; background-color: darkred; color: white"
                                                    type="button" class="btn btn-danger" disabled><i
                                                        class="las la-shopping-cart"></i>&nbsp
                                                    <?php echo e(__('Out of Stock')); ?></button>
                                            <?php endif; ?>
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <h4 class="product-title"><a style="font-size: 14px"
                                                href="<?php echo e(route('product.details', [$item->id, Str::slug($item->name)])); ?>"><?php echo e($item->getTranslation('name')); ?></a>
                                        </h4>

                                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                                            <div class="product-price">
                                                HK$ <?php if($item->price == 0): ?>
                                                    <ins class="new-price"><?php echo e($item->previous_price); ?></ins>
                                                <?php else: ?>
                                                    <ins class="new-price"><?php echo e($item->price); ?></ins><del
                                                        class="old-price"><?php echo e($item->previous_price); ?></del>
                                                <?php endif; ?>
                                            </div>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <?php if(ceil($item->avg_rating) > 0): ?>
                                                        <span class="ratings" style="width: 0%;"></span>
                                                    <?php endif; ?>

                                                    <?php if(ceil($item->avg_rating) == 1): ?>
                                                        <span class="ratings" style="width: 20%;"></span>
                                                    <?php endif; ?>
                                                    <?php if(ceil($item->avg_rating) == 2): ?>
                                                        <span class="ratings" style="width: 40%;"></span>
                                                    <?php endif; ?>
                                                    <?php if(ceil($item->avg_rating) == 3): ?>
                                                        <span class="ratings" style="width: 60%;"></span>
                                                    <?php endif; ?>
                                                    <?php if(ceil($item->avg_rating) == 4): ?>
                                                        <span class="ratings" style="width: 80%;"></span>
                                                    <?php endif; ?>
                                                    <?php if(ceil($item->avg_rating) == 5): ?>
                                                        <span class="ratings" style="width: 100%;"></span>
                                                    <?php endif; ?>
                                                    <!--<span class="tooltiptext tooltip-top"></span>-->
                                                </div>
                                                <a href="#" class="rating-reviews">(

                                                    <?php echo e($item->ratings_count); ?>


                                                    <?php echo e(__('Reviews')); ?>

                                                    )
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-lg-12 text-center">
                            <p class="text-danger"><?php echo e(__('No Feature Product Available')); ?></p>
                        </div>
                    <?php endif; ?>
                    <div class="col-12 text-center d-lg-none">
                        <a href="<?php echo e(route('productall', 'trending')); ?>"
                            class="ls-normal all-view-btn"><?php echo e(__('More Products')); ?><i
                                class="w-icon-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div style="background-color: #EBEBEB; padding: 10px 20px">
                <div class="row mb-none-20">
                    <div class="col-lg-6 mb-20">
                        <?= advertisements('710X185') ?>
                    </div>
                    <div class="col-lg-6 mb-20">
                        <?= advertisements('710X185') ?>
                    </div>
                </div>
            </div>
            <div style="background-color: #fff; padding: 15px">
                <?= advertisements('1440x250') ?>
            </div>

            <!--<div style="background-color: #E1EFFA; padding: 20px 15px">-->
            <!--    <div class="row mb-none-20">-->

            <!--        <div class="col-md-3 col-6 mb-20">-->
            <!--            <?= advertisements('356x221') ?>-->
            <!--        </div>-->
            <!--        <div class="col-md-3 col-6 mb-20">-->
            <!--            <?= advertisements('356x221') ?>-->
            <!--        </div>-->
            <!--        <div class="col-md-3 col-6 mb-20">-->
            <!--            <?= advertisements('356x221') ?>-->
            <!--        </div>-->
            <!--        <div class="col-md-3 col-6 mb-20">-->
            <!--            <?= advertisements('356x221') ?>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->

            <div style="background-color: #fff; padding: 20px 20px">
                <div class="title-link-wrapper mb-4 p-0">
                    <h2 class="title title-link pt-1"><?php echo e(__('Latest Product')); ?></h2>
                    <a href="<?php echo e(route('productall', 'latest')); ?>"
                        class="ls-normal all-view-btn d-lg-inline-block d-none"><?php echo e(__('More Products')); ?><i
                            class="w-icon-long-arrow-right"></i></a>
                </div>

                <div class="row">
                    <?php $__empty_1 = true; $__currentLoopData = $latest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                            <div class="product-wrap mt-3">
                                <div class="product">
                                    <figure class="product-media product-name">
                                        <a href="<?php echo e(route('product.details', [$item->id, Str::slug($item->name)])); ?>">
                                            <img style="height:200px;width:200;" src="<?php echo e("/$item->photo"); ?>"
                                                alt="Product" src="<?php echo e("/$item->photo"); ?>" class="lazy-img">
                                            <img style="height:200px;width:200;" src="<?php echo e("/$item->photo"); ?>"
                                                alt="Product" src="<?php echo e("/$item->photo"); ?>" class="lazy-img">
                                        </a>
                                        <div class="product-action-vertical">
                                            <?php if($item->stock > 0): ?>
                                                <a href="#" data-id="<?php echo e($item->id); ?>"
                                                    class="btn-product-icon btn-wishlist w-icon-heart Productsicon-heart"
                                                    title="Add to wishlist">
                                                </a>
                                            <?php endif; ?>
                                        </div>

                                        <div class="shopping-action">
                                            <?php if($item->stock > 0): ?>
                                                <a style="width:100%" data-id="<?php echo e($item->id); ?>"
                                                    class="btn btn-primary btn-cart" href="#"> <i
                                                        class="las la-shopping-cart"></i>&nbsp
                                                    <?php echo e(__('Buy Now')); ?></a>
                                            <?php else: ?>
                                                <button style="width: 100%; background-color: darkred; color: white"
                                                    type="button" class="btn btn-danger" disabled><i
                                                        class="las la-shopping-cart"></i>&nbsp
                                                    <?php echo e(__('Out of Stock')); ?></button>
                                            <?php endif; ?>
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <h4 class="product-title"><a style="font-size: 14px"
                                                href="<?php echo e(route('product.details', [$item->id, Str::slug($item->name)])); ?>"><?php echo e($item->getTranslation('name')); ?></a>
                                        </h4>

                                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                                            <div class="product-price">
                                                HK$ <?php if($item->price == 0): ?>
                                                    <ins class="new-price"><?php echo e($item->previous_price); ?></ins>
                                                <?php else: ?>
                                                    <ins class="new-price"><?php echo e($item->price); ?></ins><del
                                                        class="old-price"><?php echo e($item->previous_price); ?></del>
                                                <?php endif; ?>
                                            </div>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <?php if(ceil($item->avg_rating) > 0): ?>
                                                        <span class="ratings" style="width: 0%;"></span>
                                                    <?php endif; ?>

                                                    <?php if(ceil($item->avg_rating) == 1): ?>
                                                        <span class="ratings" style="width: 20%;"></span>
                                                    <?php endif; ?>
                                                    <?php if(ceil($item->avg_rating) == 2): ?>
                                                        <span class="ratings" style="width: 40%;"></span>
                                                    <?php endif; ?>
                                                    <?php if(ceil($item->avg_rating) == 3): ?>
                                                        <span class="ratings" style="width: 60%;"></span>
                                                    <?php endif; ?>
                                                    <?php if(ceil($item->avg_rating) == 4): ?>
                                                        <span class="ratings" style="width: 80%;"></span>
                                                    <?php endif; ?>
                                                    <?php if(ceil($item->avg_rating) == 5): ?>
                                                        <span class="ratings" style="width: 100%;"></span>
                                                    <?php endif; ?>
                                                    <!--<span class="tooltiptext tooltip-top"></span>-->
                                                </div>
                                                <a href="#" class="rating-reviews">(

                                                    <?php echo e($item->ratings_count); ?>


                                                    <?php echo e(__('Reviews')); ?>

                                                    )
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-lg-12 text-center">
                            <p class="text-danger"><?php echo e(__('No Feature Product Available')); ?></p>
                        </div>
                    <?php endif; ?>
                    <div class="col-12 text-center d-lg-none">
                        <a href="<?php echo e(route('productall', 'latest')); ?>"
                            class="ls-normal all-view-btn"><?php echo e(__('More Products')); ?><i
                                class="w-icon-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div style="background-color: #E1F5E1; padding: 20px 15px">
                <a href="#0" class="d-block">
                    <?= advertisements('1440x250') ?>
                </a>
            </div>

            <div style="background-color: #E1F5E1; padding: 20px 15px">
                <div class="row mb-none-20">

                    <div class="col-lg-2 col-4 mb-20">
                        <?= advertisements('224x295') ?>
                    </div>
                    <div class="col-lg-2 col-4 mb-20">
                        <?= advertisements('224x295') ?>
                    </div>
                    <div class="col-lg-2 col-4 mb-20">
                        <?= advertisements('224x295') ?>
                    </div>
                    <div class="col-lg-2 col-4 mb-20">
                        <?= advertisements('224x295') ?>
                    </div>
                    <div class="col-lg-2 col-4 mb-20">
                        <?= advertisements('224x295') ?>
                    </div>
                    <div class="col-lg-2 col-4 mb-20">
                        <?= advertisements('224x295') ?>
                    </div>
                </div>
            </div>

            <div class="common-block-wrapper" style="background-color: #fff;">
                <div class="row">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row-8-slider">
                            <div class="single-slide">
                                <?= advertisements('160x230') ?>
                            </div>
                            <div class="single-slide">
                                <?= advertisements('160x230') ?>
                            </div>
                            <div class="single-slide">
                                <?= advertisements('160x230') ?>
                            </div>
                            <div class="single-slide">
                                <?= advertisements('160x230') ?>
                            </div>
                            <div class="single-slide">
                                <?= advertisements('160x230') ?>
                            </div>
                            <div class="single-slide">
                                <?= advertisements('160x230') ?>
                            </div>
                            <div class="single-slide">
                                <?= advertisements('160x230') ?>
                            </div>
                            <div class="single-slide">
                                <?= advertisements('160x230') ?>
                            </div>
                        </div><!-- row-8-slider -->

                        <div class="single-sub-cat-wrapper">
                            <div class="col-lg-12 mb-5">
                                <div class="d-flex flex-wrap justify-content-between align-items-center">
                                    <h3 class="mb-2"><?php echo e(@$category->getTranslation('name')); ?></h3>
                                    <a href="<?php echo e(route('categorize.product', [$category->id, Str::slug($category->name)])); ?>"
                                        class="btn btn-dark mb-2">
                                        View All
                                    </a>
                                </div>
                            </div>
                            <div class="row-7-slider">
                                <?php $__currentLoopData = $category->sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="single-slide">
                                        <a href="<?php echo e(route('childCategorize.product', [$subcategory->id, Str::slug($subcategory->name)])); ?>"
                                            class="d-block sub-cat-card">
                                            <div class="sub-cat-card-thumb"
                                                data-path="<?php echo e(asset('uploads/category-images/' . $subcategory->photo)); ?>">
                                                <img src="<?php echo e(asset('uploads/category-images/' . $subcategory->photo)); ?>"
                                                    alt="image" class="lazy-img">
                                            </div>
                                            <span><?php echo e(@$subcategory->getTranslation('name')); ?></span>
                                        </a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="common-block-wrapper" style="background-color: #fff;">
                <?= advertisements('1440x250') ?>
            </div>
        </div>

        <div class="container mt-4">
            <div class="row">
                <?php if(isset($tShops[0]->id)): ?>
                    <?php $__empty_1 = true; $__currentLoopData = $tShops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $top): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php if($top != null): ?>
                            <div class="col-lg-2 col-md-3 col-md-4 col-6">
                                <div class="vendor-widget">
                                    <div class="vendor-widget-banner">
                                        <figure class="vendor-banner">

                                            <a
                                                href="<?php echo e(route('shop.product', [$top->id, Str::slug($top->shop_name)])); ?>">
                                                <img src="<?php echo e("/uploads/vendors/$top->shop_image"); ?>" class="lazy-img"
                                                    width="1200" height="390"
                                                    style="background-color: #ECE7DF; height:100px" />
                                            </a>
                                        </figure>
                                        <div class="vendor-details">
                                            <figure class="vendor-logo">
                                                <a
                                                    href="<?php echo e(route('shop.product', [$top->id, Str::slug($top->shop_name)])); ?>">
                                                    <img style="height:90px;width:90px"
                                                        src="<?php echo e("/uploads/vendors/$top->shop_image"); ?>" width="90"
                                                        height="90" />
                                                </a>
                                            </figure>
                                            <div class="vendor-personal">
                                                <h4 class="vendor-name">
                                                    <a
                                                        href="<?php echo e(route('shop.product', [$top->id, Str::slug($top->shop_name)])); ?>"><?php echo e($top->shop_name); ?></a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-danger"><?php echo e(__('No Shops Available')); ?></p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        </div>

    </main>

    <div class="modal fade top" style="padding-top: 170px;" id="modalpromo" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
        <div class="modal-dialog modal-lg modal-frame modal-top modal-notify modal-info" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class=" d-flex justify-content-center align-items-center">
                        <?php if($pop): ?>
                            <img src="\storage\storeLogo\<?php echo e($pop->file); ?>" alt="logo" />
                        <?php else: ?>
                            <img src="\storage\storeLogo\common.png" alt="logo" />
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>





<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        $(window).on('load', function() {
            let getPopup = JSON.parse(localStorage.getItem('popup'));
            if (getPopup === null) {
                let today = new Date();
                let time = today.getHours();
                let date = today.getDate();
                let popup = {
                    time: time,
                    date: date,
                    flag: 1
                }
                localStorage.setItem('popup', JSON.stringify(popup));
            } else {
                let today = new Date();
                let time = today.getHours();
                let date = today.getDate();
                let timeDiff = Math.abs(time - parseInt(getPopup.time));
                if (timeDiff >= 25 || date !== getPopup.date) {
                    let popup = {
                        time: time,
                        date: date,
                        flag: 1
                    }
                    localStorage.setItem('popup', JSON.stringify(popup));
                }
            }

            if (parseInt(getPopup.flag) === 1) {
                setTimeout(function() {
                    $('#modalpromo').modal('show');
                    let today = new Date();
                    let time = today.getHours();
                    let date = today.getDate();
                    let popup = {
                        time: time,
                        date: date,
                        flag: 0
                    }
                    localStorage.setItem('popup', JSON.stringify(popup));
                }, 100);

            }
        })
    </script>
    <script>
        $(function() {
            $('img').Lazy({

                scrollDirection: 'vertical',
                effect: 'fadeIn',
                visibleOnly: true,
                onError: function(element) {
                    console.log('error loading ' + element.data('src'));
                }
            });
        });

        // document.addEventListener("DOMContentLoaded", function() {
        //     var lazyloadImages = document.querySelectorAll("img.lazy");
        //     var lazyloadThrottleTimeout;

        //     function lazyload() {
        //         if (lazyloadThrottleTimeout) {
        //             clearTimeout(lazyloadThrottleTimeout);
        //         }

        //         lazyloadThrottleTimeout = setTimeout(function() {
        //             var scrollTop = window.pageYOffset;
        //             lazyloadImages.forEach(function(img) {
        //                 if (img.offsetTop < (window.innerHeight + scrollTop)) {
        //                     img.src = img.dataset.src;
        //                     img.classList.remove('lazy');
        //                 }
        //             });
        //             if (lazyloadImages.length == 0) {
        //                 document.removeEventListener("scroll", lazyload);
        //                 window.removeEventListener("resize", lazyload);
        //                 window.removeEventListener("orientationChange", lazyload);
        //             }
        //         }, 20);
        //     }

        //     document.addEventListener("scroll", lazyload);
        //     window.addEventListener("resize", lazyload);
        //     window.addEventListener("orientationChange", lazyload);
        // });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('page-styles'); ?>
    <style>
        .menu .menu-title {
            margin-bottom: 2rem;
            font-size: 1.4rem;
            line-height: 1;
            letter-spacing: -0.025em;
            color: inherit !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\My Workspace\Web\Laravel\Work\leemis\resources\views/frontend/main.blade.php ENDPATH**/ ?>