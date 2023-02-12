

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
    <div class="col-md-12 col-lg-4"></div>
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="header">
                <h5 class="card-title"><b>Favicon Logo</b></h5>
            </div>
            <div class="body">
               <form class="addfavicon" enctype="multipart/form-data">
                    <input type="hidden" value="header" name="logoType">
                    <input type="file" class="dropify" data-allowed-file-extensions="png jpg jpeg" name="file"  data-default-file="\storage\storeFavicon\<?php echo e($data); ?>">
                    <br>
                    <br>
                    <input class="btn btn-primary" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        
        $('.addfavicon').on('submit',function(e){
            e.preventDefault();
            let formData = new FormData()
            let file = $(this).find("input[name=file]")[0].files[0];
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
                url: "/admin/setting/storeFavicon",
                data: formData,
                success: function(response){
                    console.log(response)
                    swal("Success", "Changed successfully","success")
                },
                error: function(error){
                    alert("can not change");
                }
            });
        })
        
        // $( ".addfavicon" ).on('submit', function( event ) {
        //     event.preventDefault();
        //     let formData = new FormData()
        //     let file = $(this).find("input[name=file]")[0].files[0];
        //     formData.append('file', file);

        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         processData: false,
        //         contentType: false,
        //     });
        //     $.ajax({
        //         type: "POST",
        //         url: "/admin/setting/storeFavicon",
        //         data: formData,
        //         success: function(response){
        //             console.log(response)
        //             swal("Success", "Changed successfully","success")
        //         },
        //         error: function(error){
        //             alert("can not change");
        //         }
        //     });
        // });
    });
</script>

<?php $__env->stopSection(); ?>





<?php echo $__env->make('admin.layout.master.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/setting/favicon-view.blade.php ENDPATH**/ ?>