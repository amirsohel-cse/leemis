@include('vendor.layout.header.head')

@include('vendor.layout.header.page-topbar')

@include('vendor.layout.header.left-sidebar')

@include('vendor.layout.header.right-bar')

<div id="main-content">
    <div class="container-fluid">
        @if(Session::get('error'))
            <div class="alert alert-danger text-white container text-center" style="background: #3daa1b;">
                {{ Session::get('error') }}
            </div>
        @endif
        
        @yield('main-content')
    </div>
</div>
{{-- sweetaleart2 --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('vendor.layout.footer.footer')
<style>
    .form-control{
    border-color:#17a2b8 !important;
}
</style>

<script>
    $(".alert:not(.not_hide)").delay(5000).slideUp(700, function () {
        $(this).alert('close');
    });
</script>
