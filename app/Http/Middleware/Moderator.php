<?php

namespace App\Http\Middleware;

use App\Model\Admin;
use Closure;
use Illuminate\Support\Facades\Auth;

class Moderator
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
    
        if($admin->role_id == 1 or 2){
            return $next($request);
        }elseif($admin->role_id == 4){
            return redirect()->route('orders.dashboard');
        }
        else return redirect()->route('allProducts');
    }
}
