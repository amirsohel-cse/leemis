<?php

namespace App\Providers;

use App\Model\Brand;
use App\Model\Cart;
use App\Model\Language;
use App\Model\FacebookPixel;
use Illuminate\Contracts\Pagination\Paginator;
use App\Model\Category;
use App\Model\TopMenu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    

        view()->share('cateogries_footer',Category::whereHas('sub_categories')->with('sub_categories.child_categories','sub_categories.topBrand')->where('status','=',1)->latest()->take(5)->get());

        View::composer('components.frontend.header', function ($view) {

            $view->with('categories', Category::select('id','photo','name')
                                        ->whereHas('sub_categories')
                                        ->with('sub_categories','sub_categories.child_categories','sub_categories.topBrand')
                                        ->where('is_featured',1)->where('status','=',1)->limit(17)->get());

            $view->with('carts', Cart::select('id','product_id','price','qty','subtotal','user_id','attributes')->whereHas('product')->where('user_id', auth()->id())->get());
        });

        View::composer('components.frontend.mobile-menu',function ($view){
            $view->with('categories', Category::select('id','photo','name')->with('sub_categories','sub_categories.child_categories')->where('is_featured',1)->where('status','=',1)->limit(17)->get());
        });

        View::composer('components.frontend.header', function ($view) {
            $view->with('top', TopMenu::select('id','name','url')->with('menuCategories.category','menuBrands')->where('status','=',1)->get());
        });

        View::composer('components.frontend.mobile-menu', function ($view) {
            $view->with('top', TopMenu::select('id','name','url')->with('menuCategories.category','menuBrands')->where('status','=',1)->get());
        });

        // delete read notifications after 24 hours when page-topbar loaded
        View::composer('admin.layout.header.page-topbar', function ($view) {
            DB::table('notifications')->where('read_at', '<', now()->subDays(1))->delete();
        });

        //setup send pixel id to frontend master
        View::composer('frontend.master.master', function($view) {
            $view->with('pixel', FacebookPixel::first());
        });
        
        
       
        if(session('lang') != null){
            $Language = Language::where('short_code', session('lang'))->first();
        }else{
            $Language = Language::where('is_default', 1)->first();
            session()->put('lang', $Language->short_code);
        }



       
    }
}
