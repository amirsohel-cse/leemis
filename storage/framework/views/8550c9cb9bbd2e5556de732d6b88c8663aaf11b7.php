

<?php $__env->startSection('main-content'); ?>
<style>
.dropify-message {
    line-height: initial;
    font-size: 10px;
}
.dropify-message p {
    font-size: 18px;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<div class="row">
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="header">
                <h5 class="card-title"><b>Header Logo</b></h5>
            </div>
            <div class="body">
               <form class="addlogo" enctype="multipart/form-data">
                    <input type="hidden" value="header" name="logoType">
                    <input type="file" class="dropify" data-allowed-file-extensions="png jpg jpeg" name="file"  data-default-file="\storage\storeLogo\<?php echo e($header); ?>">
                    <br>
                    <br>
                    <input class="btn btn-primary theme-bg gradient" type="submit" value="Submit">
                </form>
            </div>   
        </div>
        
    </div>
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="header">
                <h5 class="card-title"><b>Footer Logo</b></h5>
            </div>
            <div class="body">
               <form class="addlogo" enctype="multipart/form-data">
                    <input type="hidden" value="footer" name="logoType">
                    <input type="file" class="dropify" data-allowed-file-extensions="png jpg jpeg" name="file" data-default-file="\storage\storeLogo\<?php echo e($footer); ?>">
                    <br>
                    <br>
                    <input class="btn btn-primary theme-bg gradient" type="submit" value="Submit">
                </form>
            </div>   
        </div>
        
    </div>
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="header">
                <h5 class="card-title"><b>Invoice Logo</b></h5>
            </div>
            <div class="body">
               <form class="addlogo" enctype="multipart/form-data">
                    <input type="hidden" value="invoice" name="logoType">
                    <input type="file" class="dropify" data-allowed-file-extensions="png jpg jpeg" name="file" data-default-file="\storage\storeLogo\<?php echo e($invoice); ?>">
                    <br>
                    <br>
                    <input class="btn btn-primary theme-bg gradient" type="submit" value="Submit">
                </form>
            </div>   
        </div>
        
    </div>

    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="header">
                <h5 class="card-title"><b>Admin Panel Header Logo</b></h5>
            </div>
            <div class="body">
               <form class="addlogo" enctype="multipart/form-data">
                    <input type="hidden" value="sidebar" name="logoType">
                    <input type="file" class="dropify" data-allowed-file-extensions="png jpg jpeg" name="file" data-default-file="\storage\storeLogo\<?php echo e($sidebar); ?>">
                    <br>
                    <br>
                    <input class="btn btn-primary theme-bg gradient" type="submit" value="Submit">
                </form>
            </div>   
        </div>
        
    </div>
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="header">
                <h5 class="card-title"><b>Company Name</b></h5>
            </div>
            <div class="body">
               <form class="addtext" enctype="multipart/form-data">
                    <input type="hidden" value="barText" name="logoType">
                    <input type="text" class="form-control" id="barText" name="file"  placeholder="Side Bar Text" value="<?php echo e($barText); ?>" required>
                    
                    <br>
                    <br>
                    <input class="btn btn-primary theme-bg gradient" type="submit" value="Submit">
                </form>
            </div>   
        </div>
        
    </div>
    
    
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="header">
                <h5 class="card-title"><b>Mobile App Version</b></h5>
            </div>
            <div class="body">
               <form class="addtext" enctype="multipart/form-data">
                   
                    <input type="hidden" value="version" name="logoType">
                    <input type="text" class="form-control" id="version" name="file"  placeholder="Side Bar Text" value="<?php echo e(@$barText2); ?>" required>
                    
                    <br>
                    <br>
                    <input class="btn btn-primary theme-bg gradient" type="submit" value="Submit">
                </form>
            </div>   
        </div>
        
    </div>




</div>
<script type="text/javascript">
    $(document).ready(function(){
        
        $( ".addlogo" ).submit(function( event ) {
            event.preventDefault();
            let formData = new FormData()
            let logoType = $(this).find("input[name=logoType]").val();
            let file = $(this).find("input[name=file]")[0].files[0];

            if(file == undefined){
                return false;
            }

            formData.append('logoType', logoType);
            formData.append('file', file);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
            });
            $.ajax({
                type: "POST",
                url: "/admin/setting/storeLogo",
                data: formData,
                success: function(response){
                    swal("Success", "Logo changed successfully","success")
                },
                error: function(error){
                    console.log(error)
                    alert("can not change");
                }
            });
        });

        $( ".addtext" ).submit(function( event ) {
            event.preventDefault();
            let formData = new FormData()
            let logoType = $(this).find("input[name=logoType]").val();
            let file = $(this).find("input[name=file]").val();

            formData.append('logoType', logoType);
            formData.append('file', file);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
            });
            $.ajax({
                type: "POST",
                url: "/admin/setting/storeBarText",
                data: formData,
                success: function(response){
                    console.log(response)
                    swal("Success", "Text changed successfully","success")
                },
                error: function(error){
                    console.log(error)
                    alert("can not change");
                }
            });
            
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-stylesheet'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>

    <script src="<?php echo e(asset('/backend/js/category.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/setting/logo-view.blade.php ENDPATH**/ ?>