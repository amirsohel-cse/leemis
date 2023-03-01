@extends('frontend.master.master')
@section('content')

    <head>
        <link rel="stylesheet" type="text/css" href="{{ 'frontend/assets/css/style.min.css' }}">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
                crossorigin="anonymous"></script>
    </head>


    <main class="main cart">
        <input type="text" id="viewCartUserId" value="{{ isset(Auth::user()->id) ? Auth::user()->id : '' }}" hidden>
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li>
                        <h3 class="text-dark">{{ languageChange('Shopping Cart') }}</h3>
                    </li>
                </ul>
            </div>
        </nav>
        @if (Session::get('success'))
            <div class="alert text-white container" style="background: #da1630;">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="page-content">
            <div class="container">
                <div class="row gutter-lg mb-10 align-items-end">
                    <div class="col-lg-12 pr-lg-4 mb-1">
                        <table class="shop-table cart-table">
                            <thead>
                                <tr>
                                    <th class="product-name"><span>{{ languageChange('Product') }}</span></th>
                                    <th>{{ languageChange('Attributes') }}</th>
                                    <th class="product-price"><span>{{ languageChange('Price') }}</span></th>
                                    <th class="product-quantity"><span>{{ languageChange('Quantity') }}</span></th>
                                    <th class="product-subtotal"><span>{{ languageChange('Subtotal') }}</span></th>
                                    <th class="product-subtotal"><span>{{ languageChange('Action') }}</span></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($carts as $cart)
                                  @if($cart->product != null)
                                    <tr>
                                        <td>
                                            <div class="cart-table-item">
                                                <img src="{{asset($cart->product->photo)}}" alt="">
                                                <p>{{ $cart->product->getTranslation('name') }}</p>
                                            </div>
                                        </td>

                                        <td>
                                            @if($cart->attributes != null)
                                                @foreach ($cart->attributes as $attr)
                                                    <p>{{\App\Model\CategoryAttribute::find($attr['attribute'])->name}} : {{\App\Model\AttributeOption::find($attr['option'])->option}}</p>

                                                @endforeach

                                           @else



                                           @endif
                                        </td>

                                        <td id="">
                                            {{ $cart->product->price }}
                                        </td>

                                        <td>

                                            <div class="cart-update-part">
                                                <button type="button" class="decrement_qty" data-cart="{{$cart->id}}">-</button>
                                                <input type="number" value="{{$cart->qty}}" class="cart_qty">
                                                <button type="button" class="increment_qty" data-cart="{{$cart->id}}">+</button>
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
                                            {{ $cart->subtotal }}
                                        </td>

                                        <td>
                                            <button class="btn btn-sm btn-danger cart_delete" data-cart="{{$cart->id}}"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-9">
                        <div class="cart-action mb-6">
                            <a href="/" class="btn btn-primary btn-rounded btn-icon-left btn-shopping mr-auto"><i
                                    class="w-icon-long-arrow-left"></i>{{ languageChange('Continue Shopping') }}</a>
                            <button type="submit" class="btn  btn-rounded btn-default btn-clear" name="clear_cart"
                                value="Clear Cart">{{ languageChange('Clear Cart') }}</button>
                        </div>
                    </div>
                    <div class="col-lg-3 sticky-sidebar-wrapper">
                        <div class="sticky-sidebar">
                            <hr class="divider mb-6">
                            <div class="order-total d-flex justify-content-between align-items-center">
                                <label>{{ languageChange('Total') }}</label>
                                <span class="ls-50" id="totalPrice">{{ $sum }}</span>
                            </div>
                            <a href="{{ route('checkout') }}"
                                class="btn btn-block btn-primary btn-icon-right btn-rounded  btn-checkout"
                                id="btn-checkout">
                                {{ languageChange('Proceed to checkout') }}<i class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- End of PageContent -->
    </main>

    {{-- Please wait modal --}}
    <div class="modal fade bd-example-modal-sm" id="pleaseWaitModal" tabindex="-1" role="dialog"
        aria-labelledby="pleaseWaitModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content m-0 p-0 text-center"
                style="background-color: transparent !important; border: none !important;">
                <div>
                    <div class="spinner-grow text-primary" role="status">
                        <span class="sr-only">{{ languageChange('Loading') }}...</span>
                    </div>
                    <div class="spinner-grow text-secondary" role="status">
                        <span class="sr-only">{{ languageChange('Loading') }}...</span>
                    </div>
                    <div class="spinner-grow text-success" role="status">
                        <span class="sr-only">{{ languageChange('Loading') }}...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Please wait modal end --}}
    <script src="{{ asset('frontend/js/view-cart.js') }}"></script>
@endsection

@section('view-cart-script')
    @if (\Illuminate\Support\Facades\Auth::user())
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
    @else
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
    @endif

    <script>
        $(".alert:not(.not_hide)").delay(5000).slideUp(500, function() {
            $(this).alert('close');
        });
    </script>
@endsection
