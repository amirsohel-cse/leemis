$(function(){

    $('#account-details-edit').on('click', function(){
        
    });
    $('#cancel').on('click', function(event){
        event.preventDefault();
        $(window).scrollTop(10);
       
    });
});

//Update user
$(function () {
    $(document).on('submit','#account-details-form',function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: `profile/update`,
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data)
                $('#name').val(data.name);
                $('#name2').text(data.name);
                $('#user-email').val(data.email);
                $('#email2').text(data.email);
                $('#phone').val(data.phone);
                $('#phone2').text(data.phone);
                $('#address').val(data.address);
                $('#address2').text(data.address);
                $('#city').val(data.city);
                $('#city2').text(data.city);
                $('#gender').val(data.gender);
                if(data.gender == 1){
                    $('#gender2').text('Male');
                }
                else if(data.gender == 2){
                    $('#gender2').text('Female');
                }
                else if(data.gender == 3){
                    $('#gender2').text('Others');
                }

                $('#password').val('');
                $('#password_confirmation').val('');

                $('.edit-photo').val('');

                // if image uploaded
                if(data.image){
                    $('#oldPhoto').attr('src',`../../uploads/users/${data.image}`);
                    $('#oldPhoto').attr('hidden',false);
                // if no image
                }else{
                    $('#oldPhoto').attr('hidden', true);
                }
                toastr.options = {
                    "timeOut": "3000",
                    "closeButton": true,
                };
                toastr['success']('Profile Successfully Updated!');

                $('#cancel').trigger('click');

                // remove errors
                $('#name').removeClass('is-invalid');
                $('#edit_name_error').text(null);
                $('#edit_name_error').hide();

                $('#user-email').removeClass('is-invalid');
                $('#edit_email_error').text(null);
                $('#edit_email_error').hide();

                $('#phone').removeClass('is-invalid');
                $('#edit_phone_error').text(null);
                $('#edit_phone_error').hide();

                $('#address').removeClass('is-invalid');
                $('#edit_address_error').text(null);
                $('#edit_address_error').hide();

                $('#city').removeClass('is-invalid');
                $('#edit_city_error').text(null);
                $('#edit_city_error').hide();

                $('#gender').removeClass('is-invalid');
                $('#edit_gender_error').text(null);
                $('#edit_gender_error').hide();

                $('#password').removeClass('is-invalid');
                $('#edit_password_error').text(null);
                $('#edit_password_error').hide();

                $('#image').removeClass('is-invalid');
                $('#edit_image_error').text(null);
                $('#edit_image_error').hide();
            },
            error: function (error) {
                console.log(error);
                // validation error showing
                if( error.responseJSON.errors.name && error.responseJSON.errors.name.length > 0){
                    $('#name').addClass('is-invalid');
                    // $('#name').parent().removeClass('mb-3');
                    $('#edit_name_error').text(error.responseJSON.errors.name['0']);
                    $('#edit_name_error').show();
                }
                else {
                    $('#name').removeClass('is-invalid');
                    $('#edit_name_error').text(null);
                    $('#edit_name_error').hide();
                }

                if( error.responseJSON.errors.email && error.responseJSON.errors.email.length > 0){
                    $('#user-email').addClass('is-invalid');
                    $('#user-email').parent().removeClass('mb-6');
                    $('#edit_email_error').text(error.responseJSON.errors.email['0']);
                    $('#edit_email_error').show();
                }
                else {
                    $('#user-email').removeClass('is-invalid');
                    $('#edit_email_error').text(null);
                    $('#edit_email_error').hide();
                }

                if( error.responseJSON.errors.phone && error.responseJSON.errors.phone.length > 0){
                    $('#phone').addClass('is-invalid');
                    $('#phone').parent().removeClass('mb-6');
                    $('#edit_phone_error').text(error.responseJSON.errors.phone['0']);
                    $('#edit_phone_error').show();
                }
                else {
                    $('#phone').removeClass('is-invalid');
                    $('#edit_phone_error').text(null);
                    $('#edit_phone_error').hide();
                }

                if( error.responseJSON.errors.address && error.responseJSON.errors.address.length > 0){
                    $('#address').addClass('is-invalid');
                    $('#address').parent().removeClass('mb-6');
                    $('#edit_address_error').text(error.responseJSON.errors.address['0']);
                    $('#edit_address_error').show();
                }
                else {
                    $('#address').removeClass('is-invalid');
                    $('#edit_address_error').text(null);
                    $('#edit_address_error').hide();
                }

                if( error.responseJSON.errors.city && error.responseJSON.errors.city.length > 0){
                    $('#city').addClass('is-invalid');
                    $('#city').parent().removeClass('mb-6');
                    $('#edit_city_error').text(error.responseJSON.errors.city['0']);
                    $('#edit_city_error').show();
                }
                else {
                    $('#city').removeClass('is-invalid');
                    $('#edit_city_error').text(null);
                    $('#edit_city_error').hide();
                }

                if( error.responseJSON.errors.gender && error.responseJSON.errors.gender.length > 0){
                    $('#gender').addClass('is-invalid');
                    $('#gender').parent().removeClass('mb-6');
                    $('#edit_gender_error').text(error.responseJSON.errors.gender['0']);
                    $('#edit_gender_error').show();
                }
                else {
                    $('#gender').removeClass('is-invalid');
                    $('#edit_gender_error').text(null);
                    $('#edit_gender_error').hide();
                }

                if( error.responseJSON.errors.password && error.responseJSON.errors.password.length > 0){
                    $('#password').addClass('is-invalid');
                    $('#password').parent().removeClass('mb-6');
                    $('#edit_password_error').text(error.responseJSON.errors.password['0']);
                    $('#edit_password_error').show();
                }
                else {
                    $('#password').removeClass('is-invalid');
                    $('#edit_password_error').text(null);
                    $('#edit_password_error').hide();
                }
    
                if( error.responseJSON.errors.image && error.responseJSON.errors.image.length > 0){
                    $('#image').addClass('is-invalid');
                    $('#image').parent().removeClass('mb-6');
                    $('#edit_image_error').text(error.responseJSON.errors.image['0']);
                    $('#edit_image_error').show();
                }
                else {
                    $('#image').removeClass('is-invalid');
                    $('#edit_image_error').text(null);
                    $('#edit_image_error').hide();
                }
            }
        })
    });
});