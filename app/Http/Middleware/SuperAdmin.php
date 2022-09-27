<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $txt)
    {
        $txt_arr = explode("|", $txt);
        foreach ($txt_arr as $r) {
            if (strtolower(Auth::user()->role) === strtolower($r)) {
                return $next($request)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT,PATCH, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers','Content-Type','Authorization');
            }
        }
        return response()->json(['error' => 'Unauthenticated.'], 403);
    }
}
