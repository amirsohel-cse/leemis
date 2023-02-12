
<?php $__env->startSection('main-content'); ?>
<div class="block-header">
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12">
            <h1><strong>Services</strong></h1>
            <span>Dashboard</span> <i class="fa fa-angle-right"></i>
            <span>Home Page Setting</span> <i class="fa fa-angle-right"></i>
            <span>Services</span>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">

            <div class="body">
                <button class="btn btn-success btn-round mb-5"  data-toggle="modal" data-target="#addServiceModal"><i class="fa fa-plus"></i>Add Service</button>

                <div class="table-responsive">
                    <table class="table table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Details</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Details</th>
                                <th>Options</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr data-id="<?php echo e($row->id); ?>">
                                    <td><?php echo e($row->title); ?></td>
                                    <td><?php echo e($row->details); ?></td>
                                    <td>
                                        <button data-id="<?php echo e($row->id); ?>" data-toggle="modal" data-target="#editServiceModal" class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
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



    <div class="modal ml-5 fade bd-example-modal-lg" tabindex="-1" id="addServiceModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>ADD NEW SERVICE</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="add-service-form" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Title*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Details*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="details" name="details" placeholder="Enter Details" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                             

                                <button type="submit" class="btn btn-primary theme-bg gradient">Save</button>
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




    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="editServiceModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>EDIT SERVICE</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="edit-service-form" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Title*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-title" name="title" placeholder="Enter Title" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                </div>

                                
                                <input type="text" id="service-id" name="id" hidden>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Details*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-details" name="details" placeholder="Enter Details" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                             

                                <button type="submit" class="btn btn-primary theme-bg gradient">Update Service</button>
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

<?php $__env->startSection('page-scripts'); ?>
    
    <script src="<?php echo e(asset('/backend/js/services.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/setting/services-view.blade.php ENDPATH**/ ?>