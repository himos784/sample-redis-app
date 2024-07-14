<?php

namespace App\Observers;

use App\Models\User;
use App\Services\UserService;

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
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
