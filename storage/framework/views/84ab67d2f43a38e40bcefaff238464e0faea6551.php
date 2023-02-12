

<?php $__env->startSection('main-content'); ?>
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h1><strong>Vendor Profile</strong></h1>
                <span>Dashboard</span> <i class="fa fa-angle-right"></i>
                <span>Vendor</span> <i class="fa fa-angle-right"></i>
                <span>Profile</span>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">

                    <ul class="header-dropdown dropdown">

                        <li><a href="javascript:void(0);" class="full-screen"><i class="fa fa-expand"></i></a></li>
                     
                    </ul>
                </div>
                <div class="body">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <form action="" id="edit-vendor-form" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group row">
                                <label for="edit-shop-name" class="col-sm-3 col-form-label"><strong>Shop Name</strong></label>
                                    <div class="col-sm-9">
                                       <input id="edit-shop-name" type="text" class="form-control" name="shop_name"  placeholder="Enter shop name" value="<?php echo e(old('shopname',$vendor->shop_name)); ?>" readonly>
                                    </div>
                            </div>
                         
                            <strong><span id="edit_shopname_error" class="invalid-feedback d-block mb-3" role="alert">
                            </span> </strong>
                            <div class="form-group row">
                                <label for="edit-address" class="col-sm-3 col-form-label"><strong>Address</strong></label>
                                    <div class="col-sm-9">
                                       <input id="edit-address" type="text" name="address" class="form-control"  placeholder="Enter address" value="<?php echo e($vendor->address); ?>" required>
                                    </div>
                            </div>
                         
                            <strong><span id="address_error" class="invalid-feedback d-block mb-3" role="alert">
                            </span> </strong>

                        


                           <div class="form-group row">
                                <label for="edit-name" class="col-sm-3 col-form-label"><strong>Owner Name</strong></label>
                                    <div class="col-sm-9">
                                       <input id="edit-name" type="text" name="name" class="form-control" placeholder="Enter name" value="<?php echo e(old('name',$vendor->name)); ?>"  required>
                                    </div>
                            </div>
                         
                            <strong><span id="edit_name_error" class="invalid-feedback d-block mb-3" role="alert">
                            </span> </strong>
                            
                            <div class="form-group row">
                                <label for="edit-email" class="col-sm-3 col-form-label"><strong>Owner Email</strong></label>
                                    <div class="col-sm-9">
                                       <input id="edit-email" type="email" name="email" class="form-control"  value="<?php echo e(old('email',$vendor->email)); ?>" readonly>
                                    </div>
                            </div>
                         
                            <strong><span id="edit_email_error" class="invalid-feedback d-block mb-3" role="alert">
                            </span> </strong>
                            
                            <div class="form-group row">
                                <label for="edit-phone" class="col-sm-3 col-form-label"><strong>Phone</strong></label>
                                    <div class="col-sm-9">
                                       <input id="edit-phone" type="number" name="phone" class="form-control"  value="<?php echo e(old('phone',$vendor->phone)); ?>" readonly>
                                    </div>
                            </div>
                         
                            <strong><span id="edit_phone_error" class="invalid-feedback d-block mb-3" role="alert">
                            </span> </strong>

                            <div class="form-group row">
                                <label for="edit-password" class="col-sm-3 col-form-label"><strong>Password</strong></label>
                                    <div class="col-sm-9">
                                       <input id="edit-password" type="password" name="password" class="form-control"  >
                                    </div>
                            </div>
                      
                            <strong><span id="edit_password_error" class="invalid-feedback d-block mb-3" role="alert">
                            </span> </strong>
                            
                            <div class="form-group row">
                                <label for="edit-password_confirmation" class="col-sm-3 col-form-label"><strong>Confirm Password</strong></label>
                                    <div class="col-sm-9">
                                       <input id="edit-password_confirmation" type="password" name="password_confirmation" class="form-control"  >
                                    </div>
                            </div>
                       

                            <!--<div class="row">-->
                            <!--    <div class="col-6">-->
                            <!--        <div class="input-group mb-3">-->
                            <!--            <div class="input-group-prepend">-->
                            <!--                <span class="input-group-text" id="inputGroup-sizing-default"> <strong>Image</strong></span>-->
                            <!--            </div>-->
                            <!--            <input id="edit-image" type="file" name="image" data-allowed-file-extensions="png jpg jpeg" class="dropify edit-photo" >-->
                            <!--        </div> -->
                            <!--        <strong><span id="edit_image_error" class="invalid-feedback d-block mb-3" role="alert">-->
                            <!--        </span> </strong>-->
                            <!--    </div>-->
                            <!--    <div class="col-6">-->
                            <!--        <?php if(!empty($vendor->image)): ?>-->
                            <!--            <img width="100%" height="200px" id="oldPhoto" style="margin-top: 37px" src="<?php echo e(asset('uploads/vendors/'.$vendor->image)); ?>" alt="">-->
                            <!--        <?php else: ?>-->
                            <!--            <img hidden width="100%" height="200px" id="oldPhoto" style="margin-top: 37px" src="" alt="">-->
                            <!--        <?php endif; ?>-->

                            <!--    </div>-->
                            <!--</div>                 -->

                            <button type="submit" class="btn btn-primary theme-bg gradient">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-stylesheet'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/backend/assets/css/nice-select.css')); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-scripts'); ?>
    <script src="<?php echo e(asset('/backend/assets/js/jquery.nice-select.js')); ?>"></script>
    <script !src="">
        $(document).ready(function () {
            $('select').niceSelect();
        });
    </script>
    <script src="<?php echo e(asset('/backend/js/vendor-profile.js')); ?>"></script>

<?php $__env->stopSection(); ?>

            
<?php echo $__env->make('vendor.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/vendor/vendor/vendor-profile.blade.php ENDPATH**/ ?>