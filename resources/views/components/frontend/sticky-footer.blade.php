<div style="height:60px" class="sticky-footer sticky-content fix-bottom">
    <a href="/" class="sticky-link active">
        <i class="w-icon-home"></i>
        <p>{{languageChange('Home')}}</p>
    </a>
    <a href="#" class="sticky-link mobile-menu-toggle">
        <i class="w-icon-bars"></i>
        <p>{{languageChange('Menu')}}</p>
    </a>
    <a href="/allshop" class="sticky-link">
        <i class="w-icon-category"></i>
        <p>{{languageChange('Shop')}}</p>
    </a>
    
    <a href="{{route('customer.profile')}}" class="sticky-link">
        <i class="w-icon-account"></i>
        <p>{{languageChange('Account')}}</p>
    </a>
    <div class="cart-dropdown dir-up">
        <a href="{{route('view.cart')}}" class="sticky-link">
            <i class="w-icon-cart"></i>
            <span style="right:12px;top:7px" class="cart-count">{{\App\Model\Cart::where('user_id',auth()->id())->count()}}</span>
            <p>{{languageChange('Cart')}}</p>
        </a>
    </div>
  

</div>
