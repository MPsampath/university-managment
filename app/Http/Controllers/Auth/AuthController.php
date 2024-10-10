<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public static function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required']);

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('auth_token');
         
            return response()->json(
                ['message' => 'Login successful',
                'user' => Auth::user(),
                'token' => $token->plainTextToken],
                200);
        }
        return response()->json(['message' => 'Login failed'], 401);
    }
}
