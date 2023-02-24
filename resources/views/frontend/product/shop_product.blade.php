@extends('frontend.master.master')
@section('content')
    <head>
        <link rel="stylesheet" type="text/css" href="{{('frontend/assets/css/style.min.css')}}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.3.7/jquery.jscroll.min.js"></script>
        <style>
            #s-ban{
	width: 100%;
	height: 200px;
	@if(isset($banner->file))

	background: linear-gradient(to bottom, rgba(0,0,0,.6), rgba(0,0,0,.3)), url("{{"/storage/storeFavicon/".$banner->file}}") center no-repeat;
	@endif
	background-size: cover;
	position: relative;
    overflow: hidden;

}
        </style>
    </head>
    <!-- Start of Main -->
    <main class="main container">
        <!-- Start of Page Content -->
        <div class="page-content ">
            @php($asset = $banner ? asset("/storage/storeFavicon/$banner->file") : "")
            @php($backgroundImg = $asset ? "background-color: #FFC74E; " : "background-color: #FFC74E;")
            <div id="s-ban" class="rounded mt-5 shop-default-banner shop-boxed-banner border banner d-flex align-items-end mb-6" >
                <div class="container banner-content d-flex align-items-center">
                    <div class="vendor-shop-logo">
                        <img src="{{"/uploads/vendors/".$vendor->shop_image}}" />
                    </div>
                    <div class="ml-5">
                        <h3 class="banner-subtitle m-0  text-white font-weight-bold">{{$vendor->shop_name}}</h3>
                        <h6 class=" text-white m-0 text-uppercase ">{{$vendor->address}}</h6>

                        <input type="text" id="vendor_id" value="{{$vendor->id}}" hidden>
                    </div>
                </div>

            </div>
            <!-- End of Shop Banner -->
                            <div class="infinite-scroll">

                                <div style="padding-right:0;padding-left:0;margin:0;" class="product-wrapper row col-md-12 col-sm-12 col-12" id="all_products">
                                    @forelse ($shopProduct as $item)
                                        <div class="col-md-2 col-sm-4 col-6">

                                            <div class="product-wrap mt-2">
                                                <div  class="product mb-5">
                                                    <figure class="product-media">
            <a href="{{route('product.details',[$item->id, Str::slug($item->name)])}}">
                                                            <img style="height:200px; width:100%;" src="{{"/$item->photo"}}" alt="Product" >
                                                            <img style="height:200px; width:100%;" src="{{"/$item->photo"}}" alt="Product">
                                                        </a>
                                                        @if($item->stock > 0)
                                                            <div class="product-action-vertical">
                                                                <a href="#" data-id="{{$item->id}}" class="btn-product-icon btn-wishlist w-icon-heart"
                                                                   title="Add to wishlist"></a>

                                                            </div>
                                                        @endif

                                                        <div class="shopping-action">
                                                        @if($item->stock > 0)
                                                            <a style="width:100%" data-id="{{$item->id}}" class="btn btn-primary btn-cart" href="#"> <i class="fas fa-shopping-cart"></i>&nbsp  Buy Now</a>
                                                        @else
                                                            <button style="width: 100%; background-color: darkred; color: white" type="button" class="btn btn-danger" disabled><i class="fas fa-shopping-cart"></i>&nbsp  Stock Out</button>
                                                        @endif
                                                        </div>

                                                    <!-- <div class="product-action-horizontal">
                                                        @if($item->online_payment==1)
                                                       <small class="text-primary font-weight-bold text-uppercase">Payment Only</small>
                                                    @else
                                                    <small class="text-success font-weight-bold text-uppercase">Cash On Delivery</small>
                                                    @endif
                                                    </div> -->
                                                    </figure>
                                                    @if($item->offer_product==1)
                                                    <div hidden class="product-price">
                                                        <ins class="new-price">{{$item->previous_price}}</ins><del class="old-price">{{$item->price}}</del>
                                                    </div>
                                                    <div class="badge-overlay">
                                                        <span class="top-left badge pink">SALE</span>
                                                         </div>
                                                @else
                                                    <div hidden class="product-price">
                                                        <ins class="new-price">{{$item->price}}</ins>
                                                    </div>
                                                @endif
                                                    <div class="product-details">
                                                        <h3 class="product-name mb-1">
    <a href="{{route('product.details',[$item->id, Str::slug($item->name)])}}">{{$item->name}}</a>
                                                        </h3>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                                @if(ceil($item->avg_rating) > 0)
                                                                    <span class="ratings" style="width: 0%;"></span>
                                                                @endif

                                                                @if(ceil($item->avg_rating) == 1)
                                                                    <span class="ratings" style="width: 20%;"></span>
                                                                @endif
                                                                @if(ceil($item->avg_rating) == 2)
                                                                    <span class="ratings" style="width: 40%;"></span>
                                                                @endif
                                                                @if(ceil($item->avg_rating) == 3)
                                                                    <span class="ratings" style="width: 60%;"></span>
                                                                @endif
                                                                @if(ceil($item->avg_rating) == 4)
                                                                    <span class="ratings" style="width: 80%;"></span>
                                                                @endif
                                                                @if(ceil($item->avg_rating) == 5)
                                                                    <span class="ratings" style="width: 100%;"></span>
                                                                @endif
                                                                <!--<span class="tooltiptext tooltip-top"></span>-->
                                                            </div>
                                                            <a href="#" class="rating-reviews">(

                                                                @if ($item->ratings->count()>0)

                                                                    {{$item->ratings->count()}}
                                                                @else
                                                                    0
                                                                @endif
                                                                Reviews
                                                                )</a>
                                                        </div>
                                                        <div class="product-price">
                                                            HK$ <ins class="new-price">{{$item->price}}</ins><del class="old-price">{{$item->previous_price}}</del>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @empty
                                        <p class="text-danger">Product Not found</p>
                                    @endforelse
                                </div>
                                {{ $shopProduct->links() }}
                            </div>


                        <!-- End of Main Content -->

                    <!-- End of Shop Content -->
                </div>
            </div>
        </div>

        {{--Please Wait Modal--}}
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
        </div>
            {{--Please Wait Modal--}}



    </main>
@endsection

@section('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.3.7/jquery.jscroll.min.js"></script>
    <script src="{{asset('frontend/js/shop-products.js')}}"></script>
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
