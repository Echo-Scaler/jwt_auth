<?php

namespace App\Http\Middleware;
use Tymon\JWTAuth\Facades\JWTAuth; //add 
use Exception;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //check the user
        try{
            $user = JWTAuth::parseToken()->authenticate();
            //check
            if(!$user){
                return response()->json([
                    'message' => 'Unauthorized',
                ],401);
            }
        }catch(Exception $e){
            return response()->json([
                'message' => 'Internal Server Error',
                'error'   => $e->getMessage()
            ],500);
        }
        return $next($request);
    }
}
