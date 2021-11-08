<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Models\User;

class UserService
{
    protected $user;
    protected $userRequest;

    public function __construct(User $user, UserRequest $userRequest)
    {
        $this->user = $user;
        $this->userRequest = $userRequest;
    }

    public function checkIfExist(){
        $data = $this->userRequest->all();

        if (
            $this
                ->user
                ->where('email', '=', $data['email'])
                ->orWhere('cpf', '=', $data['cpf'])
                ->orWhere('rg', '=', $data['rg'])
                ->first()
        ) {
            throw new \Exception('Usuario ja cadastrado', 409);
        }
    }

}
