<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $guard = Auth::guard('api');

        if ($guard->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = $guard->user();
            $user->generateToken();

            return response()->json([
                'data' => $user->toArray(),
            ]);
        }

        return response()->json(['error' => 'Invalid credentials',], 401);
    }
}
