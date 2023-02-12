

<?php $__env->startSection('main-content'); ?>
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h1><strong>Main Categories</strong></h1>
                <span>Dashboard</span> <i class="fa fa-angle-right"></i>
                <span>Manage Categories</span> <i class="fa fa-angle-right"></i>
                <span>Categories</span>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <button class="btn btn-success btn-round" id="addCategoryBtn" data-toggle="modal"
                        data-target="#addCategoryModal"><i class="fa fa-plus"></i> Add Category</button>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Category ID</th>
                                    <th>Category Name</th>
                                    <th>Slug</th>
                                    <th>Commission</th>
                                    <th>Status</th>
                                    <th>Is Featured</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Slug</th>
                                    <th>Commission</th>
                                    <th>Status</th>
                                    <th>Is Featured</th>
                                    <th>Options</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr data-id="<?php echo e($row->id); ?>">
                                        <td><?php echo e($row->id); ?></td>
                                        <td><?php echo e($row->name); ?></td>
                                        <td><?php echo e($row->slug); ?></td>
                                        <td><?php echo e($row->commision); ?> %</td>

                                        <td>
                                            <select class="theme-bg" name="" data-id="<?php echo e($row->id); ?>"
                                                id="selectStatus">
                                                <option value="1" <?php echo e($row->status == 1 ? 'selected' : ''); ?>>Active
                                                </option>
                                                <option value="0" <?php echo e($row->status == 0 ? 'selected' : ''); ?>>Deactive
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="theme-bg" name="" data-id="<?php echo e($row->id); ?>"
                                                id="isFeatured">
                                                <option value="1" <?php echo e($row->is_featured == 1 ? 'selected' : ''); ?>>Yes
                                                </option>
                                                <option value="0" <?php echo e($row->is_featured == 0 ? 'selected' : ''); ?>>No
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <button data-id="<?php echo e($row->id); ?>" data-toggle="modal"
                                                data-target="#editCategoryModal"
                                                class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer"
                                                type="button"><i class="fa fa-edit"></i> Edit</button>

                                            <button class="btn btn-primary btn-attr mr-1"
                                                data-href="<?php echo e(route('category-attributes', @$row->id)); ?>"
                                                data-toggle="tooltip" title="Attributes">
                                                <i class="fa fa-list"></i>
                                            </button>


                                            <a class="btn btn-primary mr-1"
                                                href="<?php echo e(route('category-attributes-show', @$row->id)); ?>"
                                                data-toggle="tooltip" title="Attributes">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <button data-id="<?php echo e($row->id); ?>"
                                                class="btn btn-danger btn-round deleteBtn" style="cursor: pointer"
                                                type="submit"><i class="fa fa-trash"></i></button>

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


    
    <div class="modal ml-5 fade bd-example-modal-lg" tabindex="-1" id="addCategoryModal" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>ADD NEW CATEGORY</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="add-category-form" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <span style="color: red" class="catname"></span>

                                <div class="input-group mb-3">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Category
                                                Name*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="name" name="name" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default" placeholder="Enter Category Name">

                                </div>

                                <span style="color: red" class="slug"></span>

                                <div class="input-group mb-3">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            id="inputGroup-sizing-default"><strong>Slug*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="slug" name="slug" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default" placeholder="Enter Slug">


                                </div>
                                <span style="color: red" class="commision"></span>

                                <div class="input-group mb-3">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Commision By
                                                Category Parcentage*</strong></span>
                                    </div>
                                    <input type="number" step="0.01" class="form-control" id="commision" name="commision"
                                        aria-label="Default" aria-describedby="inputGroup-sizing-default"
                                        placeholder="Commision Parcent">
                                    <span style="font-size: 30px;">%</span>

                                </div>

                                <span style="color: red" class="catImageError"></span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Category Image
                                                *</strong></span>
                                    </div>
                                    <input type="file" name="photo" data-allowed-file-extensions="png jpg jpeg"
                                        class="dropify photo">
                                </div>

                                

                                <!-- <div class="input-group mb-3">
                                                <div class="fancy-checkbox">
                                                    <label><input type="checkbox" class="is_featured" id="is_featured" name="is_featured" value="0"><span>Allow Featured Category</span></label>
                                                </div>
                                            </div> -->

                                <!-- <div class="feature-category" hidden>
                                                <span style="color: red" class="featuredImageError"></span>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-default">Featured Image *</span>
                                                    </div>
                                                    <input type="file" name="image" class="dropify image">
                                                </div>
                                            </div> -->
                                <button type="submit" class="btn btn-primary theme-bg gradient">Save Category</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default closeBtn" data-dismiss="modal"><b>Close</b></button>
                </div>
            </div>
        </div>
    </div>
    

    
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="editCategoryModal" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>EDIT CATEGORY</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="edit-category-form" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <span style="color: red" class="catname"></span>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Category
                                                Name*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-name" name="name"
                                        placeholder="Enter Category Name" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default">
                                </div>

                                
                                <input type="text" id="category-id" name="id" hidden>
                                <span style="color: red" class="slug"></span>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            id="inputGroup-sizing-default"><strong>Slug*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-slug" name="slug"
                                        placeholder="Enter Slug" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default">
                                </div>
                                <span style="color: red" class="commision"></span>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Commision By
                                                Category Parcentage*</strong></span>
                                    </div>
                                    <input type="number" step="0.01" class="form-control" id="edit-commision"
                                        name="commision" placeholder="Commision Parcent" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default"><span style="font-size: 30px;">%</span>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <span style="color: red" class="editCatImageError"></span>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"
                                                    id="inputGroup-sizing-default"><strong>Category Image *</strong></span>
                                            </div>
                                            <input type="file" name="photo" data-allowed-file-extensions="png jpg jpeg"
                                                class="dropify edit-photo">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <img width="100%" height="200px" id="oldPhoto" style="margin-top: 37px" src=""
                                            alt="">
                                    </div>
                                </div>


                               


                                <!-- <div class="input-group mb-3">
                                                <div class="fancy-checkbox">
                                                    <label><input type="checkbox" class="is_featured" id="is_featured" name="is_featured" value="0"><span>Allow Featured Category</span></label>
                                                </div>
                                            </div> -->

                                <!-- <div class="feature-category" hidden>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <span style="color: red" class="editFeaturedImageError"></span>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-default">Featured Image *</span>
                                                            </div>
                                                            <input type="file" name="image" class="dropify edit-image">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <img width="100%" height="200px" id="oldImage" style="margin-top: 37px" src="" alt="">
                                                    </div>
                                                </div>
                                            </div> -->
                                <button type="submit" class="btn btn-primary theme-bg gradient">Update Category</button>
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
    


    <div class="modal fade" tabindex="-1" role="dialog" id="attribute">
        <div class="modal-dialog modal-lg" role="document">
            <form action="" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Attribute</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="col-md-12 my-3">
                                <button class="btn btn-primary addnew" type="button"> <i class="fa fa-plus"></i> Add
                                    New
                                    Option</button>
                            </div>

                            <div class="col-md-12">
                                <label for="">Options </label>
                                <input type="text" name="options[]" class="form-control">
                            </div>
                        </div>

                        <div class="row appear">

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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-stylesheet'); ?>
    <!--<link rel="stylesheet" href="<?php echo e(asset('/backend/assets/css/nice-select.css')); ?>">-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-scripts'); ?>
    <!--<script src="<?php echo e(asset('/backend/assets/js/jquery.nice-select.js')); ?>"></script>-->
    <script !src="">
        $('.btn-attr').on('click', function(e) {
            e.preventDefault();


            const modal = $('#attribute');


            modal.find('form').attr('action', $(this).data('href'))

            modal.modal('show');

        })


        $('.addnew').on('click', function() {
            let html = `

            <div class="col-md-12 removeEl my-2">
                                <label for="">Options <button class="btn btn-danger remove">X</button> </label>
                                <input type="text" name="options[]" class="form-control">
                            </div>
            
            `;


            $('.appear').append(html)
        })


        $(document).on('click', '.remove', function(e) {
            e.preventDefault();

            $(this).closest('.removeEl').remove();
        })
    </script>
    <script src="<?php echo e(asset('/backend/js/category.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/category/category-view.blade.php ENDPATH**/ ?>