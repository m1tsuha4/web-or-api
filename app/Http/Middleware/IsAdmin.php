<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        // $user = Auth::user();
        // if($user->hasRole('admin'))
        // {
        //     return $next($request);
        // } else {
        //     return response('Unauthorized.', 401);
        // }
        // $IsAdmin = $request->user()->role;
        // if ($IsAdmin->hasRole('admin')){
        //     return $next($request);
        // }
            if (Auth::user() &&  Auth::user()->role == 'admin') {
                return $next($request);
           }
    //     if (! $request->user()->hasRole($request->user()->role)) {
    //         // Redirect...
    //     }
    // ;
        // return $next($request);

        // if ($request->user()->role) {
        //     return $next($request);
        // }

        // return $this->unauthorized();
    // }

    // private function unauthorized($message = null)
    // {
    //     return response()->json([
    //         'message' => $message ? $message : 'You are unauthorized to access this resource',
    //         'success' => false
    //     ], 401);
    }
}
