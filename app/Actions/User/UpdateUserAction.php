<?php

namespace App\Actions\User;

use App\Services\UserService;
use App\Helpers\RedisHashHelper;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Cache;

class UpdateUserAction
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function execute($id, array $data): UserResource
    {
        \Log::info('Update user');
        $user = new UserResource($this->userService->updateUser($id, $data));

        return $user->additional(['message' => 'User updated successfully']);
    }
}
