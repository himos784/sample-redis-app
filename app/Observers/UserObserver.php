<?php

namespace App\Observers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Cache;

class UserObserver
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        \Log::info('Caching created user');
        $this->userService->cachedUser($user->id);

        \Log::info('Clear cache paginated users');
        $this->userService->flushUserCachedPages();
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        // Removes previously cached user
        $id = $user->id;
        Cache::forget("user_{$id}");

        \Log::info('Caching updated user');
        $this->userService->cachedUser($id);

        \Log::info('Clear cache paginated users');
        $this->userService->flushUserCachedPages();
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        // Removes previously cached user
        $id = $user->id;
        Cache::forget("user_{$id}");

        \Log::info('Clear cache paginated users');
        $this->userService->flushUserCachedPages();
    }
}
