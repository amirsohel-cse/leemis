

<?php $__env->startSection('main-content'); ?>
    <div class="main-content">
        <div class="manage-language">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary add"><?php echo e(__('Create Language')); ?></button>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Language Name')); ?></th>
                                <th><?php echo e(__('Default')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($lang->name); ?></td>
                                    <td>
                                        <?php if($lang->is_default): ?>
                                            <span class="badge badge-primary"><?php echo e(__('Default')); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-warning"><?php echo e(__('Changeable')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-md btn-primary edit mr-1"
                                            data-href="<?php echo e(route('language.edit', $lang)); ?>"
                                            data-lang="<?php echo e($lang); ?>"><i class="fa fa-edit"></i></button>

                                        <?php if(!$lang->is_default): ?>
                                            <button class="btn btn-md btn-danger delete mr-1"
                                                data-href="<?php echo e(route('language.delete', $lang)); ?>"><i
                                                    class="fa fa-trash"></i></button>
                                        <?php endif; ?>
                                        <a href="<?php echo e(route('language.translator', $lang->short_code)); ?>"
                                            class="btn btn-md btn-primary"><?php echo e('Transalator'); ?></a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="add" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('Add Language')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for=""><?php echo e(__('Language Name')); ?></label>
                                <input type="text" name="language" class="form-control"
                                    placeholder="<?php echo e(__('Enter Language')); ?>">
                            </div>

                            <div class="form-group col-md-12">
                                <label for=""><?php echo e(__('Language short Code')); ?></label>
                                <input type="text" name="short_code" class="form-control"
                                    placeholder="<?php echo e(__('Enter Language Short Code')); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Create')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="edit" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('Edit Language')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for=""><?php echo e(__('Language Name')); ?></label>
                                <input type="text" name="language" class="form-control"
                                    placeholder="<?php echo e(__('Enter Language')); ?>">
                            </div>

                            <div class="form-group col-md-12">
                                <label for=""><?php echo e(__('Language short Code')); ?></label>
                                <input type="text" name="short_code" class="form-control"
                                    placeholder="<?php echo e(__('Enter Language Short Code')); ?>">
                            </div>

                            <div class="form-group col-md-12">
                                <label for=""><?php echo e(__('Is Default')); ?></label>
                                <select name="is_default" class="form-control selectric">
                                    <option value="1"><?php echo e(__('YES')); ?></option>
                                    <option value="0"><?php echo e(__('NO')); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Update')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" id="delete" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('Delete Language')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <p><?php echo e(__('Are You Sure to Delete')); ?>?</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>

                        <button type="submit" class="btn btn-danger"><?php echo e(__('Delete')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <script>
        $(function() {
            'use strict'

            $('.add').on('click', function() {
                const modal = $('#add');

                modal.modal('show')
            })

            $('.edit').on('click', function() {
                const modal = $('#edit');
                modal.find('form').attr('action', $(this).data('href'))
                modal.find('input[name=language]').val($(this).data('lang').name)
                modal.find('input[name=short_code]').val($(this).data('lang').short_code)
                modal.find('select[name=is_default]').val($(this).data('lang').is_default)
                modal.modal('show')
            })

            $('.delete').on('click', function() {
                const modal = $('#delete');

                modal.find('form').attr('action', $(this).data('href'));

                modal.modal('show');
            })

        })
    </script>



<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\My Workspace\Web\Laravel\Work\leemis\resources\views/admin/lang/index.blade.php ENDPATH**/ ?>