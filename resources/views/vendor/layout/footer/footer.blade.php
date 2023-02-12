</div>
</div>

<!-- Javascript -->
<script src="{{asset('/backend/assets/bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('/backend/assets/bundles/vendorscripts.bundle.js')}}"></script>

<!-- Vedor js file and create bundle with grunt  -->
<script src="{{asset('/backend/assets/bundles/flotscripts.bundle.js')}}"></script><!-- flot charts Plugin Js -->
<script src="{{asset('/backend/assets/bundles/c3.bundle.js')}}"></script>
<script src="{{asset('/backend/assets/bundles/apexcharts.bundle.js')}}"></script>
<script src="{{asset('/backend/assets/bundles/jvectormap.bundle.js')}}"></script>
<script src="{{asset('/backend/assets/vendor/toastr/toastr.js')}}"></script>

<script src="{{asset('backend/assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('/backend/assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('/backend/assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('/backend/assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('/backend/assets/vendor/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('/backend/assets/vendor/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('/backend/assets/vendor/sweetalert/sweetalert.min.js')}}"></script><!-- SweetAlert Plugin Js -->
<script src="{{asset('/backend/js/pages/tables/jquery-datatable.js')}}"></script>
<script src="{{asset('/backend/assets/vendor/dropify/js/dropify.js')}}"></script>
<script src="{{asset('/backend//js/pages/forms/dropify.js')}}"></script>

<!-- Project core js file minify with grunt -->
<script src="{{asset('/backend/assets/bundles/mainscripts.bundle.js')}}"></script>
<script src="{{asset('/backend/js/index.js')}}"></script>
<script src="{{asset('/backend/assets/vendor/summernote/dist/summernote-bs4.min.js')}}"></script>

<script src="{{asset('/backend/js/pages/ui/dialogs.js')}}"></script>
<script>

$('#summernote').summernote();
$('.dropdown-toggle').dropdown();

</script>
<script>
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
 });</script>

 <!-- Javascript -->
<script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<!-- Vedor js file and create bundle with grunt  -->

<!-- Project core js file minify with grunt -->
<script src="assets/bundles/mainscripts.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script src="frontend\assets\js\product.js"></script>

<script src="{{asset('/backend/assets/vendor/summernote/dist/summernote-bs4.min.js')}}"></script>
<script src="{{asset('/backend/js/pages/ui/dialogs.js')}}"></script>
<script src="{{asset('/vendor/js/vendor-notification.js')}}"></script>

@yield('page-scripts')
@yield('withdraw-scripts')
@stack('scripts')

</body>
</html>
