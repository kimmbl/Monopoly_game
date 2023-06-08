<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckModer
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->is_admin || $request->user()->is_moder)
            return $next($request);
        else
            return redirect('404');
    }
}
