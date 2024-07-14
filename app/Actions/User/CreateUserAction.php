<?php

namespace App\Actions\User;

use App\Services\UserService;
use App\Helpers\RedisHashHelper;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Cache;

class CreateUserAction
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function execute(array $data): UserResource
    {
        \Log::info('Create user');
        $user = new UserResource($this->userService->createUser($data));

        return $user->additional(['message' => 'User created successfully']);
    }
}
