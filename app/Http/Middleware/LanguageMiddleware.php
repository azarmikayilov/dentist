<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;


class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
//    public function handle(Request $request, Closure $next): Response
//    {
//        return $next($request);
//    }

//    public function handle($request, Closure $next)
//    {
//        $lang = $request->segment(2);
//        if (in_array($lang, ['Az', 'En', 'Ru'])) {
//            Session::put('lang', $lang);
//        }
//
//        return $next($request);
//    }

}
