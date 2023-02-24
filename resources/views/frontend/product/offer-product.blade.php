@extends('frontend.master.master')
@section('content')

    <head>
        <link rel="stylesheet" type="text/css" href="{{ 'frontend/assets/css/style.min.css' }}">

    </head>
    <main class="mains checkouts">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-navs">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li class="passed"><a href="/">Home</a></li>
                    <li class="active"><a href="#">Flash Sale</a></li>
                </ul>
            </div>
        </nav>
        <div class="page-content">
            <div class="container">
                <div class="shop-content gutter-lg">
                    <div class="row">
                        <div class="col-lg-3">
                            <aside class="sidebar shop-sidebar sticky-sidebar-wrapper sidebar-fixed">
                                <div class="sidebar-overlay"></div>
                                <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                                <div class="sidebar-content scrollable">
                                    <div class="sticky-sidebar">
                                        <div class="filter-actions">
                                            <label>Filter :</label>
                                            <a href="#" class="btn btn-dark btn-link filter-clean">Clean All</a>
                                        </div>
                                        <div class="widget widget-collapsible">
                                            <h3 class="widget-title"><span>All Categories</span></h3>
                                            <ul class="widget-body filter-items search-ul">
                                                @forelse($categories as $category)
                                                    <li><a data-id="{{ $category->id }}" class="product_category1"
                                                            href="#">{{ $category->name }}</a></li>
                                                @empty
                                                @endforelse
                                            </ul>
                                        </div>
                                        <div class="widget widget-collapsible">
                                            <h3 class="widget-title"><span>New Arrivals</span></h3>
                                            <div class="widget-body">
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input checkBoxFilter" id="arrival1" value="7">
                                                    <label class="form-check-label" for="arrival1">Last 7 Days</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input checkBoxFilter" id="arrival2" value="10">
                                                    <label class="form-check-label" for="arrival2">Last 10 Days</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input checkBoxFilter" id="arrival3" value="15">
                                                    <label class="form-check-label" for="arrival3">Last 15 Days</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input checkBoxFilter" id="arrival4" value="20">
                                                    <label class="form-check-label" for="arrival4">Last 20 Days</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input checkBoxFilter" id="arrival5" value="30">
                                                    <label class="form-check-label" for="arrival5">Last 30 Days</label>
                                                </div>
                                            </div>
                                        </div>
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
                                                        placeholder="$min"><span class="delimiter">-</span><input
                                                        type="number" name="max_price" class="max_price text-center"
                                                        placeholder="$max">
                                                    <a href="#" class="btn btn-primary btn-rounded goBtn">Go</a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                        </div>
                        <div class="col-lg-9">
                            <div class="infinite-scroll">

                                <div style="padding-left:0;padding-right:0;margin-left:-3px;margin-right:0"
                                    class="product-wrapper row col-md-12 col-sm-12 col-12 " id="all_products">
                                    @forelse ($offer_product as $item)
                                        <div class="col-md-3 col-sm-4 col-6  single-offer-product">

                                            <div class="product-wrap ">
                                                <div class="product border">
                                                    <figure class="product-media">
                                                        <a
                                                            href="{{ route('product.details', [$item->id, Str::slug($item->name)]) }}">
                                                            <img style="height:200px; width:100%;"
                                                                src="{{ "/$item->photo" }}" alt="Product">
                                                            <img style="height:200px; width:100%;"
                                                                src="{{ "/$item->photo" }}" alt="Product">
                                                        </a>
                                                        @if ($item->stock > 0)
                                                            <div class="product-action-vertical">
                                                                <a href="#" data-id="{{ $item->id }}"
                                                                    class="btn-product-icon btn-wishlist w-icon-heart"
                                                                    title="Add to wishlist"></a>
                                                            </div>
                                                        @endif

                                                        <div class="shopping-action">
                                                            @if ($item->stock > 0)
                                                                <a style="width:100%" data-id="{{ $item->id }}"
                                                                    class="btn btn-primary btn-cart" href="#"> <i
                                                                        class="fas fa-shopping-cart"></i>&nbsp Buy Now</a>
                                                            @else

                                                                <button
                                                                    style="width: 100%; background-color: darkred; color: white"
                                                                    type="button" class="btn btn-danger" disabled><i
                                                                        class="fas fa-shopping-cart"></i>&nbsp Out of
                                                                    Stock</button>
                                                            @endif
                                                        </div>


                                                    </figure>
                                                    <div class="badge-overlay">
                                                        <span class="top-left badge pink">SALE</span>
                                                    </div>
                                                    <div class="product-details">
                                                        <h3 class="product-name mb-1">
                                                            <a
                                                                href="{{ route('product.details', [$item->id, Str::slug($item->name)]) }}">{{ $item->name }}</a>
                                                        </h3>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                                @if (ceil($item->avg_rating) > 0)
                                                                    <span class="ratings" style="width: 0%;"></span>
                                                                @endif

                                                                @if (ceil($item->avg_rating) == 1)
                                                                    <span class="ratings" style="width: 20%;"></span>
                                                                @endif
                                                                @if (ceil($item->avg_rating) == 2)
                                                                    <span class="ratings" style="width: 40%;"></span>
                                                                @endif
                                                                @if (ceil($item->avg_rating) == 3)
                                                                    <span class="ratings" style="width: 60%;"></span>
                                                                @endif
                                                                @if (ceil($item->avg_rating) == 4)
                                                                    <span class="ratings" style="width: 80%;"></span>
                                                                @endif
                                                                @if (ceil($item->avg_rating) == 5)
                                                                    <span class="ratings"
                                                                        style="width: 100%;"></span>
                                                                @endif
                                                                <!--<span class="tooltiptext tooltip-top"></span>-->
                                                            </div>
                                                            <a href="#" class="rating-reviews">(

                                                                @if ($item->ratings->count() > 0)
                                                                    {{ $item->ratings->count() }}
                                                                @else
                                                                    0
                                                                @endif

                                                                Reviews
                                                                )
                                                            </a>
                                                        </div>
                                                        <div class="product-price">
                                                            HK$ <ins class="new-price">{{ $item->price }}</ins><del
                                                                class="old-price">{{ $item->previous_price }}</del>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @empty
                                        <p class="text-danger">Product Not found</p>
                                    @endforelse
                                </div>
                                {{ $offer_product->links() }}
                            </div>

                            <!-- End of Main Content -->
                        </div>
                    </div>
                </div>
                <!-- End of Shop Content -->
            </div>
        </div>

        {{-- Please wait modal --}}
        <div class="modal fade bd-example-modal-sm" id="pleaseWaitModal" tabindex="-1" role="dialog"
            aria-labelledby="pleaseWaitModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content m-0 p-0 text-center"
                    style="background-color: transparent !important; border: none !important;">
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
            {{-- Please wait modal end --}}
    </main>
@endsection

@section('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.3.7/jquery.jscroll.min.js"></script>
    <script src="{{ asset('/frontend/js/offer-product.js') }}"></script>
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
