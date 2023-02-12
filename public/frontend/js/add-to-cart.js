
function updateDrawCart() {
    $.ajax({
        method: "GET",
        url: `/${$('#userId').val()}/cartData`,
        success: function (response) {

            $('#cart_draw').html(response)

        }
    })
}

function updateCounter() {
    $.ajax({
        method: "GET",
        url: `/${$('#userId').val()}/cartData/counter`,
        success: function (response) {

            $('#cart .header-count-top').text(response)

        }
    })
}


$(document).on('click', '.btn-cart', function () {


    let userId = $('#userId').val();

    let id = $(this).data('id');

    let additional_price = $(this).data('additional_price');

    let attributes = $(this).data('specification');

    let qtyofOrder = $('.quantity').val() == undefined ? 1 : parseInt($('.quantity').val());

    if (userId == '') {

        toastr.options = {
            "timeOut": "3000",
            "closeButton": true,
        };
        toastr['error']('You have to login first');
        window.location.href = "/login";
        return false;
    }


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        url: '/' + id + '/saveCart',
        data: {
            user_id: userId,
            product_id: id,
            qty: qtyofOrder,
            attributes: attributes,
            additional_price: additional_price
        },
        success: (data) => {

        },
        error: (error) => console.log(error)
    });


    updateDrawCart();

    updateCounter()


});


$(document).on('click', '.cart-item-delete', function () {


    const cart = $(this).data('id');
    const userId = $('#userId').val();


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'DELETE',
        url: '/deleteCartItem/cart',
        data: {
            cart: cart,
            user_id: userId
        },
        success: (data) => {
            toastr.options = {
                "timeOut": "3000",
                "closeButton": true,
            };
            toastr['success']('Successfully Removed Cart');

            window.location.reload();
        },
        error: (error) => {

        }
    })


    updateDrawCart()
})

