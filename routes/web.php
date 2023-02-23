<?php

use App\Http\Controllers\Backend\Mail\MailController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PagesController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes();
// customer login

Route::middleware('optimizeImages')->group(function () {


    Route::get('/login', 'Frontend\Auth\LoginController@showLoginForm')->name('customer.login');
    Route::get('/register', 'Frontend\Auth\LoginController@showRegisterForm')->name('customer.register');
    Route::post('/login', 'Frontend\Auth\LoginController@login');
    Route::post('/trackOrder', 'Backend\Order\OrderController@trackOrder')->name('order.track');
    Route::post('/subscribe', 'Backend\Subscriber\SubscriberController@storeSubscribersEmail');
    Route::get('terms', 'Frontend\FrontendController@terms')->name('terms');

    // Route::get('/updateslug','Frontend\FrontendController@updateSlug');

    //google login
    Route::get('/login/google', 'Frontend\Auth\LoginController@redirectToGoogle');
    Route::get('/google/callback', 'Frontend\Auth\LoginController@handleGoogleCallback');

    //Facebook login
    Route::get('/login/facebook', 'Frontend\Auth\LoginController@redirectToFacebook');
    Route::get('/facebook/callback', 'Frontend\Auth\LoginController@handleFacebookCallback');

    // OTP
    Route::middleware('guest')->group(function () {
        Route::post('send_otp', 'Frontend\Auth\SmsController@send')->name('send.otp');
        Route::get('mobile_verification', 'Frontend\Auth\SmsController@verifyForm')->name('verify.form');
        Route::post('mobile_verification', 'Frontend\Auth\SmsController@verifyOtp')->name('verify.otp');

        Route::get('forgot_password', 'Frontend\Auth\SmsController@forgotPasswordForm')->name('forgot.password');
        Route::post('forgot_password/send_otp', 'Frontend\Auth\SmsController@sendOtpForgotPass')->name('send.otp.forgot.pass');
        Route::get('forgot_password/verify', 'Frontend\Auth\SmsController@verifyFormForgotPass')->name('verify.form.forgot.pass');
        Route::post('forgot_password/verify', 'Frontend\Auth\SmsController@verifyOtpForgotPass')->name('verify.otp.forgot.pass');
        Route::post('password_reset', 'Frontend\Auth\SmsController@resetPassword')->name('reset.password');
    });

    // vendor login routes
    Route::prefix('vendor')->group(function () {
        Route::get('/login', 'Vendor\VendorLoginController@showLoginForm')->name('vendor.login');
        Route::post('/login', 'Vendor\VendorLoginController@login');
    });

    // vendor OTP
    Route::middleware('guest')->prefix('vendor')->group(function () {
        Route::post('send_otp', 'Vendor\VendorSmsController@send')->name('vendor.send.otp');
        Route::get('mobile_verification', 'Vendor\VendorSmsController@verifyForm')->name('vendor.verify.form');
        Route::post('mobile_verification', 'Vendor\VendorSmsController@verifyOtp')->name('vendor.verify.otp');

        Route::get('forgot_password', 'Vendor\VendorSmsController@forgotPasswordForm')->name('vendor.forgot.password');
        Route::post('forgot_password/send_otp', 'Vendor\VendorSmsController@sendOtpForgotPass')->name('vendor.send.otp.forgot.pass');
        Route::get('forgot_password/verify', 'Vendor\VendorSmsController@verifyFormForgotPass')->name('vendor.verify.form.forgot.pass');
        Route::post('forgot_password/verify', 'Vendor\VendorSmsController@verifyOtpForgotPass')->name('vendor.verify.otp.forgot.pass');
        Route::post('password_reset', 'Vendor\VendorSmsController@resetPassword')->name('vendor.reset.password');
    });


    // protected vendor routes
    Route::middleware('auth:vendor')->prefix('vendor')->group(function () {
        Route::get('/profile', 'Vendor\vendorController@viewProfile')->name('vendor.vprofile');
        Route::get('/editprofile', 'Vendor\vendorController@showProfile')->name('vendor.profile');
        Route::post('/profile/update', 'Vendor\vendorController@updateProfile')->name('vendor.profile-update');
        Route::get('/dashboard', 'Vendor\DashboardController@index')->name('vendor.dashboard');
        // Review
        Route::get('/review', 'Vendor\ReviewController@index')->name('vendor.review');
        Route::get('/review/{id}', 'Vendor\ReviewController@reviewView')->name('vendor.reviewView');
        Route::get('/review-all-marked', 'Vendor\ReviewController@reviewMarkedALl')->name('vendor.reviewMarkedAll');

        Route::get('/{id}/markasread', function ($id) {
            DB::table('vendor_notifications')->orderBy('id', 'DESC')
                ->where('vendor_id', $id)
                ->whereNull('read_at')->update(['read_at' => now()]);
            return redirect()->back();
        })->name('vendor.mark-allRead');


        Route::prefix('product')->group(function () {
            Route::get('/addProduct', 'Vendor\ProductController@addProduct')->name("vendor.addproduct");
            Route::post('/createProduct', 'Vendor\ProductController@createProduct')->name("vendorcreateProduct");
            Route::get('/allProducts', 'Vendor\ProductController@showProducts')->name("vendor.allProducts");
            Route::get('/{product}/status/update', 'Vendor\ProductController@statusUpdate');
            Route::get('/productEdit/{id}', 'Vendor\ProductController@productEdit')->name("vendor.productEdit");
            Route::post('/productUpdate/{id}', 'Vendor\ProductController@productUpdate')->name("productUpdatevendor");
            // Route::get('/productDelete/{id}','Vendor\ProductController@productDelete')->name("vendor.productDelete");
            Route::get('/productView/{id}', 'Vendor\ProductController@productView')->name("vendor.productView");
            Route::get('/deActivatedProducts', 'Vendor\ProductController@deActivatedProducts')->name("vendor.deActivatedProducts");
            // Route::get('/productCatalogs','Vendor\ProductController@productCatalogs')->name("vendor.productCatalogs");

            Route::get('attribute/fetch', 'Vendor\ProductController@fetchCategory')->name('attribute.fetch');
        });


        Route::prefix('setting')->group(function () {
            Route::get('/banner', 'Vendor\DashboardController@bannerView')->name("vendor.banner");
            Route::post('/{id}/storeBanner', 'Vendor\DashboardController@storeBanner')->name("vendor.addbanner");
            Route::post('/{id}/storeShopimage', 'Vendor\DashboardController@storeLogo')->name("vendor.addlogo");
        });

        /*Orders Routes starts*/
        Route::prefix('orders')->group(function () {
            Route::get('/view', 'Backend\Order\OrderController@vendorOrderView')->name('vendorOrders.view');
            Route::get('/{id}/vendorupdateOrderStatus', 'Backend\Order\OrderController@vendorOrderStatusUpdate');
            Route::get('/{id}/vendorOrderDetails', 'Backend\Order\OrderController@vendorOrderDetails')->name('vendor.order.details');
            Route::get('/{id}/vendorinvoice', 'Backend\Order\OrderController@vendorInvoice')->name('vendor.invoice');
        });
        /*Orders routes ends*/
        /*withdraws Routes starts*/
        Route::get('/vendorWithdraws', 'Vendor\vendorController@vendorWithdraws')->name('vendorWithdraws.view');
        Route::post('/vendorWithdraws', 'Vendor\vendorController@withdrawStore')->name('withdraw.store');
        /*withdraws routes ends*/

        Route::get('/logout', 'Vendor\VendorLoginController@logout')->name('vendor.logout');

        Route::get('/logout', 'Vendor\VendorLoginController@logout')->name('vendor.logout');

        Route::get('/notify/{o_id}/vendorOrder', function ($o_id) {
            \App\Model\VendorNotification::where('order_product_id', $o_id)->orderBy('id', 'DESC')
                ->whereNull('read_at')
                ->update(['read_at' => now()]);
            return redirect()->route('vendor.order.details', $o_id);
        });
    });


    //frontendRoute

    Route::get('/', 'Frontend\FrontendController@index')->name('home');
    Route::get('/return-back', function () {
        return redirect()->back();
    })->name('return.back');

    Route::get('/home', 'Frontend\FrontendController@index')->name('home');
    Route::post('/searchajax', 'Frontend\FrontendController@searchajax')->name('search');


    //frontendbrand
    Route::get('/morebrands', 'Frontend\FrontendController@moreBrand')->name('more.brand');
    Route::get('/brandbyproduct/{id}/{slug}', 'Frontend\FrontendController@productByBrand')->name('brand.product');
    Route::post('/brandsearch', 'Frontend\FrontendController@brandSearchAjax');
    Route::post('/{brandId}/brandproductsearch/', 'Frontend\FrontendController@brandProductSearchAjax');
    //category
    Route::get('categorizeProducts/{c_id}/{slug}', 'Frontend\FrontendController@categorizeProducts')->name('categorize.product');
    Route::get('childCategorizeProducts/{c_id}/{slug}', 'Frontend\FrontendController@childCategorizeProducts')->name('childCategorize.product');
    Route::get('subCategorizeProducts/{s_id}/{slug}', 'Frontend\FrontendController@subCategorizeProducts')->name('subCategorize.product');

    // productdetails


    //All categories route
    Route::get('/all-categories', 'Frontend\FrontendController@allCategories')->name('all-categories');


    //Route::get('/productdetails/{id}','Frontend\FrontendController@productDetails')->name('product.details');
    Route::get('/productdetails/{id}/{slug}', 'Frontend\FrontendController@productDetails')->name('product.details');
    Route::get('/offerproduct', 'Frontend\FrontendController@offerProduct')->name('product.offer');
    Route::get('/allproduct/{status?}', 'Frontend\FrontendController@productAll')->name('productall');




    Route::get('/shopbystore/{id}/{slug}', 'Frontend\FrontendController@shopProduct')->name('shop.product');

    Route::get('/blogs', 'BlogController@blogs')->name('blogslist');
    Route::get('/viewblog/{id}', 'BlogController@viewblog')->name('viewblog');
    //Shop products ajax routes
    Route::get('/shop/category/{catId}/{vendorId}/product', 'Frontend\FrontendController@shopCategoryProduct');
    //shop products price filter
    Route::post('/shop/product/{vendorId}/price-filter', 'Frontend\FrontendController@shopPriceFilterProducts');

    Route::get('/allshop', 'Frontend\FrontendController@Shop')->name('more.shop');
    //Shop search ajax
    Route::post('/shopsearch', 'Frontend\FrontendController@shopSearchAjax');

    //Product by Category ajax for all products page
    Route::get('/category/{catId}/products', 'Frontend\FrontendController@categoryProducts');
    Route::get('/offer-category/{catId}/products', 'Frontend\FrontendController@offerCategoryProducts');

    //Product by price
    Route::post('/product/price-filter', 'Frontend\FrontendController@priceFilter');
    Route::post('/offer-product/price-filter', 'Frontend\FrontendController@offerPriceFilter');


    Route::get('/viewcart', 'Frontend\FrontendController@cartView')->name('view.cart');

    /*Cart AJax calling Routes starts*/
    Route::get('/{id}/product-details', 'Frontend\Cart\CartController@index');
    Route::get('/{cart_id}/product-quantity', 'Frontend\Cart\CartController@getProductQuantity');
    Route::post('/{userid}/{product_id}/storeQuantity', 'Frontend\Cart\CartController@storeProductQuantity');
    Route::get('/{userId}/get-grand-total-price', 'Frontend\Cart\CartController@getGrandTotalPrice');


    Route::post('cart-update', 'Frontend\Cart\CartController@cartUpdate')->name('cart.update');




    //Getting Cart data from database
    Route::get('/{userId}/cartData', 'Frontend\Cart\CartController@getCartData');
    Route::get('/{userId}/cartData/counter', 'Frontend\Cart\CartController@getCartCounter');
    Route::post('/{userId}/saveCart', 'Frontend\Cart\CartController@saveCartData');
    /*Cart AJax calling Routes ends*/


    Route::delete('deleteCartItem/cart', 'Frontend\Cart\CartController@deleteCartItem')->name('delete.cart');

    Route::delete('deleteAllCartItem', 'Frontend\Cart\CartController@deleteAllCartItem');

    /*Quick View Routes*/
    Route::get('/{product}/details', 'Frontend\QuickView\QuickViewController@index');
    //Update price with size change in quickview Route
    Route::get('/{id}/size-price', 'Frontend\QuickView\QuickViewController@getSizePrice');

    //wish list routes
    Route::post('/wishlist/{product}/saveWishList', 'Frontend\Wishlist\WishlistController@saveWishList'); //WishList store ajax
    Route::get('/wishlist/{userId}/view', 'Frontend\Wishlist\WishlistController@index')->name('wishlist.view');
    Route::delete('/wishlilst/{wishlist}/delete', 'Frontend\Wishlist\WishlistController@delete');



    Route::post('/pay', 'SslCommerzPaymentController@index');
    Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

    Route::post('/success',  'SslCommerzPaymentController@success');
    Route::post('/fail',  'SslCommerzPaymentController@fail');
    Route::post('/cancel',  'SslCommerzPaymentController@cancel');

    Route::post('/ipn',  'SslCommerzPaymentController@ipn');


    // protected frontend routes
    Route::middleware('auth', 'isUserDisabled')->group(function () {
        Route::get('/home', 'Frontend\FrontendController@index')->name('home');
        Route::post('/logout', 'Frontend\Auth\LoginController@logout')->name('customer.logout');
        Route::get('/checkout', 'Frontend\FrontendController@checkOut')->name('checkout');
        Route::get('/singlecheckout/{qty}/{productId}', 'Frontend\FrontendController@directcheckout');
        Route::post('/ordercompelete', 'Frontend\FrontendController@orderComplete')->name('checkout.order');


        // Route::post('bkash/get-token', 'BkashController@getToken')->name('bkash-get-token');
        Route::post('bkash/create-payment', 'BkashController@createPayment')->name('bkash-create-payment');
        Route::post('bkash/execute-payment', 'BkashController@executePayment')->name('bkash-execute-payment');
        Route::get('bkash/query-payment', 'BkashController@queryPayment')->name('bkash-query-payment');
        Route::post('bkash/success', 'BkashController@bkashSuccess')->name('bkash-success');
        Route::post('bkash/success/mobile', 'BkashController@bkashSuccessMobile')->name('bkash-success-mobile');


        Route::post('checkoutData', 'BkashController@checkout')->name('checkoutData');

        Route::get('completeOrder', 'BkashController@orderComplete')->name('orderComplete');





        Route::get('/user/profile', 'Frontend\FrontendController@profile')->name('customer.profile');
        Route::post('/user/profile/update', 'Frontend\ProfileController@updateProfile')->name('customer.profile.update');
        Route::get('/user/{id}/order-details', 'Frontend\FrontendController@orderDetails')->name('customer.order.details');
    });


    //unprotected admin routes
    Route::prefix('admin')->group(function () {
        Route::get('/login', 'Backend\Auth\AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('/login', 'Backend\Auth\AdminLoginController@login');
    });

    //product category  dependency
    Route::get('/findsub/{id}', 'Vendor\ProductController@findsub');
    Route::get('/findchild/{id}', 'Vendor\ProductController@findchild');


    // protected admin routes
    Route::prefix('admin')->middleware('auth:admin')->group(function () {

        Route::get('/2fa', 'LoginSecurityController@show2faForm')->name('2fa');
        Route::post('/2fa/generateSecret', 'LoginSecurityController@generate2faSecret')->name('generate2faSecret');
        Route::post('/2fa/enable2fa', 'LoginSecurityController@enable2fa')->name('enable2fa');
        Route::post('/2fa/disable2fa', 'LoginSecurityController@disable2fa')->name('disable2fa');

        Route::post('/2fa/2faVerify', function () {
            return redirect(URL()->previous());
        })->name('2faVerify')->middleware('2fa');



        Route::middleware('2fa')->group(function () {

            Route::get('/profile', 'Backend\Admin\AdminController@showProfile')->name('admin.profile');
            Route::post('/profile/update', 'Backend\Admin\AdminController@updateProfile')->name('admin.profile-update');
            Route::get('/logout', 'Backend\Auth\AdminLoginController@logout')->name('admin.logout');
            /* admin access only */
            Route::get('/dashboard', 'Backend\DashboardController@index')->name('admin.dashboard')->middleware('admin');
            //email
            Route::get('/viewgroupmail', 'Backend\Mail\MailSettingContrller@viewMailSettingPage')->name('groupmail');
            Route::post('/groupmail', 'Backend\Mail\MailController@sendEmail')->name('sendEmail');
            //subsribe

            Route::get('pages', [PagesController::class, 'index'])->name('frontend.pages');
            Route::get('pages/create', [PagesController::class, 'pageCreate'])->name('frontend.pages.create');
            Route::post('pages/create', [PagesController::class, 'pageInsert']);
            Route::get('pages/edit/{page}', [PagesController::class, 'pageEdit'])->name('frontend.pages.edit');
            Route::post('pages/edit/{page}', [PagesController::class, 'pageUpdate']);
            Route::get('pages/search', [PagesController::class, 'index'])->name('frontend.search');
            Route::post('pages/delete/{page}', [PagesController::class, 'pageDelete'])->name('frontend.pages.delete');






            Route::resource('help-center', 'HelpController');
            Route::get('articles/{id}', 'HelpController@articles')->name('articles.index');
            Route::post('articles/{id}', 'HelpController@articlesStore');
            Route::put('articles/{id}', 'HelpController@articlesUpdate')->name('articles.update');

            //mobile version change

            Route::get('mobileversion', 'Backend\mobileversionController@mobileversion')->name('admin.mobileversion.index');
            Route::post('mobileversion', 'Backend\mobileversionController@update');


            Route::get('language', [LanguageController::class, 'index'])->name('language.index');
            Route::post('language', [LanguageController::class, 'store']);
            Route::post('language/edit/{id}', [LanguageController::class, 'update'])->name('language.edit');
            Route::post('language/delete/{id}', [LanguageController::class, 'delete'])->name('language.delete');
            Route::get('language/translator/{lang}', [LanguageController::class, 'transalate'])->name('language.translator');
            Route::post('language/translator/{lang}', [LanguageController::class, 'transalateUpate']);
            Route::get('language/import', [LanguageController::class, 'import'])->name('language.import');




            Route::get('product/print_barcode', 'ProductController@printBarcode')->name('product.printBarcode');

            Route::get('product/lims_product_search', 'ProductController@limsProductSearch')->name('product.search');
            Route::get('product/search', 'ProductController@Search')->name('search');


            Route::get('product/barcode_print', 'ProductController@printBarcodePDF')->name('product.print.barcode');



            Route::post('category-attributes/{id}', 'Backend\Category\CategoryController@category')->name('category-attributes');
            Route::get('category-attributes/show/{id}', 'Backend\Category\CategoryController@categoryAttributeShow')->name('category-attributes-show');

            Route::post('category-attributes/edit/{id}', 'Backend\Category\CategoryController@categoryAttributeEdit')->name('category-attributes-edit');

            Route::post('category-attributes/delete/{id}', 'Backend\Category\CategoryController@categoryAttributeDelete')->name('category-attributes-delete');


            Route::get('get-category-product-type', 'Backend\Category\CategoryController@categoryAttributeFetch')->name('get-category-product-type');


            Route::get('advertise', 'Backend\AdvertiserController@advertisements')->name('advertisements');
            Route::post('advertise/store', 'Backend\AdvertiserController@advertisementStore')->name('advertisements.store');
            Route::post('advertise/update/{id}', 'Backend\AdvertiserController@advertisementUpdate')->name('advertisements.update');
            Route::post('advertise/remove/{id}', 'Backend\AdvertiserController@advertisementRemove')->name('advertisements.remove');


            // Review
            Route::get('/review', 'Backend\ReviewController@index')->name('admin.review');
            Route::get('/review/{id}', 'Backend\ReviewController@reviewView')->name('admin.reviewView');
            Route::get('/review-all-marked', 'Backend\ReviewController@reviewMarkedALl')->name('admin.reviewMarkedAll');

            // Manage Language

            Route::get('manage-language', 'Backend\LanguageController@index')->name('admin.language');
            Route::post('manage-language', 'Backend\LanguageController@update');


            //blog
            Route::get('/blogs', 'BlogController@index')->name('blogs');
            Route::get('/addblog', 'BlogController@add')->name('blogadd');
            Route::get('/delete/{id}', 'BlogController@delete')->name('blogdelete');
            Route::get('/edit/{id}', 'BlogController@edit')->name('blogedit');
            Route::post('/edit\/{id}', 'BlogController@update')->name('blogupdate');
            Route::post('/blogs', 'BlogController@store')->name('addblog');




            Route::get('/subscribers', 'Backend\Subscriber\SubscriberController@showSubscribers')->name('subscribers');
            /*Category Routes starts*/
            Route::prefix('category')->group(function () {
                Route::get('/view', 'Backend\Category\CategoryController@index')->name('category.view');
                Route::post('/store', 'Backend\Category\CategoryController@store');
                Route::delete('/{category}/delete', 'Backend\Category\CategoryController@delete');
                Route::get('/{category}/edit', 'Backend\Category\CategoryController@edit');
                Route::post('/{category}/update', 'Backend\Category\CategoryController@update');
                Route::get('/{category}/status/update', 'Backend\Category\CategoryController@statusUpdate');
                Route::get('/{category}/feature/update', 'Backend\Category\CategoryController@featureUpdate');
                
                //translations
                Route::get('/translations/{id}', 'Backend\TranslationController@categoryTranslation')->name('admin.categoryTranslations');
                Route::post('/translations/delete', 'Backend\TranslationController@deleteCategoryTranslation')->name('admin.deleteCategoryTranslation');
                Route::post('/add-category-translation', 'Backend\TranslationController@addTranslation')->name('admin.addCategoryTranslation');
                Route::post('/update-category-translation', 'Backend\TranslationController@editTranslation')->name('admin.editCategoryTranslation');
            });
            /*Category routes ends*/


            /*Orders Routes starts */
            /* admin and moderator access */
            Route::prefix('orders')->middleware('moderator')->group(function () {
                Route::get('/view', 'Backend\Order\OrderController@orderView')->name('orders.view');

                Route::get('/invoice/{id}', 'Backend\Order\OrderController@orderInvoice')->name('orders.invoice');

                Route::get('/{id}/updateOrderStatus', 'Backend\Order\OrderController@orderStatusUpdate');
                Route::get('/{id}/orderDetails', 'Backend\Order\OrderController@orderDetails')->name('order.details');
                Route::get('/{id}/invoice', 'Backend\Order\OrderController@Invoice')->name('order.invoice');
                Route::get('/view/pending', 'Backend\Order\OrderController@pendingOrders')->name('orders.pending');
                Route::get('/view/processing', 'Backend\Order\OrderController@processingOrders')->name('orders.processing');
                Route::get('/view/completed', 'Backend\Order\OrderController@completedOrders')->name('orders.completed');
                Route::get('/view/declined', 'Backend\Order\OrderController@declinedOrders')->name('orders.declined');
                Route::get('/view/on-delivery', 'Backend\Order\OrderController@onDeliveryOrders')->name('orders.ondelivery');
                Route::get('/dashboard', 'Backend\Order\OrderController@dashboard')->name('orders.dashboard');
            });



            Route::get('bkash/refund/{id}', 'BkashRefundController@index')->name('bkash-refund');
            Route::post('bkash/refund/{id}', 'BkashRefundController@refund')->name('bkash-refund');


            Route::get('bkash/refund/status/{id}', 'BkashRefundController@refundStatus')->name('bkash-refund-status');
            Route::post('bkash/refund/status/{id}', 'BkashRefundController@refundStatusPost');



            //Report routes
            Route::get('/report', 'Backend\Report\ReportController@index')->name('report')->middleware('admin');
            Route::post('/dateby', 'Backend\Report\ReportController@dateBy')->middleware('admin');


            Route::get('/cacheclear', 'Backend\Setting\SettingController@Cache')->name('cacheclear');


            /*General Setting Routes starts*/
            /* admin and moderator access */
            Route::prefix('setting')->middleware('moderator')->namespace('Backend\Setting')->group(function () {
                Route::get('/campaign', 'SettingController@campaign')->name('campaign.view');
                Route::post('/storeCampaign', 'SettingController@storeCampaign')->name('campaign.store');
                Route::get('/logo', 'SettingController@logo')->name('logo.view');
                Route::post('/storeLogo', 'SettingController@storeLogo')->name('logo.store');
                Route::post('/storeBarText', 'SettingController@storeBarText')->name('BarText.store');
                Route::post('/storeBannerLink', 'SettingController@storeBannerLink')->name('BannerLink.store');
                Route::get('/footer', 'SettingController@footer')->name('footer.view');
                Route::post('/storeFooter', 'SettingController@storeFooter')->name('footer.store');
                Route::get('/favicon', 'SettingController@favicon')->name('favicon.view');
                Route::post('/storeFavicon', 'SettingController@storeFavicon')->name('favicon.store');
                Route::get('/shipping', 'SettingController@shipping')->name('shipping.view');
                Route::post('/addShipping', 'SettingController@addShipping')->name('shipping.add');
                Route::get('/{method}/editShipping', 'SettingController@editShipping')->name('shipping.edit');
                Route::post('/{method}/updateShipping', 'SettingController@updateShipping')->name('shipping.update');
                Route::delete('/{method}/deleteShipping', 'SettingController@deleteShipping')->name('shipping.delete');
                Route::get('/{method}/status/updateShippingStatus', 'SettingController@updateShippingStatus');
                Route::get('/services', 'SettingController@services')->name('services.view');
                Route::post('/storeService', 'SettingController@storeService')->name('service.add');
                Route::get('/{service}/editService', 'SettingController@editService')->name('service.edit');
                Route::post('/{service}/updateService', 'SettingController@updateService')->name('service.update');
                Route::delete('/{service}/deleteService', 'SettingController@deleteService')->name('service.delete');
                Route::get('/contactUs', 'SettingController@contactUs')->name('contactUs.view');
                Route::post('/storeContacts', 'SettingController@storeContacts')->name('contacts.add');
                Route::get('/headerText', 'SettingController@headerText')->name('header.text');
                Route::post('/addHeaderText', 'SettingController@addHeaderText')->name('HeaderText.add');

                Route::get('/sliders', 'SettingController@sliders')->name('sliders.view');

                Route::get('/product/sliders', 'SettingController@productSliders')->name('product.sliders');
                Route::post('/product/sliders', 'SettingController@productSlidersStore');
                Route::post('/product/sliders/{id}', 'SettingController@productSlidersUpdate')->name('product.slider.update');
                Route::get('/product/sliders/delete/{id}', 'SettingController@productSlidersDelete')->name('product.slider.delete');


                Route::get('/subcategoryslider', 'SettingController@subcategoryslider')->name('subcategoryslider.view');
                Route::post('/subcategoryslider', 'SettingController@subcategorysliderstore');
                Route::post('/subcategoryslider/update/{id}', 'SettingController@subcategorysliderUpdate')->name('subcategoryslider.update');
                Route::get('/subcategoryslider/delete/{id}', 'SettingController@subcategorysliderDelete')->name('subcategoryslider.delete');


                Route::post('/storeSlider', 'SettingController@storeSlider')->name('slider.add');
                Route::get('/{slider}/editSlider', 'SettingController@editSlider')->name('slider.edit');
                Route::post('/{slider}/updateSlider', 'SettingController@updateSlider')->name('slider.update');
                Route::delete('/{slider}/deleteSlider', 'SettingController@deleteSlider')->name('slider.delete');
                Route::get('/advertise', 'SettingController@advertise')->name('advertise.view');
                Route::post('/storeAdvertise', 'SettingController@storeAdvertise')->name('advertise.add');
                Route::get('/{advertise}/editAdvertise', 'SettingController@editAdvertise')->name('advertise.edit');
                Route::post('/{advertise}/updateAdvertise', 'SettingController@updateAdvertise')->name('advertise.update');
                Route::delete('/{advertise}/deleteAdvertise', 'SettingController@deleteAdvertise')->name('advertise.delete');


                Route::get('/menu', 'FooterMenuController@menu')->name('menu');
                Route::get('/add-menu', 'FooterMenuController@add_menu')->name('add_menu');
                Route::post('/save-menu', 'FooterMenuController@save_menu')->name('store_menu');
                Route::get('/menu-edit/{id}', 'FooterMenuController@edit_menu')->name('edit');
                Route::post('/menu-update', 'FooterMenuController@update_menu')->name('store_menu');
                Route::get('/menu-delete/{id}', 'FooterMenuController@delete_menu')->name('delete');

                Route::delete('/{id}/menu', 'FooterMenuController@delete_menu');
                Route::delete('/{id}/sub-menu', 'FooterMenuController@delete_submenu');

                Route::get('/view-submenu', 'FooterMenuController@view_sub_menu')->name('view_sub_menu');
                Route::get('/sub_menu', 'FooterMenuController@sub_menu')->name('sub_menu');
                Route::post('/save-sub-menu', 'FooterMenuController@save_sub_menu')->name('store_menu');
                Route::get('/sub-delete/{id}', 'FooterMenuController@delete_sub_menu')->name('sub_delete');
                Route::get('/sub-edit/{id}', 'FooterMenuController@edit_sub_menu')->name('sub_edit');
                Route::post('/update-sub-menu/{id}', 'FooterMenuController@update_sub_menu')->name('store_menu');


                // Refund Routes for bKash




                /*slider*/
                route::get('/sliders', 'SettingController@sliders')->name('sliders.view');
                route::post('/storeslider', 'SettingController@storeslider')->name('slider.add');
                route::get('/{slider}/editslider', 'SettingController@editslider')->name('slider.edit');
                route::post('/{slider}/updateslider', 'SettingController@updateslider')->name('slider.update');
                route::delete('/{slider}/deleteslider', 'SettingController@deleteslider')->name('slider.delete');

                //Top-navbar menu settings route
                Route::get('/topmenu/view', 'TopMenuController@index')->name('topmenu.view');
                Route::post('/topmenu/store', 'TopMenuController@store');
                Route::get('/{topmenu}/topmenu/edit', 'TopMenuController@edit');
                Route::post('/{topmenu}/topmenu/update', 'TopMenuController@update');
                Route::get('/{topmenu}/topmenu/statusUpdate', 'TopMenuController@statusUpdate');
                Route::delete('/{topmenu}/topmenu/delete', 'TopMenuController@delete');

                //Facebook pixel setup routes
                Route::get('/pixel/view', 'PixelController@index')->name('pixel.view');
                Route::get('/pixel/details', 'PixelController@details')->name('pixel.details');
                Route::post('/pixel/store', 'PixelController@store');

                Route::get('terms-condition', 'SettingController@termsCondition')->name('setting.terms');
                Route::post('terms-condition', 'SettingController@termsConditionStore');
            });
            /*General Setting routes ends*/

            /* admin and moderator access */
            Route::prefix('social')->middleware('moderator')->group(function () {
                Route::get('/socialLinks', 'Backend\Setting\SettingController@socialLinks')->name('socialLinks.view');
                Route::post('/socialLinksStore', 'Backend\Setting\SettingController@socialLinksStore')->name('socialLinks.store');
                route::get('/topmenu/view', 'Backend\Setting\TopMenuController@index')->name('topmenu.view');
                Route::post('/topmenu/store', 'Backend\Setting\TopMenuController@store');
                Route::get('/{topmenu}/topmenu/edit', 'Backend\Setting\TopMenuController@edit');
                Route::patch('/{topmenu}/topmenu/update', 'Backend\Setting\TopMenuController@update');
                Route::get('/{topmenu}/topmenu/statusUpdate', 'Backend\Setting\TopMenuController@statusUpdate');
                Route::delete('/{topmenu}/topmenu/delete', 'Backend\Setting\TopMenuController@delete');
            });
            /*Social setting ends*/


            /*Category Routes starts*/
            Route::prefix('brand')->group(function () {
                Route::get('/view', 'Backend\Brand\BrandController@index')->name('brand.view');
                Route::post('/addbrand', 'Backend\Brand\BrandController@brandCreate');
            });
            /*Category routes ends*/
            // product
            Route::prefix('product')->group(function () {
                // Route::get('/Product','Backend\Product\ProductController@Product')->name("addProduct");
                // Route::post('/createProduct','Backend\Product\ProductController@createProduct')->name("createProduct");
                Route::get('/allProducts', 'Backend\Product\ProductController@showProducts')->name("allProducts");
                Route::get('/{product}/status/update', 'Backend\Product\ProductController@statusUpdate');
                Route::get('/{product}/featured/update', 'Backend\Product\ProductController@featuredUpdate');
                Route::get('/productEdit/{id}', 'Backend\Product\ProductController@productEdit')->name("productEdit");
                Route::post('/productUpdate/{id}', 'Backend\Product\ProductController@productUpdate')->name("productUpdate");
                // Route::get('/productDelete/{id}','Backend\Product\ProductController@productDelete')->name("productDelete");
                Route::get('/productView/{id}', 'Backend\Product\ProductController@productView')->name("productView");
                Route::get('/deActivatedProducts', 'Backend\Product\ProductController@deActivatedProducts')->name("deActivatedProducts");
            });
        });

        //vendor
        /* admin and moderator access */
        Route::prefix('vendor')->middleware('moderator')->group(function () {
            Route::get('/vendorsList', 'Backend\Vendor\VendorController@vendorShow')->name("vendorShow");
            Route::get('/deactivatedvendorsList', 'Backend\Vendor\VendorController@deactivatedvendor')->name("vendorDeactivated");
            Route::get('/{vendor}/status/update', 'Backend\Vendor\VendorController@statusUpdate');
            Route::get('/{vendor}/feature/update', 'Backend\Vendor\VendorController@featureUpdate');

            Route::get('/{vendor}/edit', 'Backend\Vendor\VendorController@edit');
            Route::post('/{vendor}/update', 'Backend\Vendor\VendorController@update');
            Route::post('/vendormail', 'Backend\Vendor\VendorController@sendmail')->name("vendorEmail");
            Route::delete('/{vendor}/delete', 'Backend\Vendor\VendorController@delete');
            Route::get('/withdrawrequest', 'Backend\Vendor\VendorController@withdraw')->name('withdraw');
            Route::get('/{id}/withdrawrequest', 'Backend\Vendor\VendorController@withdrawUpdate');
            Route::get('/{id}/withdrawview', 'Backend\Vendor\VendorController@withdrawView');

            Route::get('/minimum-withdraw', 'Backend\Setting\MinimumWithdrawController@index')->name('minimum.withdraw.view');
            Route::post('/storeMinimumWithdraw', 'Backend\Setting\MinimumWithdrawController@storeMinimumWithdraw')->name('minimum.withdraw.add');
            Route::get('edit/minimum-withdraw', 'Backend\Setting\MinimumWithdrawController@editMinimumWithdraw')->name('minimum.withdraw.edit');

            //top vendor
            Route::get('/top-vendor', 'Backend\Setting\TopVendorController@topVendor')->name('topvendor.view');
            Route::post('/top-vendor', 'Backend\Setting\TopVendorController@storeTopVendor');
            Route::get('/top-vendor/details', 'Backend\Setting\TopVendorController@topVendorDetails');
        });


        //cutomer
        /* admin and moderator access */
        Route::prefix('customer')->middleware('moderator')->group(function () {
            Route::get('/customerList', 'Backend\Vendor\VendorController@customerShow')->name("customerShow");
            Route::get('/{customer}/status/update', 'Backend\Vendor\VendorController@customerStatusUpdate');
            Route::get('/{customer}/edit', 'Backend\Vendor\VendorController@customerEdit');
            Route::post('/{customer}/update', 'Backend\Vendor\VendorController@customerUpdate');
            Route::delete('/{customer}/delete', 'Backend\Vendor\VendorController@customerDelete');
        });



        /*Sub Category Routes Starts*/
        Route::prefix('subcategory')->group(function () {
            Route::get('/view', 'Backend\Category\SubCategoryController@index')->name('subcategory.view');
            Route::post('/store', 'Backend\Category\SubCategoryController@store');
            Route::get('/{subCategory}/edit', 'Backend\Category\SubCategoryController@edit');
            Route::post('/{subCategory}/update', 'Backend\Category\SubCategoryController@update')->name('subcategory-update');
            Route::get('/{subCategory}/statusUpdate', 'Backend\Category\SubCategoryController@statusUpdate');
            Route::delete('/{subCategory}/delete', 'Backend\Category\SubCategoryController@delete');
        });
        /*Sub Category Routes Ends*/
        /*Child Category Routes Starts*/
        Route::prefix('childcategory')->group(function () {
            Route::get('/view', 'Backend\Category\ChildCategoryController@index')->name('childCategory.view');
            Route::post('/store', 'Backend\Category\ChildCategoryController@store');
            Route::get('/{childCategory}/edit', 'Backend\Category\ChildCategoryController@edit');
            Route::patch('/{childCategory}/update', 'Backend\Category\ChildCategoryController@update');
            Route::get('/{childCategory}/statusUpdate', 'Backend\Category\ChildCategoryController@statusUpdate');
            Route::delete('/{childCategory}/delete', 'Backend\Category\ChildCategoryController@delete');
        });
        /*Child Category Routes ends*/
        /*Brands Routes starts*/
        Route::prefix('brand')->group(function () {
            Route::get('/view', 'Backend\Brand\BrandController@index')->name('brand.view');
            Route::post('/store', 'Backend\Brand\BrandController@store');
            Route::delete('/{brand}/delete', 'Backend\Brand\BrandController@delete');
            Route::get('/{brand}/edit', 'Backend\Brand\BrandController@edit');
            Route::post('/{brand}/update', 'Backend\Brand\BrandController@update');
            Route::get('/{brand}/status/update', 'Backend\Brand\BrandController@statusUpdate');
            Route::get('/{brand}/featured/update', 'Backend\Brand\BrandController@featuredUpdate');
        });


        /*Admin access only*/
        Route::prefix('admin')->middleware('admin')->group(function () {
            Route::get('/view', 'Backend\Admin\AdminController@index')->name('admin.view');
            Route::post('/store', 'Backend\Admin\AdminController@store');
            Route::delete('/{admin}/delete', 'Backend\Admin\AdminController@delete');
            Route::get('/{admin}/edit', 'Backend\Admin\AdminController@edit');
            Route::post('/{admin}/update', 'Backend\Admin\AdminController@update');
            Route::get('/{admin}/status/update', 'Backend\Admin\AdminController@statusUpdate');
        });

        Route::get('markasread', function () {
            DB::table('notifications')->orderBy('id', 'DESC')
                ->whereNull('read_at')->update(['read_at' => now(), 'read_by' => Auth::id()]);
            return redirect()->back();
        })->name('markAllAsRead');


        Route::get('vendormarkasread', function () {
            DB::table('notifications')->orderBy('id', 'DESC')
                ->whereNull('read_at')
                ->where('data->type', '!=', 'order')
                ->update(['read_at' => now(), 'read_by' => Auth::id()]);
            return redirect()->back();
        })->name('vendor.markAllAsRead');

        Route::get('/withdrawmarkasread', function () {
            DB::table('notifications')->orderBy('id', 'DESC')
                ->whereNull('read_at')
                ->where('data->type', '!=', 'order')
                ->update(['read_at' => now(), 'read_by' => Auth::id()]);
            return redirect()->back();
        })->name('withdraw.markAllAsRead');

        Route::get('/notify/order-details/{o_id}', 'Backend\Order\OrderController@notifyOrderDetails')->name('notify.order.details');
        Route::get('/notify/vendor-list/{note_id}', function ($note_id) {
            DB::table('notifications')->orderBy('id', 'DESC')
                ->where('id', $note_id)
                ->update(['read_at' => now(), 'read_by' => Auth::id()]);
            return redirect('/admin/vendor/vendorsList');
        });

        Route::get('/notify/user-list/{note_id}', function ($note_id) {
            DB::table('notifications')->orderBy('id', 'DESC')
                ->where('id', $note_id)
                ->update(['read_at' => now(), 'read_by' => Auth::id()]);
            return redirect('/admin/customer/customerList');
        });

        Route::get('/notify/withdraw-req/{note_id}', function ($note_id) {
            DB::table('notifications')->orderBy('id', 'DESC')
                ->where('id', $note_id)
                ->update(['read_at' => now(), 'read_by' => Auth::id()]);
            return redirect('admin/vendor/withdrawrequest');
        })->name('notify.withdraw');
    });

    /* admin and moderator access */
    /*product Review*/
    route::post('/rating', 'RatingController@index')->name('productrating');
    route::get('/csrf-token', 'CsrfController@csrfToken')->name('csrf-token');

    Route::middleware('auth')->group(function () {

        // SSLCOMMERZ Start
        Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
        Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

        Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
        Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

        Route::post('/success', [SslCommerzPaymentController::class, 'success']);
        Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
        Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

        Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
        //SSLCOMMERZ END

    });


    //Reoptimized class loader:
    Route::get('/optimize', function () {
        Artisan::call('optimize');
        return '<h1>Reoptimized class loader</h1>';
    });




    Route::get('mobile-checkout/{code}', 'Frontend\FrontendController@mobilecheckout')->name('mobile-checkout');


    Route::get('newarrival/fileterbytime', 'Frontend\FrontendController@filterBytime')->name('filter.time');

    Route::get('help-center', 'Frontend\FrontendController@helpCenter')->name('help');
    Route::get('help-center/articles/{id}', 'Frontend\FrontendController@helpCenterArticles')->name('help.articles');
    Route::get('help-center/ajax', 'Frontend\FrontendController@helpCenterAjax')->name('help.ajax');

    Route::post('save-my-place', 'Frontend\FrontendController@saveMyPlace')->name('save-my-place');


    Route::post('my-place/{user}', 'Frontend\FrontendController@deleteMyPlace')->name('delete.my_place');

    //  Route::post('/amarpayment','AmarpayController@index');

    //  Route::post('/success','AmarpayController@success')->name('success');

    //  Route::post('/fail','AmarpayController@fail')->name('fail');

    Route::get('lang', 'Frontend\FrontendController@lang')->name('changeLang');

    Route::get('{pages}', 'Frontend\FrontendController@page')->name('pages');

    Route::get('{slug}', 'Backend\Setting\FooterMenuController@footer_menu_details')->name('footer_menu');
});
