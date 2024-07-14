<?php

namespace App\Actions\User;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use App\Helpers\ResponseJsonHelper;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Cache;

class DeleteUserAction
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function execute($id): JsonResponse
    {
        \Log::info('Delete user');
        $response = $this->userService->deleteUser($id);

        return ResponseJsonHelper::success($response, 'Sucessfully deleted user!');
    }
}
