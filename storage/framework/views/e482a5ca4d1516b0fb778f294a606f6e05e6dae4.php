


<?php $__env->startSection('main-content'); ?>

    <div class="row my-4">
        <div class="col-md-12">
            <h3><b> Deactivated Products</b></h3>
        </div>
        <div class="col-md-12">
            <h6><a href="">Dashboard ></a> <a href="">Products ></a> <a href="">All Products > </a> <a href="">Add
                    Product</a></h6>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-12">
            <div class="card">
                <div class="body">
                    <div class="row my-3">
                        <div class="col-md-5"></div>
                        <div class="col-md-3">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $deactivatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($row->name); ?><br> <small>Id: <?php echo e($row->id); ?></small> <small>SKU:
                                            <?php echo e($row->sku); ?></small> <small>Vendor: </small></td>
                                    
                                    <td><?php echo e($row->stock); ?></td>
                                    <td><?php echo e($row->price); ?>BDT</td>
                                    <td>0BDT</td>
                                    <td>
                                        <select name="" class="theme-bg" data-id="<?php echo e($row->id); ?>"
                                            id="selectStatus">
                                            <option value="1" <?php echo e($row->status == 1 ? 'selected' : ''); ?>>Active</option>
                                            <option value="0" <?php echo e($row->status == 0 ? 'selected' : ''); ?>>Deactive
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        
                                        <a  href="<?php echo e(route('productEdit', $row->id)); ?>"
                                            class="btn btn-primary btn-round deleteBtn" style="cursor: pointer"
                                            type="submit"><i class="fa fa-edit"></i> Edit</a>
                                        

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
        <script src="<?php echo e(asset('/backend/js/product.js')); ?>"></script>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/product/deactivatedProducts.blade.php ENDPATH**/ ?>