<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hypershop</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('vendor/css/bootstrap.min.css')); ?>">

    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('frontend/assets/vendor/fontawesome-free/css/all.min.css')); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/assets/css/line-awesome.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('../backend/assets/vendor/toastr/toastr.min.css')); ?>">

    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('frontend/assets/vendor/owl-carousel/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/assets/vendor/animate/animate.min.css')); ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('../frontend/assets/vendor/magnific-popup/magnific-popup.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/assets/vendor/photoswipe/photoswipe.min.css')); ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo e(asset('frontend/assets/vendor/photoswipe/default-skin/default-skin.min.css')); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/assets/vendor/slick-slider/slick.css')); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('../frontend/assets/css/demo5.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/assets/scss/demos/demo5/demo5.css')); ?>">

    <?php
    $data = \App\Model\Favicon::select('file')->first();
    ?>
    <?php if($data): ?>
        <link rel="icon" type="image/png" href="<?php echo e(asset('storage/storeFavicon/' . $data->file)); ?>">
    <?php else: ?>
        <link rel="icon" type="image/png" href="<?php echo e(asset('storage/storeFavicon/common.png')); ?>">
    <?php endif; ?>

</head>

<body>


    <div class="page-wrapper">
        <input id="token" type="text" value="" hidden>
        <input type="text" id="userId" value="<?php echo e(Auth::id()); ?>" hidden>
        <input type="text" id="productColor" value="" hidden>
        <input type="text" id="productSize" value="" hidden>
        <input type="text" id="productPrice" value="" hidden>
        <input type="text" id="productQty" value="" hidden>
        <!-- Start of Header -->
         <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.header','data' => []]); ?>
