<?php

namespace App\Repositories;

use Exception;
use App\Models\User;

class UserRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAll(array $queryData = [])
    {
        return $this->model->orderBy('id','DESC')->paginate($queryData['limit'] ?? 10);
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->findById($id);
        $user->update($data);

        return $user;
    }

    public function delete($id)
    {
        $user = $this->findById($id);

        if ($user) {
            $user->delete();
            return true;
        }

        return false;
    }
}
