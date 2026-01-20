<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\USerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): array
    {
        $request->authenticate();
        $user = $request->user();
        $token = $user->createToken('main')->plainTextToken;

        return [
            'user' => new USerResource($user),
            'token' => $token
        ];
    }

    /**
     * Destwroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
       $user = $request->user();
       $user->currentAccessToken()->delete();
        return response()->noContent();
    }
}
