<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // nếu user đã đăng nhập
        // if (Auth::check()) {
        //     $user = Auth::user();
        //     // nếu level =1 (admin), status = 1 (actived) thì cho qua.
        //     if ($user->status == 1) {
        //         return $next($request);
        //     } else {
        //         Auth::logout();
        //         return response()->view('user.login');
        //     }
        // } else {
        //     return view('user.login');
        // }
        if (Auth::check()) {
            return $next($request);
        } else {
            return response()->redirectTo('user/login ');
        }
    }
}
