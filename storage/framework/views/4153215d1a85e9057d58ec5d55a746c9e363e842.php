

<?php $__env->startSection('main-content'); ?>

    <div class="row my-4">
        <div class="col-md-12">
            <h3><b>Customer</b></h3>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-12">
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Join Date</th>
                                    <th>Customer Name</th>
                                    <th>Customer Phone</th>
                                    <th>Customer Email</th>
                                    <th>Customer Address</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php $__empty_1 = true; $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($row->created_at->format('d-m-Y')); ?></td>
                                        <td><?php echo e($row->name); ?></td>
                                        <td><?php echo e($row->phone); ?></td>
                                        <td><?php echo e($row->email); ?></td>
                                        <td><?php echo e($row->address); ?></td>

                                        <td>
                                            <select name="" class="theme-bg" data-id="<?php echo e($row->id); ?>"
                                                id="selectStatus">
                                                <option value="1" <?php echo e($row->status == 1 ? 'selected' : ''); ?>>Active</option>
                                                <option value="0" <?php echo e($row->status == 0 ? 'selected' : ''); ?>>Deactive
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <button data-id="<?php echo e($row->id); ?>" data-toggle="modal" data-target="#editVendorModal" class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>

                                            <button data-id="<?php echo e($row->id); ?>" class="btn btn-danger btn-round deleteBtn" style="cursor: pointer" type="submit"><i class="fa fa-trash"></i></button>

                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <td colspan="5" class="text-center">No data Available</td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>


     
     <div class="modal fade bd-example-modal-lg" tabindex="-1" id="editVendorModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">EDIT CUSTOMER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="edit-vendor-form" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Customer Name*</span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-name" name="name" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                </div>

                                
                                <input type="text" id="vendor-id" name="id" hidden>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Phone*</span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-phone" name="phone" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Email*</span>
                                    </div>
                                    <input type="email" class="form-control" id="edit-email" name="email" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                </div>
                                
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Address*</span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-address" name="address" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                </div>

                                <button type="submit" class="btn btn-primary theme-bg gradient">Update update</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default closeBtn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <?php $__env->stopSection(); ?>


    <?php $__env->startSection('page-stylesheet'); ?>
    <!--<link rel="stylesheet" href="<?php echo e(asset('/backend/assets/css/nice-select.css')); ?>">-->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-scripts'); ?>
    <!--<script src="<?php echo e(asset('/backend/assets/js/jquery.nice-select.js')); ?>"></script>-->
    <script !src="">
        // $(document).ready(function() {
        //     $('select').niceSelect();
        // });
    </script>
    <script src="<?php echo e(asset('/backend/js/customer.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\clients-project\hypershop_final\resources\views/admin/customer/list.blade.php ENDPATH**/ ?>