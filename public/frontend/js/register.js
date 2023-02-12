$(document).ready(function(){
    var resend = null;
    var timeout = null;

    $('#checkbox').on('change',function(){
        if($(this).is(':checked')){
            $('#checkbox_feedback').addClass('invalid-feedback');
        }
    })
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  
    $('#register').on('click',function (event) {
        event.preventDefault();
        if(!$('#checkbox').is(':checked')){
            $('#checkbox_feedback').removeClass('invalid-feedback');
            $('#checkbox_feedback').text('You must check terms and conditions');

            return false;
        }
      
        $.ajax({
            url: "send_otp",
            type:'POST',
            data : $('#registerForm').serialize(),
            dataType : "json",
        }).done(function (response) {
            // code sent successfully, then open otp modal
            if(response.response.code_sent){
                $('#reg_code_sent').text(response.response.code_sent);
                $('#reg_code_invalid').text(null);
            }else {
                $('#reg_code_sent').text(null);
            }
            clearInterval(resend);
            clearTimeout(timeout);

            // $('#fp_verify').hide();
            // $('#fp_resend').hide();
            $('#reg_verify').show();
            $('#reg_resend').show();
            $('#reg_otp-modal').modal({  backdrop: 'static'});
            $('#reg_otp-modal').modal('show');

            $('#reg_name').removeClass('is-invalid');
            $('#reg_name_error').text(null);
            $('#reg_name_error').hide();
            $('#reg_phone').removeClass('is-invalid');
            $('#reg_phone_error').text(null);
            $('#reg_phone_error').hide();
            $('#reg_password').removeClass('is-invalid');
            $('#reg_password_error').text(null);
            $('#reg_password_error').hide();
            $('#sending_error').text(null);
            $('#sending_error').parent().hide();

            // $('#reg_name').val('');
            // $('#reg_phone').val('');
            // $('#reg_password').val('');
            // $('#reg_password_confirmation').val('');

            // disable resend btn
            // timer in resend btn
            $('#reg_resend').prop("disabled",true);
            var i = 60;
            resend = setInterval(function() {
                $('.reg_timer').text(`in ${--i} sec`)
            },1000);
            // enable resend btn
            timeout = setTimeout(function(){ $('#reg_resend').prop("disabled",false); 
                clearInterval(resend);
                $('.reg_timer').text(null);
                $('#sending_error').text(null);
                $('#sending_error').parent().hide();
            }, 60000);

        }).fail(function (error) {
            console.log(error);
            if(error.responseJSON.message == "CSRF token mismatch."){
                // refresh csrf token
                $.ajax({
                    url: '/csrf-token',
                    type:'GET',
                }).done(function (response) {
                    $('#token').val(response.token).trigger('change');
                    console.log( $('#token').val())
                    $('#register').trigger('click');             
                }).fail(function (error){
                    window.location.reload();                   
                });              
            }

            // validation error showing in the reg form
            if( error.responseJSON.error.name && error.responseJSON.error.name.length > 0){
                $('#reg_name').addClass('is-invalid');
                $('#reg_name').css({ 'margin-bottom' : '0' });
                $('#reg_name_error').text(error.responseJSON.error.name['0']);
                $('#reg_name_error').show();
            }
            else {
                $('#reg_name').removeClass('is-invalid');
                $('#reg_name_error').text(null);
                $('#reg_name_error').hide();
            }

            if(error.responseJSON.error.phone && error.responseJSON.error.phone.length > 0){

                $('#reg_phone').addClass('is-invalid');
                $('#reg_phone').css({ 'margin-bottom' : '0' });
                $('#reg_phone_error').text(error.responseJSON.error.phone['0']);
                $('#reg_phone_error').show();
            }
            else {
                $('#reg_phone').removeClass('is-invalid');
                $('#reg_phone_error').text(null);
                $('#reg_phone_error').hide();
            }

            if(error.responseJSON.error.password && error.responseJSON.error.password.length > 0){
                $('#reg_password').addClass('is-invalid');
                $('#reg_password').css({ 'margin-bottom' : '0' });
                $('#reg_password_error').text(error.responseJSON.error.password['0']);
                $('#reg_password_error').show();
            }
            else {
                $('#reg_password').removeClass('is-invalid');
                $('#reg_password_error').text(null);
                $('#reg_password_error').hide();
            }

            // verification code sending error
            if(error.responseJSON.error.sending_error){
                $('#sending_error').text(error.responseJSON.error.sending_error);
                $('#sending_error').parent().show();
            }
            else{
                $('#sending_error').text(null);
                $('#sending_error').parent().hide();
            }

            // frequent request error
            if(error.responseJSON.error.frequent_req){
                $('#sending_error').text("Try another request ");
                $('#sending_error').parent().show();
            }
            else{
                $('#sending_error').text(null);
                $('#sending_error').parent().hide();
            }
        });
    });

    $('#reg_verify').on('click', function (event) {
        $.ajax({
            url: "mobile_verification",
            type:'POST',
            dataType : "json",
            data: $('#reg_code').serialize(),
        }).done(function (response) {
            if(response.response.reg_successful){
                // registration msg show if cant login
                $('#reg_successful').text(response.response.reg_successful);
                $('#reg_successful').parent().show();
                $('#LoginModal').modal('show');
            }
            // if registered and logged in
            // if(response.response.intended){
            //     window.location.assign(response.response.intended);
            // }
            if(response.response.route){
                window.location.assign(response.response.route);
            }
            
            $('#sending_error').text(null);
            $('#sending_error').parent().hide();
            $('#otp-modal').modal('hide');
            // $('#login').click();
            // $('#login').trigger('click');

        }).fail(function (error) {
            console.log(error);
            if(error.responseJSON.message == "CSRF token mismatch."){
                // refresh csrf token
                $.ajax({
                    url: '/csrf-token',
                    type:'GET',
                }).done(function (response) {
                    $('#token').val(response.token).trigger('change');
                    console.log( $('#token').val())
                    $('#reg_verify').trigger('click');             
                }).fail(function (error){
                    window.location.reload();                   
                });              
            }
            
            // if code invalid
            if(error.responseJSON.error.code_invalid){
                $('#reg_code_invalid').text(error.responseJSON.error.code_invalid);
                $('#reg_code_sent').text(null);
            }else {
                $('#reg_code_invalid').text(null);
            }
            // registration error
            if(error.responseJSON.error.reg_error){
                $('#sending_error').text(error.responseJSON.error.reg_error);
                $('#sending_error').parent().show();
                // $('#reg_successful').text(null);
                // $('#reg_successful').parent().hide();
                $('#otp-modal').modal('hide');
            }
        });
    });
    // ===============================================
    $('#reg_resend').on('click', function (e) {
        e.preventDefault();
        // submit reg form using submit button
        $('#register').trigger('click');
    });
});