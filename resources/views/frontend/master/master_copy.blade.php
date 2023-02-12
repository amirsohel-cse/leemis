<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
   
    <title>HyperShop</title>


    <link rel="stylesheet" href="{{asset('vendor/css/bootstrap.min.css')}}">

   <?php
    $data=\App\Model\Favicon::select('file')->first();
   ?>
    @if($data)
        <link rel="icon" type="image/png" href="{{asset('storage/storeFavicon/'.$data->file)}}">
       
    @else
        <link rel="icon" type="image/png" href="{{asset('storage/storeFavicon/common.png')}}">
    @endif
    
    

  <script>
      WebFontConfig = {
          google: { families: ['Poppins:400,500,600,700,800'] }
      };
      (function (d) {
          var wf = d.createElement('script'), s = d.scripts[0];
          wf.src = '{{ asset('frontend/assets/js/webfont.js') }}';
          wf.async = true;
          s.parentNode.insertBefore(wf, s)
      })(document);
  </script>

       {{-- <link rel="preload" href="{{asset('frontend/assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2')}}" as="font" type="font/woff2"
       crossorigin="anonymous">
   <link rel="preload" href="{{asset('frontend/assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2')}}" as="font" type="font/woff2"
       crossorigin="anonymous">
   <link rel="preload" href="{{asset('frontend/assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2')}}" as="font" type="font/woff2"
           crossorigin="anonymous">
   <link rel="preload" href="{{asset('frontend/assets/fonts/wolmart.ttf?png09e" as="font" type="font/ttf')}}" crossorigin="anonymous"> --}}

   <!-- Vendor CSS -->
   <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/fontawesome-free/css/all.min.css')}}">

   <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/line-awesome.min.css')}}">

   <!-- Plugins CSS -->
   <link rel="stylesheet" href="{{ asset('../backend/assets/vendor/toastr/toastr.min.css') }}">

   <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/owl-carousel/owl.carousel.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/animate/animate.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('../frontend/assets/vendor/magnific-popup/magnific-popup.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/photoswipe/photoswipe.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/photoswipe/default-skin/default-skin.min.css')}}">

   <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/slick-slider/slick.css')}}">

   <link rel="stylesheet" type="text/css" href="{{asset('../frontend/assets/css/demo5.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/scss/demos/demo5/demo5.css')}}">
    @yield('page-styles')
    @yield('profile-styles')

    <style>

.toast-message {
      font-size:16px;
      color:rgb(248, 248, 248);
      font-weight: 400px;
 }

 a :hover{
    text-decoration: none !important;

  }
  body a {
      text-decoration:none !important;
  }
  
  .custom-map-control-button {
            background-color: #fff;
            border: 0;
            border-radius: 2px;
            box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
            margin: 10px;
            padding: 0 0.5em;
            font: 400 18px Roboto, Arial, sans-serif;
            overflow: hidden;
            height: 40px;
            cursor: pointer;
        }

        .custom-map-control-button:hover {
            background: rgb(235, 235, 235);
        }
    </style>


</head>




<body class="home">
    

    <div class="page-wrapper">
        <input id="token" type="text" value="" hidden>
        <input type="text" id="userId" value="{{Auth::id()}}" hidden>
        <input type="text" id="productColor" value="" hidden>
        <input type="text" id="productSize" value="" hidden>
        <input type="text" id="productPrice" value="" hidden>
        <input type="text" id="productQty" value="" hidden>
        <!-- Start of Header -->
        <x-frontend.header/>
        <!-- End of Header -->

        <!-- Start of Main-->
        @yield('content')
        <!-- End of Main -->

        <!-- Start of Footer -->
        <x-frontend.footer/>
        <!-- End of Footer -->
    </div>
    <!-- End of Page Wrapper -->


    <!-- Start of Sticky Footer -->
    <x-frontend.sticky-footer/>
    <!-- End of Sticky Footer -->


    <!-- Start of Scroll Top -->
    <a id="scroll-top" href="#top" title="Top" role="button" class="scroll-top"><i class="fas fa-chevron-up"></i></a>
    <!-- End of Scroll Top -->

    <!-- Start of Mobile Menu -->
    <x-frontend.mobile-menu/>
    <!-- End of Mobile Menu -->

    <!-- Start of Quick View -->
    <x-frontend.product-popup/>

    <!-- End of Quick view -->



   <script src="{{asset('../frontend/assets/vendor/jquery/jquery.min.js')}}"></script>
   <script src="{{asset('frontend/assets/vendor/sticky/sticky.min.js')}}"></script>
   <script src="{{asset('frontend/assets/vendor/jquery.plugin/jquery.plugin.min.js')}}"></script>
   <script src="{{asset('frontend/assets/vendor/parallax/parallax.min.js')}}"></script>
   <script src="{{asset('frontend/assets/vendor/owl-carousel/owl.carousel.min.js')}}"></script>
   <script src="{{asset('frontend/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
   <script src="{{asset('frontend/assets/vendor/jquery.countdown/jquery.countdown.min.js')}}"></script>

   <script src="{{asset('frontend/assets/vendor/slick-slider/slick.min.js')}}"></script>

    <script>
        
        $.ajax({
            method:"GET",
            url: `/${$('#userId').val()}/cartData`,
            success:function(response){

                $('#cart_draw').html(response)

            }
        })
        
        
    </script>

    <script src="{{asset('../frontend/assets/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

   <script src="{{asset('frontend/assets/vendor/zoom/jquery.zoom.js')}}"></script>
   <script src="{{asset('frontend/assets/vendor/skrollr/skrollr.min.js')}}"></script>
   <script src="{{asset('frontend/assets/vendor/photoswipe/photoswipe.min.js')}}"></script>
   <script src="{{asset('frontend/assets/vendor/photoswipe/photoswipe-ui-default.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{asset('../backend/assets/vendor/toastr/toastr.js')}}"></script>
<script src="{{asset('frontend/assets/js/main.js')}}"></script>

@yield('page-scripts')
@yield('profile-scripts')
<script src="{{asset('/backend/js/subscribe.js')}}"></script>
    <script src="{{asset('/frontend/js/trackOrder.js')}}"></script>
    <script src="{{asset('/frontend/js/add-to-cart.js')}}"></script>
    <script src="{{asset('/frontend/js/quickView.js')}}"></script>
    <script src="{{asset('/frontend/js/wishList.js')}}"></script>
    <script src="{{asset('frontend/js/popup-login.js')}}"></script>
    @stack('script')
@yield('view-cart-script')
    <script>
        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
    </script>

    
   
    
     <script src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_API')}}&callback=initMap"
        defer></script>


    <script>
        let map, infoWindow;
        let __KEY = "{{env('MAP_API')}}";
        const locationsAvailable = document.getElementById('locationList');
        
        let btnDis = document.getElementById('disabtn');
            
        btnDis.setAttribute('disabled',true);
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
                    lat: {{env('LAT')}},
                    lng: {{env('LNG')}}
                },
                restriction: {
                    strictBounds: false,
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

                fetch(
                        `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latlng}&key=${__KEY}`)

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


        $(document).on('click','.with-gap', function(){
            $('#form_address').val($(this).val())
        })
        
        
        
         var url = "{{ route('changeLang') }}";

        $(".changeLang").change(function() {
            if ($(this).val() == '') {
                return false;
            }
            window.location.href = url + "?lang=" + $(this).val();
        });
    </script>

   

</body>
</html>
