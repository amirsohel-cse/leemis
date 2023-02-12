@php
    $orders = \App\Model\VendorNotification::where('vendor_id',\Illuminate\Support\Facades\Auth::id())
                            ->whereNull('read_at')->get();
@endphp

<!-- Page top navbar -->
<nav class="navbar navbar-fixed-top mb-5">
    <div class="container-fluid">
        <div class="navbar-left">

            <div class="navbar-btn">
                <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-align-left"></i></button>
            </div>


            <a href="{{route('shop.product',[Auth::user()->id,  Str::slug(Auth::user()->shop_name)])}}" class="mt-2 btn btn-info">
                Visit Store</a>
                <a href="{{ route('vendor.vprofile') }}" class="mt-2 btn btn-info">
                My Profile</a>

        </div>

        

        <div class="navbar-right">
            <div id="navbar-menu">
                <ul class="nav navbar-nav">

                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="notification-dot info" id="vendorOrderCount">{{count($orders)}}</span>
                            <input type="text" id="vendorId" value="{{\Illuminate\Support\Facades\Auth::id()}}" hidden>
                        </a>
                        <ul class="dropdown-menu feeds_widget mt-0 animation-li-delay overflow-auto" id="vendorOrderNotify">

                            <li class="header theme-bg gradient mt-0 py-0 text-light"><a class="text-white" href="{{ route('vendor.mark-allRead',\Illuminate\Support\Facades\Auth::id()) }}">Mark all as Read</a></li>
                            @forelse($orders as $row)
                                <li>
                                    <a href="{{url('/vendor/notify/'.$row->order_product_id.'/vendorOrder')}}">
                                        <div class="mr-4"><i class="fa fa-check text-green"></i></div>
                                        <div class="feeds-body">
                                            <h4 class="title text-danger">#{{$row->order_code}} <small class="float-right text-muted font-12">{{$row->created_at}}</small></h4>
                                            <small>{{$row->name}} has placed an order</small>
                                        </div>
                                    </a>
                                </li>
                            @empty

                            @endforelse
                        </ul>
                    </li>
                    <li class="dropdown" >
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu"  data-toggle="dropdown">
                            <i class="fa fa-comments"></i>
                            <span class="notification-dot info" id="reviewCount">
                                <?php @$count = 0; ?>
                                @foreach(@$ratings_all as $rating)
                                    @if($rating->vendor_id == Auth::user()->id)
                                        <?php @$count++; ?>
                                    @endif
                                @endforeach
                                <?php echo @$count; ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu feeds_widget mt-0 animation-li-delay overflow-auto" id="notificationList">

                            <li class="header theme-bg gradient mt-0 py-0 text-light"><a class="text-white" href="{{ route('vendor.reviewMarkedAll') }}">Mark all as Read</a></li>

                            @foreach(@$ratings_all as $rating)
                                @if(@$rating->vendor_id == Auth::user()->id)

                                    <li>
                                        <a href="{{ route('vendor.reviewView', $rating->id) }}">
                                            <div class="mr-4"><i class="fa fa-check text-green"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-danger"># {{ $rating->rating }} star. <small class="float-right text-muted font-12">{{ $rating->created_at }}</small></h4>
                                                <small>{{$rating->name}} reviewed a product. </small>
                                            </div>
                                            <?php
                                                $seen=\App\Model\Rating::find(@$rating->id);
                                                $seen->read_status = 1;
                                                $seen->save();
                                            ?>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>

                    <li class="hidden-xs"><a href="javascript:void(0);" id="btnFullscreen" class="icon-menu"><i class="fa fa-arrows-alt"></i></a></li>
                    <li><a href="{{route('vendor.logout')}}" class="icon-menu"><i class="fa fa-power-off"></i></a></li>
                </ul>
            </div>
        </div>

    </div>
</nav>

