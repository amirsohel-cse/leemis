
$(document).ready(function(){
    var resend = null;
    var timeout = null;
    var reg_resend = null;
    var reg_timeout = null;
    
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
    $('#token').on('change', function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#token').val()
            }
        });
    });

      // submit reg form using submit button
      $('#register').on('click', function (event) {
        event.preventDefault();
        if(!$('#checkbox').is(':checked')){
            $('#checkbox_feedback').removeClass('invalid-feedback');
            $('#checkbox_feedback').text('You must check terms and conditions');

            return false;
        }
        // console.log($('#registerForm').serialize())
        $.ajax({
            url: "send_otp",
            type:'POST',
            data : $('#registerForm').serialize(),
            dataType : "json",
        }).done(function (response) {
            // code sent successfully
            if(response.response.code_sent){
                $('#code_sent').text(response.response.code_sent);
                $('#code_invalid').text(null);
            }else {
                $('#code_sent').text(null);
            }

            clearInterval(reg_resend);
            clearTimeout(reg_timeout);

            $('#fp_verify').hide();
            $('#verify').show();
            $('#fp_resend').hide();
            $('#resend').show();
            $('#otp-modal').modal({  backdrop: 'static'});
            $('#otp-modal').modal('show');

            $('#reg_name').removeClass('is-invalid');
            $('#reg_name_error').text(null);
            $('#reg_name_error').hide();
            $('#reg_phone').removeClass('is-invalid');
            $('#reg_phone_error').text(null);
            $('#reg_phone_error').hide();
            $('#reg_email').removeClass('is-invalid');
            $('#reg_email_error').text(null);
            $('#reg_email_error').hide();
            $('#reg_shop_name').removeClass('is-invalid');
            $('#reg_shop_name_error').text(null);
            $('#reg_shop_name_error').hide();
            $('#reg_address').removeClass('is-invalid');
            $('#reg_address_error').text(null);
            $('#reg_address_error').hide();
            $('#reg_password').removeClass('is-invalid');
            $('#reg_password_error').text(null);
            $('#reg_password_error').hide();
            $('#sending_error').text(null);
            $('#sending_error').parent().hide();

            // disable resend btn
            // timer in resend btn
            $('#resend').prop("disabled",true);
            var i = 60;
            reg_resend = setInterval(function() {
                $('.reg_timer').text(`in ${--i} sec`)
            },1000);
            // enable resend btn
            reg_timeout = setTimeout(function(){ $('#resend').prop("disabled",false); 
                clearInterval(reg_resend);
                $('.reg_timer').text(null);
                $('#reg_sending_error').text(null);
                $('#reg_sending_error').parent().parent().hide();
            }, 60000);

        }).fail(function (error) {
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

            // validation error
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

            if(error.responseJSON.error.email && error.responseJSON.error.email.length > 0){

                $('#reg_email').addClass('is-invalid');
                $('#reg_email').css({ 'margin-bottom' : '0' });
                $('#reg_email_error').text(error.responseJSON.error.email['0']);
                $('#reg_email_error').show();
            }
            else {
                $('#reg_email').removeClass('is-invalid');
                $('#reg_email_error').text(null);
                $('#reg_email_error').hide();
            }

            if(error.responseJSON.error.shop_name && error.responseJSON.error.shop_name.length > 0){

                $('#reg_shop_name').addClass('is-invalid');
                $('#reg_shop_name').css({ 'margin-bottom' : '0' });
                $('#reg_shop_name_error').text(error.responseJSON.error.shop_name['0']);
                $('#reg_shop_name_error').show();
            }
            else {
                $('#reg_shop_name').removeClass('is-invalid');
                $('#reg_shop_name_error').text(null);
                $('#reg_shop_name_error').hide();
            }
            if(error.responseJSON.error.address && error.responseJSON.error.address.length > 0){

                $('#reg_address').addClass('is-invalid');
                $('#reg_address').css({ 'margin-bottom' : '0' });
                $('#reg_address_error').text(error.responseJSON.error.address['0']);
                $('#reg_address_error').show();
            }
            else {
                $('#reg_address').removeClass('is-invalid');
                $('#reg_address_error').text(null);
                $('#reg_address_error').hide();
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
                $('#reg_sending_error').text("Try another request ");
                $('#reg_sending_error').parent().parent().show();
            }
            else{
                $('#reg_sending_error').text(null);
                $('#reg_sending_error').parent().parent().hide();
            }
        });
    });

    $('#verify').on('click', function (event) {
        $.ajax({
            url: "mobile_verification",
            type:'POST',
            dataType : "json",
            data: $('#code').serialize(),
        }).done(function (response) {
            console.log(response);
            // if registered and logged in
            // if(response.response.intended){
            //     window.location.assign(response.response.intended);
            // }
            // registration msg
            $('#reg_successful').text(response.response.reg_successful);
            $('#reg_successful').parent().show();
            $('#sending_error').text(null);
            $('#sending_error').parent().hide();
            $('#otp-modal').modal('hide');
            // open login tab
            $('#sign-in-tab-a').trigger('click');

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

            // code sent successfully
            if(response.response.code_sent){
                $('#code_sent').text(response.response.code_sent);
                $('#code_invalid').text(null);
            }else {
                $('#code_sent').text(null);
            }

            clearInterval(resend);
            clearTimeout(timeout);

            $('#fp-modal').modal('hide');
            $('#verify').hide();
            $('#fp_verify').show();
            $('#fp_resend').show();
            $('#resend').hide();
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
                $('.timer').text(`after ${--i} sec`);
            },1000);
            // enable fp_resend btn
            timeout = setTimeout(function(){ $('#fp_resend').prop("disabled",false); 
                clearInterval(resend);
                $('.timer').text(null);
                $('#fp_sending_error').text(null);
                $('#fp_sending_error').parent().hide();
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
                    $('#fp-form').trigger('submit');
                }).fail(function (error){
                    window.location.reload();
                });
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
            console.log(response);
            //
            $('#reset_successful').text(response.response.reset_successful);
            $('#reset_successful').parent().show();
            $('#reset-modal').modal('hide');
            $('#reg_successful').text(null);
            $('#reg_successful').parent().hide();
            $('#sign-in-tab-a').trigger('click');

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
    $('#resend').on('click', function () {
        // resend registration code
        $('#register').trigger('click');
    });
    $('#fp_resend').on('click', function () {
        // resend forgot pass code
        $('#fp-form').trigger('submit');;
    });
    $('.fp_login_btn').on('click', function (e) {
        e.preventDefault();
        $('#fp-modal').modal('hide');
        // open login tab
        $('#sign-in-tab-a').trigger('click');
    });
});
