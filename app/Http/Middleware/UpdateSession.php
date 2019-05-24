<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\SessionController;

class UpdateSession
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
        $response = $next($request);

        $userId = $request->header('userId');

        $controller = new SessionController;
        $controller->updateVisitTime($userId);

        return $response;
        
    }
}
