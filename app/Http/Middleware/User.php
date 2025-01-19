<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class User
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
        // $user = Auth::user();
        // if ($user) {
        //     if (in_array($user->role_id, [2])) {
        //         if ($user->status != 1) {
        //             Auth::logout();
        //             if ($request->ajax()) {
        //                 return response()->json(
        //                     [
        //                         'status' => false,
        //                         'message' => trans('auth.account_deactivate')
        //                     ],
        //                     401
        //                 );
        //             }
        //             return redirect('/')->with('warning', trans('auth.account_deactivate'));
        //         }
        //         return $next($request);
        //     }
        //     return redirect('/')->with('warning', trans('auth.sufficient_permissions'));
        // }
        // return redirect('/')->with('warning', trans('auth.account_deleted'));
    }
}
