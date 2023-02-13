<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Hypershop</title>
    <?php
    $data=\App\Model\Favicon::first();
   ?>
    <?php if($data): ?>
        <link rel="icon" type="image/png" href="\storage\storeFavicon\<?php echo e($data->file); ?>">
    <?php else: ?>
        <link rel="icon" type="image/png" href="\storage\storeFavicon\common.png">
    <?php endif; ?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">



  <link rel="icon" type="image/png" href="<?php echo e(asset('frontend/assets/images/icons/favicon.png')); ?>">
  <script>
      WebFontConfig = {
          google: { families: ['Poppins:400,500,600,700,800'] }
      };
      (function (d) {
          var wf = d.createElement('script'), s = d.scripts[0];
          wf.src = '<?php echo e(asset('frontend/assets/js/webfont.js')); ?>';
          wf.async = true;
          s.parentNode.insertBefore(wf, s)
      })(document);
  </script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
       <link rel="preload" href="<?php echo e(asset('frontend/assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2')); ?>" as="font" type="font/woff2"
       crossorigin="anonymous">
   <link rel="preload" href="<?php echo e(asset('frontend/assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2')); ?>" as="font" type="font/woff2"
       crossorigin="anonymous">
   <link rel="preload" href="<?php echo e(asset('frontend/assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2')); ?>" as="font" type="font/woff2"
           crossorigin="anonymous">
   <link rel="preload" href="<?php echo e(asset('frontend/assets/fonts/wolmart.ttf?png09e" as="font" type="font/ttf')); ?>" crossorigin="anonymous">

   <!-- Vendor CSS -->
   <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/assets/vendor/fontawesome-free/css/all.min.css')); ?>">

   <!-- Plugins CSS -->
   <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/assets/vendor/owl-carousel/owl.carousel.min.css')); ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/assets/vendor/animate/animate.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('../frontend/assets/vendor/magnific-popup/magnific-popup.min.css')); ?>">

   <!-- Default CSS -->

   <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/assets/css/demo5.min.css')); ?>">
</head>

<body>
  
        <?php echo $__env->yieldContent('content'); ?>

 
     
   <!-- Plugin JS File -->

   <script src="<?php echo e(asset('/frontend/assets/vendor/jquery/jquery.min.js')); ?>"></script>
   <script src="<?php echo e(asset('frontend/assets/vendor/jquery.plugin/jquery.plugin.min.js')); ?>"></script>
   <script src="<?php echo e(asset('frontend/assets/vendor/parallax/parallax.min.js')); ?>"></script>
   <script src="<?php echo e(asset('frontend/assets/vendor/owl-carousel/owl.carousel.min.js')); ?>"></script>
   <script src="<?php echo e(asset('frontend/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')); ?>"></script>
   <script src="<?php echo e(asset('frontend/assets/vendor/jquery.countdown/jquery.countdown.min.js')); ?>"></script>
<script src="<?php echo e(asset('../frontend/assets/vendor/magnific-popup/jquery.magnific-popup.min.js')); ?>"></script>

   <script src="<?php echo e(asset('frontend/assets/vendor/zoom/jquery.zoom.js')); ?>"></script>
   <script src="<?php echo e(asset('frontend/assets/vendor/skrollr/skrollr.min.js')); ?>"></script>

    <script src="<?php echo e(asset('frontend/assets/js/main.js')); ?>"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- login js -->

   <?php echo $__env->yieldContent('page-scripts'); ?>

 

</body>
</html><?php /**PATH D:\My Workspace\Web\Laravel\Work\leemis\resources\views/vendor/master/master.blade.php ENDPATH**/ ?>