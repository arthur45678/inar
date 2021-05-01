<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class InvestorUser
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

        if(Auth::user()){
            if(Auth::user()->type == User::TYPE_INVESTOR){
                return $next($request);
            }
            return redirect('/');
        }

        return redirect('/');

    }
}
