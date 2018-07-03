<?php

namespace QuadStudio\Online;

/**
 * @license MIT
 * @package QuadStudio\Online
 */

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class OnlineMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::check()) {
            Cache::put(
                'user-is-online-' . Auth::user()->getAuthIdentifier(),
                true,
                Carbon::now()->addMinutes(config('online.timeout', 2))
            );
        }

        return $next($request);
    }
}