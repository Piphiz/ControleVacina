<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $user = $this->user->all();

        return response()->json(['data' => $user], 200);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->only(['name', 'email', 'cpf', 'rg', 'phone', 'address', 'birth_date']);

            if ($this->user->where('email', '=', $data['email'])->first() !== null ||
            $this->user->where('cpf', '=', $data['cpf'])->first() !== null ||
            $this->user->where('rg', '=', $data['rg'])->first() !== null) {
                return response()->json([],409);
            }

            if($request->has('birth_date')){
                $data['birth_date'] = Carbon::parse($data['birth_date']);
            }

            $this->user->create($data);
            return response()->json([],201);
        } catch (\Exception $e) {
            return response()->json([],422);
        }
    }

    public function show(User $user, $id)
    {
        try {
            $user = $this->user->findOrFail($id);
            return response()->json(['data' => $user], 200);
        } catch (\Exception $e) {
            return response()->json([],404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->only(['name', 'email', 'cpf', 'rg', 'phone', 'address', 'birth_date']);

            if($request->has('birth_date')){
                $data['birth_date'] = Carbon::parse($data['birth_date']);
            }

            $user = $this->user->find($id);
            $user->update($data);
            return response()->json([],200);
        } catch (\Exception $e) {
            return response()->json([],404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->user->findOrFail($id);
            $this->user->destroy($id);
            return response()->json([],200);
        } catch (\Exception $e) {
            return response()->json([],404);
        }
    }
}
