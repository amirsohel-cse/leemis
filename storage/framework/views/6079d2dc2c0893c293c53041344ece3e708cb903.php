<?php $__env->startSection('content'); ?>
    <style>
        .login-popup#login-page {
            margin: auto;
        }

        #m-sign {
            display: none;
        }

        .page-title {
            text-align: center;
        }

        .social-button {
            background-position: 25px 0px;
            box-sizing: border-box;
            color: rgb(255, 255, 255);
            cursor: pointer;
            display: inline-block;
            height: 50px;
            line-height: 50px;
            text-align: left;
            text-decoration: none;
            text-transform: uppercase;
            vertical-align: middle;
            width: 100%;
            border-radius: 3px;
            margin: 10px auto;
            outline: rgb(255, 255, 255) none 0px;
            padding-left: 20%;
            transition: all 0.2s cubic-bezier(0.72, 0.01, 0.56, 1) 0s;
            -webkit-transition: all .3s ease;
            -moz-transition: all .3s ease;
            -ms-transition: all .3s ease;
            -o-transition: all .3s ease;
            transition: all .3s ease;
        }

        #facebook-connect {
            background: rgb(255, 255, 255) url('https://raw.githubusercontent.com/eswarasai/social-login/master/img/facebook.svg?sanitize=true') no-repeat scroll 5px 0px / 30px 50px padding-box border-box;
            border: 1px solid rgb(60, 90, 154);
        }

        #facebook-connect:hover {
            border-color: rgb(60, 90, 154);
            background: rgb(60, 90, 154) url('https://raw.githubusercontent.com/eswarasai/social-login/master/img/facebook-white.svg?sanitize=true') no-repeat scroll 5px 0px / 30px 50px padding-box border-box;
            -webkit-transition: all .8s ease-out;
            -moz-transition: all .3s ease;
            -ms-transition: all .3s ease;
            -o-transition: all .3s ease;
            transition: all .3s ease-out;
        }

        #facebook-connect span {
            box-sizing: border-box;
            color: rgb(60, 90, 154);
            cursor: pointer;
            text-align: center;
            text-transform: uppercase;
            border: 0px none rgb(255, 255, 255);
            outline: rgb(255, 255, 255) none 0px;
            -webkit-transition: all .3s ease;
            -moz-transition: all .3s ease;
            -ms-transition: all .3s ease;
            -o-transition: all .3s ease;
            transition: all .3s ease;
        }

        #facebook-connect:hover span {
            color: #FFF;
            -webkit-transition: all .3s ease;
            -moz-transition: all .3s ease;
            -ms-transition: all .3s ease;
            -o-transition: all .3s ease;
            transition: all .3s ease;
        }

        #google-connect {
            background: rgb(255, 255, 255) url('https://raw.githubusercontent.com/eswarasai/social-login/master/img/google-plus.png') no-repeat scroll 5px 0px / 50px 50px padding-box border-box;
            border: 1px solid rgb(220, 74, 61);
        }

        #google-connect:hover {
            border-color: rgb(220, 74, 61);
            background: rgb(220, 74, 61) url('https://raw.githubusercontent.com/eswarasai/social-login/master/img/google-plus-white.png') no-repeat scroll 5px 0px / 50px 50px padding-box border-box;
            -webkit-transition: all .8s ease-out;
            -moz-transition: all .3s ease;
            -ms-transition: all .3s ease;
            -o-transition: all .3s ease;
            transition: all .3s ease-out;
        }

        #google-connect span {
            box-sizing: border-box;
            color: rgb(220, 74, 61);
            cursor: pointer;
            text-align: center;
            text-transform: uppercase;
            border: 0px none rgb(220, 74, 61);
            outline: rgb(255, 255, 255) none 0px;
            -webkit-transition: all .3s ease;
            -moz-transition: all .3s ease;
            -ms-transition: all .3s ease;
            -o-transition: all .3s ease;
            transition: all .3s ease;
        }

        #google-connect:hover span {
            color: #FFF;
            -webkit-transition: all .3s ease;
            -moz-transition: all .3s ease;
            -ms-transition: all .3s ease;
            -o-transition: all .3s ease;
            transition: all .3s ease;
        }

        @media (max-width: 575.98px) {
            #m-pic {
                display: none;
            }

            #m-sign {
                display: block;
            }
        }
    </style>

    <main class="main login-page">


        <div class="page-content">
            <div class="container p-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="account-wrapper">
                            <div class="left"
                                style="background-image: url('https://hyper.springsoftit.com/public/frontend/images/login.jpg')">
                                <div class="account-content">
                                    <h3 class="account-title"><?php echo e(languageChange('Login your Account')); ?></h3>
                                    <p><span style="text-align:center"> Don't have an account? <a
                                                href="<?php echo e(route('customer.register')); ?>">Sign Up</a> </span> </p>
                                </div>
                            </div>
                            


                            <div class="right">
                                <?php if(session()->has('errors')): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Your credentials does not match!</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>

                                <?php if(Session::get('error')): ?>
                                    <div class="alert text-white container" style="background: red;">
                                        <?php echo e(Session::get('error')); ?>

                                    </div>
                                <?php endif; ?>
                                <form id="customer-login-form" action="<?php echo e(route('customer.login')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark"><?php echo e(languageChange('Email')); ?>.
                                            *</label>
                                        <input placeholder="Enter email" name="email" type="text"
                                            class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            value="<?php echo e(old('email')); ?>" required autofocus>
                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <?php if(session('notify')): ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Your Account Has Been Disabled!</strong>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label class="font-weight-bold text-dark"><?php echo e(languageChange('Password')); ?> *</label>
                                        <input type="password" name="password" placeholder="Minimum 8 characters"
                                            class="form-control mb-1 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            value="<?php echo e(old('password')); ?>" required autocomplete="password" autofocus>
                                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <a href="#" class="fp mt-2 mb-2"><u><?php echo e(languageChange('Forgot password')); ?>?</u>
                                    </a>
                                    <button type="submit"
                                        class="btn btn-primary btn-block my-4"><?php echo e(languageChange('Sign In')); ?></button>
                                    <span id="m-sign" style="text-align:center"> Don't have an account? <a
                                            href="<?php echo e(route('customer.register')); ?>">Sign Up</a> </span>
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
    </main>
    <script>
        $(".alert:not(.not_hide)").delay(5000).slideUp(500, function() {
            $(this).alert('close');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\My Workspace\Web\Laravel\Work\leemis\resources\views/frontend/auth/login.blade.php ENDPATH**/ ?>