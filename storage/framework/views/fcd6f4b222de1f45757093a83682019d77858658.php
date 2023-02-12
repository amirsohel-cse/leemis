
<?php $__env->startSection('content'); ?>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo e(('frontend/assets/css/style.min.css')); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.3.7/jquery.jscroll.min.js"></script>
</head>
<main class="container">
    
    <div class="category-top-slider">
        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="single-slide">
            <a href="<?php echo e($slider->link); ?>">
                <img src="\storage\subcategorysliderstore\<?php echo e($slider->photo); ?>" alt="image">
            </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="title-link-wrapper m-5 title-deals appear-animate mb-4">
        <h2 class="title title-link"><?php echo e($SubCategory ? $SubCategory->name : "Not Found"); ?></h2>
        <div class="product-countdown-container font-size-sm text-white align-items-center mr-auto"> </div>
        <a href="/" class="ls-normal">Back <i class="w-icon-long-arrow-left"></i></a>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <aside class="sidebar shop-sidebar sticky-sidebar-wrapper sidebar-fixed">
                <div class="sidebar-overlay"></div>
                <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                <div class="sidebar-content scrollable">
                    <div class="sticky-sidebar">
                        <div class="filter-actions">
                            <label>Filter :</label>
                            
                        </div>
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title"><span>All Categories</span></h3>
                            <ul class="widget-body filter-items search-ul">
                                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li><a data-id="<?php echo e($category->id); ?>" class="product_category1" href="#"><?php echo e($category->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                        
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title"><span>Price</span></h3>
                            <div class="widget-body">
                                <ul class="filter-items search-ul" id="priceUl">
                                    <li><a href="#">Tk. 0 - 500</a></li>
                                    <li><a href="#">Tk. 500 - 1000</a></li>
                                    <li><a href="#">Tk. 1000 - 2000</a></li>
                                    <li><a href="#">Tk. 2000 - 3000</a></li>
                                    <li><a href="#">Tk. 3000 - 4000</a></li>
                                    <li><a href="#">Tk. 4000 - 5000</a></li>
                                    <li><a href="#">Tk. 5001 +</a></li>
                                </ul>
                                <form class="price-range">
                                    <input type="number" name="min_price" class="min_price text-center"
                                        placeholder="min ৳"><span class="delimiter">-</span><input
                                        type="number" name="max_price" class="max_price text-center"
                                        placeholder="max ৳">
                                        <a href="#" class="btn btn-primary btn-rounded goBtn">Go</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
        <div class="col-lg-9">
            <div class="infinite-scroll">
                <div class="mt-2">
                    <div  id="brandProductList" class="product-wrapper row" id="shops">
                        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="product-wrap col-md-3 col-sm-4 col-6 mb-4">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="<?php echo e(route('product.details',[$item->id, Str::slug($item->name)])); ?>">
                                        <img style="height:200px; width:200px;" src="<?php echo e("/$item->photo"); ?>" alt="Product" >
                                        <img style="height:200px; width:200px;" src="<?php echo e("/$item->photo"); ?>" alt="Product">
                                    </a>
                                    <?php if($item->stock > 0): ?>
                                    <div class="product-action-vertical">
                                        <a href="#" data-id="<?php echo e($item->id); ?>" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <div class="product-action-horizontal">    
                                        <?php if($item->online_payment==1): ?>                   
                                        <small class="text-primary font-weight-bold text-uppercase">Payment Only</small>                                                                          
                                        <?php else: ?>
                                        <small class="text-success font-weight-bold text-uppercase">Cash On Delivery</small>
                                        <?php endif; ?>
                                    </div>
                                </figure>
                                <?php if($item->offer_product==1): ?>
                                <div hidden class="product-price">
                                    <ins class="new-price"><?php echo e($item->previous_price); ?></ins><del class="old-price"><?php echo e($item->price); ?></del>
                                </div>
                                <div class="badge-overlay">
                                    <span class="top-left badge pink">SALE</span>
                                </div>
                                <?php else: ?>
                                <div hidden class="product-price">
                                    <ins class="new-price"><?php echo e($item->price); ?></ins>
                                </div>
                                <?php endif; ?>
                                <div class="product-details">
                                    <h4 class="product-name">
                                        <a href="<?php echo e(route('product.details',[$item->id, Str::slug($item->name)])); ?>"><?php echo e($item->name); ?></a>
                                    </h4>
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

                                            <?php if($item->ratings->count()>0): ?>

                                            <?php echo e($item->ratings->count()); ?>

                                            <?php else: ?>
                                                0
                                            <?php endif; ?>
                                            Reviews
                                            )</a>
                                    </div>
                                    <div class="product-price">
                                        TK <ins class="new-price"><?php echo e($item->price); ?></ins><del class="old-price"><?php echo e($item->previous_price); ?></del>
                                    </div>
                                    <?php if($item->stock > 0): ?>
                                    <a style="width:100%" data-id="<?php echo e($item->id); ?>" class="btn btn-primary btn-cart" href="#"> <i class="fas fa-shopping-cart"></i>&nbsp  Buy Now</a>
                                    <?php else: ?>
                                        <button style="width: 100%; background-color: darkred; color: white" type="button" class="btn btn-danger" disabled><i class="fas fa-shopping-cart"></i>&nbsp  Out of Stock</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="no-product-wrapper">
                            <i class="far fa-sad-tear"></i>
                            <h4>No product Found</h4>
                        </div>
                        <?php endif; ?>

                    </div>
                    <?php echo e($products->links()); ?>


                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade bd-example-modal-sm" id="pleaseWaitModal" tabindex="-1" role="dialog" aria-labelledby="pleaseWaitModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content m-0 p-0 text-center" style="background-color: transparent !important; border: none !important;">
                <div>
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
        </div>
    </div>
    

</main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.3.7/jquery.jscroll.min.js"></script>
    <script src="<?php echo e(asset('/frontend/js/all-products.js')); ?>"></script>
     <script type="text/javascript">
        $('ul.pagination').hide();
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            debug: true,
            loadingHtml: '<h4 class="text-center mt-2 mb-2">Loading More</h4>',
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/frontend/category/subCategorizeProducts.blade.php ENDPATH**/ ?>