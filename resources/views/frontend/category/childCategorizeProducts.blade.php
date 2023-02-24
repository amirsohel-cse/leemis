@extends('frontend.master.master')
@section('content')
<head>
    <link rel="stylesheet" type="text/css" href="{{('frontend/assets/css/style.min.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.3.7/jquery.jscroll.min.js"></script>
</head>
<main class="container py-5">



                <div class="infinite-scroll">
                <div class="main-content mt-2">
                    <div  id="brandProductList" class="product-wrapper row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2" id="shops">
                        @forelse ($products as $item)
                        <div class="product-wrap">
                                <div class="product">
                                    <figure class="product-media product-name">
                                        <a href="{{ route('product.details', [$item->id, Str::slug($item->name)]) }}">
                                            <img style="height:200px; width:100%;" src="{{ "/$item->photo" }}"
                                                alt="Product">
                                            <img style="height:200px; width:100%;" src="{{ "/$item->photo" }}"
                                                alt="Product">
                                        </a>
                                        <div class="product-action-vertical">
                                            @if ($item->stock > 0)
                                                <a href="#" data-id="{{ $item->id }}"
                                                    class="btn-product-icon btn-wishlist w-icon-heart"
                                                    title="Add to wishlist"></a>
                                            @endif
                                        </div>

                                        <div class="shopping-action">
                                            @if ($item->stock > 0)
                                                <a style="width:100%" data-id="{{ $item->id }}"
                                                    class="btn btn-primary btn-cart" href="#"><i
                                                        class="las la-shopping-cart"></i> Buy Now</a>
                                            @else
                                                <button style="width: 100%; background-color: darkred; color: white"
                                                    type="button" class="btn btn-danger" disabled><i
                                                        class="las la-shopping-cart"></i>&nbsp
                                                    {{ __('Out of Stock') }}</button>
                                            @endif
                                        </div>
                                    </figure>
                                    <div class="badge-overlay">
                                        <span class="top-left badge pink">{{ __('SALE') }}</span>
                                    </div>
                                    <div class="product-details">

                                        <h4 class="product-title"><a style="font-size: 14px"
                                                href="{{ route('product.details', [$item->id, Str::slug($item->name)]) }}">{{ $item->name }}</a>
                                        </h4>

                                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                                            <div class="product-price">
                                                HK$ @if($item->price == 0)<ins class="new-price">{{ $item->previous_price }}</ins> @else <ins class="new-price">{{ $item->price }}</ins><del class="old-price">{{ $item->previous_price }}</del>@endif
                                            </div>

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
                                                        <span class="ratings" style="width: 100%;"></span>
                                                    @endif

                                                </div>
                                                <a href="#" class="rating-reviews">(

                                                    @if ($item->ratings->count() > 0)
                                                        {{ $item->ratings->count() }}
                                                    @else
                                                        0
                                                    @endif

                                                    )
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                    @empty
                        <div class="product-not-found-wrapper">
                            <i class="las la-frown"></i>
                            <h5 class="product-not-found-title">Product Not Found</h5>
                        </div>
                    @endforelse

                </div>
                {{$products->links() }}

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
