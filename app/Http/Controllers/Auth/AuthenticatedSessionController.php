<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
        ]);

        $user = User::findOrFail($request->email);

        return response()->json([
            'status' => 'success',
            'message' => 'User Registered!',
            'accessToken' => $this->generateToken($user),
        ]);
    }

    /**
     * Generates a new JWT.
     */
    private function generateToken(User $user)
    {
        $payload = array(
            "id" => $user->id,
        );

        return JWT::encode($payload, config('jwt.key'));
    }
}
