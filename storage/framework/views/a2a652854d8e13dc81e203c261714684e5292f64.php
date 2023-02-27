<?php $__env->startSection('main-content'); ?>
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h1>Product</h1>
                <span>Dashboard</span> <i class="fa fa-angle-right"></i>
                <span>Product</span> <i class="fa fa-angle-right"></i>
                <span>Product View</span>
            </div>
        </div>
    </div>
    <?php if(Session::get('delete')): ?>
        <div class="alert text-white container" style="background: #c41818;">
            <?php echo e(Session::get('delete')); ?>

        </div>
    <?php endif; ?>
    <div class="row clearfix">
        <div class="col-12">
            <div class="card">
                <div class="body">
                    <div class="row my-3">
                        <div class="col-md-5"></div>
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-4 d-flex flex-row-reverse">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Product Code</th>
                                    <th>Vendor Name</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Is Featured</th>
                                    <th>Options</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e(Str::limit($row->name, 50)); ?><br></small> <small>SKU:
                                                <?php echo e($row->sku); ?></small> <small>Shop:
                                                <?php echo e(isset($row->vendor->shop_name) ? $row->vendor->shop_name : ''); ?> </small>
                                        </td>
                                        <td><?php echo e($row->code); ?></td>
                                        <td><?php echo e($row->vendor->name); ?></td>
                                        <td><?php echo e($row->stock); ?></td>
                                        <td><?php echo e($row->price); ?></td>

                                        <td>
                                            <select class="theme-bg" data-id="<?php echo e($row->id); ?>" id="selectStatus">
                                                <option class="text-dark" value="1"
                                                    <?php echo e($row->status == 1 ? 'selected' : ''); ?>>Active</option>
                                                <option value="0" <?php echo e($row->status == 0 ? 'selected' : ''); ?>>Deactive
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="theme-bg" data-id="<?php echo e($row->id); ?>" id="selectIsFeatured">
                                                <option class="text-dark" value="1"
                                                    <?php echo e($row->featured == 1 ? 'selected' : ''); ?>>Yes</option>
                                                <option value="0" <?php echo e($row->featured == 0 ? 'selected' : ''); ?>>No
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('productEdit', $row->id)); ?>"
                                                class="btn btn-primary btn-round deleteBtn" style="cursor: pointer"
                                                type="submit"><i class="fa fa-edit"></i> Edit</a>

                                            <a class="btn btn-primary mr-1"
                                                href="<?php echo e(route('admin.productTranslations',['id'=>$row->id])); ?>"
                                                data-toggle="tooltip" title="Translations">
                                                <i class="fa fa-language"></i>
                                            </a>

                                            <a href="<?php echo e(route('productView', $row->id)); ?>"
                                                class="btn btn-info btn-round deleteBtn" style="cursor: pointer"
                                                type="submit"><i class="fa fa-eye"></i></a>
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
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-scripts'); ?>
    <script src="<?php echo e(asset('/backend/js/product.js')); ?>"></script>

    <script>
        $(function() {
            $('#selectStatus').on('change', function() {
                if ($(this).val() == 0) {
                    localStorage.removeItem("items");
                }
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\My Workspace\Web\Laravel\Work\leemis\resources\views/admin/product/allProducts.blade.php ENDPATH**/ ?>