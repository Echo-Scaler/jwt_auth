<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    public function login()
    {
        try {

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function logout()
    {
        try {

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function me()
    {
        try {

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ],500);
        }
    }
}
