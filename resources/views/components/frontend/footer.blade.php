@php
    $s_data = App\Model\Submenu::where('sub_status','Active')->get();
@endphp

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/brands.min.css" />
                        
<footer class="footer">
   <div class="footer-help-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content"> 
                        <h3 class="title">{{__('We\'re Always Here To Help')}}</h3>
                        <p>{{__('Reach out to us through any of these support channels')}}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="help-item-wrapper">
                        @php
                            $footer = \App\Model\Footer::first();
                        @endphp
                        <div class="help-item">
                            <a href="{{route('help')}}" class="help-item-link"></a>
                            <div class="icon">
                                <i class="las la-phone"></i>
                            </div>
                            
                            <div class="content">
                                <p>{{__('HOTLINE')}}</p>          
                                <h6 class="title">{{$footer->site_number}}</h6>                      
                            </div>
                        </div>


                        <div class="help-item">
                            <a href="{{route('help')}}" class="help-item-link"></a>
                            <div class="icon">
                                <i class="las la-exclamation-circle"></i>
                            </div>
                            
                            <div class="content">
                                <p>{{__('HELP CENTER')}}</p>          
                                <h6 class="title">help.hypershop.com.bd</h6>                      
                            </div>
                        </div>
                        <div class="help-item">
                            
                            <div class="icon">
                                <i class="las la-envelope"></i>
                            </div>
                            <div class="content">
                                <p>{{__('EMAIL SUPPORT')}}</p>          
                                <h6 class="title"><a href="mailto:info@hypershop.com">info@hypershop.com.bd</a></h6>                      
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
<style>    
    .footer-help-area {
    padding: 25px 0;
    background-color: #F7F7FA;
    border-top: 1px solid #e5e5e5;
    border-bottom: 1px solid #e5e5e5;
    overflow: hidden;
    }

    .footer-help-area .left-content .title {
    margin-bottom: 5px;
    color: #404553;
    font-weight: 600;
    }
    .footer-help-area .left-content p {
    font-size: 13px;
    margin-bottom: 0;
    color: #7e859b;
    }

    .help-item-wrapper {
    display: flex;
    align-items: center;
    margin: -10px -15px;
    justify-content: flex-end;
    }

    .help-item {
    padding: 10px 15px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    position: relative;
    transition: all 0.3s;
    }
    .help-item:hover {
    opacity: 0.75;
    }
    .help-item-link {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    }

    .help-item .icon {
    width: 36px;
    height: 36px;
    background-color: #fff;
    border: 1px solid #e5e5e5;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 26px;
    color: #404553;
    }
    .help-item .content {
    width: calc(100% - 36px);
    padding-left: 15px;
    }

    .help-item .content p {
    font-weight: 500;
    margin-bottom: 3px;
    color: #7e859b;
    font-size: 12px;
    }
    .help-item .content .title {
    color: #404553;
    font-size: 18px;
    font-family: Poppins, sans-serif;
    font-weight: 500;
    margin-bottom: 0;
    }
