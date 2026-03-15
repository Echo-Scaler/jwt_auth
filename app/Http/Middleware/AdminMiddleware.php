<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         $user = JWTAuth::parseToken()->authenticate();
        if(!$user){
            return response()->json([
                'message' => 'Unauthorized',
            ],401);
        }

        if($user->role !== 'admin'){
            return response()->json([
                'message' => 'This route only can Admin User',
            ],403);
        }
        return $next($request);
    }
}
