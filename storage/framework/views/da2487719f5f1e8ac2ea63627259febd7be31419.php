<?php $__env->startSection('main-content'); ?>
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h1><strong>Product Translations</strong></h1>
                <span>Dashboard</span> <i class="fa fa-angle-right"></i>
                <span>Products</span> <i class="fa fa-angle-right"></i>
                <span>Translations</span> <i class="fa fa-angle-right"></i>
                <span>Add Translation</span>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h5 class="card-title float-left">Ad Translations for <b><?php echo e($product->name); ?></b></h5>
                    <a href="<?php echo e(route('admin.productTranslations', ['id' => $product->id])); ?>"
                        class="btn btn-success btn-round float-right" id="addProductBtn"><i class="fa fa-plus"></i> All
                        Translations</a>
                </div>
                <div class="body">
                    <form action="" id="add-product-translation-form" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <label for="">Product Name</label>
                                <input type="text" class="form-control" value="<?php echo e($product->name); ?>" readonly />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="">Select Language</label>
                                <select class="form-control" name="language" id="language" required>
                                    <option value="">Select language</option>
                                    <option value="EN">English</option>
                                    <option value="cn">Traditional Chinese</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="" class="">Translated Name</label>
                                <input type="text" class="form-control" name="translated_name" placeholder="Enter name"
                                    id="translated_name" />
                            </div>

                            <div class="col-md-12">
                                <label for="" class="">Translated Description</label>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Enter Description" id="summernote" name="details" rows="7"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <button class="btn btn-primary spec" type="button"> <i class="fa fa-plus"></i> Add
                                    New Specification</button>
                            </div>

                            <div class="col-md-12 mt-3 appear">
                                <?php if($product->specification != null): ?>
                                    <?php $__currentLoopData = $product->specification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $spec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $last = $key + 1;
                                        ?>
                                        <?php if($loop->first): ?>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <label>Specification Title</label>
                                                    <input name="specification[<?php echo e($key); ?>][title]"
                                                        class="form-control" value="<?php echo e($spec['title']); ?>" required>
                                                </div>

                                                <div class="col-md-8">
                                                    <label>Specification Details</label>
                                                    <input name="specification[<?php echo e($key); ?>][details]"
                                                        class="form-control" value="<?php echo e($spec['details']); ?>" required>
                                                </div>
                                            </div>
                                            <?php continue; ?>
                                        <?php endif; ?>

                                        <div class="row mb-3 removeEl">
                                            <div class="col-md-4">
                                                <label>Specification Title</label>
                                                <input name="specification[<?php echo e($key); ?>][title]" class="form-control"
                                                    value="<?php echo e($spec['title']); ?>" required>
                                            </div>

                                            <div class="col-md-7">
                                                <label>Specification Details</label>
                                                <input name="specification[<?php echo e($key); ?>][details]"
                                                    class="form-control" value="<?php echo e($spec['details']); ?>" required>
                                            </div>

                                            <div class="col-md-1">
                                                <label class="w-100"></label>
                                                <button type="button" class="btn btn-danger remove"> <i
                                                        class="fa fa-trash"></i> </button>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Specification Title</label>
                                            <input name="specification[0][title]" class="form-control" required>
                                        </div>

                                        <div class="col-md-8">
                                            <label>Specification Details</label>
                                            <input name="specification[0][details]" class="form-control" required>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php $__errorArgs = ['specification.*.title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="form-text text-danger"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                <?php $__errorArgs = ['specification.*.details'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="form-text text-danger"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary theme-bg gradient add-btn-submit">Add Translation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-stylesheet'); ?>
    <!--<link rel="stylesheet" href="<?php echo e(asset('/backend/assets/css/nice-select.css')); ?>">-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-scripts'); ?>
    <script>
        let incrementer = "<?php echo e($last); ?>";
        $('.spec').on('click', function(e) {
            e.preventDefault();
            let html = `
                <div class="row removeEl">
                                
                  <div class="col-md-4">
                            <label>Specification Title</label>
                            <input name="specification[${incrementer}][title]" class="form-control" required>
                        </div>
                        
                        <div class="col-md-7">
                            <label>Specification Details</label>
                            <input name="specification[${incrementer}][details]" class="form-control" required>
                        </div>
                        
                         <div class="col-md-1">
                            <label class="w-100"></label>
                            <button type="button" class="btn btn-danger remove"> <i class="fa fa-trash"></i> </button>
                        </div>
                </div>
            
            
            `;

            $('.appear').append(html);
            incrementer++;
        });
        $(document).on('click', '.remove', function() {
            $(this).closest('.removeEl').remove();
        });
    </script>
    <script>
        $(".add-btn-submit").click(function(e) {
            e.preventDefault();
            var category_id = $("#category_id").val();
            var name = $("#translated_name").val();
            var lang = $("#language").val();

            $.ajax({
                type: 'POST',
                url: "<?php echo e(route('admin.addProductTranslation')); ?>",
                data: {
                    category_id: category_id,
                    name: name,
                    lang: lang
                },
                beforeSend: function() {
                    $(".add-btn-submit").addClass('disabled');
                    $(".add-btn-submit").html('<i class="fa fa-spinner fa-spin"></i> Loading');
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        toastr.success(data.success);
                        $('#addLangProductModal').modal('hide');

                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        printErrorMsg(data.error);
                    }
                    $(".add-btn-submit").removeClass('disabled');
                    $(".add-btn-submit").html('Add Translation');
                }
            });

        });

        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });

        }

        $(".edit-btn-submit").click(function(e) {
            e.preventDefault();
            var category_id = $("#edit_category_id").val();
            var translation_id = $("#translation_id").val();
            var name = $("#edit_translated_name").val();
            var lang = $("#edit_language").val();

            $.ajax({
                type: 'POST',
                url: "<?php echo e(route('admin.editProductTranslation')); ?>",
                data: {
                    category_id: category_id,
                    translation_id: translation_id,
                    name: name,
                    lang: lang
                },
                beforeSend: function() {
                    $(".edit-btn-submit").addClass('disabled');
                    $(".edit-btn-submit").html('<i class="fa fa-spinner fa-spin"></i> Loading');
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        toastr.success(data.success);
                        $('#editLangProductModal').modal('hide');

                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        printEditErrorMsg(data.error);
                    }
                    $(".edit-btn-submit").removeClass('disabled');
                    $(".edit-btn-submit").html('Update Translation');
                }
            });

        });

        function printEditErrorMsg(msg) {
            $(".print-edit-error-msg").find("ul").html('');
            $(".print-edit-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-edit-error-msg").find("ul").append('<li>' + value + '</li>');
            });

        }

        $(".deleteBtn").click(function(e) {
            var translation_id = $(this).data('id');

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success ml-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo e(route('admin.deleteCategoryTranslation')); ?>",
                        data: {
                            translation_id: translation_id
                        },
                        success: function(data) {
                            swalWithBootstrapButtons.fire(
                                'Deleted',
                                'Your file has been deleted successfully)',
                                'success'
                            )
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your file is safe :)',
                        'error'
                    )
                }
            })

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\My Workspace\Web\Laravel\Work\leemis\resources\views/admin/product/translations/add-translation.blade.php ENDPATH**/ ?>