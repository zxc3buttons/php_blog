<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        event(new Registered($user = $this->store($request)));

        Auth::guard('api')->login($user);

        return $this->registered($user);
    }

    /**
     * @param $user
     * @return JsonResponse
     */
    protected function registered($user): JsonResponse
    {
        $user->generateToken();

        return response()->json(['data' => $user->toArray()], 201);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request): mixed
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        return User::create($data);
    }
}
