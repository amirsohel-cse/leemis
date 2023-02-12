

<div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay"></div>

    <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
   

    <div class="mobile-menu-container scrollable">
        

        <!-- End of Search Form -->
        <div class="tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a href="#main-menu" class="nav-link active"><?php echo e(languageChange('Main Menu')); ?></a>
                </li>
                <li class="nav-item">
                    <a href="#categories" class="nav-link"><?php echo e(languageChange('Categories')); ?></a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="main-menu">
                <ul class="mobile-menu">
                    <?php $__empty_1 = true; $__currentLoopData = $top; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li><a href="<?php echo e($item->url); ?>"><?php echo e($item->name); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <?php endif; ?>
                    <li><a href="<?php echo e(route('vendor.login')); ?>"><?php echo e(languageChange('Merchant Zone')); ?></a></li>
                    <!--<li><a href="#TrackModal">Track Order</a></li>-->
                    <li><a href="<?php echo e(route('blogslist')); ?>"><?php echo e(languageChange('News Feed')); ?></a></li>
                </ul>
            </div>
            <div class="tab-pane" id="categories">
                <ul class="mobile-menu">
                    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li>
                        <a href="<?php echo e(route('categorize.product',[$category->id, Str::slug($category->name)])); ?>">
                            <i class="w-icon-category"></i><?php echo e($category->name); ?>

                        </a>
                        <ul>
                            <?php $__empty_2 = true; $__currentLoopData = $category->sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                            <li>
                                <a href="<?php echo e(route('subCategorize.product', [$subCategory->id, Str::slug($subCategory->name)])); ?>"><?php echo e($subCategory->name); ?></a>
                                <ul>
                                    <?php $__empty_3 = true; $__currentLoopData = $subCategory->child_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_3 = false; ?>
                                    <li>
                                        <a href="<?php echo e(route('childCategorize.product', [$childCategory->id,Str::slug($childCategory->name)])); ?>">
                                            <?php echo e($childCategory->name); ?></a>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_3): ?>
                                        <li>Empty</li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                <li>Empty</li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li>Empty</li>
                    <?php endif; ?>
                    
                    <li>
                        <a href="<?php echo e(url('/all-categories')); ?>" class="text-center"><?php echo e(languageChange('All Categories')); ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php /**PATH C:\xampp\htdocs\clients-project\hypershop_final\resources\views/components/frontend/mobile-menu.blade.php ENDPATH**/ ?>