$(function () {
    
    
     function updateDrawCart(){
        $.ajax({
            method:"GET",
            url: `/${$('#userId').val()}/cartData`,
            success:function(response){

                $('#cart_draw').html(response)

            }
        })
    }
    
    
    $('.increment_qty').each(function (index) {
        $(this).on('click', function () {
            let qty = parseInt($(this).parent().find('.cart_qty').val()) + 1;
            let cart = $(this).data('cart')

            $(this).parent().find('.cart_qty').val(qty)


            updateCart(cart, qty, index)

            updateDrawCart()
        })
    })


    $('.decrement_qty').each(function (index) {

        $(this).on('click', function () {
            let qty = parseInt($(this).parent().find('.cart_qty').val()) - 1;


            let cart = $(this).data('cart')

            if (qty <= 0) {
                return
            }

            $(this).parent().find('.cart_qty').val(qty)


            updateCart(cart, qty, index)
            
            updateDrawCart()

        })
    })


    $('.cart_delete').on('click', function () {
        let cart = $(this).data('cart')

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'DELETE',
            url: 'deleteCartItem/cart',
            data: {
                cart: cart,
                user_id: $('#userId').val()
            },
            success: (data) => {


                toastr.options = {
                    "timeOut": "3000",
                    "closeButton": true,
                };
                toastr['success']('Cart Deleted');
                window.location.href = '/viewcart'
                return false;
            },
            error: (error) => console.log(error)
        });
        
        
        updateDrawCart()

    })


    $('.btn-clear').on('click', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'DELETE',
            url: '/deleteAllCartItem',
            data: {
                user_id: $('#userId').val()
            },
            success: (data) => {


                toastr.options = {
                    "timeOut": "3000",
                    "closeButton": true,
                };
                toastr['success']('Cart Deleted');
                window.location.href = '/viewcart'
                return false;
            },
            error: (error) => console.log(error)
        });
        
        
        updateDrawCart()
    })





    function updateCart(cart, qty, index) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/cart-update',
            data: {
                cart: cart,
                qty: qty,
                user_id: $('#userId').val()
            },
            success: (data) => {

                $('.subtotal').eq(index).text(data[0].subtotal)
                $('#totalPrice').text(data[1])

                toastr.options = {
                    "timeOut": "3000",
                    "closeButton": true,
                };
                toastr['success']('Cart Updateed');
                return false;
            },
            error: (error) => console.log(error)
        });
    }





})