</style>

    <div class="footer-middle">
        <div class="container">
            <div class="row">
                @foreach ($cateogries_footer as $category)
                    
              <!--  <div class="col-lg-2">
                    <div class="footer-menu-widget">
                        <h4 class="title">{{$category->name}}</h4>
                        <ul class="footer-menu-list">
                            @foreach ($category->sub_categories as $sub)
                            
                            @if($loop->iteration == 10) @break @endif
                                
                            <li><a href="{{route('childCategorize.product',[$sub->id, Str::slug($sub->name)])}}">{{$sub->name}}</a></li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>  -->
                @endforeach
              
          
                <div class="col-lg-4">
                    <div class="footer-collapse-data">
                        <div class="footer-collapse-data-inner" style="font-size:16px; color:000 !important">
                            <p>
                                <?php
                                $copy=\App\Model\Footer::first();
                                ?>
                                @if($copy)
                                    <?= $copy->copyright ?>
                                @else
                                    <p class="cotact">{{languageChange('Nothing')}}</p>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="d-inline-block">
                        <h5>Delivery Time : (Inside Dhaka - 5 days & Outside Dhaka - 10 days)</h5>
                        <h6 class="mb-1">CONNECT WITh US</h6>
                        <div class="social-icons social-icons-colored">
                            <?php
                            $social=\App\Model\Social::first();
                            ?>
                            @if($social && $social->f_status)
                                <a href="{{$social->facebook}}" target="_blank" class="social-icon social-facebook w-icon-facebook"></a>
                           
                            @endif
                        
                            @if($social && $social->l_status)
                            <a href="{{$social->linkedin}}" target="_blank" class="social-icon social-instagram w-icon-instagram"></a>
                           
                            @endif
    
                            @if($social && $social->t_status)
                                    <a href="{{$social->twitter}}" target="_blank" class="social-icon social-pinterest w-icon-youtube"></a>
                               
                                @endif                            
                            
    
                                @if($social && $social->d_status)
                                <a href="{{$social->dribble}}" target="_blank" class="social-icon social-twitter w-icon-twitter"></a>
                            
                            @endif 
                            
                            
                            
                               @if($social && $social->link_status)
                                <a href="{{$social->link}}" target="_blank" class="social-icon social-facebook"><i class="fab fa-linkedin-in"></i></a>
                          
                            @endif
                            
                            
                             @if($social && $social->snap_status)
                                <a href="{{$social->snapchat}}" target="_blank" class="social-icon social-linkedin w-icon-linkedin"><i class="fab fa-snapchat-ghost"></i></a>
                          
                            @endif
                            
                            
                             @if($social && $social->tiktok_status)
                                <a href="{{$social->tiktok}}" target="_blank" class="social-icon"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="64" height="64" viewBox="0 0 64 64" style=" fill:#000000;"><path d="M48,8H16c-4.418,0-8,3.582-8,8v32c0,4.418,3.582,8,8,8h32c4.418,0,8-3.582,8-8V16C56,11.582,52.418,8,48,8z M50,27 c-3.964,0-6.885-1.09-9-2.695V38.5C41,44.841,35.841,50,29.5,50S18,44.841,18,38.5S23.159,27,29.5,27h2v5h-2 c-3.584,0-6.5,2.916-6.5,6.5s2.916,6.5,6.5,6.5s6.5-2.916,6.5-6.5V14h5c0.018,1.323,0.533,8,9,8V27z"></path></svg></a>
                            @endif
                            
                            
                             @if($social && $social->pinterest_status)
                                <a href="{{$social->pinterest}}" target="_blank" class="social-icon social-linkedin w-icon-linkedin"><i class="fab fa-pinterest"></i></a>
                           
                            @endif
                            
                            
                            <style>
                                
                                .fa-tiktok{
                                    font-family: "Font Awesome 5 Free";
                                        font-weight: 900;
                                }
                                
                                .fa-tiktok:before {
                                    content: "\e07b";
                                }
                                
                            </style>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <a data-toggle="modal" href="#TrackModal" class="track-order-text"><i class="las la-truck"></i> {{__('Track Order')}}</a>
                    <p>{{__('Hypershop a trusted ecommerce platform in Bangladesh')}}</p>
                </div>
                <div class="col-lg-3">
                    <h6 class="mb-2">{{__('SHOP ON THE GO')}}</h6>
                    <div class="d-flex flex-wrap">
                        <a href="https://play.google.com/store/apps/details?id=com.hypershop.bd.hypershop" class="mr-2"><img src="https://z.nooncdn.com/s/app/com/common/images/logos/google-play.svg" style="height: 38px;" /></a>
                        <a href="https://play.google.com/store/apps/details?id=com.hypershop.bd.hypershop"><img src="https://z.nooncdn.com/s/app/com/common/images/logos/app-store.svg" style="height: 38px;" /></a>
                    </div>
                </div>
            </div>

            <!-- <div class="row">
                <div class="col-lg-2">
                    <div class="footer-widget-body">
                        <div style="padding:0px" class="col-xl-3 col-lg-2 col-sm-4 ">
                            <a href="/" class="logo-footer">
                                <?php
                                $headerLogo=\App\Model\Logo::where('type','header')->first();
                                ?>
                                @if($headerLogo)
                                    <img src="\storage\storeLogo\{{$headerLogo->file}}" alt="logo" width="110" height="30"/>
                                @else
                                    <img src="\storage\storeLogo\common.png" alt="logo" width="110" height="30"/>
                                @endif                
                            </a>
                        </div>
                        <label class="label-social d-block text-dark mt-4"><h4>{{languageChange('Get in Touch')}}</h4></label>
                        <div class="social-icons social-icons-colored">
                            <?php
                            $social=\App\Model\Social::first();
                            ?>
                            @if($social && $social->f_status)
                                <a href="{{$social->facebook}}" target="_blank" class="social-icon social-facebook w-icon-facebook"></a>
                            @else
                                <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                            @endif
                        
                            @if($social && $social->l_status)
                            <a href="{{$social->linkedin}}" target="_blank" class="social-icon social-instagram w-icon-instagram"></a>
                            @else
                                <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                            @endif

                            @if($social && $social->t_status)
                                    <a href="{{$social->twitter}}" target="_blank" class="social-icon social-pinterest w-icon-youtube"></a>
                                @else
                                    <a href="#" class="social-icon social-pinterest w-icon-youtube"></a>
                                @endif                            
                            

                                @if($social && $social->d_status)
                                <a href="{{$social->dribble}}" target="_blank" class="social-icon social-twitter w-icon-twitter"></a>
                            @else
                                <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                            @endif 
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h3 class="footer-widget-title"> {{isset($s_data[0])?$s_data[0]->menu:''}}</h3>
                        <ul class="footer-menu">
                            @foreach($s_data as $footer_menu)
                                <li>
                                    <a href="{{ route('footer_menu',['slug' => Str::slug($footer_menu->sub_menu)]) }}">{{ $footer_menu->sub_menu }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">{{ __('Popular Products') }}</h4>
                        <ul class="footer-menu">
                            <li><a href="#0">Aarong</a></li>
                            <li><a href="#0">Cats Eye</a></li>
                            <li><a href="#0">Richman</a></li>
                            <li><a href="#0">NogorPolli</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">{{ __('Popular Brands') }}</h4>
                        <ul class="footer-menu">
                            <li><a href="#0">Aarong</a></li>
                            <li><a href="#0">Cats Eye</a></li>
                            <li><a href="#0">Richman</a></li>
                            <li><a href="#0">NogorPolli</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">{{ __('Popular Sellers') }}</h4>
                        <ul class="footer-menu">
                            <li><a href="#0">Aarong</a></li>
                            <li><a href="#0">Cats Eye</a></li>
                            <li><a href="#0">Richman</a></li>
                            <li><a href="#0">NogorPolli</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">
                            <?php
                            $footerText=\App\Model\Footer::first();
                            
                            ?>
                            @if($footerText)
                                {{$footerText->footer}}
                            @else
                                <p>nothing</p>
                            @endif
                        </h4>
                        <p ><i class="fas fa-map-marker-alt"></i>
                            &nbsp;  
                            
                            <?php
                            $copyright=\App\Model\Footer::first();
                            ?>
                            @if($copyright)
                                {!!$copyright->copyright!!}
                                
                            @else
                                <p class="copyright">Nothing</p>
                            @endif
                        </p>
                        <p> <i class="fa fa-phone"></i> &nbsp; 
                            <?php
                            $phone=\App\Model\Footer::first();
                            ?>
                            @if($phone)
                                {{$phone->site_number}}
                                
                            @else
                                <p class="copyright">Nothing</p>
                            @endif
                        </p>
                    </div>
                </div>
            </div> -->
        </div>
    </div><!-- footer-middle -->
    
    <div class="footer-bottom">
        <div class="container d-block">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-3">
                    <p class="text-small"> @if($copyright)
                            {!!$copyright->cotact!!}
                        @else
                            <p class="copyright">Nothing</p>
                        @endif</p>
                </div>
                        
                <div class="col-lg-9 mt-lg-0 mt-3">
                    <ul class="inline-menu justify-content-lg-end">
                        @php
                            $pages =\App\Page::where('status',1)->get();
                        @endphp
                        
                        @foreach($pages as $page)
                        <li><a href="{{route('pages',$page->slug)}}">{{$page->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-12 mt-3">
                    <img src="{{asset('ssl.png')}}" alt="">
                </div>
            </div>
        </div>
    </div><!-- footer-bottom -->
</footer>

@push('script')
    

<script>
    $('.read-more-btn').on('click', function(){
        $('.footer-collapse-data').toggleClass('active');
        
        if ($(this).text() == "Read More") {
            $(this).text("Read Less");
        } else {
            $(this).text("Read More");
        }
    });
</script>

@endpush

