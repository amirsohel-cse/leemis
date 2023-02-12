

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
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<div class="row">

    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="header">
                <h5 class="card-title"><b>Shop Logo</b></h5>
            </div>
            <div class="body">
               <form class="addLogo" enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo e($id); ?>" name="id" id="id">
                    <input type="file" class="dropify" data-allowed-file-extensions="png jpg jpeg" name="file"  data-default-file="\uploads\vendors\<?php echo e(@$logo->shop_image); ?>">
                    <br>
                    <br>
                    <input class="btn btn-primary" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="header">
                <h5 class="card-title"><b>Banner</b></h5>
            </div>
            <div class="body">
               <form class="addBanner" enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo e($id); ?>" name="id" id="id">
                    <input type="file" class="dropify" data-allowed-file-extensions="png jpg jpeg" name="file"  data-default-file="\storage\storeFavicon\<?php echo e($data); ?>">
                    <br>
                    <br>
                    <input class="btn btn-primary" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $( ".addBanner" ).submit(function( event ) {
            event.preventDefault();
            let formData = new FormData()
            var id = $("#id").val();
            //alert(id)
            let file = $(this).find("input[name=file]")[0].files[0];
            formData.append('file', file);
            //console.log(file)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
            });
            $.ajax({
                type: "POST",
                url: `/vendor/setting/${id}/storeBanner`,
                data: formData,
                success: function(response){
                    console.log(response)
                    swal("Success", "Changed successfully","success")
                },
                error: function(error){
                    console.log(error)
                    alert("can not change");
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $( ".addLogo" ).submit(function( event ) {
            event.preventDefault();
            let formData = new FormData()
            var id = $("#id").val();
            //alert(id)
            let file = $(this).find("input[name=file]")[0].files[0];
            formData.append('file', file);
            
            //console.log(file)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
            });
        $.ajax({
                type: "POST",
                url: `/vendor/setting/${id}/storeShopimage`,
                data: formData,
                success: function(response){
                   
                    console.log(response)
                    swal("Success", "Changed successfully","success")
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

<?php echo $__env->make('vendor.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/vendor/setting/banner.blade.php ENDPATH**/ ?>