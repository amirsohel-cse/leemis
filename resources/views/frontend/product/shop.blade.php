@extends('frontend.master.master')
@section('content')
<head>
    <link rel="stylesheet" type="text/css" href="{{('frontend/assets/css/style.min.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.3.7/jquery.jscroll.min.js"></script>
</head>
<main class="mains ">
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-navs">
        <div class="container-fluid">
            <ul class="breadcrumb shop-breadcrumb bb-no">
                <li class="passed"><a href="/">Home</a></li>
                <li class="active"><a href="#">All Shops</a></li>
            </ul>
        </div>
    </nav>
{{-- 
    <div class="row ">
        <div class="col">
            <input style="margin-left:380px;" type="text" class="form-control"  id="shopSearchInput" placeholder="Search for Shop">
        </div>
        <div class="col">
            <button style="margin-left:380px" id="shopSearchBtn" class="btn btn-dark">Search</button>
        </div>

    </div> --}}
    <div class="page-content mb-10">
        <div class="container-fluid">
            <div class="shop-content">

                <div class="infinite-scroll">
                <div class="main-content">
                    <div class="product-wrapper row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2" id="shops">
                        @forelse ($shop as $item)
                        <div class="product-wrap">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="{{route('shop.product',[$item->id, Str::slug($item->shop_name)])}}">
                                        <img style="height:140px" src="{{"/uploads/vendors/".$item->shop_image}}" width="100"
                                            height="100" />
                                    </a>

                                </figure>
                                <div class="product-details">
                                    <h5 class="">
                                        <a class="text-dark" href="{{route('shop.product',[$item->id, Str::slug($item->shop_name)])}}">{{$item->shop_name}}</a>
                                    </h5>

                                    <a style="width:100%" class="btn btn-primary" href="{{route('shop.product',[$item->id, Str::slug($item->shop_name)])}}"> <i class="fa fa-eye"></i>&nbsp  Visit Shop</a>

                                </div>
                            </div>
                        </div>

                    @empty
                        <p class="text-danger">No product Found</p>
                    @endforelse

                </div>
                {{ $shop->links() }}

            </div>
        </div>
    </div>
</div>
        {{--Please wait modal--}}
        <div class="modal fade bd-example-modal-sm" id="pleaseWaitModal" tabindex="-1" role="dialog" aria-labelledby="pleaseWaitModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content m-0 p-0 text-center" style="background-color: transparent !important; border: none !important;">
                    <div>
                        <div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-secondary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-grow text-success" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
            {{--Please wait modal--}}

</main>
<script type="text/javascript">
    $('ul.pagination').hide();
    $('.infinite-scroll').jscroll({
            autoTrigger: true,
            debug: true,
            loadingHtml: '<h4 class="text-center mt-2 mb-2">Loading More</h4>',
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
    });
</script>
@endsection

@section('page-scripts')
    <script src="{{asset('/frontend/js/shop.js')}}"></script>
@endsection
