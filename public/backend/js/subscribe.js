$(document).ready(function () {
    $(document).on('submit','#add-sub-form',function (e) {
        e.preventDefault();
        $('#eError').text('');


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/subscribe',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                $('#phone').val('');      
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,
                };
                toastr['success'](data);

            },
            
            error:function(error){
                $('#eError').text(error.responseJSON.errors.phone);
                }
        })
    });
});
