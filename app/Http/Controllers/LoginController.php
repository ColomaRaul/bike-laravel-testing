<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

final class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $user = User::where('email', $request->get('email'))->first();
            $token = $user->createToken('token-name')->plainTextToken;

            return response()->json(['access_token' => $token]);
        }

        return response()->json(['message' => 'Credenciales inválidas'], 401);
    }

    public function register(Request $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = $user->createToken('token-name')->plainTextToken;

        return response()->json(['access_token' => $token], 201);
    }
}