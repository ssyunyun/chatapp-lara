<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\SessionController;

class CheckSession
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
        $userId = $request->header($userId);
        $token = $request->header($token);

        $controller = new SessionController;//インスタンス化
        $check = $controller->checkSession($userId, $token);
        if($check == 1) {
            return $next($request);
        } else {
            return "Error";
        }

    }
}
