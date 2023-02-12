
<?php $__env->startSection('content'); ?>

    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo e('frontend/assets/css/style.min.css'); ?>">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>

    </head>

    <main class="mains checkouts">
        <nav class="breadcrumb-navs">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li class="passed"><a href="<?php echo e(route('view.cart')); ?>"><?php echo e(languageChange('Shopping Cart')); ?></a></li>
                    <li class="active"><a href="#"><?php echo e(languageChange('checkouts')); ?></a></li>
                </ul>
            </div>
        </nav>

        <div class="page-content">
            <div class="container">

                <div class="row mb-5">
                    <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                        <?php echo e(languageChange('Billing Details')); ?>

                    </h3>
                    <?php if(auth()->user()->my_place == null): ?>
                        <div class="col-lg-4 col-sm-6">
                            <button aria-label="Add a new address" class="addNewAddress" data-toggle="modal"
                                data-target="#locationModal"> <i class="fa fa-plus"></i> Add a new address</button>
                        </div>
                    <?php else: ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="save-address-card">
                                <div class="save-address-header">
                                    <h6>Primary Address</h6>
                                    <button class="delete_btn" data-url="<?php echo e(route('delete.my_place', auth()->id())); ?>"><i
                                            class="far fa-trash-alt"></i></button>
                                </div>
                                <div class="save-address-body">
                                    <ul class="save-address-list">
                                        <li>
                                            <span class="caption">Name</span>
                                            <span class="value name"><?php echo e(auth()->user()->name); ?></span>
                                        </li>
                                        <li>
                                            <span class="caption">Address</span>
                                            <span class="value"><?php echo e(auth()->user()->my_place); ?></span>
                                        </li>
                                        <li>
                                            <span class="caption">Phone Number</span>
                                            <span class="value"><?php echo e(auth()->user()->phone); ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mt-md-0 mt-4">
                            <button aria-label="Add a new address" class="addNewAddress" data-toggle="modal"
                                data-target="#locationModal"> <i class="fa fa-plus"></i> Add a new address</button>
                        </div>
                    <?php endif; ?>

                </div>


                <form action="<?php echo e(url('/pay')); ?>" method="POST" class="needs-validation" id="checkout-form">
                    <input type="hidden" value="<?php echo e(csrf_token()); ?>" name="_token" />
                    <div class="row mb-9">
                        <div class="col-lg-7 pr-lg-4 mb-4">
                            <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                                <?php echo e(languageChange('Billing Details')); ?>

                            </h3>
                            <div class="row gutter-sm">

                                <div class="">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark"><?php echo e(languageChange('Name')); ?> *</label>
                                        <input placeholder="Enter your name" value="<?php echo e($users->name); ?>"
                                            style="border: 1px solid gray" type="text" id="customer_name"
                                            class="form-control form-control-md text-dark" name="name" required>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="font-weight-bold text-dark"><?php echo e(languageChange('Street address')); ?> *</label>
                                <input style="border: 1px solid gray" type="text"
                                    placeholder="House number and street name"
                                    class="form-control text-dark form-control-md mb-2" name="address" id="street"
                                    value="<?php echo e($users->address); ?>" required>

                            </div>
                            <div class="row gutter-sm">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark"><?php echo e(languageChange('Town / City')); ?>

                                            *</label>
                                        <input placeholder="Enter city" value="<?php echo e($users->city); ?>"
                                            style="border: 1px solid gray" type="text"
                                            class="form-control text-dark form-control-md" name="city" required
                                            id="city">
                                    </div>
                                  
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(languageChange('Phone')); ?> *</label>
                                        <input style="border: 1px solid gray" type="number"
                                            class="form-control form-control-md" name="phone"
                                            placeholder="Enter Phone Number" required id="phone">
                                        <small id="phoneError" style="color: red"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-7">
                                <label class="font-weight-bold text-dark"><?php echo e(languageChange('Email address')); ?> *</label>
                                <input style="border: 1px solid gray" value="<?php echo e($users->email); ?>"
                                    placeholder="Enter email" type="email"
                                    class="form-control  text-darkform-control-md" name="email" required
                                    id="email">
                            </div>

                            <div class="form-group mt-3">
                                <label
                                    class="font-weight-bold text-dark"for="order-notes"><?php echo e(languageChange('Order notes (optional)')); ?></label>
                                <textarea style="border: 1px solid gray" class="form-control mb-0 text-dark" id="note" name="note"
                                    cols="30" rows="4" placeholder="Notes about your order, e.g special notes for delivery"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-5 mb-4 sticky-sidebar-wrapper">
                            <div class="order-summary-wrapper sticky-sidebar">
                                <h3 class="title text-uppercase ls-10"><?php echo e(languageChange('Your Order')); ?></h3>
                                <div class="order-summary">

                                    <div class="checkout-product-list-wrapper">
                                        <table style="width: 100%" class="order-table">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">
                                                        <b><?php echo e(languageChange('Product')); ?></b>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr class="bb-no">
                                                        <td style="word-wrap: break-word" class="product-name">
                                                            <?php echo e($item->product->name); ?><i class="fas fa-times"></i> <span
                                                                class="product-quantity"><?php echo e($item->qty); ?></span></td>
                                                        <td class="product-total"><?php echo e($item->qty * $item->price); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <p class="text-danger"><?php echo e(languageChange('Product Not Found')); ?></p>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="payment-methods" id="payment_method">
                                    <tfoot>
                                        <ul class="checkout-bottom-list">
                                            <li class="cart-subtotal bb-no">
                                                <span class="caption"><?php echo e(languageChange('Subtotal')); ?></span>
                                                <span class="amount">
                                                    <?php echo e($sum); ?>

                                                    <input type="text" value="<?php echo e($sum); ?>" name="subtotal"
                                                        hidden id="subtotal">
                                                </span>
                                            </li>
                                        </ul>
                                        <div class="shipping-methods">
                                            <h4 class="title title-simple bb-no mb-1 pb-0 pt-3">
                                                <?php echo e(languageChange('Shipping')); ?>

                                            </h4>
                                            <?php $__empty_1 = true; $__currentLoopData = $ship; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <div>
                                                    <input type="radio"
                                                        value="<?php echo e($item->price .'TK '. $item->title); ?>"
                                                        class="ship" id="ship" name="ship">
                                                    <label class="color-dark"><?php echo e($item->title); ?>:
                                                        <?php echo e($item->price); ?></label>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <?php endif; ?>

                                            <ul class="checkout-bottom-list mt-3">
                                                <li class="order-total">
                                                    <span class="caption fs-18px"><?php echo e(languageChange('Total')); ?></span>
                                                    <span class="amount">
                                                        <p id="total" class="fs-18px"></p>
                                                        <input id="t" value="" hidden name="total">
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- <tr class="shipping-methods">
                                            <td colspan="2" class="text-lefts">
                                                
                                                

                                                        </td>
                                                        </tr>
                                                        
                                        </tfoot> -->
                                        <h4 class="title font-weight-bold ls-25 pb-0 mb-1">
                                            <?php echo e(languageChange('Payment Methods')); ?></h4>
                                        <div class="accordion payment-accordion">
                                            <?php if($isOnlinePayment == 0): ?>
                                                <div class="cards">
                                                    <input id="cashOnCheckBox" type="radio" value="cash on" name="payment" checked>
                                                    <label class="color-dark"><?php echo e(languageChange('Cash On Delivery')); ?></label>
                                                </div>
                                                <div class="cards">
                                                    <input id="onlinePayChackBox" type="radio" value="online" name="payment">
                                                    <label class="color-dark"><?php echo e(languageChange('Online Payment')); ?></label>
                                                    <div class="d-flex flex-wrap align-items-center">
                                                        <button hidden type="submit" class="bkash-btn" id="bKash_button" onclick="BkashPayment()">
                                                            <img src="<?php echo e(asset('bkash.png')); ?>" width="60"> Pay with bKash
                                                        </button>

                                                        <button id="sslczPayBtn" class="d-none ssl-btn" token="if you have any token validation" postdata="" endpoint="/pay-via-ajax"><img src="<?php echo e(asset('ssl-pay.png')); ?>" alt="">  Pay with SSLCOMMERZ
                                                        </button>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="cards">
                                                    <div class="d-flex flex-wrap align-items-center">
                                                        <button type="submit" class="btn bkash-btn" id="bKash_button"
                                                            onclick="BkashPayment()">
                                                            <img src="<?php echo e(asset('bkash.png')); ?>" width="60"> Pay with bKash
                                                        </button>

                                                        <button id="sslczPayBtn" class="ssl-btn"  token="if you have any token validation"
                                                            postdata="" endpoint="/pay-via-ajax"> 
                                                            <img src="<?php echo e(asset('ssl-pay.png')); ?>" alt=""> Pay with SSLCOMMERZ
                                                        </button>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                        </div>

                                        <?php
                                            $return = \App\Page::where('status', 1)->get();
                                        ?>

                                        <label for="">
                                            <input type="checkbox" name="accept" id="" required>
                                            <p> agree to the <a href="<?php echo e(route('pages','terms-of-use')); ?>">Terms & Conditions</a>,<a href="<?php echo e(route('pages','privacy-policy')); ?>"> Privacy Policy</a> and <a href="<?php echo e(route('pages','return-refund-policy')); ?>">Return Refund Policy</a></p>
                                        </label>

                                    </div>

                                    <?php if($isOnlinePayment == 0): ?>
                                        <div class="form-group place-order pt-6">

                                            <button type="submit" class="btn btn-primary btn-block btn-rounded"
                                                id="place-orderBtn"><?php echo e(languageChange('Place Order')); ?></button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
        </div>
    </main>

    <div class="modal fade" tabindex="-1" role="dialog" id="deleteMyPlace">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                <?php echo csrf_field(); ?>

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure to delete your address ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <?php $__env->startSection('page-scripts'); ?>
        <script src=" https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script type="text/javascript">
            function BkashPayment() {
                var formData = $("form").serialize();

                let address = $('#street').val()
                let city = $('#city').val()
                let phone = $('#phone').val()
                let email = $('#email').val()



                if (address == '' || city == '' || phone == '' || email == '') {
                    swal('Please fill up all requied Field', "warning");
                    return
                }




                $.ajax({
                    url: "<?php echo e(route('checkoutData')); ?>",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData
                })


                $('pay-with-bkash-button').trigger('click');


            }


            let paymentID = '';
            bKash.init({
                paymentMode: 'checkout',
                paymentRequest: {

                },
                createRequest: function(request) {
                    setTimeout(function() {
                        createPayment(request);
                    }, 2000)
                },

                executeRequestOnAuthorization: function(request) {
                    $.ajax({
                        url: '<?php echo e(route('bkash-execute-payment')); ?>',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        contentType: 'application/json',
                        data: JSON.stringify({
                            "paymentID": paymentID
                        }),
                        success: function(data) {


                            if (data) {
                                if (data.paymentID != null) {
                                    BkashSuccess(data);
                                } else {
                                    showErrorMessage(data);
                                    bKash.execute().onError();
                                }
                            } else {
                                $.get('<?php echo e(route('bkash-query-payment')); ?>', {
                                    payment_info: {
                                        payment_id: paymentID
                                    }
                                }, function(data) {

                                    if (data.transactionStatus === 'Completed') {
                                        BkashSuccess(data);
                                    } else {
                                        createPayment(request);
                                    }
                                });
                            }
                        },
                        error: function(err) {
                            bKash.execute().onError();
                        }
                    });
                },
                onClose: function() {
                    // for error handle after close bKash Popup
                }
            });

            function createPayment(request) {
                // Amount already checked and verified by the controller
                // because of createRequest function finds amount from this request
                request['amount'] = $('#t').val(); // max two decimal points allowed

                $.ajax({
                    url: '<?php echo e(route('bkash-create-payment')); ?>',
                    data: JSON.stringify(request),
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: 'application/json',
                    success: function(data) {

                        if (data && data.paymentID != null) {
                            paymentID = data.paymentID;
                            bKash.create().onSuccess(data);
                        } else {
                            bKash.create().onError();
                        }
                    },
                    error: function(err) {


                        showErrorMessage(err.responseJSON);
                        bKash.create().onError();
                    }
                });
            }

            function BkashSuccess(data) {
                $.post('<?php echo e(route('bkash-success')); ?>', {
                    payment_info: data
                }, function(res) {
                    window.location.href = "<?php echo e(route('orderComplete')); ?>"
                });
            }

            function showErrorMessage(response) {
                let message = 'Unknown Error';

                if (response.hasOwnProperty('errorMessage')) {
                    let errorCode = parseInt(response.errorCode);
                    let bkashErrorCode = [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014,
                        2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030,
                        2031, 2032, 2033, 2034, 2035, 2036, 2037, 2038, 2039, 2040, 2041, 2042, 2043, 2044, 2045, 2046,
                        2047, 2048, 2049, 2050, 2051, 2052, 2053, 2054, 2055, 2056, 2057, 2058, 2059, 2060, 2061, 2062,
                        2063, 2064, 2065, 2066, 2067, 2068, 2069, 503,
                    ];

                    if (bkashErrorCode.includes(errorCode)) {
                        message = response.errorMessage


                        swal(message, "warning");
                    }
                }

                // swal(message, "warning");


            }
        </script>
    <?php $__env->stopSection(); ?>



    <script>
        var obj = {};

        obj.cus_name = $('#customer_name').val();
        obj.cus_phone = $('#phone').val();
        obj.cus_email = $('#email').val();
        obj.cus_addr1 = $('#address').val();
        obj.amount = parseFloat($('#total').text());

        $('#sslczPayBtn').prop('postdata', obj);
    </script>
    <script>
        $(function() {
            $('.delete_btn').on('click', function() {
                const modal = $('#deleteMyPlace');

                modal.find('form').attr('action', $(this).data('url'));


                modal.modal('show');
            })
        })




        $("input:radio").first().click();

        $("input:radio:first").prop("checked:true", function() {
            var amount = parseInt($(this).val()) + parseInt($("#subtotal").val());
            $("#total").text(amount);
            $("#t").val(amount);


        });

        $('.ship').on("change", function() {
            var amount = parseInt($(this).val()) + parseInt($("#subtotal").val());
            $("#total").text(amount);
            $("#t").val(amount);

        });

        $('#place-orderBtn').on('click', function(e) {
            $('#checkout-form').attr('action', "<?php echo e(url('/ordercompelete')); ?>");

        })


        $('#onlinePayChackBox').on('change', function(e) {
            if ($(this).prop('checked') == true) {
                $('#phonenum').attr('hidden', true);
                $('#tranid').attr('hidden', true);
                $('#place-orderBtn').attr('hidden', true);
                $('#bKash_button').attr('hidden', false);
                $('#sslczPayBtn').removeClass('d-none');
            }
        });

        $('#cashOnCheckBox').on('change', function() {
            if ($(this).prop('checked') == true) {
                $('#place-orderBtn').attr('hidden', false);
                $('#phonenum').attr('hidden', false);
                $('#tranid').attr('hidden', false);
                $('#bKash_button').attr('hidden', true);
                $('#sslczPayBtn').addClass('d-none');
            }
        })


        $(document).on('submit', '#checkout-form', function(e) {

            let phone = $('#phone').val();
            let regex = new RegExp(/^(?:\+88|88)?(01[3-9]\d{8})$/);
            if (phone) {
                if (regex.test(phone)) {
                    $('#phoneError').text('');
                } else {
                    e.preventDefault();
                    $('#phoneError').text('Your phone number is invalid!!');
                }
            }

            if (!navigator.onLine) {
                toastr.options = {
                    "timeOut": "3000",
                    "closeButton": true,
                };
                toastr['error']('You are in Offline!!!');
                e.preventDefault();
            }
        })
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\clients-project\hypershop_final\resources\views/frontend/checkout.blade.php ENDPATH**/ ?>