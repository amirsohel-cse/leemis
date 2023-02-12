<?php echo $__env->make('admin.layout.header.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('admin.layout.header.page-topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('admin.layout.header.left-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('admin.layout.header.right-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div id="main-content">
    <div class="container-fluid">
        <?php echo $__env->yieldContent('main-content'); ?>
    </div>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php echo $__env->make('admin.layout.footer.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style>
    .form-control{
    border-color:#17a2b8 !important;
}
</style>
<script>
    $(".alert:not(.not_hide)").delay(5000).slideUp(700, function () {
     $(this).alert('close');
 });
</script><?php /**PATH /var/www/html/resources/views/admin/layout/master/master.blade.php ENDPATH**/ ?>