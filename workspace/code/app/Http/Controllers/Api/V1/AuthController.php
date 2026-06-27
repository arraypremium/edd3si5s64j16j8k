<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Support\Data;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * Authentication endpoints for API v1 (Sanctum bearer tokens).
 */
class AuthController extends ApiController
{
    /**
     * Create a Sanctum bearer token for a user.
     *
     * @unauthenticated
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $identifier = Data::string($request->input('username'));
        $errorKey = 'username';

        if ($identifier === '') {
            $identifier = Data::string($request->input('email'));
            $errorKey = 'email';
        }

        $user = User::query()
            ->where('username', $identifier)
            ->first();

        if (! $user || ! Hash::check(Data::string($request->input('password')), Data::string($user->password))) {
            throw ValidationException::withMessages([
                $errorKey => ['These credentials do not match our records.'],
            ]);
        }

        $deviceName = Data::string($request->input('device_name')) ?: Data::string($request->userAgent(), 'api');
        $deviceName = mb_substr($deviceName, 0, 255);

        $token = $user->createToken($deviceName)->plainTextToken;

        $user->load('roles');

        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => new UserResource($user),
        ]);
    }

    /**
     * Return the authenticated user (includes roles and permissions).
     */
    public function me(Request $request): UserResource
    {
        /** @var User $user */
        $user = $request->user();

        $user->load('roles');

        return new UserResource($user);
    }

    /**
     * Revoke the current token.
     */
    public function logout(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        if ($request->bearerToken() !== null) {
            $user->currentAccessToken()->delete();
        } else {
            $user->tokens()->delete();
        }

        return $this->noContent();
    }
}
