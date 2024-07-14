<?php

namespace App\Actions\User;

use App\Services\UserService;
use App\Helpers\RedisHashHelper;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Cache;

class RetrieveUserAction
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function execute($id)
    {
        $key = "user_{$id}";

        // Expires in 30mins
        return Cache::remember($key, 1800, function () use($id) {
            $user = new UserResource($this->userService->getUserById($id));
            return $user->additional(['message' => 'User fetched successfully']);
        });
    }
}
