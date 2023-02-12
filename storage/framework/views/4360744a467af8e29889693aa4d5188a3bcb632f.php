
            <?php $__empty_1 = true; $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e(++$key); ?></td>
                    <td><?php echo e($row->name); ?></td>
                    <td><?php echo e($row->email); ?>

                        <input type="hidden" name="email" value="<?php echo e($row->email); ?>">
                    </td>
                    <td><?php echo e($row->phone); ?></td>
                    <td><?php echo e($row->shop_name); ?></td>
                    <td><?php echo e($row->address); ?></td>
                    <td><?php echo e($row->created_at->format('d-m-Y')); ?></td>
                    <td>
                        <span data-id="<?php echo e($row->id); ?>"
                            class="badge <?php echo e($row->feature == 1 ? 'badge-success' : 'badge-danger'); ?> yesNo"
                            style="cursor: pointer"><?php echo e($row->feature == 1 ? 'YES' : 'NO'); ?></span>


                    </td>
                    <td>
                        <span data-id="<?php echo e($row->id); ?>"
                            class="badge <?php echo e($row->s_status == 1 ? 'badge-success' : 'badge-danger'); ?> selectStatus"
                            style="cursor: pointer"><?php echo e($row->s_status == 1 ? 'ACTIVE' : 'DEACTIVE'); ?></span>

                    </td>

                    <td>
                        <button data-id="<?php echo e($row->id); ?>" data-toggle="modal"
                            data-target="#editVendorModal"
                            class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer"
                            type="button"><i class="fa fa-edit"></i> Edit</button>

                        <button data-id="<?php echo e($row->id); ?>" data-toggle="modal" id="email"
                            data-target="#emailModal" class="btn btn-warning btn-round mr-1 editBtn"
                            style="cursor: pointer" type="button"><i class="fa fa-edit"></i>
                            Email</button>



                    </td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <td colspan="5" class="text-center">No data Available</td>
                </tr>
            <?php endif; ?>


<?php /**PATH /var/www/html/resources/views/admin/vendor/vendor_response.blade.php ENDPATH**/ ?>