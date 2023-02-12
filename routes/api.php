<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::post('myorder','Api\OrderController@index');

    Route::post('profile-update','Api\UserController@profileUpdate');
    
    Route::post('place-order','Api\UserController@preOrder');
    
    Route::post('online-payment','Api\OrderController@pay'); 
    
    Route::post('review','Api\FrontendController@review');
    Route::post('my-place','Api\FrontendController@myPlace');

});

Route::post('shipping','Api\FrontendController@shipping');

Route::post('registration','Api\RegistrationController@registration');
Route::post('login','Api\LoginController@login');

Route::post('categories','Api\CategoryController@index');
Route::post('all-categories','Api\CategoryController@allCategory');


Route::post('filter-product','Api\ProductController@filterProduct');

Route::post('all-products','Api\ProductController@allProduct');

Route::post('sliders','Api\FrontendController@slider');

Route::post('banners','Api\FrontendController@banners');

Route::post('send-again','Api\RegistrationController@sendAgain');

Route::post('verify-otp','Api\RegistrationController@verifyOtp');

Route::post('vendors','Api\FrontendController@vendors');
Route::get('vendorsss','Api\FrontendController@vendorsss');

Route::post('search','Api\FrontendController@search');

Route::post('social-login','Api\FrontendController@socialLogin');

Route::post('forgot-password','Api\LoginController@forgotMobile');

Route::post('otp','Api\LoginController@otpverify');
Route::post('reset-password','Api\LoginController@resetPassword');
Route::post('category-product','Api\FrontendController@categoryProduct');
Route::post('vendor-product','Api\FrontendController@vendorProduct');
Route::post('related-product','Api\FrontendController@relatedProduct');

Route::post('product-details','Api\FrontendController@productDetails');
Route::post('app-version','Api\FrontendController@appVersion');



Route::post('subcategory','Api\FrontendController@subcategory');
Route::post('recommended ','Api\FrontendController@recommended');
Route::post('trending ','Api\FrontendController@trending');
Route::post('featured ','Api\FrontendController@featured');
Route::post('topselling ','Api\FrontendController@topselling');
Route::post('latest ','Api\FrontendController@latest');
Route::post('subcategorywithproduct ','Api\FrontendController@subcategorywithproduct');





Route::post('advertisement','Api\FrontendController@advertisement');




