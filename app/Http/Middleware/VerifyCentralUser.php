<?php

namespace Pmis\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class VerifyCentralUser
{
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!is_super_admin()) {
            return view('errors.access-denied');
        }

        return $next($request);
    }
}
