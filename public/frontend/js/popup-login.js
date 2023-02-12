$(document).ready(function(){
    var resend = null;
    var timeout = null;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#token').on('change', function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#token').val()
            }
        });
    });
    
    $('#login').on('click',function (event) {
        event.preventDefault();
        $.ajax({
            url: '/login',
            type:'POST',
            data : $('#customerLogin').serialize(),
            dataType : "json",
        }).done(function (response) {

            if(response.isDisabled){

                $('#isdisabled').removeClass('d-none');

                

                return false;
            }
            window.location.assign(response.route);

        }).fail(function (error){
            
            if(error.responseJSON.message == "CSRF token mismatch."){
                // refresh csrf token and login again
                $.ajax({
                    url: '/csrf-token',
                    type:'GET',
                }).done(function (response) {
                    $('#token').val(response.token).trigger('change');
                    
                    $('#login').trigger('click');                 
                }).fail(function (error){
                    window.location.reload();                   
                });              
            }
            //$('#login_error').text(error.responseJSON.errors.phone['0']);
            if(error.responseJSON.errors.password == undefined){
                $('#login_error').text("You haven’t signup yet or your password was incorrect");
            }else{
                $('#login_error').text(error.responseJSON.errors.password['0']);
            }
            
            $('#login_error').parent().show();

        }).always(function(){ console.log('login')});
    });
    
    $('.close').on('click',function(){
        $(this).parent().css('display','none');
    })
    

    $('#verify').on('click', function (event) {
        $.ajax({
            url: "mobile_verification",
            type:'POST',
            dataType : "json",
            data: $('#code').serialize(),
        }).done(function (response) {
            console.log(response);
            // registration msg
            $('#reg_successful').text(response.response.reg_successful);
            $('#reg_successful').parent().show();
            $('#sending_error').text(null);
            $('#sending_error').parent().hide();
            $('#otp-modal').modal('hide');
            // $('#login').click();
            $('#login').trigger('click');

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
                    $('#verify').trigger('click');             
                }).fail(function (error){
                    window.location.reload();                   
                });              
            }
            // if code invalid
            if(error.responseJSON.error.code_invalid){
                $('#code_invalid').text(error.responseJSON.error.code_invalid);
                $('#code_sent').text(null);
            }else {
                $('#code_invalid').text(null);
            }
            // registration error
            if(error.responseJSON.error.reg_error){
                $('#sending_error').text(error.responseJSON.error.reg_error);
                $('#sending_error').parent().show();
                $('#reg_successful').text(null);
                $('#reg_successful').parent().hide();
                $('#otp-modal').modal('hide');
            }
        });
    });
