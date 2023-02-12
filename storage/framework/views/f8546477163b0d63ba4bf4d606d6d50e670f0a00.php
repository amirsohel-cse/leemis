

<?php $__env->startSection('main-content'); ?>

    <div class="main-content">

        <div class="language-index-row">
            <div class="card">

                <div class="card-header">
                    <div class="w-100">
                        <div class="input-group mb-3">
                            <select class="custom-select export selectric" id="inputGroupSelect02">
                                <option selected> <?php echo e(__('Select Language')); ?> </option>
                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $la): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($la->short_code); ?>"><?php echo e(__($la->name)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                            <div class="input-group-append">
                                <label class="input-group-text bg-primary text-white custom-imp"
                                    for="inputGroupSelect02"><?php echo e(__('Import From')); ?></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <form action="" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="text-right text-right-to-left my-3">
                            <button type="button" class="btn btn-primary addmore"> <i class="fa fa-plus"></i>
                                <?php echo e(__('Add More')); ?></button>

                            <button type="submit" class="btn btn-success"><?php echo e(__('Update Language')); ?></button>

                        </div>

                        <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Key')); ?></th>
                                    <th><?php echo e(__('Value')); ?></th>
                                </tr>
                            </thead>

                            <tbody id="append">

                                <?php $__empty_1 = true; $__currentLoopData = $translators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $translate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                    <tr>
                                        <td>
                                            <textarea type="text" name="key[]" class="form-control"><?php echo e($key); ?></textarea>
                                        </td>
                                        
                                        <td>
                                            <textarea type="text" name="value[]" class="form-control"><?php echo e($translate); ?></textarea>
                                        </td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                <?php endif; ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <script>
        'use strict'
        $(function() {
            let i = <?php echo e($translators != null ? count($translators) : 0); ?>;
            $('.addmore').on('click', function() {
                let html = `
                        <tr>
                            <td>
                                <textarea type="text" name="key[]" class="form-control"></textarea>
                            </td>
                            <td>
                                <textarea type="text" name="value[]" class="form-control"></textarea>
                            </td>

                        </tr>
            `;
                i++;
                $('#append').prepend(html);
            })

            $('.export').on('change', function() {

                let lang = $(this).val();
                let current = "<?php echo e(request()->lang); ?>"
                let text = "Are You Sure to Import From " + lang + " . Your Current Data will be Removed";
                if (confirm(text) == true) {

                    $.ajax({
                        url: "<?php echo e(route('language.import')); ?>",
                        method: "GET",
                        data: {
                            import: lang,
                            current: current
                        },
                        success: function(response) {
                          
                            window.location.reload(true)
                        }
                    })
                }

            })
        })
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/lang/translate.blade.php ENDPATH**/ ?>