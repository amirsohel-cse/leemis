<?php

namespace App\Http\Middleware;

use App\Model\Admin;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $admin = Admin::find(Auth::id());
    
        if($admin->role_id == 1){
            return $next($request);
        }
        else if($admin->role_id == 2){
            return redirect()->route('campaign.view');
        }
        elseif($admin->role_id == 3){
            return redirect()->route('allProducts');
        }

        return redirect()->route('orders.dashboard');
    }
}
