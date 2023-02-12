

<?php $__env->startSection('main-content'); ?>
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h1><strong>Brand</strong></h1>
                <span>Dashboard</span> <i class="fa fa-angle-right"></i>
                <span>Brand</span> <i class="fa fa-angle-right"></i>
                <span>Brands</span>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">

                    <button class="btn btn-success btn-round" id="addbrandBtn" data-toggle="modal" data-target="#addbrandModal"><i class="fa fa-plus"></i> Add Brand</button>

                    <ul class="header-dropdown dropdown">

                        <li><a href="javascript:void(0);" class="full-screen"><i class="fa fa-expand"></i></a></li>
                       
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>Brand Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Is Featured</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Brand Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Is Featured</th>
                                <th>Options</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr data-id="<?php echo e($row->id); ?>">
                                <td><?php echo e($row->name); ?></td>
                                <td><?php echo e($row->slug); ?></td>

                                <td>
                                    <select class="theme-bg"  data-id="<?php echo e($row->id); ?>" id="selectStatus">
                                        <option class="text-dark" value="1" <?php echo e($row->status == 1 ? 'selected' : ''); ?>>Active</option>
                                        <option value="0" <?php echo e($row->status == 0 ? 'selected' : ''); ?>>Deactive</option>
                                    </select>
                                </td>
                                
                                <td>
                                    <select class="theme-bg"  data-id="<?php echo e($row->id); ?>" id="isFeatured">
                                        <option class="text-dark" value="1" <?php echo e($row->is_featured == 1 ? 'selected' : ''); ?>>Yes</option>
                                        <option class="text-dark" value="0" <?php echo e($row->is_featured == 0 ? 'selected' : ''); ?>>No</option>
                                    </select>
                                </td>
                                
                                <td>
                                    <button data-id="<?php echo e($row->id); ?>" data-toggle="modal" data-target="#editbrandModal" class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
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


    
    <div class="modal ml-5 fade bd-example-modal-lg" tabindex="-1" id="addbrandModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>ADD NEW BRAND</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="add-brand-form" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                   <span style="color: red" class="bname"></span>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Brand Name*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="name" name="name" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Enter Brand Name" >
                                </div>
                                <span style="color: red" class="slug"></span>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Slug*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="slug" name="slug" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Enter Slug" >
                                </div>
                                <span style="color: red" class="photo"></span>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Brand Image *</strong></span>
                                    </div>
                                    <input type="file" data-allowed-file-extensions="png jpg jpeg" name="photo" class="dropify photo">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="fancy-checkbox">
                                        <label><input type="checkbox" class="is_featured" id="is_featured" name="is_featured" value="0"><span><strong>Allow Featured brand</strong></span></label>
                                    </div>
                                </div>

                                <div class="feature-brand" hidden>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><strong>Featured Image *</strong></span>
                                        </div>
                                        <input type="file" name="image" class="dropify image">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary theme-bg gradient">Save brand</button>
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
    

    
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="editbrandModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>EDIT BRAND</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="edit-brand-form" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                
                               <span style="color: red" class="editname"></span>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Brand Name*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-name" name="name" placeholder="Enter Brand Name" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                </div>

                                
                                <input type="text" id="brand-id" name="id" hidden>
                                    <span style="color: red" class="editslug"></span>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Slug*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-slug" name="slug" placeholder="Enter Slug" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                </div>

                                <div class="row">
                                  <span style="color: red" class="editphoto"></span>

                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Brand Image *</strong></span>
                                            </div>
                                            <input type="file" data-allowed-file-extensions="png jpg jpeg" name="photo" class="dropify edit-photo">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <img width="100%" height="200px" id="oldPhoto" style="margin-top: 37px" src="" alt="">
                                    </div>
                                </div>


                                <div class="input-group mb-3">
                                    <div class="fancy-checkbox">
                                        <label><input type="checkbox" class="is_featured" id="is_featured" name="is_featured" value="0"><span><strong>Allow Featured brand</strong></span></label>
                                    </div>
                                </div>

                                <div class="feature-brand" hidden>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default"><strong>Featured Image *</strong></span>
                                                </div>
                                                <input type="file" name="image" class="dropify edit-image">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <img width="100%" height="200px" id="oldImage" style="margin-top: 37px" src="" alt="">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary theme-bg gradient">Update Brand</button>
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
    <script src="<?php echo e(asset('/backend/js/brand.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hypershop\resources\views/admin/brand/brand-view.blade.php ENDPATH**/ ?>