<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login()
    {
        try {
            $credentials = request()->only('email', 'password'); // if exist
            // jwt config ::
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return response()->json([
                'access_token' => $token,
                'token_type' => 'barer',
                'expires_in' => JWTAuth::factory()->getTTL() * 60,  // token expire time create
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function logout()
    {
        try {
            // when logout
            JWT::logout();

            return response()->json([
                'message' => 'Successfully Logged Out',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function me()
    {
        try {
            $authUser = JWTAuth::user();
            return response()->json([
                'message' => 'User retrieved successfully',
                'user' => $authUser,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}