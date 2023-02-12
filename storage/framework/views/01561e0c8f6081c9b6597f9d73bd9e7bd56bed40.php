

<?php $__env->startSection('main-content'); ?>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><strong>Two Factor Authentication</strong></div>
                    <div class="card-body">
                        <p>Two factor authentication (2FA) strengthens access security by requiring two methods (also referred to as factors) to verify your identity. Two factor authentication protects against phishing, social engineering and password brute force attacks and secures your logins from attackers exploiting weak or stolen credentials.</p>

                        <?php if(session('error')): ?>
                            <div class="alert alert-danger">
                                <?php echo e(session('error')); ?>

                            </div>
                        <?php endif; ?>
                        <?php if(session('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>

                        <?php if($data['user']->loginSecurity == null): ?>
                            <form class="form-horizontal" method="POST" action="<?php echo e(route('generate2faSecret')); ?>">
                                <?php echo e(csrf_field()); ?>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Generate Secret Key to Enable 2FA
                                    </button>
                                </div>
                            </form>
                        <?php elseif(!$data['user']->loginSecurity->google2fa_enable): ?>
                            1. Scan this QR code with your Google Authenticator App. Alternatively, you can use the code: <code><?php echo e($data['secret']); ?></code><br/>
                            <img src="<?php echo e($data['google2fa_url']); ?>" alt="">
                            <br/><br/>
                            2. Enter the pin from Google Authenticator app:<br/><br/>
                            <form class="form-horizontal" method="POST" action="<?php echo e(route('enable2fa')); ?>">
                                <?php echo e(csrf_field()); ?>

                                <div class="form-group<?php echo e($errors->has('verify-code') ? ' has-error' : ''); ?>">
                                    <label for="secret" class="control-label">Authenticator Code</label>
                                    <input id="secret" type="password" class="form-control col-md-4" name="secret" required>
                                    <?php if($errors->has('verify-code')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('verify-code')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Enable 2FA
                                </button>
                            </form>
                        <?php elseif($data['user']->loginSecurity->google2fa_enable): ?>
                            <div class="alert alert-success">
                                2FA is currently <strong>enabled</strong> on your account.
                            </div>
                            <p>If you are looking to disable Two Factor Authentication. Please confirm your password and Click Disable 2FA Button.</p>
                            <form class="form-horizontal" method="POST" action="<?php echo e(route('disable2fa')); ?>">
                                <?php echo e(csrf_field()); ?>

                                <div class="form-group<?php echo e($errors->has('current-password') ? ' has-error' : ''); ?>">
                                    <label for="change-password" class="control-label">Current Password</label>
                                        <input id="current-password" type="password" class="form-control col-md-4" name="current-password" required>
                                        <?php if($errors->has('current-password')): ?>
                                            <span class="help-block">
                                        <strong><?php echo e($errors->first('current-password')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                </div>
                                <button type="submit" class="btn btn-primary ">Disable 2FA</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/2fa_settings.blade.php ENDPATH**/ ?>