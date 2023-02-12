// Track Order
$(document).ready(function () {
    $(document).on('submit','#track_form',function (e) {
        $('#order_status').hide();
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/trackOrder',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
              
                if(data && data.status)
                {
                    $('#order_status').html('Your order is ' +data.status);
                    $('#order_status').show();
                    $('#order_status').removeClass('alert-warning').addClass('alert-success');
                }
                else{
                    $('#order_status').html('Your order is invalid');
                    $('#order_status').show();
                    $('#order_status').removeClass('alert-success').addClass('alert-danger');
                }
                //$('#oid').val('');

                 $("#trackXCloseBtn").click(function(){
                    $('#order_status').hide();
                    $('#oid').val('');
                });
                $("#trackCloseBtn").click(function(){
                    $('#order_status').hide();
                    $('#oid').val('');
                });
            },
            error: function (error) {
                alert("something wrong")
                console.log(error);
            }
        })
    });
});