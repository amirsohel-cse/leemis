

<?php $__env->startSection('main-content'); ?>
<style>
    .profile-head {
    transform: translateY(5rem)
}

.cover {
    background-image: url(https://images.unsplash.com/photo-1530305408560-82d13781b33a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1352&q=80);
    background-size: cover;
    background-repeat: no-repeat
}

</style>
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

    <div class="row py-5 px-4">
    <div class="col-md-12 mx-auto">
        <!-- Profile widget -->
        <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 pt-0 pb-4 cover">
                <div class="media align-items-end profile-head">
                    <div class="profile mr-3"><img src="/uploads/vendors/<?php echo e($vendor->image); ?>" alt="..." width="130" class="rounded mb-2 img-thumbnail">
                </div>
                
                    <div class="media-body mb-5 text-white">
                        <h4 class="mt-0 mb-0"><?php echo e(old('shopname',$vendor->shop_name)); ?></h4>
                        <p class="small mb-4"> <i class="fa fa-map-marker-alt mr-2 text-white"></i><?php echo e($vendor->address); ?></p>
                    </div>
                    
                    <div class="float-right ">
                        <a style="background-color:#343A40; color: #54C4BC; margin-right: 30px"
                     href="<?php echo e(route('vendor.profile')); ?>" class="btn btn-outline-dark btn-sm btn-block">Edit profile</a>
                    </div>
                    
                </div>
            </div>
           
            <div class="px-4 py-3 mt-3">
                <h5 class="mb-0">About</h5>
                <div class="p-4 rounded shadow-sm bg-light">
                    <table class="table border">
                    <thead>
                    <tr>
                    <th width="40%" scope="row">Shop Name</th>
                    <td><?php echo e(old('shopname',$vendor->shop_name)); ?></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                    <th scope="row">Address</th>
                    <td><?php echo e($vendor->address); ?></td>
                    
                    </tr>
                    <tr>
                    <th scope="row">Shop Image</th>
                    <td>Jacob</td>
                    
                    </tr>
                    <tr>
                    <th scope="row">Owner Name</th>
                    <td><?php echo e(old('name',$vendor->name)); ?></td>
                    
                    </tr>
                      <tr>
                    <th scope="row">Owner Email</th>
                    <td><?php echo e(old('email',$vendor->email)); ?></td>
                    
                    </tr>
                     
                    </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</div>
    <!-- <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">

                    <ul class="header-dropdown dropdown">

                        <li><a href="javascript:void(0);" class="full-screen"><i class="fa fa-expand"></i></a></li>
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                            <ul class="dropdown-menu theme-bg gradient">
                                <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-eye"></i> View Details</a></li>
                                <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-share-alt"></i> Share</a></li>
                                <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-copy"></i> Copy to</a></li>
                                <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-folder"></i> Move to</a></li>
                                <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-edit"></i> Rename</a></li>
                                <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-trash"></i> Delete</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <form action="" id="edit-vendor-form" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default"><strong>Shop Name*</strong></span>
                                </div>
                                <input type="text" class="form-control" id="edit-shop-name" placeholder="Enter shop name" name="shop_name" value="<?php echo e(old('shopname',$vendor->shop_name)); ?>" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                            </div>
                            <strong><span id="edit_shopname_error" class="invalid-feedback d-block mb-3" role="alert">
                            </span> </strong>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default"><strong>Address*</strong></span>
                                </div>
                                <textarea id ="edit-address" class="input-field" name="address" required=""  placeholder="Enter address"><?php echo e($vendor->address); ?></textarea>
                            </div>
                            <strong><span id="address_error" class="invalid-feedback d-block mb-3" role="alert">
                            </span> </strong>

                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"><strong>Shop Image*</strong></span>
                                        </div>
                                        <input id="edit-shop-image" type="file" name="shop_image" class="dropify edit-shop_photo" >
                                    </div> 
                                    <strong><span id="edit_shopimage_error" class="invalid-feedback d-block mb-3" role="alert">
                                    </span> </strong>
                                </div>
                                <div class="col-6">
                                    <?php if(!empty($vendor->shop_image)): ?>
                                        <img width="100%" height="200px" id="oldShopPhoto" style="margin-top: 37px" src="<?php echo e(asset('uploads/vendors/'.$vendor->shop_image)); ?>" alt="">
                                    <?php else: ?>
                                        <img hidden width="100%" height="200px" id="oldShopPhoto" style="margin-top: 37px" src="" alt="">
                                    <?php endif; ?>

                                </div>
                            </div> 


                           
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default"><strong>Owner Name*</strong></span>
                                </div>
                                <input type="text" class="form-control" id="edit-name" name="name" placeholder="Enter name" value="<?php echo e(old('name',$vendor->name)); ?>" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                            </div>
                            <strong><span id="edit_name_error" class="invalid-feedback d-block mb-3" role="alert">
                            </span> </strong>
                            

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default"><strong>Owner Email*</strong></span>
                                </div>
                                <input type="email" class="form-control" id="edit-email" name="email" placeholder="Enter email" value="<?php echo e(old('email',$vendor->email)); ?>" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                            </div>
                            <strong><span id="edit_email_error" class="invalid-feedback d-block mb-3" role="alert">
                            </span> </strong>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default"><strong>Owner Phone*</strong></span>
                                </div>
                                <input type="number" class="form-control" id="edit-phone" name="phone" placeholder="Enter phone number" value="<?php echo e(old('phone',$vendor->phone)); ?>" aria-label="Default" aria-describedby="inputGroup-sizing-default" >
                            </div>
                            <strong><span id="edit_phone_error" class="invalid-feedback d-block mb-3" role="alert">
                            </span> </strong>

   
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default"><strong>Password</strong></span>
                                </div>
                                <input type="password" class="form-control" id="edit-password" name="password" aria-label="Default" placeholder="Minimum 8 characters" aria-describedby="inputGroup-sizing-default" >
                            </div>
                            <strong><span id="edit_password_error" class="invalid-feedback d-block mb-3" role="alert">
                            </span> </strong>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default"><strong>Confirm Password</strong></span>
                                </div>
                                <input type="password" class="form-control" id="edit-password_confirmation" name="password_confirmation" aria-label="Default" placeholder="Confirm password" aria-describedby="inputGroup-sizing-default" >
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default"> <strong>Image</strong></span>
                                        </div>
                                        <input id="edit-image" type="file" name="image" class="dropify edit-photo" >
                                    </div> 
                                    <strong><span id="edit_image_error" class="invalid-feedback d-block mb-3" role="alert">
                                    </span> </strong>
                                </div>
                                <div class="col-6">
                                    <?php if(!empty($vendor->image)): ?>
                                        <img width="100%" height="200px" id="oldPhoto" style="margin-top: 37px" src="<?php echo e(asset('uploads/vendors/'.$vendor->image)); ?>" alt="">
                                    <?php else: ?>
                                        <img hidden width="100%" height="200px" id="oldPhoto" style="margin-top: 37px" src="" alt="">
                                    <?php endif; ?>

                                </div>
                            </div>                 

                            <button type="submit" class="btn btn-primary theme-bg gradient">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
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

            
<?php echo $__env->make('vendor.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/vendor/vendor/profile.blade.php ENDPATH**/ ?>