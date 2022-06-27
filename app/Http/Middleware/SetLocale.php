<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
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

        $languages = array_keys(config('cz_media.lang'));

        $goLang =  config('app.locale');
        if (session('lang')) {
            $goLang = session('lang');
        }

        if ($request->lang) {
            $goLang =  $request->lang;
            session()->put('lang', $goLang);
            session()->save();
        }


        if (!in_array($goLang, $languages)) {
            abort(400);
        } else {

            \App::setLocale($goLang);
        }


        return $next($request);
    }
}
