<div id="left-sidebar" class="sidebar">
    <a href="#" class="menu_toggle"><i class="fa fa-angle-left"></i></a>
    <div class="navbar-brand">
        @php
        $file=App\Model\Logo::where('type','sidebar')->first();
        $file2=App\Model\Logo::where('type','barText')->first();
        @endphp
        @if($file)
            <a href="/vendor/dashboard"><img src="{{asset('/storage/storeLogo')}}/{{$file->file}}" alt="Logo" class="img-fluid logo"></a>
            @else
            <p>Company Logo</p>    
          @endif
        @if($file2)
            <span>{{$file2->file}}</span>
            @else
            <span>Company Name</span>
        @endif
        <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i class="fa fa-close"></i></button>

    </div>
    <div class="sidebar-scroll">
        <div class="user-account">
            <div class="user_div">
                <img src="{{ asset('uploads/vendors/'.Auth::user()->shop_image) }}"  class="user-photo" alt="Profile Picture">
            </div>
            <div class="dropdown">
                <span>Vendor</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{Auth::user()->name}}</strong></a>
                <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
                    <li><a href="{{ route('vendor.vprofile') }}"><i class="fa fa-user"></i>My Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="{{route('vendor.logout')}}"><i class="fa fa-power-off"></i>Logout</a></li>
                </ul>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu animation-li-delay">
                {{-- <li class="header">Main</li> --}}
                <li class="{{Request::is('vendor/dashboard') ? 'active' : '' }}"><a href="{{route('vendor.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                <li class="{{Request::is('vendor/orders/view') ? 'active' : '' }}">
                    <a href="{{route('vendorOrders.view')}}"><i class="fa fa-anchor"></i><span>Orders</span></a>
                </li>

                {{-- <li class="header">Vendors</li> --}}


                <li  class="{{Request::is('vendor/product/*') ? 'active' : '' }}">
                    <a href="#product" class="has-arrow"><i class="fa fa-cart-plus"></i><span>Products</span></a>
                    <ul class="metismenu">
                        <li class="{{Request::is('vendor/product/addProduct') ? 'active' : '' }}"><a href="{{route('vendor.addproduct')}}" id= button>Add New Product</a></li>
                        <li class="{{Request::is('vendor/product/allProducts') ? 'active' : '' }}"><a href="{{route('vendor.allProducts')}}">All Products</a></li>
                        <li class="{{Request::is('vendor/product/deActivatedProducts') ? 'active' : '' }}"><a href="{{route('vendor.deActivatedProducts')}}">Deactivated Products</a></li>
                        {{-- <li><a href="{{route('vendor.productCatalogs')}}">Product Catalogs</a></li> --}}

                    </ul>
                </li>

                <li class="{{Request::is('vendor/profile', 'vendor/setting/banner') ? 'active' : '' }}">
                    <a href="#" class="has-arrow"><i class="fa fa-anchor"></i><span>Setting</span></a>
                    <ul class="metismenu">
                        <li class="{{Request::is('vendor/profile') ? 'active' : '' }}"><a href="{{ route('vendor.profile') }}">Shop Setting</a></li>
                        <li class="{{Request::is('vendor/setting/banner') ? 'active' : '' }}"><a href="{{ route('vendor.banner') }}">Shop Logo & Banner</a></li>
                    </ul>
                </li>

                <li class="{{Request::is('vendor/vendorWithdraws') ? 'active' : '' }}">
                    <a href="/vendor/vendorWithdraws"><i class="fa fa-anchor"></i><span>Withdraws</span></a>
                    
                </li>
                
                <li class="{{Request::is('vendor/review') ? 'active' : '' }}">
                    <a href="{{ route('vendor.review') }}"><i class="fa fa-anchor"></i><span>Review</span></a>
                </li>
             
            </ul>
        </nav>
    </div>
</div>


