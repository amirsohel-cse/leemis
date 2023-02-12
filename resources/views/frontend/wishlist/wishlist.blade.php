@extends('frontend.master.master')
@section('content')
    <head>
        <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/style.min.css')}}">
        <script
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>

    </head>

    <main class="main wishlist-pages">
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li ><h3 class="text-primary">Wishlist</h3></li>
                </ul>
            </div>
        </nav>

        <div class="page-content">
            <div class="container">
                <h3 class="wishlist-title">My wishlist</h3>
                <table class="shop-table wishlist-table">
                    <thead>
                    <tr>
                        <th class="product-name"><span>Product</span></th>
                        <th></th>
                        <th class="product-price"><span>Price</span></th>
                        <th class="product-stock-status"><span>Stock Status</span></th>
                        <th class="wishlist-action">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($wishlist as $row)
                        <tr>
                            <td class="product-thumbnail">
                                <div class="p-relative">
                                    <a href="{{route('product.details',[$row->product_id, Str::slug($row->name)])}}">
                                        <figure>
                                            <img src="{{asset($row->image)}}" alt="product" width="300"
                                                 height="338">
                                        </figure>
                                    </a>
                                    <button data-id="{{$row->id}}" type="submit" class="btn btn-close"><i
                                            class="fas fa-times"></i></button>
                                </div>
                            </td>
                            <td class="product-name">
                                <a href="{{route('product.details',[$row->product_id, Str::slug($row->name)])}}">
                                    {{$row->name}}
                               </a>
                            </td>
                            <td class="product-price">
                                <ins class="new-price">Tk. {{$row->price}}</ins>
                            </td>
                            <td class="product-stock-status">
                                @if($row->stock_status == 1)
                                    <span class="wishlist-in-stock">In Stock</span>
                                @else
                                    <span class="wishlist-out-stock">Out of Stock</span>
                                @endif
                            </td>
                            <td class="wishlist-action">
                                <div class="d-lg-flex">
                                    <button data-id="{{$row->product_id}}" class="btn btn-primary btn-cart">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span>Add to Cart</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"><h4 class="text-center">You have no wish list yet</h4></td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
{{--                <div class="social-links">--}}
{{--                    <label>Share On:</label>--}}
{{--                    <div class="social-icons social-no-color border-thin">--}}
{{--                        <a href="#" class="social-icon social-facebook w-icon-facebook"></a>--}}
{{--                   --}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
        <!-- End of PageContent -->
    </main>



    <script>
        $(document).ready(function () {
    $(document).on('click', '.btn-cart', function () {
         toastr.options = {
                    "timeOut": "3000",
                    "closeButton": true,
                };
                toastr['success']('successfully added to the Cart');
            });
        });
    </script>
@endsection

@section('page-scripts')
    <script src="{{asset('/frontend/js/delete-wishlist.js')}}"></script>

@endsection
