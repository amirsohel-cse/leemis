
<?php $__env->startSection('main-content'); ?>
<div class="block-header">
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12">
            <h1><strong>Shipping Method</strong></h1>
            <span>Dashboard</span> <i class="fa fa-angle-right"></i>
            <span>General Setting</span> <i class="fa fa-angle-right"></i>
            <span>Shipping Methods</span>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <button class="btn btn-success btn-round" id="addMethodBtn" data-toggle="modal" data-target="#addMethodModal"><i class="fa fa-plus"></i>Add Shipping Method</button>
               

            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr data-id="<?php echo e($row->id); ?>">
                                    <td><?php echo e($row->title); ?></td>
                                    <td><?php echo e($row->price); ?></td>

                                    <td>
                                        <select name="" class="theme-bg " data-id="<?php echo e($row->id); ?>" id="selectStatus">
                                            <option class="text-dark" value="1" <?php echo e($row->status == 1 ? 'selected' : ''); ?>>Active</option>
                                            <option value="0" <?php echo e($row->status == 0 ? 'selected' : ''); ?>>Deactive</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button data-id="<?php echo e($row->id); ?>" data-toggle="modal" data-target="#editMethodModal" class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
                                        <button data-id="<?php echo e($row->id); ?>" class="btn btn-danger btn-round deleteBtn" style="cursor: pointer" type="submit"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <td colspan="5" class="text-center">No data Available</td>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



    <div class="modal ml-5 fade bd-example-modal-lg" tabindex="-1" id="addMethodModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>ADD NEW Method</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="add-method-form" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <span style="color: red" class="titleError"></span>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Title*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="title" name="title" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Enter Title">
                                </div>
                                <span style="color: red" class="priceError"></span>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Price*</strong></span>
                                    </div>
                                    <input type="number" class="form-control" id="price" name="price" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Enter Price">
                                </div>

                                <button type="submit" class="btn btn-primary theme-bg gradient">Save Method</button>
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




    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="editMethodModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>EDIT BRAND</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="edit-method-form" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <span style="color: red" class="titleError"></span>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Title*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-title" name="title" placeholder="Enter Title" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                </div>

                                
                                <input type="text" id="method-id" name="id" hidden>
                                <span style="color: red" class="priceError"></span>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Price*</strong></span>
                                    </div>
                                    <input type="number" class="form-control" id="edit-price" name="price" placeholder="Enter Price" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                </div>


                                <button type="submit" class="btn btn-primary theme-bg gradient">Update Method</button>
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
        // $(document).ready(function () {
        //     $('select').niceSelect();
        // });
    </script>
    <script src="<?php echo e(asset('/backend/js/shippingMethod.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/setting/shipping-view.blade.php ENDPATH**/ ?>