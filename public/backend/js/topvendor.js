//Store minimum witdraw ajax request
$(document).ready(function () {
    $(document).on('click','#add_btn',function (e){
        $.ajax({
            type: 'GET',
            url: '/admin/vendor/top-vendor/details',
            success: (data) => {
                if (data){
                    $('#formAmount').val(data.top_vendor_amount);
                }
            },
            error: (error) => {
                console.log(error)
            }
        })
    });

    $(document).on('submit','#add-withdraw-form',function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/admin/vendor/top-vendor',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                $('#amount').val('');
                $('.closeBtn').click();
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                toastr['success']('Top Vendor Minimum Amount Successfully Stored');
                appendTableRow(data)
               //  $('tbody').html(`
               //  <tr id="data-id" data-id="{{$other->id}}">
               //        <td id="id">${data.id}</td>
               //        <td id="amount">${data.top_vendor_amount}</td>
               // </tr>
               //
               //  `);
            },
            error: function (error) {
               
                if (typeof(error.responseJSON.errors.amount) !== "undefined"){
                    $('.error').text(error.responseJSON.errors.amount[0]);
                }else{
                    $('.error').text('');
                }
                $('.error').text(error.responseJSON.errors.amount[0]);
            }
        })
    });
});


function appendTableRow(data) {
    $('tbody').html(`
        <tr data-id="${data.id}">
            <td>${data.id}</td>
            <td>${data.top_vendor_amount}</td>
        </tr>
    `);

}
