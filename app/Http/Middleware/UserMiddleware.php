<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()) {
            $user = Auth::user();
            if($user->role == "business" && $user->status == 'active') {
                return $next($request);
            }else{
                Auth::logout();
                return redirect()->back()->with("error","Oops, insufficient access. Please contact administration for assistance.");
            }
        }else{
            
            return redirect()->route('login.get');
        }
    }
}
