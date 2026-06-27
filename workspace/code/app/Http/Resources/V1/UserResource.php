<?php

namespace App\Http\Resources\V1;

use App\Services\Api\Schemas\UserSchema;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\User
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \App\Models\User $user */
        $user = $this->resource;

        $includePermissions = $request->is('api/v1/me') || $request->is('api/v1/auth/login');

        return UserSchema::resource($user, includePermissions: $includePermissions);
    }
}
