</div>
</div>

<!-- Javascript -->
{{-- <script src="{{asset('/backend/assets/vendor/jquery/jquery-3.5.1.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.5/umd/popper.min.js" integrity="sha512-8cU710tp3iH9RniUh6fq5zJsGnjLzOWLWdZqBMLtqaoZUA6AWIE34lwMB3ipUNiTBP5jEZKY95SfbNnQ8cCKvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>


<script src="{{ asset('/backend/assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('/backend/assets/bundles/vendorscripts.bundle.js') }}"></script>

<!-- Vedor js file and create bundle with grunt  -->
<script src="{{ asset('/backend/assets/bundles/flotscripts.bundle.js') }}"></script><!-- flot charts Plugin Js -->
<script src="{{ asset('/backend/assets/bundles/c3.bundle.js') }}"></script>
<script src="{{ asset('/backend/assets/bundles/apexcharts.bundle.js') }}"></script>
<script src="{{ asset('/backend/assets/bundles/jvectormap.bundle.js') }}"></script>
<script src="{{ asset('/backend/assets/vendor/toastr/toastr.js') }}"></script>

<script src="{{ asset('backend/assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('/backend/assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/backend/assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/backend/assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('/backend/assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/backend/assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('/backend/assets/vendor/sweetalert/sweetalert.min.js') }}"></script><!-- SweetAlert Plugin Js -->
<script src="{{ asset('/backend/js/pages/tables/jquery-datatable.js') }}"></script>
<script src="{{ asset('/backend/assets/vendor/dropify/js/dropify.js') }}"></script>
<script src="{{ asset('/backend/js/pages/forms/dropify.js') }}"></script>
<script src="{{ asset('../backend/js/pages/charts/apex.js') }}"></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


<!-- Project core js file minify with grunt -->
<script src="{{ asset('/backend/assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('/backend/js/index.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script src="{{ asset('/backend/js/pages/ui/dialogs.js') }}"></script>

<script>
    $('#summernote').summernote();
    $('.dropdown-toggle').dropdown();
</script>

<script>
    $(document).ready(function() {
        toastr.options = {
            "progressBar": true,
            "positionClass": "toast-top-right"
        };
    });
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>



<!-- Javascript -->
<script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<!-- Vedor js file and create bundle with grunt  -->

<!-- Project core js file minify with grunt -->
<script src="assets/bundles/mainscripts.bundle.js"></script>

<script src="frontend\assets\js\product.js"></script>
<script src="{{asset('/backend/assets/vendor/summernote/dist/summernote-bs4.min.js')}}"></script>
<script src="{{ asset('/backend/js/pages/ui/dialogs.js') }}"></script>
<script src="{{ asset('backend/js/pusher.js') }}"></script>

@yield('page-scripts')
@yield('minimum-withdraw-scripts')
@stack('scripts')




</body>

</html>
