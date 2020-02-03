<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckBalance
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return RedirectResponse | Response
     */
    public function handle(Request $request, Closure $next)
    {
        //dd(Auth::user());
        //dd($request->user()->balance);
        if ($request->user()->balance < 50) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
