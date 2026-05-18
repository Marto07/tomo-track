<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();   

        $user = Auth::user();

        // sanctum token creation
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message'     => 'logged in successfully',
            'user'        => $user,
            'access_token'=> $token,
            'token_type'  => 'Bearer',
        ]);
    }
}
