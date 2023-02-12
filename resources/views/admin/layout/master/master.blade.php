@include('admin.layout.header.head')

@include('admin.layout.header.page-topbar')

@include('admin.layout.header.left-sidebar')

@include('admin.layout.header.right-bar')

<div id="main-content">
    <div class="container-fluid">
        @yield('main-content')
    </div>
</div>
{{-- sweetaleart2 --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@include('admin.layout.footer.footer')
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