<?php $component->withName('frontend.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
        <!-- End of Header -->

        <!-- Start of Main-->
        <?php echo $__env->yieldContent('content'); ?>
        <!-- End of Main -->

        <!-- Start of Footer -->
         <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.footer','data' => []]); ?>
<?php $component->withName('frontend.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
        <!-- End of Footer -->
    </div>
    <!-- End of Page Wrapper -->


    <!-- Start of Sticky Footer -->
     <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.sticky-footer','data' => []]); ?>
<?php $component->withName('frontend.sticky-footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
    <!-- End of Sticky Footer -->


    <!-- Start of Scroll Top -->
    <a id="scroll-top" href="#top" title="Top" role="button" class="scroll-top"><i
            class="fas fa-chevron-up"></i></a>
    <!-- End of Scroll Top -->

    <!-- Start of Mobile Menu -->
     <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.mobile-menu','data' => []]); ?>
<?php $component->withName('frontend.mobile-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
    <!-- End of Mobile Menu -->

    <!-- Start of Quick View -->
     <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.product-popup','data' => []]); ?>
<?php $component->withName('frontend.product-popup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 

    <!-- End of Quick view -->



    <script src="<?php echo e(asset('frontend/assets/vendor/jquery/jquery.min.js')); ?>"></script>

    <script src="<?php echo e(asset('frontend/assets/vendor/sticky/sticky.min.js')); ?>"></script>

    <script src="<?php echo e(asset('frontend/assets/vendor/jquery.plugin/jquery.plugin.min.js')); ?>"></script>

    <script src="<?php echo e(asset('frontend/assets/vendor/parallax/parallax.min.js')); ?>"></script>

    <script src="<?php echo e(asset('frontend/assets/vendor/owl-carousel/owl.carousel.min.js')); ?>"></script>

    <script src="<?php echo e(asset('frontend/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')); ?>"></script>

    <script src="<?php echo e(asset('frontend/assets/vendor/jquery.countdown/jquery.countdown.min.js')); ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

    <script src="<?php echo e(asset('frontend/assets/vendor/slick-slider/slick.min.js')); ?>"></script>

    <?php if(auth()->guard()->check()): ?>
        <script>
            $.ajax({
                method: "GET",
                url: `/${$('#userId').val()}/cartData`,
                success: function(response) {
                    $('#cart_draw').html(response)
                }
            })
        </script>
    <?php endif; ?>

    <script src="<?php echo e(asset('../frontend/assets/vendor/magnific-popup/jquery.magnific-popup.min.js')); ?>"></script>

    <script src="<?php echo e(asset('frontend/assets/vendor/zoom/jquery.zoom.js')); ?>"></script>


    <script src="<?php echo e(asset('frontend/assets/vendor/skrollr/skrollr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/assets/vendor/photoswipe/photoswipe.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/assets/vendor/photoswipe/photoswipe-ui-default.min.js')); ?>"></script>
    <script src="<?php echo e(asset('../backend/assets/vendor/toastr/toastr.js')); ?>"></script>
    <script src="https://templates.thesoftking.com/direcon/demo/assets/js/jquery.unveil.js"></script>
    <script src="<?php echo e(asset('frontend/assets/js/main.js')); ?>"></script>

    <?php echo $__env->yieldContent('page-scripts'); ?>
    <?php echo $__env->yieldContent('profile-scripts'); ?>
    <script src="<?php echo e(asset('/backend/js/subscribe.js')); ?>"></script>
    <script src="<?php echo e(asset('/frontend/js/trackOrder.js')); ?>"></script>
    <script src="<?php echo e(asset('/frontend/js/add-to-cart.js')); ?>"></script>
    <script src="<?php echo e(asset('/frontend/js/quickView.js')); ?>"></script>
    <script src="<?php echo e(asset('/frontend/js/wishList.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/popup-login.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('script'); ?>
    <?php echo $__env->yieldContent('view-cart-script'); ?>
    


    <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(env('MAP_API')); ?>&callback=initMap"></script>


    <script>
        let map, infoWindow;
        let __KEY = "<?php echo e(env('MAP_API')); ?>";
        const locationsAvailable = document.getElementById('locationList');

        let btnDis = document.getElementById('disabtn');

        btnDis.setAttribute('disabled', true);

        function removeAddressCards() {
            if (locationsAvailable.hasChildNodes()) {
                while (locationsAvailable.firstChild) {
                    locationsAvailable.removeChild(locationsAvailable.firstChild);
                }
            }
        }

        let inputClicked = (result) => {

            result.address_components.map(component => {
                const types = component.types

                if (types.includes('postal_code')) {
                    $('postal_code').value = component.long_name
                }

                if (types.includes('locality')) {
                    $('locality').value = component.long_name
                }

                if (types.includes('administrative_area_level_2')) {
                    $('city').value = component.long_name
                }

                if (types.includes('administrative_area_level_1')) {
                    $('state').value = component.long_name
                }

                if (types.includes('point_of_interest')) {
                    $('landmark').value = component.long_name
                }
            });

            $('address').value = result.formatted_address;


        }

        populateCard = (geoResults) => {
            // check if a the container has a child node to force re-render of dom
            removeAddressCards();

            let input = document.getElementById('form_address')

            input.setAttribute("value", geoResults[0].formatted_address);

            let btn = document.getElementById('disabtn');

            btn.removeAttribute('disabled');


        }

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: <?php echo e(env('LAT')); ?>,
                    lng: <?php echo e(env('LNG')); ?>

                },
                restriction: {
                    strictBounds: true,
                },
                zoom: 20,
            });

            infoWindow = new google.maps.InfoWindow();

            const locationButton = document.createElement("button");

            locationButton.textContent = "Current Location";

            locationButton.classList.add("custom-map-control-button");

            map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

            locationButton.addEventListener("click", () => {

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            const pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude,
                            };

                            new google.maps.Marker({
                                position: pos,
                                map,
                            });

                            const latlng = pos.lat + "," + pos.lng;


                            fetch(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${latlng}&key=${__KEY}`)
                                .then(res => res.json())
                                .then(data => populateCard(data.results));

                            infoWindow.setPosition(pos);

                            map.setCenter(pos);
                        },
                        () => {
                            handleLocationError(true, infoWindow, map.getCenter());
                        }
                    );
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }
            });



            infoWindow.open(map);

            // Configure the click listener.
            map.addListener("click", (mapsMouseEvent) => {
                // Close the current InfoWindow.
                infoWindow.close();


                // Create a new InfoWindow.
                infoWindow = new google.maps.InfoWindow({
                    position: mapsMouseEvent.latLng,
                });

                let position = mapsMouseEvent.latLng.toJSON();

                const latlng = position.lat + "," + position.lng;

                fetch(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${latlng}&key=${__KEY}`)
                    .then(res => res.json())
                    .then(data => populateCard(data.results));
                infoWindow.open(map);
            });
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(
                browserHasGeolocation ?
                "Error: The Geolocation service failed." :
                "Error: Your browser doesn't support geolocation."
            );
            infoWindow.open(map);
        }

        window.initMap = initMap;

        $(document).on('click', '.with-gap', function() {
            $('#form_address').val($(this).val())
        })

        var url = "<?php echo e(route('changeLang')); ?>";

        $(".changeLang").change(function() {
            if ($(this).val() == '') {
                return false;
            }
            window.location.href = url + "?lang=" + $(this).val();
        });
    </script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\clients-project\hypershop_final\resources\views/frontend/master/master.blade.php ENDPATH**/ ?>