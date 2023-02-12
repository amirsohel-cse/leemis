@extends('frontend.master.master')
@section('content')
<head>
    <link rel="stylesheet" type="text/css" href="{{('frontend/assets/css/style.min.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.3.7/jquery.jscroll.min.js"></script>
</head>
<main class="container py-5">

<div class="title-link-wrapper title-deals mb-4">
    <h2 class="title title-link">{{$productByBrand[0] ? $productByBrand[0]->brand->name : "No Products Available"}}</h2>
    <div
        class="product-countdown-container font-size-sm text-white align-items-center mr-auto">

    </div>
    <a href="/" class="ls-normal">Back<i class="w-icon-long-arrow-left"></i></a>
</div>
                <div class="infinite-scroll">
                <div class="main-content mt-2">
                    <input type="text" id="brandId" value="{{isset($productByBrand[0]->brand_id) ? $productByBrand[0]->brand_id : ''}}" hidden>
                    <div  id="brandProductList" class="product-wrapper row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2" id="shops">
                    @forelse ($productByBrand as $item)
                        <div class="product-wrap">
                            <div class="product border">
                                <figure class="product-media">
                                    <a href="{{route('product.details',[$item->id, Str::slug($item->name)])}}">
                                        <img style="height:200px; width:200px;" src="{{"/$item->photo"}}" alt="Product">
                                        <img style="height:200px; width:200px;" src="{{"/$item->photo"}}" alt="Product">
                                    </a>
                                    @if($item->stock > 0)
                                    <div class="product-action-vertical">
                                       <a href="#" data-id="{{$item->id}}" class="btn-product-icon btn-wishlist w-icon-heart"
                           title="Add to wishlist"></a>
                           
                                    </div>
                                    @endif
                                    
                                    <!-- <div class="product-action-horizontal">    
                                        @if($item->online_payment==1)                   
                                    <small class="text-primary font-weight-bold text-uppercase">Payment Only</small>                                                                  
                                    @else
                                    <small class="text-success font-weight-bold text-uppercase">Cash On Delivery</small>
                                    @endif
                                    </div> -->
                                    <div class="shopping-action">
                                        @if($item->stock > 0)
                                            <a style="width:100%" data-id="{{$item->id}}" class="btn btn-primary btn-cart" href="#"> <i class="fas fa-shopping-cart"></i>&nbsp  Buy Now</a>
                                        @else
                                            <button style="width: 100%; background-color: darkred; color: white" type="button" class="btn btn-danger" disabled><i class="fas fa-shopping-cart"></i>&nbsp  Out of Stock</button>
                                        @endif
                                    </div>
                                    
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a href="{{route('product.details',[$item->id, Str::slug($item->name)])}}">{{$item->name}}</a></h4>
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
                                        TK <ins class="new-price">{{$item->price}}</ins><del class="old-price">{{$item->previous_price}}</del>
                                    </div>
                            </div>

                            </div>
                        </div>

                    @empty
                        <div class="no-product-wrapper">
                            <i class="far fa-sad-tear"></i>
                            <h4>No product Found</h4>
                        </div>
                    @endforelse

                </div>
                {{$productByBrand->links() }}

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
{{--    <script src="{{asset('frontend/js/brand-product.js')}}"></script>--}}
@endsection
