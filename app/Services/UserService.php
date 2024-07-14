<?php

namespace App\Services;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\UserCollection;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers(array $data)
    {
        return $this->userRepository->getAll($data);
    }

    public function createUser(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function getUserById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function updateUser($id , array $data)
    {
        return $this->userRepository->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }

    public function cacheUser(User $user, array $additonalData = ['message' => 'User fetched successfully'])
    {
        $key = "user_{$user->id}";

        // Expires in 30mins
        return Cache::remember($key, 1800, function () use($user, $additonalData) {
            $user = new UserResource($user);
            if(!empty($additonalData)) {
                $user->additional($additonalData);
            }
            \Log::info("Cached user_{$user->id}");
            return $user;
        });
    }

    public function flushUserCachedPages() {
        $pages = Cache::get('user_pages');

        if(!empty($pages)) {
            // Forget every user query that was cached
            foreach ($pages as $page) {
                Cache::forget($page);
            }
        }

        Cache::forget('user_pages');
        \Log::info('Done clearing cached paginated users');
    }
}
