


<?php $__env->startSection('main-content'); ?>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-end bg-primary text-white">
                <a href="<?php echo e(route('frontend.pages.create')); ?>" class="btn btn-icon icon-left btn-success add-page"> <i class="fa fa-plus"></i> <?php echo e(__('Add Page')); ?></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>

                            <tr>
                                <th><?php echo e(__('Sl')); ?></th>
                                <th><?php echo e(__('Page Name')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
    
                                    <td>
                                        <?php echo e($key + $pages->firstItem()); ?>

                                    </td>
                                    <td>
                                        <?php echo e($page->name); ?>

                                    </td>
    
                                    <td>
    
                                        <a href="<?php echo e(route('frontend.pages.edit', $page)); ?>"
                                            class="btn btn-icon btn-primary edit"><i class="fa fa-edit"></i></a>
                                       
                                            <a href="#" class="btn btn-icon btn-danger delete"
                                                data-url="<?php echo e(route('frontend.pages.delete', $page)); ?>"><i
                                                    class="fa fa-trash"></i></a>
                                        
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <?php endif; ?>

                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('Delete Page')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <?php echo csrf_field(); ?>

                        <p><?php echo e(__('Are You Sure To Delete Pages')); ?>?</p>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary mr-3"
                                data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                            <button type="submit" class="btn btn-danger"><?php echo e(__('Delete Page')); ?></button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
    <script>
        'use strict'

        $(function() {

            $('.delete').on('click', function() {
                const modal = $('#deleteModal');

                modal.find('form').attr('action', $(this).data('url'))
                modal.modal('show')
            })
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/pages/pages.blade.php ENDPATH**/ ?>