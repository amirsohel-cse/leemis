
<?php $__env->startSection('content'); ?>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo e(('frontend/assets/css/style.min.css')); ?>">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.3.7/jquery.jscroll.min.js"></script>
    </head>
    <main class="mains checkouts">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-navs">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li class="passed"><a href="/">Home</a></li>
                    <li class="active"><a href="#">All Categories</a></li>
                </ul>
            </div>
        </nav>
        <div class="main-content container">
            <div class="infinite-scroll">
                <div class="row col-md-12 col-sm-12 col-12">
            <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-2 col-sm-4 col-6 mb-3">
                    <div style="text-align:center;padding:10px" class="border bg-white">
                        <div>
                            <a href="<?php echo e(route('categorize.product',[$item->id, Str::slug($item->name)])); ?>"><img style="height:120px;width:100%" src="<?php echo e("/uploads/category-images/$item->photo"); ?>" alt="Category image"></a>
                        </div>
                        <a href="<?php echo e(route('categorize.product',[$item->id, Str::slug($item->name)])); ?>"><h5 style="margin-bottom:0px" class="mt-1"><?php echo e($item->name); ?></h5></a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               
            </div>
                <?php echo e($categories->links()); ?>


            </div>
        </div>

    </main>

    
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

<?php $__env->startSection('page-scripts'); ?>
    <script src="<?php echo e(asset('/frontend/js/brand-search.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/frontend/category/allCategories.blade.php ENDPATH**/ ?>