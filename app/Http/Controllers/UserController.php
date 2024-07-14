<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Helpers\ResponseJsonHelper;
use Illuminate\Support\Facades\Log;
use App\Actions\User\CreateUserAction;
use App\Http\Requests\UserFormRequest;
use App\Actions\User\RetrieveUserAction;
use App\Actions\User\RetrieveUsersAction;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, RetrieveUsersAction $action)
    {
        try {
            return $action->execute($request->all());
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJsonHelper::error($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserFormRequest $request, CreateUserAction $action) {
        try {
            return $action->execute($request->validated());
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJsonHelper::error($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, RetrieveUserAction $action) {
        try {
            return $action->execute($request->id);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJsonHelper::error($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserFormRequest $request) {
        try {
            $user = $this->userService->updateUser($request->id, $request->validated());

            return ResponseJsonHelper::success($user, 'Sucessfully updated user!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJsonHelper::error($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $response = $this->userService->deleteUser($request->id);

            return ResponseJsonHelper::success($response, 'Sucessfully deleted user!');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseJsonHelper::error($th->getMessage());
        }
    }
}
