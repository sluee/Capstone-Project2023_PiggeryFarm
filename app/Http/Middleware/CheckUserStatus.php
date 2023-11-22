<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('Middleware is being executed');

        if (auth()->check()) {
            $status = auth()->user()->status;
            Log::info('User status: ' . $status);

            if ($status === 0) {
                auth()->logout();
                return redirect()->route('login')->with('error', 'Your account is inactive. Contact the administrator for assistance.');
            }
        }
        return $next($request);
    }
}
