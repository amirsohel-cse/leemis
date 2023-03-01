{{-- @foreach ($cartData as $cart_item)
   @if($cart_item->product != null)
    <div style="width:240px" class="product product-cart">
        <div class="product-detail">
            <a href="{{ route('product.details', [$cart_item->product->id, Str::slug($cart_item->product->name)]) }}"
                class="product-name">{{ $cart_item->product->name }}</a>
            <div class="price-box">
                <span class="product-quantity">{{ $cart_item->qty }}</span>
                <span class="product-price">Tk. {{ $cart_item->subtotal }}</span>
            </div>
        </div>
        <figure class="product-media">
            <a href="{{ route('product.details', [$cart_item->product->id, Str::slug($cart_item->product->name)]) }}">
                <img src="{{ asset($cart_item->product->photo) }}" alt="product" height="84" width="94">
            </a>
        </figure>
        <button data-id="{{ $cart_item->id }}" class="btn btn-link btn-close cart-item-delete">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif
@endforeach

@auth

    <div class="cart-total">
        <label>{{ languageChange('Subtotal') }}:</label>
        <span class="price">{{ \App\Model\Cart::whereHas('product')->where('user_id', auth()->id())->sum('subtotal') }}</span>
    </div>

    <div class="cart-action">
        <a href="{{ route('view.cart') }}"
            class="btn btn-dark btn-outline btn-rounded">{{ languageChange('View Cart') }}</a>
        <a href="{{ route('checkout') }}" class="btn btn-primary  btn-rounded"
            id="sidebarCheckoutBtn">{{ languageChange('Checkout') }}</a>
    </div>
@endauth

@guest
    <div class="cart-action">
        <a href="{{ route('customer.login') }}" class="btn btn-dark btn-outline btn-rounded"
            style="width: auto">{{ __('Login To View Cart') }}</a>
    </div>
@endguest --}}


<div class="sidebar-cart-wrapper">
    @foreach ($cartData as $cart_item)
       @if($cart_item->product != null)
        <div style="width:240px" class="product product-cart sidebar-cart-product">
            <div class="product-detail">
                <a href="{{ route('product.details', [$cart_item->product->id, Str::slug($cart_item->product->name)]) }}"
                    class="product-name">{{ $cart_item->product->getTranslation('name') }}</a>
                <div class="price-box">
                    <span class="product-quantity">{{ $cart_item->qty }}</span>
                    <span class="product-price">HK$. {{ $cart_item->subtotal }}</span>
                </div>
            </div>
            <figure class="product-media">
                <a href="{{ route('product.details', [$cart_item->product->id, Str::slug($cart_item->product->name)]) }}">
                    <img src="{{ asset($cart_item->product->photo) }}" alt="product" height="84" width="94">
                </a>
            </figure>
            <button data-id="{{ $cart_item->id }}" class="btn btn-link btn-close cart-item-delete">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif
    @endforeach
    </div>

    @auth
    <div class="sidebar-cart-footer">
        <div class="cart-total">
            <label>{{ languageChange('Subtotal') }}:</label>
            <span class="price">{{ \App\Model\Cart::whereHas('product')->where('user_id', auth()->id())->sum('subtotal') }}</span>
        </div>

        <div class="cart-action">
            <a href="{{ route('view.cart') }}"
                class="btn btn-dark btn-outline btn-rounded">{{ languageChange('View Cart') }}</a>
            <a href="{{ route('checkout') }}" class="btn btn-primary  btn-rounded"
                id="sidebarCheckoutBtn">{{ languageChange('Checkout') }}</a>
        </div>
    </div>
    @endauth

    @guest
        <div class="cart-action">
            <a href="{{ route('customer.login') }}" class="btn btn-dark btn-outline btn-rounded"
                style="width: auto">{{ __('Login To View Cart') }}</a>
        </div>
    @endguest
