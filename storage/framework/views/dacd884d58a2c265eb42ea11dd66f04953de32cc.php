
<?php $__env->startSection('main-content'); ?>
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h1><strong>Top Menu</strong></h1>
                <span>Dashboard</span> <i class="fa fa-angle-right"></i>
                <span>General Setting</span> <i class="fa fa-angle-right"></i>
                <span>Top Menu</span>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <button class="btn btn-success btn-round" id="addTopMenuBtn" data-toggle="modal"
                        data-target="#addMethodModal"><i class="fa fa-plus"></i>Add Top Menu</button>
                    <ul class="header-dropdown dropdown">
                        <li><a href="javascript:void(0);" class="full-screen"><i class="fa fa-expand"></i></a></li>
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false"></a>
                            <ul class="dropdown-menu theme-bg gradient">
                                <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-eye"></i> View Details</a>
                                </li>
                                <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-share-alt"></i> Share</a>
                                </li>
                                <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-copy"></i> Copy to</a></li>
                                <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-folder"></i> Move to</a>
                                </li>
                                <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-edit"></i> Rename</a></li>
                                <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-trash"></i> Delete</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Url</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Url</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $topmenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr data-id="<?php echo e($row->id); ?>">
                                        <td><?php echo e($row->name); ?></td>
                                        <td><?php echo e($row->url); ?></td>

                                        <td>
                                            <select data-id="<?php echo e($row->id); ?>" class="theme-bg selectStatus">
                                                <option value="1" <?php echo e($row->status == 1 ? 'selected' : ''); ?>>Active
                                                </option>
                                                <option value="0" <?php echo e($row->status == 0 ? 'selected' : ''); ?>>Deactive
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <button data-id="<?php echo e($row->id); ?>" data-row="<?php echo e($row); ?>" data-toggle="modal"
                                                data-target="#editTopMenuModal"
                                                class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer"
                                                type="button"><i class="fa fa-edit"></i> Edit</button>
                                            <button data-id="<?php echo e($row->id); ?>" class="btn btn-danger btn-round deleteBtn"
                                                style="cursor: pointer" type="submit"><i
                                                    class="fa fa-trash"></i></button>
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


    
    <div class="modal ml-5 fade bd-example-modal-lg" tabindex="-1" id="addMethodModal" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>ADD NEW TOP MENU</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="add-topmenu-form" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            id="inputGroup-sizing-default"><strong>Name*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="name" name="name" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default" placeholder="Name" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong> URL*
                                            </strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="url" name="url" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default" placeholder="URL" required>
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Select
                                                Category* </strong></span>
                                    </div>
                                    <select name="category[]" class="form-control" id="category_id" multiple>
                                        <option value="" disabled>Select Category</option>
                                        <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($sub->id); ?>"><?php echo e($sub->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Top
                                                Brand* </strong></span>
                                    </div>
                                    <select name="brand[]" class="form-control" id="brand_id" multiple>
                                        <option value="" disabled>Select Category</option>
                                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>


                                <div class="upload__box">
                                    <div class="upload__img-wrap"></div>
                                    <div class="upload__btn-box">
                                        <label class="upload__btn">
                                            <p>Upload images (Hold ctrl for select Multiple)</p>
                                            <input type="file" multiple="" name="images[]" data-max_length="20" class="upload__inputfile">
                                        </label>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary theme-bg gradient">Save Top Menu</button>
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
    


    
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="editTopMenuModal" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>EDIT TOP MENU</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="edit-topmenu-form" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            id="inputGroup-sizing-default"><strong>Name*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-name" name="name"
                                        placeholder="Enter Name" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default" required>
                                </div>

                                
                                <input type="text" id="topmenu-id" name="id" hidden>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            id="inputGroup-sizing-default"><strong>URL*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-url" name="url"
                                        placeholder="Enter URL" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default" required>
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Select
                                                Category* </strong></span>
                                    </div>
                                    <select name="category[]" class="form-control select-edit" id="edit_category_id" multiple>
                                        <option value="" disabled>Select Category</option>
                                        <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($sub->id); ?>"><?php echo e($sub->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Top
                                                Brand* </strong></span>
                                    </div>
                                    <select name="brand[]" class="form-control" id="edit_brand_id" multiple>
                                        <option value="" disabled>Select Category</option>
                                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                
                                <div class="upload__box">
                                    <div class="upload__img-wrap"></div>
                                    <div class="upload__btn-box">
                                        <label class="upload__btn">
                                            <p>Upload images (Hold ctrl for select Multiple)</p>
                                            <input type="file" multiple="" name="images[]" data-max_length="20" class="upload__inputfile">
                                        </label>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary theme-bg gradient">Update TopMenu</button>
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
    <link rel="stylesheet" href="https://cdn.rawgit.com/lcdsantos/jQuery-Selectric/master/public/selectric.css">
    
    <style>
        .input-group .selectric-wrapper {
            position: relative;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            width: 1%;
            min-width: 0;
            margin-bottom: 0;
            border-color: #17a2b8 !important;
        }


        .upload__box {
            padding: 40px;
        }

        .upload__inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .upload__btn {
            display: inline-block;
            font-weight: 600;
            color: #fff;
            text-align: center;
            min-width: 116px;
            padding: 5px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid;
            background-color: #4045ba;
            border-color: #4045ba;
            border-radius: 10px;
            line-height: 26px;
            font-size: 14px;
        }

        .upload__btn:hover {
            background-color: unset;
            color: #4045ba;
            transition: all 0.3s ease;
        }

        .upload__btn-box {
            margin-bottom: 10px;
        }

        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .upload__img-box {
            width: 200px;
            padding: 0 10px;
            margin-bottom: 12px;
        }

        .upload__img-close {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: center;
            line-height: 24px;
            z-index: 1;
            cursor: pointer;
        }

        .upload__img-close:after {
            content: "✖";
            font-size: 14px;
            color: white;
        }

        .img-bg {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            padding-bottom: 100%;
        }

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-scripts'); ?>
    
    <script src="https://cdn.rawgit.com/lcdsantos/jQuery-Selectric/master/public/jquery.selectric.js"></script>
    <script>
        $('select').selectric();


        jQuery(document).ready(function() {
            ImgUpload();
        });

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            $('.upload__inputfile').each(function() {
                $(this).on('change', function(e) {
                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');

                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    var iterator = 0;
                    filesArr.forEach(function(f, index) {

                        if (!f.type.match('image.*')) {
                            return;
                        }

                        if (imgArray.length > maxLength) {
                            return false
                        } else {
                            var len = 0;
                            for (var i = 0; i < imgArray.length; i++) {
                                if (imgArray[i] !== undefined) {
                                    len++;
                                }
                            }
                            if (len > maxLength) {
                                return false;
                            } else {
                                imgArray.push(f);

                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    var html =
                                        "<div class='upload__img-box'><div style='background-image: url(" +
                                        e.target.result + ")' data-number='" + $(
                                            ".upload__img-close").length + "' data-file='" + f
                                        .name +
                                        "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                    imgWrap.append(html);
                                    iterator++;
                                }
                                reader.readAsDataURL(f);
                            }
                        }
                    });
                });
            });

            $('body').on('click', ".upload__img-close", function(e) {
                var file = $(this).parent().data("file");
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
            });
        }
    </script>
    <script src="<?php echo e(asset('/backend/js/topMenu.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\My Workspace\Web\Laravel\Work\leemis\resources\views/admin/setting/top-menu-view.blade.php ENDPATH**/ ?>