// ======================================================
    $('.fp').on('click', function(e){
        e.preventDefault();
        $('#LoginModal').modal('hide');
        $('#fp-modal').modal({  backdrop: 'static'});
        $('#fp-modal').modal('show');
    });

    $('#fp-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: 'forgot_password/send_otp',
            type:'POST',
            data : $('#fp-form').serialize(),
            dataType : "json",

        }).done(function (response) {
            clearInterval(resend);
            clearTimeout(timeout);
            // code sent successfully
            if(response.response.code_sent){
                $('#code_sent').text(response.response.code_sent);
                $('#code_invalid').text(null);
            }else {
                $('#code_sent').text(null);
            }
            $('#fp-modal').modal('hide');
            $('#verify').hide();
            $('#resend').hide();
            $('#fp_verify').show();
            $('#fp_resend').show();
            $('#otp-modal').modal({  backdrop: 'static'});
            $('#otp-modal').modal('show');

            $('#fp_phone').removeClass('is-invalid');
            $('#fp_phone_error').text(null);
            $('#fp_phone_error').hide();

            // disable resend btn
            // timer in resend btn
            $('#fp_resend').prop("disabled",true);
            var i = 60;
            resend = setInterval(function() {
                $('.timer').text(`after ${--i} sec`)
            },1000);
            // enable resend btn
            timeout = setTimeout(function(){ $('#fp_resend').prop("disabled",false); 
                clearInterval(resend);
                $('.timer').text(null);
                $('#fp_sending_error').text(null);
                $('#fp_sending_error').parent().hide();
            },60000);

        }).fail(function (error) {
            console.log(error);
            if(error.responseJSON.message == "CSRF token mismatch."){
                window.location.reload();                                
            }
            if(error.responseJSON.error.phone && error.responseJSON.error.phone.length > 0){
                $('#fp_phone').addClass('is-invalid');
                $('#fp_phone').css({ 'margin-bottom' : '0' });
                $('#fp_phone_error').text(error.responseJSON.error.phone['0']);
                $('#fp_phone_error').show();
            }
            else {
                $('#fp_phone').removeClass('is-invalid');
                $('#fp_phone_error').text(null);
                $('#fp_phone_error').hide();
            }

            // verification code sending error
            if(error.responseJSON.error.sending_error){
                $('#fp_sending_error').text(error.responseJSON.error.sending_error);
                $('#fp_sending_error').parent().show();
            }
            else{
                $('#fp_sending_error').text(null);
                $('#fp_sending_error').parent().hide();
            }

            // mobile not found error
            if(error.responseJSON.error.phone_invalid){
                $('#fp_phone_invalid').text(error.responseJSON.error.phone_invalid);
                $('#fp_phone_invalid').parent().show();
            }
            else{
                $('#fp_phone_invalid').text(null);
                $('#fp_phone_invalid').parent().hide();
            }

            // frequent request error
            if(error.responseJSON.error.frequent_req){
                $('#fp_sending_error').text("Try another request ");
                $('#fp_sending_error').parent().show();
            }
            else{
                $('#fp_sending_error').text(null);
                $('#fp_sending_error').parent().hide();
            }
        });
    });

    $('#fp_verify').on('click', function (event) {
        $.ajax({
            url: "forgot_password/verify",
            type:'POST',
            dataType : "json",
            data: $('#code').serialize()

        }).done(function (response) {
            console.log(response);
            $('#reset_uniqid').val(response.response.uniqid);
            $('#otp-modal').modal('hide');
            $('#reset-modal').modal({  backdrop: 'static'});
            $('#reset-modal').modal('show');
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
                    $('#fp_verify').trigger('click');                 
                }).fail(function (error){
                    window.location.reload();                   
                });              
            }

            // if code invalid
            if(error.responseJSON.error.code_invalid){
                $('#code_invalid').text(error.responseJSON.error.code_invalid);
                $('#code_sent').text(null);
            }else {
                $('#code_invalid').text(null);
            }
        });
    });

    $('#reset-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: 'password_reset',
            type:'POST',
            data : $('#reset-form').serialize(),
            dataType : "json",

        }).done(function (response) {
            $('#reset_successful').text(response.response.reset_successful);
            $('#reset_successful').parent().show();
            $('#reset-modal').modal('hide');
            $('#LoginModal').modal('show');
            $('#login').trigger('submit');
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
                    $('#reset-form').trigger('submit');                 
                }).fail(function (error){
                    window.location.reload();                   
                });              
            }
            
            if(error.responseJSON.error.password && error.responseJSON.error.password.length > 0){
                $('#reset_password').addClass('is-invalid');
                $('#reset_password').css({ 'margin-bottom' : '0' });
                $('#reset_password_error').text(error.responseJSON.error.password['0']);
                $('#reset_password_error').show();
            }
            else {
                $('#reset_password').removeClass('is-invalid');
                $('#reset_password_error').text(null);
                $('#reset_password_error').hide();
            }

            // mobile not found error
            if(error.responseJSON.error.phone_invalid){
                $('#reset_error').text(error.responseJSON.error.phone_invalid);
                $('#reset_error').parent().show();
            }
            else{
                $('#reset_error').text(null);
                $('#reset_error').parent().hide();
            }

        });
    });
    // ===============================================
    $('#fp_resend').on('click', function () {
        $('#fp-form').trigger('submit');
    });
    $('#fp_login_btn').on('click', function (e) {
        e.preventDefault();
        $('#LoginModal').modal('show');
        $('#fp-modal').modal('hide');
    });
});