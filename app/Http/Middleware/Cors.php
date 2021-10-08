<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{

    public function handle($request, Closure $next)
    {
        $domain = $request->getHost();
        // or $domain =  $_SERVER['HTTP_HOST'];
        return $next($request)
            ->header('Access-Control-Allow-Origin', $domain)
                ->header('Access-Control-Allow-Methods', "PUT,POST,DELETE,GET,OPTIONS")
                ->header('Access-Control-Allow-Headers', "Accept,Authorization,Content-Type");
    }
    
}
