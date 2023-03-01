@extends('frontend.master.master')
@section('content')
    <head>
        <link rel="stylesheet" type="text/css" href="{{('frontend/assets/css/style.min.css')}}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.3.7/jquery.jscroll.min.js"></script>
    </head>
    <style>
        .cm{
            width:80%;
            height:200px;
        }
        @media (max-width: 575.98px) {
            .cm{
            width:100% !important;
            height:150px !important;
        }
         }
    </style>
    <main class="mains checkouts">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-navs">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li class="passed"><a href="/">Home</a></li>
                    <li class="active"><a href="#">All Brand</a></li>
                </ul>
            </div>
        </nav>

        <div  class="container">
            <div class="row col-md-12 col-sm-12 col-12 ">
            @forelse ($brand as $item)
                <div style="margin-left:auto;margin-right:auto" class="col-md-2 col-sm-4 col-6 mb-2">
                    <div style="text-align:center;padding:10px" class="border bg-white">
                        <div>
                            <a href="{{route('brand.product',[$item->id, Str::slug($item->name)])}}"><img style="height:120px;width:100%" src="{{"/uploads/brand-images/$item->photo"}}" alt=""></a>
                        </div>
                        <a href="{{route('brand.product',[$item->id,Str::slug($item->name)])}}"><h5 style="margin-bottom:0px" class="mt-1">{{$item->getTranslation('name')}}</h5></a>
                    </div>
                </div>
                @empty
                        <h4 class="text-danger">No Brands Available</h4>
                    @endforelse
            </div>
        </div>

        <!-- <div class="">


            <div class="infinite-scroll">
                <div  class="product-wrapper row col-md-12 col-sm-12 col-xs-12 ml-3" id="brandList">
                    @forelse ($brand as $item)

                        <div style="display:inline;float:left;" class="product-wrap col-md-2 col-sm-4 col-xs-6 square bg-white rounded mb-5">
                           <div   class="border cm brands-home product-wrap ">
                           <a href="{{route('brand.product',[$item->id,Str::slug($item->name)])}}">
                                <img style="height:130px; width:130px;" src="{{"/uploads/brand-images/$item->photo"}}" alt="" >
                            </a>  <br> <br>
                            <a href="{{route('brand.product',[$item->id,Str::slug($item->name)])}}"><h4>{{$item->name}}</h4></a>
                           </div>
                        </div>
                    @empty
                        <h4 class="text-danger">No Brands Available</h4>
                    @endforelse
                </div>
                {{ $brand->links() }}

            </div>
        </div> -->

    </main>

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
</main>
    {{--    Please wait modal end--}}

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

@section('page-scripts')
    <script src="{{asset('/frontend/js/brand-search.js')}}"></script>
@endsection

