<nav class="navbar navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-left">
            <div class="navbar-btn">
                <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-align-left"></i></button>
            </div>
<a href="/" class="btn btn-info" target="_blank"><i class="fa fa-eye"></i> Visit Home</a> <a href="{{ route('admin.profile') }}" class="btn btn-info"><i class="fa fa-user"></i> My Profile</a>
        </div>
        <div class="navbar-right" >
          
            <div id="navbar-menu">
                 <a href="{{route('admin.logout')}}" class="btn btn-danger"><i class="fa fa-power-off"></i> Logout</a>
                <ul class="nav navbar-nav">

                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu"  data-toggle="dropdown">
                            <i class="fa fa-address-book"></i>                           <?php
                                $i = 0;
                                $j = 0;
                                $k = 0;
                                foreach (Auth::user()->unreadNotifications as $notification){
                                    if ($notification->data['type'] == 'vendor' || $notification->data['type'] == 'user'){
                                        $i = $i + 1;
                                    }
                                    else if ($notification->data['type'] == 'order'){
                                        $j = $j + 1;
                                    }else if ($notification->data['type'] == 'withdraw'){
                                        $k = $k + 1;
                                    }
                                }
                            ?>
                            <span class="notification-dot info" id="vendorCount"><?=$i?></span>
                        </a>
                        <ul class="dropdown-menu feeds_widget mt-0 animation-li-delay overflow-auto" id="vendorSignupNotification">

                            <li class="header theme-bg gradient mt-0 py-0 text-light"><a class="text-white" href="{{ route('vendor.markAllAsRead') }}">Mark all as Read</a></li>

                            @foreach(Auth::user()->unreadNotifications as $notification)
                                @if($notification->data['type'] == 'vendor')
                                    <li>
                                        <a href="{{url('/admin/notify/vendor-list/'.$notification->id)}}">
                                            <div class="mr-4"><i class="fa fa-check text-green"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-danger">#{{$notification->data['name']}} <small class="float-right text-muted font-12">{{$notification->created_at}}</small></h4>
                                                <small>{{$notification->data['text']}}</small>
                                            </div>
                                        </a>
                                    </li>
                                @elseif($notification->data['type'] == 'user')
                                    <li>
                                        <a href="{{url('/admin/notify/user-list/'.$notification->id)}}">
                                            <div class="mr-4"><i class="fa fa-check text-green"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-danger">#{{$notification->data['name']}} <small class="float-right text-muted font-12">{{$notification->created_at}}</small></h4>
                                                <small>{{$notification->data['text']}}</small>
                                            </div>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown" >
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu"  data-toggle="dropdown">
                            <i class="fa fa-bank"></i>
                           <span class="notification-dot info" id="withdrawNotificationCount"><?=$k?></span>
                        </a>
                        <ul class="dropdown-menu feeds_widget mt-0 animation-li-delay overflow-auto" id="withdrawNotificationList">

                            <li class="header theme-bg gradient mt-0 py-0 text-light"><a class="text-white" href="{{ route('withdraw.markAllAsRead') }}">Mark all as Read</a></li>

                            @foreach(Auth::user()->unreadNotifications as $notification)
                                @if($notification->data['type'] == 'withdraw')
                                    <li>
                                        <a href="{{route('notify.withdraw',$notification->id)}}">
                                            <div class="mr-4"><i class="fa fa-check text-green"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-danger">Tk. {{$notification->data['amount']}} <small class="float-right text-muted font-12">{{$notification->created_at}}</small></h4>
                                                <small>{{$notification->data['name']}} {{$notification->data['text']}}</small>
                                            </div>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown" >
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu"  data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="notification-dot info" id="orderCount"><?=$j?></span>
                        </a>
                        <ul class="dropdown-menu feeds_widget mt-0 animation-li-delay overflow-auto" id="notificationList">

                            <li class="header theme-bg gradient mt-0 py-0 text-light"><a class="text-white" href="{{ route('markAllAsRead') }}">Mark all as Read</a></li>

                            @foreach(Auth::user()->unreadNotifications as $notification)
                                @if($notification->data['type'] == 'order')
                                    <li>
                                        <a href="{{route('notify.order.details', $notification->data['order_id'] )}}">
                                            <div class="mr-4"><i class="fa fa-check text-green"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-danger">#{{$notification->data['order_code']}} <small class="float-right text-muted font-12">{{$notification->created_at}}</small></h4>
                                                <small>{{$notification->data['name']}} {{$notification->data['text']}}</small>
                                            </div>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown" >
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu"  data-toggle="dropdown">
                            <i class="fa fa-comments"></i>
                            <span class="notification-dot info" id="orderCount"><?php echo count(@$ratings_all ?? []) ?></span>
                        </a>
                        <ul class="dropdown-menu feeds_widget mt-0 animation-li-delay overflow-auto" id="notificationList">

                            <li class="header theme-bg gradient mt-0 py-0 text-light"><a class="text-white" href="{{ route('admin.reviewMarkedAll') }}">Mark all as Read</a></li>

                            @foreach(@$ratings_all as $rating)
                                <li>
                                    <a href="{{ route('admin.reviewView', $rating->id) }}">
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
                            @endforeach
                        </ul>
                    </li>

                    <li class="hidden-xs"><a href="javascript:void(0);" id="btnFullscreen" class="icon-menu"><i class="fa fa-arrows-alt"></i></a></li>
                    <!-- <li><a href="{{route('admin.logout')}}" class="icon-menu"><i class="fa fa-power-off"></i></a></li> -->
                </ul>
            </div>
        </div>

    </div>
</nav>


