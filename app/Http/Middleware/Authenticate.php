<?php

namespace App\Http\Middleware;

use Closure;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    public function handle($request, Closure $next, ...$guards)
    {
        $user = Auth::user();
        $this->authenticate($request, $guards);
       
       
        if (!empty ($user)) {
            // dd($user);
            if ($user->role == 1) return redirect(RouteServiceProvider::ADMIN);
        } else {
           
            return $next($request);
        }
        
    }
}
