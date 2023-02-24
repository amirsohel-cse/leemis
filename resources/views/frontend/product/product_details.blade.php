@extends('frontend.master.master')
@section('content')

    <main class="main">
        <div class="page-content mt-2">
            <div class="container">
                @if (Session::get('success'))
                    <div class="alert text-white container" style="background: #09c422;">
                        {{ Session::get('success') }}
                    </div>
                @endif
            </div>

            <div class="main-content">
                @forelse ($productDetails as $item)
                    <div class="product product-single" style="background-color: #fff; padding: 20px">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 mb-4 mb-md-8">
                                    <div class="product-gallery product-gallery-sticky">
                                        <div
                                            class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1 gutter-no">
                                            <figure class="product-image">
                                                <img src="{{ "/$item->photo" }}" style="width: 100%; height: 500px"
                                                    data-zoom-image="{{ "/$item->photo" }}"
                                                    alt="Fashion Table Sound Marker">
                                            </figure>
                                            @forelse($item->galleries as $row)
                                                <figure class="product-image">
                                                    <img src="{{ asset('../../uploads/product-gallery/' . $row->image_file) }}"
                                                        data-zoom-image="{{ asset('../../uploads/product-gallery/' . $row->image_file) }}"
                                                        alt="Fashion Table Sound Marker" width="800" height="900">
                                                </figure>
                                            @empty
                                            @endforelse
                                        </div>
                                        <div class="product-thumbs-wrap">
                                            <div class="product-thumbs row cols-4 gutter-sm">
                                                <div class="product-thumb active">
                                                    <img src="{{ "/$item->photo" }}" alt="Product Thumb" width="400"
                                                        height="500">
                                                </div>
                                                @forelse($item->galleries as $row)
                                                    <div class="product-thumb">
                                                        <img src="{{ asset('../../uploads/product-gallery/' . $row->image_file) }}"
                                                            alt="Product Thumb" width="800" height="900">
                                                    </div>
                                                @empty
                                                @endforelse
                                            </div>
                                            <button class="thumb-up disabled"><i class="w-icon-angle-left"></i></button>
                                            <button class="thumb-down disabled"><i class="w-icon-angle-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-6 mb-md-8">
                                    <div class="product-details pt-5 pb-md-5 single-product-details"
                                        data-sticky-options="{'minWidth': 767}">
                                        <h1 class="product-title">{{ $item->name }}</h1>
                                        <div class="product-bm-wrapper">
                                            <figure class="brand">
                                                @if (isset($item->brand->photo))
                                                    <img src="{{ isset($item->brand->photo) ? '/uploads/brand-images/' . $item->brand->photo : '' }}"
                                                        alt="Brand" width="60" height="30" />
                                                @endif
                                            </figure>
                                            <div class="product-meta">
                                                <div class="product-categories font-weight-bold" style="font-size:15px">
                                                    Category:
                                                    <span class="product-category newcustomcolor"><a
                                                            href="{{ route('categorize.product', [$item->categories->id, Str::slug($item->categories->name)]) }}">{{ isset($item->categories->name) ? $item->categories->name : '' }}</a></span>
                                                </div>
                                                <div class="product-sku font-weight-bolder newcustomcolor"
                                                    style="font-size:15px">
                                                    SKU: <span>{{ $item->sku }}</span>
                                                </div>
                                                <div class="product-sku mt-2 font-weight-bolder newcustomcolor"
                                                    style="font-size:15px">
                                                    Stock: <span id="stock"
                                                        data-stock="{{ $item->stock }}">{{ $item->stock }}</span>
                                                </div>

                                                <div class="product-sku mt-2 font-weight-bolder" style="font-size:15px">
                                                    Estimate Shipping Time: {{ $item->ship }}</span>
                                                </div>


                                            </div>

                                        </div>
                                        <hr class="product-divider">
                                        <div class="product-price">

                                            HK$ @if ($item->price == 0)
                                                <ins class="new-price">{{ $item->previous_price }}</ins>
                                            @else
                                                <ins class="new-price">{{ $item->price }}</ins><del
                                                    class="old-price">{{ $item->previous_price }}</del>
                                            @endif
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
                                                Reviews
                                                )
                                            </a>
                                        </div>


                                        <hr class="product-divider">


                                        @php
                                            $specifications = collect($item->product_specification)->groupBy('category_attribute_id');
                                        @endphp

                                        @if ($item->product_specification != null)
                                            @foreach ($specifications as $key => $specification)
                                                @php
                                                    $attribute = \App\Model\CategoryAttribute::find($key);
                                                @endphp

                                                <div class="product-form product-variation-form product-size-swatch">
                                                    <label class="mb-1">{{ $attribute->name }}:</label>
                                                    <div class="flex-wrap d-flex align-items-center product-variations"
                                                        data-specification="{{ $attribute->id }}">
                                                        @foreach ($specification as $spec)
                                                            @php
                                                                $options = \App\Model\AttributeOption::find($spec['attribute']);
                                                            @endphp


                                                            @if ($spec['attribute'] != null)
                                                                <a href="#" data-id="{{ $item->id }}"
                                                                    data-price="{{ $spec['price_attr'] }}"
                                                                    data-qty="{{ $spec['qty_attr'] }}"
                                                                    data-specification="{{ $attribute->id }}"
                                                                    class="size varient"
                                                                    data-option="{{ $options->id }}">{{ $options->option }}</a>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="product-variation-price pvp d-none" style="margin-top: -30px">
                                                Additional Price : <span class="product-price-text-bottom"></span>
                                            </div>
                                        @endif

                                        <div class="fix-bottom ">
                                            <div class="product-form container">
                                                <div class="product-qty-form">
                                                    <div class="row input-group">
                                                        <input class="quantity form-control" id="cart-qty-details"
                                                            type="number" min="1" max="10000000" value="1">
                                                        <button class="quantity-plus w-icon-plus"
                                                            style="border: none !important"></button>
                                                        <button class="quantity-minus w-icon-minus"
                                                            style="border: none !important"></button>
                                                    </div>
                                                </div>

                                                @if ($item->stock > 0)
                                                    <button data-id="{{ $item->id }}"
                                                        class="btn btn-primary btn-buy mr-3" id="buyNowBtn">

                                                        <i class="w-icon-cart"></i>
                                                        <span> {{ 'Buy Now' }}</span>
                                                    </button>
                                                    <button data-id="{{ $item->id }}"
                                                        data-stock="{{ $item->stock }}"
                                                        class="btn btn-primary btn-cart">
                                                        <i class="fas fa-shopping-cart"></i>
                                                        <span>{{ languageChange('Add to Cart') }}</span>
                                                    </button>
                                                @else
                                                    <button data-id="{{ $item->id }}"
                                                        data-stock="{{ $item->stock }}" class="btn btn-danger btn-cart"
                                                        disabled>
                                                        <i class="w-icon-cart"></i>
                                                        <span>Out of stock</span>
                                                    </button>
                                                @endif

                                            </div>

                                            <div class="product-form container">

                                                <ul class="d-flex align-items-center social-share">
                                                    <p style="margin-bottom:0">Share :</p>
                                                    @foreach ($socials as $social)
                                                        <?= $social ?>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @php
                                    $left1 = \App\Model\HeaderText::where('type', '=', 'left1')->first();
                                    if ($left1) {
                                        $left1 = $left1->text;
                                    }
                                    $left2 = \App\Model\HeaderText::where('type', '=', 'left2')->first();
                                    if ($left2) {
                                        $left2 = $left2->text;
                                    }
                                    $right = \App\Model\HeaderText::where('type', '=', 'right')->first();
                                    if ($right) {
                                        $right = $right->text;
                                    }

                                    $right2 = \App\Model\HeaderText::where('type', '=', 'right2')->first();
                                    if ($right2) {
                                        $right2 = $right2->text;
                                    }

                                @endphp
                                <div class="col-md-4">
                                    <div class="widget widget-icon-box mb-6 product-details-widget">
                                        <div class="icon-box icon-box-side text-dark">
                                            <span class="icon-box-icon icon-shipping">
                                                <i class="w-icon-money"></i>
                                            </span>
                                            <div class="icon-box-content">
                                                <h4 class="icon-box-title font-weight-bolder ls-normal"> secure payment
                                                </h4>
                                                <p class="text-default">{{$left1}}</p>
                                            </div>
                                        </div>

                                        <div class="icon-box icon-box-side text-dark">
                                            <span class="icon-box-icon icon-shipping">
                                                <i class="w-icon-bag "></i>
                                            </span>
                                            <div class="icon-box-content">
                                                <h4 class="icon-box-title font-weight-bolder ls-normal">
                                                    Money back Guaranty</h4>
                                                <p class="text-default">{{$left2}}</p>
                                            </div>
                                        </div>

                                        <div class="icon-box icon-box-side text-dark">
                                            <span class="icon-box-icon icon-shipping">
                                                <i class="w-icon-headphone"></i>
                                            </span>
                                            <div class="icon-box-content">
                                                <h4 class="icon-box-title font-weight-bolder ls-normal">
                                                    Customer support</h4>
                                                <p class="text-default">{{$right}}</p>
                                            </div>
                                        </div>

                                        <div class="icon-box icon-box-side text-dark">
                                            <span class="icon-box-icon icon-shipping">
                                                <i class="w-icon-truck"></i>
                                            </span>
                                            <div class="icon-box-content">
                                                <h4 class="icon-box-title font-weight-bolder ls-normal">
                                                    Delivery</h4>
                                                <p class="text-default">{{$right2}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-3 mt-4">
                        <div class="container">
                            <div class="tab tab-nav-boxed tab-nav-underline product-tabs mb-5 p-3">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a href="#product-tab-specification" class="nav-link active p-2">Specification</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#product-tab-description" class="nav-link p-2">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#product-tab-vendor" class="nav-link p-2">Vendor Info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#product-tab-reviews" class="nav-link p-2">Customer Reviews
                                            ({{ count($rating) }})
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="product-tab-specification">
                                        <table class="table product-specification-table">


                                            @if (isset($item->brand->name))
                                                <tr>
                                                    <th style="width:30%">Brand</th>

                                                    <td>{{ $item->brand->name }}</td>

                                                </tr>
                                            @endif


                                            @if ($item->specification != null)
                                                @foreach ($item->specification as $spec)
                                                    <tr>
                                                        <th style="width:30%">{{ $spec['title'] }}</th>

                                                        <td>{{ $spec['details'] }}</td>

                                                    </tr>
                                                @endforeach
                                            @endif


                                        </table>
                                    </div>
                                    <div class="tab-pane" id="product-tab-description">
                                        <div class="row mb-4">
                                            <div class="col-md-8 mb-5">
                                                <p class="mb-4">{!! $item->details !!}</p>
                                                <ul class="list-type-check">
                                                </ul>
                                                <div class="banner banner-video product-video br-xs">
                                                    <figure class="banner-media video-container">
                                                        @if (!empty($item->youtube))
                                                            <iframe
                                                                src="https://www.youtube.com/embed/{{ $item->youtube }}"
                                                                title="YouTube video player" frameborder="0"
                                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                                allowfullscreen></iframe>
                                                        @endif
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="product-tab-vendor">
                                        <div class="tab-vendor mt-4">
                                            <div class="left">
                                                <img src="{{ isset($item->vendor->shop_image) ? asset('/uploads/vendors/' . $item->vendor->shop_image) : '' }}"
                                                    alt="Vendor Banner" class="tab-vendor-logo" />
                                            </div>
                                            <div class="right">
                                                <div class="vendor-user">
                                                    <figure class="vendor-logo mr-4">
                                                        {{-- <a href="#">
                                                    <img
                                                    src="{{isset($item->vendor->shop_image) ? asset('/uploads/vendors/'.$item->vendor->shop_image) : ''}}"
                                                    alt="Vendor Logo" width="80" height="80"/>
                                                    </a> --}}
                                                    </figure>
                                                    <div>
                                                    </div>
                                                </div>
                                                <ul class="vendor-info list-style-none">
                                                    <li class="store-name">
                                                        <h3 style="line-height:0" class="detail">
                                                            {{ $item->vendor->shop_name }}</h3>
                                                    </li>

                                                </ul>
                                                <a href="{{ route('shop.product', [$item->vendor->id, Str::slug($item->vendor->shop_name)]) }}"
                                                    class="btn btn-dark btn-link btn-underline btn-icon-right">Visit
                                                    Store<i class="w-icon-long-arrow-right"></i></a>
                                            </div>
                                        </div>

                                        <!--<div class="row mb-3">-->
                                        <!--    <div class="col-md-4 mb-4">-->
                                        <!--        <figure class="vendor-banner br-sm">-->
                                        <!--            <img src="{{ isset($item->vendor->shop_image) ? asset('/uploads/vendors/' . $item->vendor->shop_image) : '' }}"-->
                                        <!--                alt="Vendor Banner" width="300" height="295"-->
                                        <!--                style="background-color: #353B55;" />-->
                                        <!--        </figure>-->
                                        <!--    </div>-->
                                        <!--    <div class="col-md-6 pl-2 pl-md-6 mb-4">-->
                                        <!--        <div class="vendor-user">-->
                                        <!--            <figure class="vendor-logo mr-4">-->
                                        <!--                {{-- <a href="#">-->
                                <!--                    <img-->
                                <!--                    src="{{isset($item->vendor->shop_image) ? asset('/uploads/vendors/'.$item->vendor->shop_image) : ''}}"-->
                                <!--                    alt="Vendor Logo" width="80" height="80"/>-->
                                <!--                    </a> --}}-->
                                        <!--            </figure>-->
                                        <!--            <div>-->
                                        <!--            </div>-->
                                        <!--        </div>-->
                                        <!--        <ul class="vendor-info list-style-none"> <br><br>-->
                                        <!--            <li class="store-name">-->
                                        <!--                <h3 style="line-height:0" class="detail">-->
                                        <!--                    {{ $item->vendor->shop_name }}</h3>-->
                                        <!--            </li>-->

                                        <!--        </ul>-->
                                        <!--        <a href="{{ route('shop.product', [$item->vendor->id, Str::slug($item->vendor->shop_name)]) }}"-->
                                        <!--            class="btn btn-dark btn-link btn-underline btn-icon-right">Visit-->
                                        <!--            Store<i class="w-icon-long-arrow-right"></i></a>-->
                                        <!--    </div>-->
                                        <!--</div>-->

                                    </div>
                                    <?php
                                    $star1 = $item->ratings
                                        ->where('product_id', $item->id)
                                        ->where('rating', 1)
                                        ->count();

                                    $star2 = $item->ratings
                                        ->where('product_id', $item->id)
                                        ->where('rating', 2)
                                        ->count();
                                    $star3 = $item->ratings
                                        ->where('product_id', $item->id)
                                        ->where('rating', 3)
                                        ->count();
                                    $star4 = $item->ratings
                                        ->where('product_id', $item->id)
                                        ->where('rating', 4)
                                        ->count();
                                    $star5 = $item->ratings
                                        ->where('product_id', $item->id)
                                        ->where('rating', 5)
                                        ->count();

                                    $tot_stars = $star1 + $star2 + $star3 + $star4 + $star5;
                                    if ($tot_stars > 0) {
                                        $ar = 1 * $star1 + 1 * $star2 + 1 * $star3 + 1 * $star4 + (1 * $star5) / 5;
                                    } else {
                                        $ar = 0;
                                    }

                                    ?>


                                    <div class="tab-pane" id="product-tab-reviews">
                                        <div class="row mb-4">
                                            <div class="col-xl-4 col-lg-5 mb-4">
                                                <div class="ratings-wrapper">
                                                    <div class="avg-rating-container">
                                                        <!--<h4 class="avg-mark font-weight-bolder ls-50">{{ $ar }}</h4>-->
                                                        <div class="avg-rating">
                                                            <p class="text-dark mb-1">Average Rating</p>
                                                            <div class="ratings-container">
                                                                <a href="#"
                                                                    class="rating-reviews">({{ count($item->ratings) }}
                                                                    Reviews)</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ratings-value d-flex align-items-center text-dark ls-25">
                                                        <span class="text-dark font-weight-bold"></span>Rating by
                                                        Stars<span class="count"></span>
                                                    </div>
                                                    <div class="rating-overview-area">
                                                        <?php

                                                        for ($i = 1; $i <= 5; ++$i) {
                                                            $var = "star$i";
                                                            $count = $$var;
                                                            if ($tot_stars > 0) {
                                                                $percent = ($count * 100) / $tot_stars;
                                                            } else {
                                                                $percent = 0;
                                                            }

                                                            for ($j = 1; $j <= 5; ++$j) {
                                                                echo $j <= $i ? '<i class="fas fa-star"></i>' : '  ';
                                                            }
                                                            printf("\t%2d (%5.2f%%)\n <p></p>", $count, $percent, 2);
                                                        }

                                                        ?>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-xl-8 col-lg-7 mb-4">
                                                @if (Auth::check())
                                                    <div class="review-form-wrapper">
                                                        <h3 class="title tab-pane-title font-weight-bold mb-1">Submit Your
                                                            Review</h3>
                                                        <p class="mb-3">Your email address will not be published.
                                                            Required
                                                            fields are marked *</p>
                                                        <form action="{{ route('productrating') }}" method="POST"
                                                            class="review-form">
                                                            @csrf
                                                            <div class="rating-form">
                                                                <label for="rating">Your Rating Of This Product :
                                                                </label>
                                                                <span class="ratingt-stars">
                                                                    <a class="star1" id="a">⭐ |</a>
                                                                    <a class="star2" id="b">⭐⭐ |</a>
                                                                    <a class="sta-3" id="c">⭐⭐⭐ |</a>
                                                                    <a class="sta-4" id="d">⭐⭐⭐⭐ |</a>
                                                                    <a class="star5" id="e">⭐⭐⭐⭐⭐ |</a>


                                                                </span>
                                                                <input type="hidden" id="rat" name="rating">
                                                                <input type="hidden" value="{{ $item->id }}"
                                                                    name="product_id">


                                                            </div>
                                                            <textarea cols="30" rows="6" name="review" placeholder="Write Your Review Here..." class="form-control"
                                                                id="review" required></textarea>
                                                            <div class="row gutter-md mt-2">
                                                                <div class="col-md-6">
                                                                    <input type="hidden" class="form-control mb-2"
                                                                        name="name" value="{{ auth()->user()->name }}"
                                                                        placeholder="Your Name" id="author">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="hidden" class="form-control"
                                                                        name="email"
                                                                        value="{{ auth()->user()->email }}"
                                                                        id="email_1">
                                                                </div>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary mt-5">Submit
                                                                Review
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <a href="/login" style="margin: 15rem"
                                                        class="btn btn-primary btn-lg">Log in
                                                        First</a>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
                                            <h4>Reviews</h4>
                                            <hr>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="show-all">
                                                    <ul class="comments list-style-none">
                                                        @forelse ($item->ratings as $r)
                                                            <li class="comment">
                                                                <div class="comment-body">
                                                                    <div class="comment-content">
                                                                        <h4 class="comment-author">
                                                                            <h5 class="text-info">{{ $r->name }}
                                                                                <br><small
                                                                                    class="text-dark">{{ $r->created_at->format('d-m-y') }}</small>
                                                                            </h5>
                                                                        </h4>
                                                                        <div class="ratings-container comment-rating">
                                                                            <div class="ratings-container">
                                                                                <div class="ratings-full">
                                                                                    @if (ceil($r->rating) > 0)
                                                                                        <span class="ratings"
                                                                                            style="width: 0%;"></span>
                                                                                    @endif

                                                                                    @if (ceil($r->rating) == 1)
                                                                                        <span class="ratings"
                                                                                            style="width: 20%;"></span>
                                                                                    @endif
                                                                                    @if (ceil($r->rating) == 2)
                                                                                        <span class="ratings"
                                                                                            style="width: 40%;"></span>
                                                                                    @endif
                                                                                    @if (ceil($r->rating) == 3)
                                                                                        <span class="ratings"
                                                                                            style="width: 60%;"></span>
                                                                                    @endif
                                                                                    @if (ceil($r->rating) == 4)
                                                                                        <span class="ratings"
                                                                                            style="width: 80%;"></span>
                                                                                    @endif
                                                                                    @if (ceil($r->rating) == 5)
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
                                                                        </div>
                                                                        <p>{{ $r->review }}</p>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                        @empty
                                                        @endforelse

                                                    </ul>
                                                </div>
                                            </div>
                                        @empty
                                            <p>Not Found</p>
                @endforelse
            </div>
        </div>
        </div>
        </div>
        </div>
        </div>

        <section class="related-product-section py-5">
            <div class="container">
                <div class="title-link-wrapper mb-4">
                    <h4 class="title">Related Products</h4>
                    <a href="{{ isset($productDetails[0]->categories->id) ? route('categorize.product', [$productDetails[0]->categories->id, Str::slug($productDetails[0]->categories->name)]) : '#' }}"
                        class="btn btn-dark btn-link btn-slide-right btn-icon-right">More
                        Products<i class="w-icon-long-arrow-right"></i></a>
                </div>
                <div class="owl-carousel owl-theme row cols-lg-3 cols-md-4 cols-sm-3 cols-2"
                    data-owl-options="{
                                                            'nav': false,
                                                            'dots': false,
                                                            'margin': 20,
                                                            'responsive': {
                                                            '0': {
                                                            'items': 2
                                                            },
                                                            '576': {
                                                            'items': 3
                                                            },
                                                            '768': {
                                                            'items': 4
                                                            },
                                                            '992': {
                                                            'items': 5
                                                            }
                                                            }
                                                            }">
                    @forelse($categoryProducts as $item)
                        <div class="product">
                            <figure class="product-media">
                                <a href="{{ route('product.details', [$item->id, Str::slug($item->name)]) }}">
                                    <img style="height:200px;width:200px;" src="{{ "/$item->photo" }}" alt="Product"
                                        width="300" height="338">
                                    <img style="height:200px;width:200px;" src="{{ "/$item->photo" }}" alt="Product"
                                        width="300" height="338">
                                </a>
                                <div class="product-action-vertical">
                                    {{-- <a href="#" data-id="{{$item->id}}" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a> --}}
                                    @if ($item->stock > 0)
                                        <a href="#" data-id="{{ $item->id }}"
                                            class="btn-product-icon btn-wishlist w-icon-heart"
                                            title="Add to wishlist"></a>
                                    @endif
                                </div>
                                <div class="shopping-action">
                                    @if ($item->stock > 0)
                                        <a style="width:100%" data-id="{{ $item->id }}"
                                            class="btn btn-primary btn-cart" href="#"> <i
                                                class="fas fa-shopping-cart"></i>&nbsp Buy Now</a>
                                    @else
                                        <button style="width: 100%; background-color: darkred; color: white"
                                            type="button" class="btn btn-danger" disabled><i
                                                class="fas fa-shopping-cart"></i>&nbsp Out of
                                            Stock</button>
                                    @endif
                                </div>
                                <!-- <div class="product-action-horizontal">
                                                                                @if ($item->online_payment == 1)
    <small class="text-primary font-weight-bold text-uppercase">Payment Only</small>
