<?php

namespace App\Services;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
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
        $users = $this->userRepository->getAll($data);
        // return UserResource::collection($users);
        return UserResource::collection($users)->additional(['message' => 'All users fetched successfully',]);
        // return new UserCollection(User::paginate(200));
        // return UserResource::collection(User::paginate(10));
    }

    public function createUser(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function getUserById($id)
    {
        return new UserResource($this->userRepository->findById($id));
    }

    public function updateUser($id , array $data)
    {
        return $this->userRepository->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }
}
