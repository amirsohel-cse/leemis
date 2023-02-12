

<?php $__env->startSection('main-content'); ?>

    <?php if(Session::get('cache')): ?>
        <div class="alert text-white container" style="background: #1dca0d;">
            <?php echo e(Session::get('cache')); ?>

        </div>
    <?php endif; ?>

    <!-- Page header section  -->
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <h1><strong>Hi, Welcomeback!</strong></h1>
                <span><?php echo e(Auth::user()->name); ?>,</span>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 text-lg-right">
                <div class="d-flex align-items-center justify-content-lg-end mt-4 mt-lg-0 flex-wrap vivify pullUp delay-550">
                    <?php if($profit->isNotEmpty()): ?>
                        <div class="border-right pr-4 mr-4 mb-2 mb-xl-0 hidden-xs">
                            <p class="text-muted mb-1">Product Sell <span id="mini-bar-chart3" class="mini-bar-chart"></span>
                            </p>
                            <h5 class="mb-0"><?php echo e($profit->where('status', 'Completed')->sum('qty')); ?></h5>
                        </div>

                        <div class="border-right pr-4 mr-4 mb-2 mb-xl-0">
                            <p class="text-muted mb-1">Total Sell Amount<span id="mini-bar-chart1"
                                    class="mini-bar-chart"></span></p>
                            <?php if(!empty($order_o[0])): ?>
                                <h5 class="mb-0"><?php echo e($order_o[0]->where('status', 'Completed')->sum('subtotal')); ?></h5>
                            <?php endif; ?>

                        </div>
                        <div class="border-right pr-4 mr-4 mb-2 mb-xl-0">
                            <p class="text-muted mb-1">Total Amount After Withdraw Complete<span id="mini-bar-chart4"
                                    class="mini-bar-chart"></span></p>
                            <h5 class="mb-0">
                                <?php echo e($order_o[0]->where('status', 'Completed')->sum('subtotal') - $data['withdraw']->where('status', 'Completed')->sum('amount')); ?>

                            </h5>
                        </div>
                        <div class="border-right pr-4 mr-4 mb-2 mb-xl-0">
                            <p class="text-muted mb-1">Profit <span id="mini-bar-chart2" class="mini-bar-chart"></span></p>
                            <h5 class="mb-0"><?php echo e($profit->where('status', 'Completed')->sum('profit')); ?></h5>
                        </div>
                    <?php endif; ?>



                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">

        <div class="col-12">
            <div class="card theme-bg gradient">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div id="slider1" class="carousel vert slide" data-ride="carousel"
                                        data-interval="2700">
                                        <div class="carousel-inner">
                                            <?php if($profit->isNotEmpty()): ?>
                                                <div class="carousel-item active">
                                                    <div>Total Sell</div>
                                                    <div class="mt-3 h1">
                                                        <?php echo e($order_o[0]->where('status', 'Completed')->sum('subtotal')); ?>

                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div>Total Product Sell</div>
                                                    <div class="mt-3 h1">
                                                        <?php echo e($profit->where('status', 'Completed')->sum('qty')); ?></div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div>Total Profit</div>
                                                    <div class="mt-3 h1">
                                                        <?php echo e($profit->where('status', 'Completed')->sum('profit')); ?></div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div id="slider2" class="carousel vert slide" data-ride="carousel"
                                        data-interval="2800">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div>Total Vendor</div>
                                                <div class="mt-3 h1"><?php echo e($vendor); ?></div>
                                            </div>
                                            <div class="carousel-item">
                                                <div>Total Customer</div>
                                                <div class="mt-3 h1"><?php echo e($user); ?></div>
                                            </div>
                                            <div class="carousel-item">
                                                <div>Total Admin</div>
                                                <div class="mt-3 h1"><?php echo e($admin); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div id="slider3" class="carousel vert slide" data-ride="carousel"
                                        data-interval="3000">
                                        <div class="carousel-inner">
                                            <?php if($profit->isNotEmpty()): ?>
                                                <div class="carousel-item active">
                                                    <div>Order Complete</div>
                                                    <div class="mt-3 h1">
                                                        <?php echo e($profit[0]->where('status', '=', 'Completed')->count()); ?></div>

                                                </div>
                                                <div class="carousel-item">
                                                    <div>Order Pending</div>
                                                    <div class="mt-3 h1">
                                                        <?php echo e($profit[0]->where('status', '=', 'Pending')->count()); ?></div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div>Order Declined</div>
                                                    <div class="mt-3 h1">
                                                        <?php echo e($profit[0]->where('status', '=', 'Declined')->count()); ?></div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div>Total Number of Order</div>
                                                    <div class="mt-3 h1"><?php echo e($profit[0]->count()); ?></div>

                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div id="slider4" class="carousel vert slide" data-ride="carousel"
                                        data-interval="2500">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div>Totall Brand</div>
                                                <div class="mt-3 h1"><?php echo e($brand); ?></div>
                                            </div>
                                            <div class="carousel-item">
                                                <div>Withdraw Completed</div>
                                                <div class="mt-3 h1">
                                                    <?php echo e($data['withdraw']->where('status', '=', 'Completed')->count()); ?>

                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div>Withdraw Pending</div>
                                                <div class="mt-3 h1">
                                                    <?php echo e($data['withdraw']->where('status', '=', 'Pending')->count()); ?></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <style>
        .bg {
            background-image: -webkit-gradient(linear, left top, right top, from(#f7a7bb), to(#f18a8a));
            background-image: -webkit-linear-gradient(left, #e6767f, #f5e394);
            background-image: -o-linear-gradient(left, #f56f6f, #ecaec6);
            background-image: linear-gradient(to right, #d87e7e, #f15a1f);
        }

        .bg::after {
            background: #f55f5f;
        }

        .bg {
            color: whitesmoke;
        }

        .bg1 {
            background-image: -webkit-gradient(linear, left top, right top, from(#130449), to(#160542));
            background-image: -webkit-linear-gradient(left, #12023a, #04083a);
            background-image: -o-linear-gradient(left, #04053a, #18073f);
            background-image: linear-gradient(to right, #7d4eb3, #4721af);
        }

        .bg1::after {
            background: #41308d;
        }

        .bg1 {
            color: whitesmoke;
        }
    </style>
    <div class="row clearfix">
        <div class="col-12">
            <div class="row clearfix">
                <?php if($profit->isNotEmpty()): ?>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card bg">
                            <div class="body">
                                <div><strong>Total Sell</strong></div>
                                <h3 class="mb-1"> <?php echo e($order_o[0]->where('status', 'Completed')->sum('subtotal')); ?></h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card bg">
                            <div class="body">
                                <div><strong> Total Product Sell</strong></div>
                                <h3 class="mb-1"> <?php echo e($profit->where('status', 'Completed')->sum('qty')); ?></h3>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card bg">
                            <div class="body">
                                <div><strong>Total Profit</strong></div>
                                <h3 class="mb-1"> <?php echo e($profit->where('status', 'Completed')->sum('profit')); ?></h3>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>



                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card bg">
                        <div class="body">
                            <div><strong>Total Product</strong></div>
                            <h3 class="mb-1"><?php echo e($product); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card bg">
                        <div class="body">
                            <div><strong>Total Customer</strong></div>
                            <h3 class="mb-1"><?php echo e($user); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card bg">
                        <div class="body">
                            <div><strong>Total Vendor</strong></div>
                            <h3 class="mb-1"><?php echo e($vendor); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card bg">
                        <div class="body">
                            <div><strong>Total Admin</strong></div>
                            <h3 class="mb-1"><?php echo e($admin); ?></h3>
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card bg1">
                                <div class="body">
                                    <div><strong>Pending Withdraw</strong></div>
                                    <h3 class="mb-1"><?php echo e($data['withdraw']->where('status', '=', 'Pending')->count()); ?>

                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card bg1">
                                <div class="body">
                                    <div><strong>Processing Withdraw</strong></div>
                                    <h3 class="mb-1">
                                        <?php echo e($data['withdraw']->where('status', '=', 'Processing')->count()); ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card bg1">
                                <div class="body">
                                    <div><strong>Completed Withdraw</strong></div>
                                    <h3 class="mb-1"><?php echo e($data['withdraw']->where('status', '=', 'Completed')->count()); ?>

                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card bg1">
                                <div class="body">
                                    <div><strong>Declined Withdraw</strong></div>
                                    <h3 class="mb-1"><?php echo e($data['withdraw']->where('status', '=', 'Declined')->count()); ?>

                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card theme-bg gradient text-light">
                        <div class="body">
                            <div><strong>Order Pending</strong></div>
                            <h3 class="mb-1"><?php echo e($data['order_pending']); ?></h3>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card theme-bg gradient text-light">
                        <div class="body">
                            <div><strong>Order Completed</strong></div>
                            <h3 class="mb-1"><?php echo e($data['order_completed']); ?></h3>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card theme-bg gradient text-light">
                        <div class="body">
                            <div><strong>Order Declined</strong></div>
                            <h3 class="mb-1"><?php echo e($data['order_declined']); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card theme-bg gradient text-light">
                        <div class="body">
                            <div><strong>Total Order</strong></div>
                            <h3 class="mb-1"><?php echo e($data['order_all']); ?></h3>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="header">
                    <h2><strong>User Growth</strong></h2>
                </div>
                <div class="body">
                    <div id="bar-chart" class="ct-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Vendor Growth</strong></h2>
                </div>
                <div class="body">
                    <div id="bar-chart2" class="ct-chart"></div>

                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="header">
            <h2><strong>Montly Report</strong></h2>
        </div>
        <div class="body">
            <div id="apex-basic-column"></div>
        </div>
    </div>

    <div class="row clearfix row-deck">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Recent Orders</strong></h2>
                </div>
                <div class="body">
                    <table class="table table-striped mb-0">
                        <tbody>
                            <tr>
                                <th>Order Code</th>
                                <th>Order Date</th>
                                <th>Details</th>
                            </tr>
                            <?php $__currentLoopData = $data['recent_orders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($row->order_id); ?></td>
                                    <td><?php echo e($row->created_at->format('d-m-Y')); ?></td>
                                    <td><a href="<?php echo e(route('order.details', $row->id)); ?>"
                                            class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer"
                                            type="button"> view </a></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="header">
                    <h2><strong>New Customers</strong></h2>
                </div>
                <div class="body">
                    <table class="table table-striped mb-0">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <th>Joined</th>
                                <th>Details</th>
                            </tr>
                            <?php $__currentLoopData = $data['new_customers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($row->name); ?></td>
                                    <td><?php echo e($row->created_at->format('d-m-Y')); ?></td>
                                    <td><a href="<?php echo e(route('customerShow')); ?>"
                                            class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer"
                                            type="button"> view </a></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Top <?php echo e($data['tsp']->count()); ?> selling products of last 7 days</strong></h2>
                </div>
                <div class="body">
                    <table class="table table-striped mb-0">
                        <tbody>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Shop Name</th>
                                <th>Stock</th>
                                <th>Details</th>
                            </tr>
                            <?php $__currentLoopData = $data['tsp']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($row->id); ?></td>
                                    <td><?php echo e($row->name); ?></td>
                                    <td><?php echo e(@$row->categories->name); ?></td>
                                    <td><?php echo e($row->brand ? @$row->brand->name : null); ?></td>
                                    <td><?php echo e($row->vendor ? @$row->vendor->name : null); ?></td>
                                    <td><?php echo e($row->stock); ?></td>
                                    <td><a href="<?php echo e(route('productView', $row->id)); ?>"
                                            class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer"
                                            type="button"> view </a></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Top <?php echo e($data['top_vendor']->count()); ?> vendors of last 7 days</strong></h2>
                </div>
                <div class="body">
                    <table class="table table-striped mb-0">
                        <tbody>
                            <tr>
                                <th>Id</th>
                                <th>Owner Name</th>
                                <th>Shop Name</th>
                                <th>Address</th>
                            </tr>
                            <?php $__currentLoopData = $data['top_vendor']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($row->id); ?></td>
                                    <td><?php echo e($row->name); ?></td>
                                    <td><?php echo e($row->shop_name); ?></td>
                                    <td><?php echo e($row->address); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    </div>

    <script src="<?php echo e(asset('../backend/js/pages/charts/chartjs.js')); ?>"></script>
    <script src="<?php echo e(asset('../backend/assets/bundles/chartist.bundle.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

    <script>
        $(".alert:not(.not_hide)").delay(6000).slideUp(500, function() {
            $(this).alert('close');
        });

        var options;
        var user = <?php echo json_encode($userC); ?>;
        console.log(user);

        var data = {
            labels: ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            series: [
                user
            ],

        };

        // bar chart
        options = {
            height: "300px",
            axisX: {
                showGrid: false
            },
            plugins: [
                Chartist.plugins.tooltip({
                    appendToBody: true
                }),
            ]
        };
        new Chartist.Bar('#bar-chart', data, options);
        //vendor
        var options;
        var vendor = <?php echo json_encode($vendorG); ?>;
        console.log(vendor);

        var data = {
            labels: ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            series: [
                vendor
            ]
        };

        // bar chart
        options = {

            height: "300px",
            axisX: {
                showGrid: false
            },
            plugins: [
                Chartist.plugins.tooltip({
                    appendToBody: true
                }),
            ]
        };
        new Chartist.Bar('#bar-chart2', data, options);

        //Sales
        $(document).ready(function() {
            var datas = <?php echo json_encode($datas); ?>;
            var sell = <?php echo json_encode($sell); ?>;
            var withdraw = <?php echo json_encode($withdraw); ?>;




            var options = {
                chart: {
                    height: 350,
                    type: 'bar',
                },
                colors: ['#a1e461', '#14ea92', '#944ef4'],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                series: [{
                    name: 'Profit',
                    data: datas
                }, {
                    name: 'Total Sell',
                    data: sell
                }, {
                    name: 'Withdraw Request',
                    data: withdraw
                }],
                xaxis: {
                    categories: ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                        'Nov', 'Dec'
                    ],
                },
                yaxis: {
                    title: {
                        text: '(BDT)'
                    }
                },
                fill: {
                    opacity: 1

                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " BDT"
                        }
                    }
                }
            }

            var chart = new ApexCharts(
                document.querySelector("#apex-basic-column"),
                options
            );

            chart.render();
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/dashboard/dashboard.blade.php ENDPATH**/ ?>