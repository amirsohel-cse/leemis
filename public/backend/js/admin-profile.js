
// var tableRow = '';
// $(document).ready(function () {
//     $(document).on('click','.editBtn',function () {
//         const id = $(this).attr('data-id');
//         tableRow = $(this).parent().parent();
//         $('#admin-id').val(id);

//         $.ajax({
//             type: 'GET',
//             url: `/admin/admin/${id}/edit`,
//             success: (data) => {
//                 $('#edit-name').val(data.name);
//                 $('#edit-email').val(data.email);
//                 $('#edit-phone').val(data.phone);
//                 if(data.image){
//                     $('#oldPhoto').attr('hidden',false);
//                     $('#oldPhoto').attr('src',`../../uploads/admins/${data.image}`);
//                 }
//                 $('.dropify-clear').trigger('click');
//             },
//             error: (error) => {
//                 console.log(error);
//             }
//         })
//     });
// });

//Update admin Ajax
$(document).ready(function () {
    $(document).on('submit','#edit-admin-form',function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: `/admin/profile/update`,
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data)
                $('#edit-name').val(data.name);
                $('#edit-email').val(data.email);
                $('#edit-phone').val(data.phone);
                $('#edit-password').val('');
                $('#edit-password_confirmation').val('');
                // $('.edit-image').val('');
                $('.edit-photo').val('');
                $('.dropify-clear').trigger('click');
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                // if image uploaded
                if(data.image){
                    $('#oldPhoto').attr('src',`../../uploads/admins/${data.image}`);
                    $('#oldPhoto').attr('hidden',false);
                // if no image
                }else{
                    $('#oldPhoto').attr('hidden', true);
                }

                toastr['success']('Admin Profile Successfully Updated!!!');

                // remove errors
                $('#edit-name').removeClass('is-invalid');
                $('#edit_name_error').text(null);
                $('#edit_name_error').hide();

                $('#edit-email').removeClass('is-invalid');
                $('#edit_email_error').text(null);
                $('#edit_email_error').hide();

                $('#edit-phone').removeClass('is-invalid');
                $('#edit_phone_error').text(null);
                $('#edit_phone_error').hide();

                $('#edit-password').removeClass('is-invalid');
                $('#edit_password_error').text(null);
                $('#edit_password_error').hide();

                $('#edit-image').removeClass('is-invalid');
                $('#edit_image_error').text(null);
                $('#edit_image_error').hide();
            },
            error: function (error) {
                console.log(error);
                // validation error showing in add admin
                if( error.responseJSON.errors.name && error.responseJSON.errors.name.length > 0){
                    $('#edit-name').addClass('is-invalid');
                    $('#edit-name').parent().removeClass('mb-3');
                    $('#edit_name_error').text(error.responseJSON.errors.name['0']);
                    $('#edit_name_error').show();
                }
                else {
                    $('#edit-name').removeClass('is-invalid');
                    $('#edit_name_error').text(null);
                    $('#edit_name_error').hide();
                }

                if( error.responseJSON.errors.email && error.responseJSON.errors.email.length > 0){
                    $('#edit-email').addClass('is-invalid');
                    $('#edit-email').parent().removeClass('mb-3');
                    $('#edit_email_error').text(error.responseJSON.errors.email['0']);
                    $('#edit_email_error').show();
                }
                else {
                    $('#edit-email').removeClass('is-invalid');
                    $('#edit_email_error').text(null);
                    $('#edit_email_error').hide();
                }

                if( error.responseJSON.errors.phone && error.responseJSON.errors.phone.length > 0){
                    $('#edit-phone').addClass('is-invalid');
                    $('#edit-phone').parent().removeClass('mb-3');
                    $('#edit_phone_error').text(error.responseJSON.errors.phone['0']);
                    $('#edit_phone_error').show();
                }
                else {
                    $('#edit-phone').removeClass('is-invalid');
                    $('#edit_phone_error').text(null);
                    $('#edit_phone_error').hide();
                }

                if( error.responseJSON.errors.password && error.responseJSON.errors.password.length > 0){
                    $('#edit-password').addClass('is-invalid');
                    $('#edit-password').parent().removeClass('mb-3');
                    $('#edit_password_error').text(error.responseJSON.errors.password['0']);
                    $('#edit_password_error').show();
                }
                else {
                    $('#edit-password').removeClass('is-invalid');
                    $('#edit_password_error').text(null);
                    $('#edit_password_error').hide();
                }

                if( error.responseJSON.errors.image && error.responseJSON.errors.image.length > 0){
                    $('#edit-image').addClass('is-invalid');
                    $('#edit-image').parent().removeClass('mb-3');
                    $('#edit_image_error').text(error.responseJSON.errors.image['0']);
                    $('#edit_image_error').show();
                }
                else {
                    $('#edit-image').removeClass('is-invalid');
                    $('#edit_image_error').text(null);
                    $('#edit_image_error').hide();
                }
            }
        })
    });
});