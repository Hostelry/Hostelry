<?php

declare(strict_types=1);

namespace Hostelry\Account\Http\Controllers;

use Hostelry\Account\Http\Requests\SignInRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

final class SignInController extends Controller
{
    public function __invoke(SignInRequest $request) : JsonResponse
    {
        $isAuthenticated = Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ]);

        if ($isAuthenticated) {
            $user = $request->user();

            return response()->json([
                'success' => true,
                'api_token' => $user->api_token,
            ]);
        }

        return response()->json([
            'success' => false,
            'error' => "Unauthorized"
        ], 401);
    }
}
