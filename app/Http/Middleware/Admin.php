<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
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
        $user = Auth::user();
        if(!empty($user)){
            if($user->role==1){
                return $next($request);
            }
            else{
                request()->session()->flash('error','You do not have any permission to access this page');
                return redirect('/');
            }
        } else return $next($request);
        
    }
}
