<?php $__env->startSection('main-content'); ?>
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h1><strong>Child Categories</strong></h1>
                <span>Dashboard</span> <i class="fa fa-angle-right"></i>
                <span>Manage Categories</span> <i class="fa fa-angle-right"></i>
                <span>Child Categories</span>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <button class="btn btn-success btn-round" id="addChildcategoryBtn" data-toggle="modal" data-target="#addChildCategoryModal"><i class="fa fa-plus"></i> Add Child Category</button>
                    <ul class="header-dropdown dropdown">

                        <li><a href="javascript:void(0);" class="full-screen"><i class="fa fa-expand"></i></a></li>

                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sub Category</th>
                                <th>Child Category Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Sub Category</th>
                                <th>Child Category Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $childcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($row->id); ?></td>
                                    <td><?php echo e(isset($row->sub_category->name) ? $row->sub_category->name : ''); ?></td>
                                    <td><?php echo e($row->name); ?></td>
                                    <td><?php echo e($row->slug); ?></td>
                                    <td>
                                        <select class="theme-bg selectStatus" data-id="<?php echo e($row->id); ?>" >
                                            <option value="1" <?php echo e($row->status == 1 ? 'selected' : ''); ?>>Active</option>
                                            <option value="0" <?php echo e($row->status == 0 ? 'selected' : ''); ?>>Deactive</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button data-id="<?php echo e($row->id); ?>" data-toggle="modal" data-target="#editChildCategoryModal" class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
                                        <a class="btn btn-primary mr-1"
                                            href="<?php echo e(route('admin.childCategoryTranslations',['id'=>$row->id])); ?>"
                                            data-toggle="tooltip" title="Translations">
                                            <i class="fa fa-language"></i>
                                        </a>
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


    
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="addChildCategoryModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>ADD NEW CHILD CATEGORY</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="add-childcategory-form" method="post">
                                <?php echo csrf_field(); ?>
                                <span style="color: red" class="catIdError"></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Select SubCategory*</strong></span>
                                    </div>
                                    <select class="form-control" name="sub_category_id" id="categoryId">
                                        <option value="" data-display="Select"><strong>Select SubCategory</strong></option>
                                        <?php $__empty_1 = true; $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <option value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <option value=""><strong>No SubCategory Added</strong></option>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <span style="color: red" class="nameError"></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Child Category Name*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="name" name="name" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Enter Child Category Name">
                                </div>

                                <span style="color: red" class="slugError"></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Slug*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="slug" name="slug" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Enter Slug">
                                </div>

                                <button type="submit" class="btn btn-primary theme-bg gradient">Save ChildCategory</button>
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
    

    
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="editChildCategoryModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>EDIT CHILD CATEGORY</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="edit-childcategory-form" method="post">
                                <?php echo csrf_field(); ?>
                                <span style="color: red" class="catIdError"></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Select Sub Category*</strong></span>
                                    </div>
                                    <select class="form-control" name="sub_category_id" id="editcategoryId">
                                        <option value="" data-display="Select">Select SubCategory</option>
                                        <?php $__empty_1 = true; $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <option value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <option value="">No Sub Categories Added</option>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <span style="color: red" class="nameError"></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Child Category Name*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-name" name="name" aria-label="Default" placeholder="Enter Child Category Name" aria-describedby="inputGroup-sizing-default">
                                </div>

                                <span style="color: red" class="slugError"></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Slug*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-slug" name="slug" placeholder="Enter Slug" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                </div>

                                <button type="submit" class="btn btn-primary theme-bg gradient">Update ChildCategory</button>
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
    <script src="<?php echo e(asset('/backend/js/child-category.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\My Workspace\Web\Laravel\Work\leemis\resources\views/admin/child-category/child-category-view.blade.php ENDPATH**/ ?>