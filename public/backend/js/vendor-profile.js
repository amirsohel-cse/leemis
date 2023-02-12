//Update vendor Ajax
$(document).ready(function () {
    $(document).on('submit','#edit-vendor-form',function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: `/vendor/profile/update`,
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
             
   
                $('#edit-shop-name').val(data.shop_name);
                $('#edit-address').val(data.address);
                $('#edit-name').val(data.name);
                $('#edit-email').val(data.email);
                $('#edit-phone').val(data.phone);
                $('#edit-password').val('');
                $('#edit-password_confirmation').val('');
                // $('.edit-image').val('');
                $('.edit-photo').val('');
                $('.edit-shop-photo').val('');
                $('.dropify-clear').trigger('click');
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                // if image uploaded
                if(data.shop_image){
                    $('#oldShopPhoto').attr('src',`../../uploads/vendors/${data.shop_image}`);
                    $('#oldShopPhoto').attr('hidden',false);
                // if no image
                }else{
                    $('#oldShopPhoto').attr('hidden', true);
                }
                if(data.image){
                    $('#oldPhoto').attr('src',`../../uploads/vendors/${data.image}`);
                    $('#oldPhoto').attr('hidden',false);
                // if no image
                }else{
                    $('#oldPhoto').attr('hidden', true);
                }

                toastr['success']('Vendor Profile Successfully Updated!!!');
                  // remove errors
                  $('#edit-shop-name').removeClass('is-invalid');
                  $('#edit_shopname_error').text(null);
                  $('#edit_shopname_error').hide();

                  $('#edit-address').removeClass('is-invalid');
                  $('#address_error').text(null);
                  $('#address_error').hide();
  
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

                  $('#edit-shop-image').removeClass('is-invalid');
                  $('#edit_shopimage_error').text(null);
                  $('#edit_shopimage_error').hide();
               
            },
            error: function (error) {
                if( error.responseJSON.errors.shop_name && error.responseJSON.errors.shop_name.length > 0){
                    $('#edit-shop-name').addClass('is-invalid');
                    $('#edit-shop-name').parent().removeClass('mb-3');
                    $('#edit_shopname_error').text(error.responseJSON.errors.name['0']);
                    $('#edit_shopname_error').show();
                }
                else {
                    $('#edit-shop-name').removeClass('is-invalid');
                    $('#edit_shopname_error').text(null);
                    $('#edit_shopname_error').hide();
                }
                if( error.responseJSON.errors.address && error.responseJSON.errors.address.length > 0){
                    $('#edit-address').addClass('is-invalid');
                    $('#edit-address').parent().removeClass('mb-3');
                    $('#address_error').text(error.responseJSON.errors.name['0']);
                    $('#address_error').show();
                }
                else {
                    $('#edit-name').removeClass('is-invalid');
                    $('#edit_name_error').text(null);
                    $('#edit_name_error').hide();
                }
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
                if( error.responseJSON.errors.shop_image && error.responseJSON.errors.shop_image.length > 0){
                    $('#edit-shop-image').addClass('is-invalid');
                    $('#edit-shop-image').parent().removeClass('mb-3');
                    $('#edit_shopimage_error').text(error.responseJSON.errors.shop_image['0']);
                    $('#edit_shopimage_error').show();
                }
                else {
                    $('#edit-shop-image').removeClass('is-invalid');
                    $('#edit_shopimage_error').text(null);
                    $('#edit_shopimage_error').hide();
                }
               
                console.log(error);
            }
        })
    });
});
