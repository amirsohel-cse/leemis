
<?php $__env->startSection('content'); ?>

    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo e('frontend/assets/css/style.min.css'); ?>">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
                crossorigin="anonymous"></script>
    </head>


    <main class="main cart">
        <input type="text" id="viewCartUserId" value="<?php echo e(isset(Auth::user()->id) ? Auth::user()->id : ''); ?>" hidden>
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li>
                        <h3 class="text-dark"><?php echo e(languageChange('Shopping Cart')); ?></h3>
                    </li>
                </ul>
            </div>
        </nav>
        <?php if(Session::get('success')): ?>
            <div class="alert text-white container" style="background: #da1630;">
                <?php echo e(Session::get('success')); ?>

            </div>
        <?php endif; ?>
        <div class="page-content">
            <div class="container">
                <div class="row gutter-lg mb-10 align-items-end">
                    <div class="col-lg-12 pr-lg-4 mb-1">
                        <table class="shop-table cart-table">
                            <thead>
                                <tr>
                                    <th class="product-name"><span><?php echo e(languageChange('Product')); ?></span></th>
                                    <th><?php echo e(languageChange('Attributes')); ?></th>
                                    <th class="product-price"><span><?php echo e(languageChange('Price')); ?></span></th>
                                    <th class="product-quantity"><span><?php echo e(languageChange('Quantity')); ?></span></th>
                                    <th class="product-subtotal"><span><?php echo e(languageChange('Subtotal')); ?></span></th>
                                    <th class="product-subtotal"><span><?php echo e(languageChange('Action')); ?></span></th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php if($cart->product != null): ?>
                                    <tr>
                                        <td>
                                            <div class="cart-table-item">
                                                <img src="<?php echo e(asset($cart->product->photo)); ?>" alt="">
                                                <p><?php echo e($cart->product->name); ?></p>
                                            </div>
                                        </td>

                                        <td>
                                            <?php if($cart->attributes != null): ?>
                                                <?php $__currentLoopData = $cart->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <p><?php echo e(\App\Model\CategoryAttribute::find($attr['attribute'])->name); ?> : <?php echo e(\App\Model\AttributeOption::find($attr['option'])->option); ?></p>
                                                        
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                           <?php else: ?>

                                            

                                           <?php endif; ?>
                                        </td>

                                        <td id="">
                                            <?php echo e($cart->product->price); ?>

                                        </td>

                                        <td>
                                            
                                            <div class="cart-update-part">
                                                <button type="button" class="decrement_qty" data-cart="<?php echo e($cart->id); ?>">-</button>
                                                <input type="number" value="<?php echo e($cart->qty); ?>" class="cart_qty">
                                                <button type="button" class="increment_qty" data-cart="<?php echo e($cart->id); ?>">+</button>
                                            </div>

                                            <style>
                                                .cart-update-part {
                                                    display: inline-flex;
                                                    border: 1px solid #e5e5e5;
                                                    border-radius: 5px;
                                                }
                                                .cart-update-part button {
                                                    width: 30px;
                                                    background-color: #f7f7f7;
                                                    height: 30px;
                                                    border: none;
                                                }
                                                .cart-update-part input {
                                                    width: 50px;
                                                    border: none;
                                                    border-left: 1px solid #e5e5e5;
                                                    border-right: 1px solid #e5e5e5;
                                                    text-align: center;
                                                    padding: 0 10px;
                                                }
                                                input::-webkit-outer-spin-button,
                                                input::-webkit-inner-spin-button {
                                                    -webkit-appearance: none;
                                                }

                                                input[type=number] {
                                                    -moz-appearance:textfield; /* Firefox */
                                                }

                                                .cart-table-item {
                                                    display: flex;
                                                    flex-wrap: wrap;
                                                    align-items: center;
                                                }
                                                .cart-table-item img {
                                                    width: 70px;
                                                    height: 70px;
                                                    object-fit: cover;
                                                    -o-object-fit: cover;
                                                    border-radius: 5px;
                                                }
                                                .cart-table-item p {
                                                    width: calc(100% - 70px);
                                                    padding-left: 20px;
                                                    margin-bottom: 0;
                                                }
                                            </style>
                                           
                                        </td>

                                        <td class="subtotal">
                                            <?php echo e($cart->subtotal); ?>

                                        </td>

                                        <td>
                                            <button class="btn btn-sm btn-danger cart_delete" data-cart="<?php echo e($cart->id); ?>"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-9">
                        <div class="cart-action mb-6">
                            <a href="/" class="btn btn-primary btn-rounded btn-icon-left btn-shopping mr-auto"><i
                                    class="w-icon-long-arrow-left"></i><?php echo e(languageChange('Continue Shopping')); ?></a>
                            <button type="submit" class="btn  btn-rounded btn-default btn-clear" name="clear_cart"
                                value="Clear Cart"><?php echo e(languageChange('Clear Cart')); ?></button>
                        </div>
                    </div>
                    <div class="col-lg-3 sticky-sidebar-wrapper">
                        <div class="sticky-sidebar">
                            <hr class="divider mb-6">
                            <div class="order-total d-flex justify-content-between align-items-center">
                                <label><?php echo e(languageChange('Total')); ?></label>
                                <span class="ls-50" id="totalPrice"><?php echo e($sum); ?></span>
                            </div>
                            <a href="<?php echo e(route('checkout')); ?>"
                                class="btn btn-block btn-primary btn-icon-right btn-rounded  btn-checkout"
                                id="btn-checkout">
                                <?php echo e(languageChange('Proceed to checkout')); ?><i class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- End of PageContent -->
    </main>

    
    <div class="modal fade bd-example-modal-sm" id="pleaseWaitModal" tabindex="-1" role="dialog"
        aria-labelledby="pleaseWaitModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content m-0 p-0 text-center"
                style="background-color: transparent !important; border: none !important;">
                <div>
                    <div class="spinner-grow text-primary" role="status">
                        <span class="sr-only"><?php echo e(languageChange('Loading')); ?>...</span>
                    </div>
                    <div class="spinner-grow text-secondary" role="status">
                        <span class="sr-only"><?php echo e(languageChange('Loading')); ?>...</span>
                    </div>
                    <div class="spinner-grow text-success" role="status">
                        <span class="sr-only"><?php echo e(languageChange('Loading')); ?>...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="<?php echo e(asset('frontend/js/view-cart.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('view-cart-script'); ?>
    <?php if(\Illuminate\Support\Facades\Auth::user()): ?>
        <script !src="">
            $(document).on('click', '.quantity-plus', function() {
                let id = $(this).attr('data-id');
                let a = $(this).parent().find('.quantity').val();
                const userId = $('#viewCartUserId').val();

                productStock(id, (stock) => {

                    if (parseInt(a) < parseInt(stock)) {
                        $(this).parent().find('.quantity').val(parseInt(a) + 1);

                        let quantity = parseInt($(this).parent().find('.quantity').val());

                        let price = parseInt($(this).parent().parent().prev().find('.amount').text());

                        // let price = parseInt($('#product-price-'+id).text());
                        // let subtotal =quantity * price;

                        let subtotal = $(this).parent().parent().next().find('.subtotal').text(quantity *
                        price);

                        $('#product-subtotal-' + id).text(subtotal);

                        // let total = $('#totalPrice').text();
                        //
                        // $('#totalPrice').text(parseInt(total) + parseInt(price));

                        let qty = $(this).parent().find('.quantity').val();
                        if (userId) {
                            storeProductQuantity(userId, id, qty);
                        }

                        getGrandTotalPrice(userId);

                    } else {
                        $(this).attr('disabled', true);
                    }

                });
            });

            $(document).on('click', '.quantity-minus', function() {
                const userId = $('#viewCartUserId').val();
                let id = $(this).attr('data-id');
                $('.quantity-plus').attr('disabled', false);
                let a = $(this).parent().find('.quantity').val();
                if (parseInt(a) > 1) {
                    $(this).parent().find('.quantity').val(parseInt(a) - 1);
                }
                let quantity = $(this).parent().find('.quantity').val();
                let price = $(this).parent().parent().prev().find('.amount').text();
                let subtotal = $(this).parent().parent().next().find('.subtotal').text();

                // let total = $('#totalPrice').text();
                // if (parseInt(subtotal) > parseInt(price)){
                //     $('#totalPrice').text(parseInt(total) - parseInt(price));
                // }

                $(this).parent().parent().next().find('.subtotal').text(parseInt(quantity) * parseInt(price));

                let qty = $(this).parent().find('.quantity').val();
                if (userId) {
                    storeProductQuantity(userId, id, qty);
                }

                getGrandTotalPrice(userId)
            });

            $(document).on('blur', '.quantity', function() {
                let id = $(this).attr('data-id');
                let quantity = $(this).val();
                const userId = $('#viewCartUserId').val();
                productStock(id, (stock) => {
                    if (parseInt(quantity) < parseInt(stock)) {
                        if (parseInt(quantity) < 1) {
                            $(this).val(1);
                            quantity = 1;
                        }
                        let price = $(this).parent().parent().prev().find('.amount').text();
                        let subtotal = $(this).parent().parent().next().find('.subtotal').text(parseInt(
                            quantity) * parseInt(price));
                        let total = $('#totalPrice').text();
                        let subtotal1 = $('.subtotal');
                        let totalAmount = 0;
                        subtotal1.each(function(index, value) {
                            totalAmount = totalAmount + parseInt($(value).text());
                        });
                        $('#totalPrice').text(totalAmount);
                    } else {
                        $(this).val(1);
                    }
                });

                let qty = $(this).val();
                if (userId) {
                    storeProductQuantity(userId, id, qty);
                }

            })

            $(function() {
                $(document).on('click', '.view-cart.btn-close', function() {
                    let subtotal = $(this).parent().parent().parent().find('.subtotal').text();
                    $('#totalPrice').text(parseInt($('#totalPrice').text()) - parseInt(subtotal));
                    const cartCount = $('.cart-count');
                    const product_id = $(this).attr('data-id');
                    const userId = $('#userId').val();
                    console.log("deleted: " + product_id, userId)
                    let localItems = JSON.parse(localStorage.getItem('items'));
                    const filtered = localItems.filter(item => item.id != product_id);
                    localStorage.setItem('items', JSON.stringify(filtered));
                    $(this).parent().parent().parent().remove();
                    $(cartCount).text(parseInt($(cartCount[0]).text()) - 1);
                    if (userId !== '') {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'DELETE',
                            url: `/${userId}/${product_id}/deleteCartItem`,
                            success: (data) => {
                                toastr.options = {
                                    "timeOut": "3000",
                                    "closeButton": true,
                                };
                                toastr['success']('Successfully Removed Cart');
                            },
                            error: (error) => {
                                console.log(error)
                            }
                        })
                    } else {
                        toastr.options = {
                            "timeOut": "3000",
                            "closeButton": true,
                        };
                        toastr['success']('Successfully Removed Cart');
                    }

                });
            });

            function productStock(id, quantity) {
                $.ajax({
                    type: 'GET',
                    url: `/${id}/product-quantity`,
                    success: (data) => {
                        quantity(data);
                    },
                    error: (error) => {
                        console.log(error)
                    }
                });
            }

            function getGrandTotalPrice(userId) {
                $.ajax({
                    type: 'GET',
                    url: `/${userId}/get-grand-total-price`,
                    success: (data) => {
                        
                        $('#totalPrice').text(data);
                        console.log('=============')
                    },
                    error: (error) => {
                        console.log(error)
                    }
                });
            }


            function storeProductQuantity(userId, cartId, qty) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: `/${userId}/${cartId}/storeQuantity`,
                    data: {
                        quantity: qty
                    },
                    success: (data) => {
                        console.log(data);
                    },
                    error: (error) => {
                        console.log(error);
                    }
                })
            }

            $(document).on('click', '#btn-checkout', function(e) {
                let userId = $('#userId').val();
                if (!userId) {
                    e.preventDefault();
                    toastr.options = {
                        "timeOut": "3000",
                        "closeButton": true,
                    };
                    toastr['error']('You have to login first!!!');
                }
            });
        </script>
    <?php else: ?>
        <script !src="">
            $(document).on('click', '.quantity-plus', function() {
                let id = $(this).attr('data-id');
                let a = $(this).parent().find('.quantity').val();

                const userId = $('#viewCartUserId').val();

                productStock(id, (stock) => {

                    if (parseInt(a) < parseInt(stock)) {
                        $(this).parent().find('.quantity').val(parseInt(a) + 1);

                        let quantity = parseInt($(this).parent().find('.quantity').val());

                        // let price = $(this).parent().parent().prev().find('.amount').text();

                        let price = parseInt($('#product-price-' + id).text());


                        let subtotal = quantity * price;



                        // let subtotal = $(this).parent().parent().next().find('.subtotal').text(parseInt(quantity) * parseInt(price));

                        $('#product-subtotal-' + id).text(subtotal);



                        let total = $('#totalPrice').text();

                        $('#totalPrice').text(parseInt(total) + parseInt(price));

                        let qty = $(this).parent().find('.quantity').val();
                        if (userId) {
                            storeProductQuantity(userId, id, qty);
                        }
                    } else {
                        $(this).attr('disabled', true);
                    }

                });
            });

            $(document).on('click', '.quantity-minus', function() {
                const userId = $('#viewCartUserId').val();
                let id = $(this).attr('data-id');
                $('.quantity-plus').attr('disabled', false);
                let a = $(this).parent().find('.quantity').val();
                if (parseInt(a) > 1) {
                    $(this).parent().find('.quantity').val(parseInt(a) - 1);
                }
                let quantity = $(this).parent().find('.quantity').val();
                let price = $(this).parent().parent().prev().find('.amount').text();
                let subtotal = $(this).parent().parent().next().find('.subtotal').text();

                let total = $('#totalPrice').text();
                if (parseInt(subtotal) > parseInt(price)) {
                    $('#totalPrice').text(parseInt(total) - parseInt(price));
                }

                $(this).parent().parent().next().find('.subtotal').text(parseInt(quantity) * parseInt(price));

                let qty = $(this).parent().find('.quantity').val();
                if (userId) {
                    storeProductQuantity(userId, id, qty);
                }

            });

            $(document).on('blur', '.quantity', function() {
                let id = $(this).attr('data-id');
                let quantity = $(this).val();
                const userId = $('#viewCartUserId').val();
                productStock(id, (stock) => {
                    if (parseInt(quantity) < parseInt(stock)) {
                        if (parseInt(quantity) < 1) {
                            $(this).val(1);
                            quantity = 1;
                        }
                        let price = $(this).parent().parent().prev().find('.amount').text();
                        let subtotal = $(this).parent().parent().next().find('.subtotal').text(parseInt(
                            quantity) * parseInt(price));
                        let total = $('#totalPrice').text();
                        let subtotal1 = $('.subtotal');
                        let totalAmount = 0;
                        subtotal1.each(function(index, value) {
                            totalAmount = totalAmount + parseInt($(value).text());
                        });
                        $('#totalPrice').text(totalAmount);
                    } else {
                        $(this).val(1);
                    }
                });

                let qty = $(this).val();
                if (userId) {
                    storeProductQuantity(userId, id, qty);
                }

            })

            $(function() {
                $(document).on('click', '.view-cart.btn-close', function() {
                    let subtotal = $(this).parent().parent().parent().find('.subtotal').text();
                    $('#totalPrice').text(parseInt($('#totalPrice').text()) - parseInt(subtotal));
                    const cartCount = $('.cart-count');
                    const product_id = $(this).attr('data-id');
                    const userId = $('#userId').val();
                    console.log(product_id, userId)
                    let localItems = JSON.parse(localStorage.getItem('items'));
                    const filtered = localItems.filter(item => item.id != product_id);
                    localStorage.setItem('items', JSON.stringify(filtered));
                    $(this).parent().parent().parent().remove();
                    $(cartCount).text(parseInt($(cartCount[0]).text()) - 1);
                    if (userId !== '') {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'DELETE',
                            url: `/${userId}/${product_id}/deleteCartItem`,
                            success: (data) => {
                                toastr.options = {
                                    "timeOut": "3000",
                                    "closeButton": true,
                                };
                                toastr['success']('Successfully Removed Cart');
                            },
                            error: (error) => {
                                console.log(error)
                            }
                        })
                    } else {
                        toastr.options = {
                            "timeOut": "3000",
                            "closeButton": true,
                        };
                        toastr['success']('Successfully Removed Cart');
                    }

                });
            });

            function productStock(id, quantity) {
                $.ajax({
                    type: 'GET',
                    url: `/${id}/product-quantity`,
                    success: (data) => {
                        quantity(data);
                    },
                    error: (error) => {
                        console.log(error)
                    }
                });
            }


            function storeProductQuantity(userId, cartId, qty) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: `/${userId}/${cartId}/storeQuantity`,
                    data: {
                        quantity: qty
                    },
                    success: (data) => {
                        console.log(data);
                    },
                    error: (error) => {
                        console.log(error);
                    }
                })
            }

            $(document).on('click', '#btn-checkout', function(e) {
                let userId = $('#userId').val();
                if (!userId) {
                    e.preventDefault();
                    toastr.options = {
                        "timeOut": "3000",
                        "closeButton": true,
                    };
                    toastr['error']('You have to login first!!!');
                }
            });
        </script>
    <?php endif; ?>

    <script>
        $(".alert:not(.not_hide)").delay(5000).slideUp(500, function() {
            $(this).alert('close');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/frontend/viewcart.blade.php ENDPATH**/ ?>