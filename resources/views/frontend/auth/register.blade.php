@extends('frontend.master.master')
@section('content')
    <style>
        .login-popup.registration {
            margin: auto;
        }

        .page-title {
            text-align: center;
        }

        #m-log {
            display: none;
        }

        .login-popup.registration .form-group {
            margin-bottom: 0;
        }

        .login-popup.registration .tab-pane {
            padding-top: 0;
        }

        .tacbox {
            display: block;
            padding: 0em;
            margin: 0em;
            background-color: #fff;
            max-width: 800px;
        }

        #checkbox {
            height: 1em;
            width: 1em;
            vertical-align: middle;
        }

        @media (max-width: 575.98px) {
            #m-pic {
                display: none;
            }

            #m-log {
                display: block;
            }
        }
    </style>

    <!-- Start of Main -->
    <main class="main login-page">
        <!-- Start of Page Header -->


        <div class="page-content">
            <div class="container p-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="account-wrapper">
                            <div class="left"
                                style="background-image: url('https://hyper.springsoftit.com/public/frontend/images/login.jpg')">
                                <div class="account-content">
                                    <h3 class="account-title">{{ languageChange('Create your Account') }}</h3>
                                    <p><span class="font-size-md"> Already have an account? </span> <a
                                            class="mb-4 text-primary font-size-md" href="{{ route('customer.login') }}">
                                            Login </a></p>
                                </div>
                            </div>
                            {{-- <div class="right">
                            <form  method="post" id="registerForm" >
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold text-dark">Your Name *</label>
                                    <input placeholder="Enter your name" id="reg_name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                    <strong><span id="reg_name_error" class="invalid-feedback" role="alert">
                                    </span> </strong>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold text-dark">Mobile No. *</label>
                                    <input placeholder="Enter mobile no" type="text" id="reg_phone" class="form-control" name="phone"  value="{{ old('phone') }}" required>
                                    <strong><span id="reg_phone_error" class="invalid-feedback" role="alert">
                                    </span> </strong>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold text-dark">Password *</label>

                                    <div class="password-field">
                                        <input type="password" id="reg_password" class="form-control" name="password"  value="{{ old('password') }}" placeholder="Minimum 8 characters" required>
                                        <button type="button" class="password-toggle">
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </div>

                                    <strong><span id="reg_password_error" class="invalid-feedback" role="alert">
                                    </span> </strong>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold text-dark">Password Confirmation *</label>

                                    <div class="password-field">
                                        <input type="password" id="reg_password_confirmation" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required>
                                        <button type="button" class="password-toggle">
                                        <i class="far fa-eye"></i>
                                        </button>
                                    </div>

                                </div>
                                <div class="tacbox bg-transparent">
                                    <input id="checkbox" type="checkbox" />
                                    <label for="checkbox"> I agree to these <a href="{{route('terms')}}">Terms and Conditions</a>.</label>
                                    <strong><span id="checkbox_feedback" class="invalid-feedback text-danger" role="alert">
                                    </span> </strong>
                                </div>
                                <a id="register" href="#" type="submit" class="btn btn-primary my-4">Sign Up</a>
                                 <span id="m-log" class="font-size-md"> Already have an account?  <a class="mb-4 text-primary font-size-md" href="{{ route('customer.login') }}"> Login </a></span>
                                <!-- already have account -->
                                <!-- <span class="font-size-md"> Already have an account? </span> <a class="mb-4 text-primary font-size-md" href="{{ route('customer.login') }}"> Login </a> -->
                            </form>
                        </div> --}}

                            <div class="right">
                                <form method="post" id="registerForm">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold text-dark">Your Name *</label>
                                        <input placeholder="Enter your name" id="reg_name" type="text"
                                            class="form-control" name="name" value="{{ old('name') }}" required>
                                        <strong><span id="reg_name_error" class="invalid-feedback" role="alert">
                                            </span> </strong>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold text-dark">Mobile No. *</label>
                                        <input placeholder="Enter mobile no" type="text" id="reg_phone"
                                            class="form-control" name="phone" value="{{ old('phone') }}" required>
                                        <strong><span id="reg_phone_error" class="invalid-feedback" role="alert">
                                            </span> </strong>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold text-dark">Password *</label>

                                        <div class="password-field">
                                            <input type="password" id="reg_password" class="form-control" name="password"
                                                value="{{ old('password') }}" placeholder="Minimum 8 characters" required>
                                            <button type="button" class="password-toggle">
                                                <i class="far fa-eye"></i>
                                            </button>
                                        </div>

                                        <strong><span id="reg_password_error" class="invalid-feedback" role="alert">
                                            </span> </strong>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold text-dark">Password Confirmation *</label>

                                        <div class="password-field">
                                            <input type="password" id="reg_password_confirmation" class="form-control"
                                                name="password_confirmation" value="{{ old('password_confirmation') }}"
                                                placeholder="Confirm Password" required>
                                            <button type="button" class="password-toggle">
                                                <i class="far fa-eye"></i>
                                            </button>
                                        </div>

                                    </div>
                                    <div class="tacbox bg-transparent">
                                        <input id="checkbox" type="checkbox" />
                                        <label for="checkbox"> I agree to these <a href="{{route('pages', 'terms-of-use')}}">Terms and
                                                Conditions</a>.</label>
                                        <strong><span id="checkbox_feedback" class="invalid-feedback text-danger"
                                                role="alert">
                                            </span> </strong>
                                    </div>
                                    <a id="register" href="#" type="submit" class="btn w-100 btn-primary my-4">Sign
                                        Up</a>
                                    <span id="m-log" class="font-size-md"> Already have an account? <a
                                            class="mb-4 text-primary font-size-md" href="{{ route('customer.login') }}">
                                            Login </a></span>
                                    <!-- already have account -->
                                    <!-- <span class="font-size-md"> Already have an account? </span> <a class="mb-4 text-primary font-size-md" href="{{ route('customer.login') }}"> Login </a> -->
                                </form>

                                <div class="social-icons social-icon-border-color d-flex justify-content-start">
                                    <a href="/login/facebook" class="social-button" id="facebook-connect">
                                        <span>Sign In With Facebook</span></a>
                                    <a href="/login/google" class="social-button" id="google-connect">
                                        <span>Sign In With Google</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--------- reg otp modal ----->
        <div class="modal fade shadow mt-3" id="reg_otp-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content m-auto" id="" style="width: 50%">
                    <div class="modal-header">
                        <p class="modal-title" id="">Phone Verification</p>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body m-0">
                        <!-- alert start-->
                        <div class="alert-success">
                            <span class="text-center mt-2" id="reg_code_sent" style="padding: 10px 0"></span>
                        </div>
                        <div class="alert-warning">
                            <span class="text-center mt-2" id="reg_code_invalid" style="padding: 10px 0"></span>
                        </div>
                        <div class="alert-warning">
                            <span class="text-center mt-2" id="reg_verification-error" style="padding: 10px 0"></span>
                        </div>
                        <!-- alert end-->


                        <label for="code"></label>
                        <input type="text" class="mb-2 form-control" name="code" id="reg_code"
                            placeholder="verification code" autocomplete="off">
                        <button type="button" id="reg_verify" class="btn btn-sm btn-primary mt-2">Verify</button>
                        <button type="button" id="reg_resend" class="btn btn-sm btn-primary mt-2" disabled>Resend code
                            <br> <span class="text-warning reg_timer"></span> </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="" class="btn btn-priamry"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


    </main>
    <!-- End of Main -->
@endsection
@section('page-scripts')
    <script src="{{ asset('/frontend/js/register.js') }}"></script>
@endsection
