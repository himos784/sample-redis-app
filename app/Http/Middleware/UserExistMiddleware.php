<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\ResponseJsonHelper;
use App\Repositories\UserRepository;
use Symfony\Component\HttpFoundation\Response;

class UserExistMiddleware
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $this->userRepository->findById($request->id);

        if (empty($user)) {
            return ResponseJsonHelper::notFound('User not found');
        }

        return $next($request);
    }
}
