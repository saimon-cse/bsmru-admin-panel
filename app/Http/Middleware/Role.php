<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // if($request->user()->role !== $role){
        //     Auth::guard('web')->logout();

        //     $request->session()->invalidate();

        //     $request->session()->regenerateToken();

        //     return redirect('/approval-pending');

        // }
        // return $next($request);

        if (Auth::check()) {
            if (auth()->user()->isApprove == true) {
                return $next($request);
            } else if (auth()->user()->isApprove == false) {
                Auth::logout();
                return Redirect::route('approval-pending');
            }

            else {
                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return redirect('/login');
            }
        }
        if(!Auth::check()){
            return redirect('/login');
        }


    }
}
