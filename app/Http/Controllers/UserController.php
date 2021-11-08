<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;
    protected $userService;

    public function __construct(
        User $user,
        UserService $userService
    ) {
        $this->user = $user;
        $this->userService = $userService;
    }

    public function index()
    {
        $user = $this->user->paginate(10);

        return response()->json($user, 200);
    }

    public function store(UserRequest $request)
    {
        try {
            $this->userService->checkIfExist();

            $data = $request->all();
            $this->user->create($data);
            return response()->json(
                ['message' => 'Usuario criado com sucesso'],
                201
            );
        } catch (\Exception $e) {
            return response()->json(
                ['Error' => $e->getMessage()],
                $e->getCode()
            );
        }
    }

    public function show(User $user, $id)
    {
        $user = $this->user->findOrFail($id);
        return response()->json($user, 200);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->user->findOrFail($id);
        try {
            $data = $request->all();
            $user->update($data);
            return response()->json(
                ['message' => 'Usuario atualizado com sucesso'],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                ['Error' => 'Erro ao atualizar usuario'],
                500
            );
        }
    }

    public function destroy($id)
    {
        $user = $this->user->findOrFail($id);
        $user->destroy();
        return response()->json(
            ['message' => 'Usuario deletado com sucesso'],
            204
        );
    }
}
