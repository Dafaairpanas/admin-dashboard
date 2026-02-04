<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('selected_language')) {
            $lang = session('selected_language');
        } else {
            // Fallback to default
            $default = \App\Models\Languages::where('is_default', 1)->first();
            $lang = $default ? $default->code : 'en';
            session(['selected_language' => $lang]);
        }

        app()->setLocale($lang);

        return $next($request);
    }
}
