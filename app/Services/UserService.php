<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;

class UserService extends BaseService
{
  public function __construct(
    protected UserRepository $repository,
  ) {
    parent::__construct($repository);
  }

  public function store(UserRequest $request): User
  {
    return $this->repository->store((object) $request->validated());
  }

  public function update(int $id, UserRequest $request): User
  {
    $data = (object) $request->validated();
    if (isset($data->password)) {
      return $this->repository->update($id, $data);
    }
    return $this->repository->updateWithoutPwd($id, $data);
  }
}
