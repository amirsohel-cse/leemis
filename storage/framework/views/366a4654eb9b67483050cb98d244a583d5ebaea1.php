
<?php $__env->startSection('main-content'); ?>

<div class="block-header">
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12">
            <h1><strong>All Orders</strong></h1>
            <span>Dashboard</span> <i class="fa fa-angle-right"></i>
            <span>Orders</span> <i class="fa fa-angle-right"></i>
            <span>All Orders</span>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
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
                                <th>Customer Email</th>
                                <th>Order Code</th>
                                <th>Total QTY</th>
                                <th>Total Cost</th>
                                <th>Status</th>
                                <th>Update Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Customer Email</th>
                                <th>Order Code</th>
                                <th>Total QTY</th>
                                <th>Total Cost</th>
                                <th>Status</th>
                                <th>Update Status</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr data-id="<?php echo e($order->id); ?>">
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($order->email); ?></td>
                                    <td><?php echo e($order->order_id); ?></td>
                                    <td><?php echo e($order->orderProduct->sum('qty')); ?></td>
                                    <td><?php echo e($order->total); ?></td>
                                    <td>
                                        <?php if($order->status == 'pending'): ?>
                                            <span class="badge bg-warning text-white">Pending</span>
                                        <?php elseif($order->status == 'Processing'): ?>
                                            <span class="badge bg-info text-white">Processing</span>
                                        <?php elseif($order->status =='Completed'): ?>
                                            <span class="badge bg-success text-white">Completed</span>
                                        <?php elseif($order->status =='On Delivery'): ?>
                                            <span class="badge bg-primary text-white">Declined</span>
                                        <?php elseif($order->status =='Declined'): ?>
                                            <span class="badge bg-danger text-white">Declined</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <input type="hidden" id="email" name="email" value="<?php echo e($order->email); ?>">
                                        <select name="" class="theme-bg " data-id="<?php echo e($order->id); ?>" id="selectStatus" >
                                            <option class="text-dark" value="pending" <?php echo e($order->status == "pending" ? 'selected' : ''); ?>>Pendi'ng</option>
                                            <option class="text-dark" value="Processing" <?php echo e($order->status == "Processing" ? 'selected' : ''); ?>>Processi'ng</option>
                                            <option class="text-dark" value="On Delivery" <?php echo e($order->status == "On Delivery" ? 'selected' : ''); ?>>On-Deli'very</option>
                                            <option class="text-dark" value="Completed" <?php echo e($order->status == "Completed" ? 'selected' : ''); ?>>Complet'ed</option>
                                            <option class="text-dark" value="Declined" <?php echo e($order->status == "Declined" ? 'selected' : ''); ?>>Decli'ned</option>
                                        </select>
                                    </td>
                                    <td>
                                        
                                        
                            
                                        <div class="dropdown">
                                           
                                            <a class="btn btn-primary" href="/admin/orders/<?php echo e($order->id); ?>/orderDetails"> Details</a>
                                            <a class="btn btn-primary" href="<?php echo e(route('order.invoice',$order->id)); ?>"> Invoice</a>
                                            <a class="btn btn-primary" href="<?php echo e(route('orders.invoice',$order->id)); ?>"> Qr</a>
                                            
                                            
                                        </div>


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


<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-stylesheet'); ?>
   

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-scripts'); ?>
   
    <script>
        $(document).ready(function (){
            $('.sort-by-status').on('change',function (){
                let status = $(this).val();
                const allSelect = $('td select');
                allSelect.each(function (index, value){
                   console.log(value);
                });
            })
        })
    </script>
    <script>

       

        //Status update ajax
        $(document).ready(function () {
            $(document).on('change','#selectStatus',function () {
                let status = $(this).val();
                let id = $(this).attr('data-id');
                //let email = $("#email").val();
                 var oc = $(this).parent().parent().find('td')[1];
                 var bc = $(oc).text()
                // let email = $(em).text();
                //alert(oc);
                console.log(bc)
                let email = $(this).prev().val();
                let selectUpdate = $(this).parent().prev();

                $.ajax({
                    type: 'GET',
                    url: `/admin/orders/${id}/updateOrderStatus`,
                    data: {'status': status,
                            'oc' : bc,
                         'email':email
                         },
                    success: (data) => {
                        toastr.options = {
                            "timeOut": "2000",
                            "closeButton": true,

                        };
                        toastr['success'](data);
                        if (status == 'pending'){
                            $(selectUpdate).html(`
                            <span class="badge bg-warning text-white">${status}</span>
                        `)
                        }else if (status == 'Processing') {
                            $(selectUpdate).html(`
                            <span class="badge bg-info text-white">${status}</span>
                        `)
                        }else if (status == 'Completed') {
                            $(selectUpdate).html(`
                            <span class="badge bg-success text-white">${status}</span>
                        `)
                        }else if (status == 'On Delivery') {
                            $(selectUpdate).html(`
                            <span class="badge bg-primary text-white">${status}</span>
                        `)
                        }else if (status == 'Declined') {
                            $(selectUpdate).html(`
                            <span class="badge bg-danger text-white">${status}</span>
                        `)
                        }

                    },
                    error: (error) => {
                        console.log(error);
                        }
                })
            });
        });
    </script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\clients-project\hypershop_final\resources\views/admin/orders/order-view.blade.php ENDPATH**/ ?>