@else
    <small class="text-success font-weight-bold text-uppercase">Cash On Delivery</small>
    @endif
                                                                            </div> -->
                            </figure>
                            @if ($item->offer_product == 1)
                                <div class="badge-overlay">
                                    <span class="top-left badge pink">SALE</span>
                                </div>
                            @endif

                            <div class="product-details">
                                <h4 class="product-name mb-1"><a
                                        href="{{ route('product.details', [$item->id, Str::slug($item->name)]) }}">{{ $item->name }}</a>
                                </h4>
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
                                    <ins class="new-price">HK$ {{ $item->price }}</ins><del class="old-price">HK$
                                        {{ $item->previous_price }}</del>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </section>
        </div>

        <!-- End of Main Content -->
        <!-- <aside class="product-sidebar sidebar-fixed right-sidebar bg-white sticky-sidebar-wrapper">
                                                    <div class="sidebar-overlay"></div>
                                                    <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                                                    <a href="#" class="sidebar-toggle d-flex d-lg-none"><i class="fas fa-chevron-left"></i></a>
                                                    <div class="sidebar-content scrollable">
                                                        <div class="sticky-sidebar">
                                                            <div class="widget widget-icon-box mb-6">
                                                                <div class="icon-box icon-box-side text-dark">
                                                                    <span class="icon-box-icon icon-shipping">
                                                                        <i class=w-icon-money "></i>
                                                                    </span>
                                                                    <div class=" icon-box-content">
                                                                        <h4 class="icon-box-title font-weight-bolder ls-normal"> {{ isset($services[0]) ? $services[0]->title : 'Not Found' }}</h4>
                                                                        <p class="text-default"> {{ isset($services[0]) ? $services[0]->details : 'Not Found' }}</p>
                                                                    </div>
                                                                </div>

                                                                <div class="icon-box icon-box-side text-dark">
                                                                    <span class="icon-box-icon icon-shipping">
                                                                        <i class="w-icon-bag "></i>
                                                                    </span>
                                                                    <div class="icon-box-content">
                                                                        <h4 class="icon-box-title font-weight-bolder ls-normal">
                                                                            {{ isset($services[1]) ? $services[1]->title : 'Not Found' }}</h4>
                                                                        <p class="text-default">{{ isset($services[1]) ? $services[1]->details : 'Not Found' }}</p>
                                                                    </div>
                                                                </div>

                                                                <div class="icon-box icon-box-side text-dark">
                                                                    <span class="icon-box-icon icon-shipping">
                                                                        <i class="w-icon-headphone"></i>
                                                                    </span>
                                                                    <div class="icon-box-content">
                                                                        <h4 class="icon-box-title font-weight-bolder ls-normal">
                                                                            {{ isset($services[2]) ? $services[2]->title : 'Not Found' }}</h4>
                                                                        <p class="text-default">{{ isset($services[2]) ? $services[2]->details : 'Not Found' }}</p>
                                                                    </div>
                                                                </div>

                                                                <div class="icon-box icon-box-side text-dark">
                                                                    <span class="icon-box-icon icon-shipping">
                                                                        <i class="w-icon-truck"></i>
                                                                    </span>
                                                                    <div class="icon-box-content">
                                                                        <h4 class="icon-box-title font-weight-bolder ls-normal">
                                                                            {{ isset($services[3]) ? $services[3]->title : 'Not Found' }}</h4>
                                                                        <p class="text-default">{{ isset($services[3]) ? $services[3]->details : 'Not Found' }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @forelse ($banner as $item)
    <div class="widget widget-banner mb-2">
                                                                    <div class="banner banner-fixed br-sm">
                                                                        <figure>
                                                                            <img src="{{ url("storage/advertise/$item->image_file") }}" width="240" height="260"
                                                                                style="background-color: #7def78;" />
                                                                        </figure>

                                                                    </div>
                                                                </div>
                        @empty
                                                                <p>Not Found</p>
    @endforelse
                                                        </div>
                                                    </div>
                                                </aside> -->
        </div>
    </main>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {

            $("#a").on('click', function() {
                $("#rat").val(1);
                $("#b").hide();
                $("#c").hide();
                $("#d").hide();
                $("#e").hide();
            })

            $("#b").on('click', function() {
                $("#rat").val(2);
                $("#a").hide();
                $("#c").hide();
                $("#d").hide();
                $("#e").hide();
            })

            $("#c").on('click', function() {
                $("#rat").val(3);
                $("#b").hide();
                $("#a").hide();
                $("#d").hide();
                $("#e").hide();
            })

            $("#d").on('click', function() {
                $("#rat").val(4);
                $("#b").hide();
                $("#c").hide();
                $("#a").hide();
                $("#e").hide();
            })

            $("#e").on('click', function() {
                $("#rat").val(5);
                $("#b").hide();
                $("#c").hide();
                $("#a").hide();
                $("#d").hide();
            })
        });
    </script>
    <script>
        $(".alert:not(.not_hide)").delay(5000).slideUp(500, function() {
            $(this).alert('close');
        });
    </script>
