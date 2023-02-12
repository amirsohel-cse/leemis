

<?php $__env->startSection('content'); ?>
<section class="section-padding">
    <div class="container custom-container">
        <div class="row mb-none-30">
            <div class="col-lg-12">
                <h2 class="mb-4" style="color: #404553">Browse Topics</h2>
            </div>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-6 mb-30">
                <div class="faq-box">
                    <a href="<?php echo e(route('help.articles', $category->id)); ?>" class="faq-box-link"></a>
                    <div class="icon">
                        <img src="<?php echo e(asset('topic.png')); ?>" alt="image">
                    </div>
                    <div class="content">
                        <h3 class="title"><?php echo e($category->name); ?></h3>
                        <span><?php echo e($category->articals->count()); ?> articles</span>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>    





<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.master.help_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\clients-project\hypershop_final\resources\views/frontend/help_center.blade.php ENDPATH**/ ?>