<!doctype html>
<html lang="en">

<head>
<title>Yuu Solution | Login</title>
<?php
$data=\App\Model\Favicon::first();
?>
@if($data)
    <link rel="icon" type="image/png" href="\storage\storeFavicon\{{$data->file}}">
@else
    <link rel="icon" type="image/png" href="\storage\storeFavicon\common.png">
@endif
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Mooli Bootstrap 4x admin is super flexible, powerful, clean &amp; modern responsive admin dashboard with unlimited possibilities.">
<meta name="author" content="GetBootstrap, design by: puffintheme.com">

<!-- VENDOR CSS -->
<link rel="stylesheet" href="{{asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/vendor/animate-css/vivify.min.css')}}">

<!-- MAIN CSS -->
<link rel="stylesheet" href="{{asset('backend/assets/css/mooli.min.css')}}">

</head>

<body>

<div id="body" class="theme-cyan">

    <div class="auth-main">
        <div class="auth_div vivify fadeIn">
            <div class="auth_brand">
                <a class="navbar-brand" href="#"><img src="{{asset('backend/assets/images/icon.svg')}}" width="50" class="d-inline-block align-top mr-2" alt="">Admin</a>
            </div>
            <div class="card">
                <div class="header">

                @if(session()->has('errors'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Your credentials does not match!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                    <p class="lead">Login to your account</p>
                </div>
                <div class="body">
                    <form class="form-auth-small" action="{{ route('admin.login') }}" method="post">
                        @csrf
                        <div class="form-group c_form_group">
                            <label>Email</label>
                            <input name="email" type="email" class="form-control" placeholder="Enter your email address">
                        </div>
                        <div class="form-group c_form_group">
                            <label>Password</label>
                            <input name="password" type="password" class="form-control" placeholder="Enter your password">
                        </div>
                        <div class="form-group clearfix">
                            <label class="fancy-checkbox element-left">
                                <input type="checkbox">
                                <span>Remember me</span>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-dark btn-lg btn-block">LOGIN</button>

                        {{-- <div class="bottom">
                            <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="page-forgot-password.html">Forgot password?</a></span>
                            <span>Don't have an account? <a href="page-register.html">Register</a></span>
                        </div> --}}

                    </form>
                </div>
            </div>
        </div>
        <div class="animate_lines">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </div>

</div>

<script src="{{asset('backend/assets/bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('backend/assets/bundles/vendorscripts.bundle.js')}}"></script>

<!-- Vedor js file and create bundle with grunt  -->
<script>
    $('.choose-skin li').on('click', function() {
	    var $body = $('body');
	    var $this = $(this);

	    var existTheme = $('.choose-skin li.active').data('theme');

	    $('.choose-skin li').removeClass('active');
	    $body.removeClass('theme-' + existTheme);
	    $this.addClass('active');
	    var newTheme = $('.choose-skin li.active').data('theme');
	    $body.addClass('theme-' + $this.data('theme'));
	});

	// Theme Setting
	$('.themesetting .theme_btn').on('click', function() {
		$('.themesetting').toggleClass('open');
	});
	// dark version
    $(".dark_mode input").on('change',function() {
        if(this.checked) {
            $("body").addClass('dark_active');
        }else{
            $("body").removeClass('dark_active');
        }
	});
</script>
</body>
</html>
