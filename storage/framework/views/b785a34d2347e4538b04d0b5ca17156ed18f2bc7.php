

<?php $__env->startSection('main-content'); ?>

<?php if($errors->any()): ?>
<div class="alert alert-danger">
    <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>


    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-header">
                    <button type="button" class="btn btn-primary mr-3 mt-2 adModal"><i class="la la-plus"></i><?php echo app('translator')->get('Create Category'); ?></button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col"><?php echo app('translator')->get('Name'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('Status'); ?></th>

                                    <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $__currentLoopData = $helps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $help): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($help->name); ?></td>
                                        <td>
                                            <?php if($help->status): ?>
                                             <span class="badge badge-success">Active</span>
                                            <?php else: ?>
                                            <span class="badge badge-danger">InActive</span>
                                            <?php endif; ?>
                                             
                                        </td>

                                        <td>
                                            <button class="btn btn-primary edit" data-help="<?php echo e($help); ?>" data-url="<?php echo e(route('help-center.update', $help->id)); ?>">Edit</button>

                                            <a href="<?php echo e(route('articles.index', $help->id)); ?>" class="btn btn-primary">Articles</a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="add">
        <div class="modal-dialog" role="document">
            <form action="<?php echo e(route('help-center.store')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="from-group">
                            <label for="">Category Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        
                        <div class="from-group">
                            <label for="">Category Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="edit">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="from-group">
                            <label for="">Category Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        
                        <div class="from-group">
                            <label for="">Category Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
    <script>

        

        $(function(){
            $('.adModal').on('click', function(){
                const modal = $('#add')

                modal.modal('show')
            })

            $('.edit').on('click', function(){
                const modal = $('#edit')
                modal.find('input[name=name]').val($(this).data('help').name)
                modal.find('select[name=status]').val($(this).data('help').status)

                modal.find('form').attr('action', $(this).data('url'))

                modal.modal('show')
            })
        })

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\My Workspace\Web\Laravel\Work\leemis\resources\views/admin/help/index.blade.php ENDPATH**/ ?>