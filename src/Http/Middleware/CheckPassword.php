<?php

namespace FireBender\Laravel\PictureWorks\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $password = $request->input('password');

        if ($password === null)
        {
            return response('401 Invalid password', 401);
        }

        $password = Str::upper($password);

        if ($password !== '720DF6C2482218518FA20FDC52D4DED7ECC043AB')
        {
            return response('401 Invalid password', 401);
        }

        return $next($request);
    }
}
