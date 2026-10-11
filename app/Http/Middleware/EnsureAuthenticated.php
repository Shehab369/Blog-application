<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // لو مفيش user_id في السيشن → رجّع المستخدم على صفحة اللوجين
        if (!session()->has('user_id')) {
            return redirect()->route('homepage')->with('error', 'You need to login first !!');
        }

        // غير كده → كمل عادي
        return $next($request);
    }
}
