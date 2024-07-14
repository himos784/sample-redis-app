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
}