@endsection

@section('page-scripts')
    <script>
        $(document).ready(function() {


            let initialValue = 0;




            $('.varient').on('click', function() {

                let specification = [];

                let price = [];


                let main = $(this).data('price')

                price.push(main)

                $('.varient').not(this).removeClass('active');



                let data = {
                    attribute: $(this).data('specification'),
                    option: $(this).data('option')
                }



                specification.push(data)



                const total = price.reduce(
                    (previousValue, currentValue) => previousValue + currentValue,
                    initialValue
                );


                $('.quantity').val(1);



                $('.btn-cart').attr('data-additional_price', total)
                $('.btn-cart').attr('data-specification', JSON.stringify(specification))



                $('#buyNowBtn').attr('data-additional_price', total)
                $('#buyNowBtn').attr('data-specification', JSON.stringify(specification))



                $('.product-price-text-bottom').text(total);

                $('.product-variation-price').removeClass('d-none');


            })


            $('#buyNowBtn').on('click', function() {

                if ($('#userId').val() == '') {
                    toastr.options = {
                        "timeOut": "3000",
                        "closeButton": true,
                    };
                    toastr['error']('You have to login first!!!');

                    window.location.href = "/login";
                }



                let userId = $('#userId').val();

                let qty = 1;

                if ($('#productQty').val()) {
                    qty = $('#productQty').val();
                }


                if ($('#stock').data('stock') < qty) {
                    toastr.options = {
                        "timeOut": "3000",
                        "closeButton": true,
                    };
                    toastr['error']('You can not add Product More than Stock');

                    return false;
                }

                let varient = $(this).data('specification') ?? []
                let atrribute = [];
                let option = [];
                for (let index = 0; index < varient.length; index++) {


                    atrribute.push(varient[index]['attribute'])
                    option.push(varient[index]['option'])

                }

                let productId = $(this).attr('data-id');

                if (varient) {
                    window.location.replace(
                        `/singlecheckout/${qty}/${productId}?attribute=${atrribute.toString()}&option=${option.toString()}`
                        );
                } else {
                    window.location.replace(`/singlecheckout/${qty}/${productId}`);
                }

            });
        });
    </script>

    <script>
        $(function() {

            $('.quantity-plus').on('click', function() {
                let a = $('.quantity').val();
                if ($('.varient').hasClass('active')) {


                    if (a >= $('.varient.active').data('qty')) {
                        toastr.options = {
                            "timeOut": "3000",
                            "closeButton": true,
                        };
                        toastr['error']('Quantity not avilable');
                        return
                    }

                }
                $('.quantity').val(parseInt(a) + 1);
                $('#productQty').val($('.quantity').val());
            });


            $('#cart-qty-details').on('keyup', function() {

                let a = $(this).val();


                if ($('.varient').hasClass('active')) {

                    if (a > $('.varient.active').data('qty')) {
                        toastr.options = {
                            "timeOut": "3000",
                            "closeButton": true,
                        };
                        toastr['error']('Quantity not avilable');
                        return
                    }

                }
            })

            $('.quantity-minus').on('click', function() {
                let a = $('.quantity').val();
                if (parseInt(a) > 1) {
                    $('.quantity').val(parseInt(a) - 1);
                }
                $('#productQty').val($('.quantity').val());
            });

            $('.quantity').on('change', function() {
                if ($(this).val() < 1) {
                    $(this).val(1);
                }
                $('#productQty').val($('.quantity').val());
            });

        });
    </script>
@endsection
