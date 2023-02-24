@extends('frontend.master.master')
@section('content')

<Style>

.btn-product-icon:hover, .btn-product-icon:active {
    border-color: #fd3d11 !important;
    color: #fff !important;
    background-color: #fd3d11 !important;
}
</Style>

    <head>
        <link rel="stylesheet" type="text/css" href="{{('frontend/assets/css/style.min.css')}}">

    </head>
    <main class="mains checkouts mt-5">
        <div class="page-content">
            <div class="container">
                <div class="shop-content row gutter-lg">
                    <!-- <div class="filter-mb">
                        <div class="widget widget-collapsible mb-2">
                            <h3 style="border: 1px solid #fd3d11;" class="widget-title m-4 p-3 collapsed"><span class="m-3">All Categories &nbsp</span></h3>
                            <ul class="widget-body filter-items search-ul m-3" style="display: none">
                                @forelse($categories as $category)
                                <li><a data-id="{{$category->id}}" class="product_category1" href="#">{{$category->name}}</a></li>
                                @empty
                                @endforelse
                            </ul>
                        </div>

                        <div class="widget widget-collapsible">
                            <h3 style="border: 1px solid #fd3d11;" class="widget-title m-4 p-3 collapsed"><span class="m-3">Price &nbsp</span></h3>
                            <div class="widget-body m-3" style="display: none">
                                <ul class="filter-items search-ul" id="priceUl">
                                    <li><a href="#">HK$. 0 - 500</a></li>
                                    <li><a href="#">HK$. 500 - 1000</a></li>
                                    <li><a href="#">HK$. 1000 - 2000</a></li>
                                    <li><a href="#">HK$. 2000 - 3000</a></li>
                                    <li><a href="#">HK$. 3000 - 4000</a></li>
                                    <li><a href="#">HK$. 4000 - 5000</a></li>
                                    <li><a href="#">HK$. 5001 +</a></li>
                                </ul>
                                <form class="price-range">
                                    <input type="number" name="min_price" class="min_price text-center"
                                        placeholder="$min"><span class="delimiter">-</span><input
                                        type="number" name="max_price" class="max_price text-center"
                                        placeholder="$max"><a href="#"
                                        class="btn btn-primary btn-rounded goBtn">Go</a>
                                </form>
                            </div>
                        </div>
                    </div><br> -->

                    <div class="col-lg-3">
                        <aside class="sidebar shop-sidebar sticky-sidebar-wrapper sidebar-fixed">
                            <div class="sidebar-overlay"></div>
                            <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                            <div class="sidebar-content scrollable">
                                <div class="sticky-sidebar">
                                    <div class="filter-actions">
                                        <label>Filter :</label>

                                    </div>
                                    <div class="widget widget-collapsible">
                                        <h3 class="widget-title"><span>All Categories</span></h3>
                                        <ul class="widget-body filter-items search-ul">
                                            @forelse($categories as $category)
                                                <li><a data-id="{{$category->id}}" class="product_category1" href="#">{{$category->name}}</a></li>
                                            @empty
                                            @endforelse
                                        </ul>
                                    </div>
                                    {{-- <div class="widget widget-collapsible">
                                        <h3 class="widget-title"><span>New Arrivals</span></h3>
                                        <div class="widget-body">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="arrival1">
                                                <label class="form-check-label" for="arrival1">Last 7 Days</label>
                                            </div>
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="arrival2">
                                                <label class="form-check-label" for="arrival2">Last 10 Days</label>
                                            </div>
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="arrival3">
                                                <label class="form-check-label" for="arrival3">Last 15 Days</label>
                                            </div>
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="arrival4">
                                                <label class="form-check-label" for="arrival4">Last 20 Days</label>
                                            </div>
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="arrival5">
                                                <label class="form-check-label" for="arrival5">Last 30 Days</label>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="widget widget-collapsible">
                                        <h3 class="widget-title"><span>Price</span></h3>
                                        <div class="widget-body">
                                            <ul class="filter-items search-ul" id="priceUl">
                                                <li><a href="#">HK$. 0 - 500</a></li>
                                                <li><a href="#">HK$. 500 - 1000</a></li>
                                                <li><a href="#">HK$. 1000 - 2000</a></li>
                                                <li><a href="#">HK$. 2000 - 3000</a></li>
                                                <li><a href="#">HK$. 3000 - 4000</a></li>
                                                <li><a href="#">HK$. 4000 - 5000</a></li>
                                                <li><a href="#">HK$. 5001 +</a></li>
                                            </ul>
                                            <form class="price-range">
                                                <input type="number" name="min_price" class="min_price text-center"
                                                    placeholder="min ৳"><span class="delimiter">-</span><input
                                                    type="number" name="max_price" class="max_price text-center"
                                                    placeholder="max ৳">
                                                    <a href="#" class="btn btn-primary btn-rounded goBtn">Go</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>

                    <div class="col-lg-9">
                        <div  class="infinite-scroll">
                            <div style="padding-right:0;padding-left:0" class="product-wrapper row" id="all_products">
                                    @forelse ($product as $item)
                                        <div class="col-md-3 col-sm-4 col-6">
                                            <div class="product-wrap">
                                                <div  class="product">
                                                    <figure class="product-media">
                                                        <a href="{{route('product.details',[$item->id, Str::slug($item->name)])}}">
                                                            <img style="height:200px; width:100%;" src="{{"/$item->photo"}}"  >
                                                            <img style="height:200px; width:100%;" src="{{"/$item->photo"}}" >
                                                        </a>
                                                        <div class="product-action-vertical">
                                                            @if($item->stock > 0)
                                                                <a href="#" data-id="{{$item->id}}" class="btn-product-icon btn-wishlist w-icon-heart"
                                                                title="Add to wishlist"></a>
                                                            @endif
                                                        </div>
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
                                                                <button style="width: 100%; background-color: darkred; color: white" type="button" class="btn btn-danger" disabled><i class="fas fa-shopping-cart"></i>&nbsp  Stock Out</button>
                                                            @endif
                                                        </div>
                                                    </figure>
                                                    <div class="product-details">
                                                        <h3 class="product-name">
                                                            <a href="{{route('product.details',[$item->id, Str::slug($item->name)])}}">{{$item->name}}</a>
                                                        </h3>
                                                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                                                            <div class="product-price">
                                                                HK$ <ins class="new-price">{{$item->price}}</ins><del class="old-price">{{$item->previous_price}}</del>
                                                            </div>
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
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-lg-12">
                                            <p class="text-danger">Product Not found</p>
                                        </div>
                                    @endforelse
                            </div>
                            {{ $product->links() }}
                        </div>
                    </div>
                    <!-- End of Main Content -->
                </div>
                <!-- End of Shop Content -->
            </div>
        </div>

        {{--    Please wait modal--}}
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
        {{--    Please wait modal end--}}
    </main>

@endsection

@section('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.3.7/jquery.jscroll.min.js"></script>
    <script src="{{asset('/frontend/js/all-products.js')}}"></script>
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
