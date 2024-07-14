<?php

namespace App\Actions\User;

use App\Services\UserService;
use App\Helpers\RedisHashHelper;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Cache;

class RetrieveUsersAction
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function execute(array $data)
    {
        $page = $data['page'] ?? 1;
        $limit = $data['limit'] ?? 10;
        $key = "page_{$page}_limit_{$limit}";
        $pages = Cache::get('user_pages');

        // Checks new key is within cache or cache is empty
        if(empty($pages) || !in_array($key, Cache::get('user_pages'))) {
            $pages[] = $key;
            Cache::put('user_pages', $pages);
        }

        // Expires in 30mins
        return Cache::remember($key, 1800, function () use($data) {
            return UserResource::collection($this->userService->getUsers($data))->additional(['message' => 'Users fetched successfully',]);
        });
    }
}
