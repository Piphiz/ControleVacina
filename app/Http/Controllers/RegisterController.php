<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Register;
use App\Models\User;
use App\Models\Vaccine;
use App\Services\RegisterService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $register;
    protected $vaccine;
    protected $registerService;

    public function __construct(Register $register, Vaccine $vaccine, RegisterService $registerService)
    {
        $this->register = $register;
        $this->vaccine = $vaccine;
        $this->registerService = $registerService;
    }

    public function index()
    {
        $register = $this->register->paginate(10); //with

        return response()->json($register, 200);
    }

    public function register()
    {
        try {
            $data = $this->registerService->createARegister();
            $this->register->create($data);
            return response()->json(['message' => 'Registro criado com sucesso'],201);
        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()],$e->getCode());
        }
    }

    public function show(Register $register, $id)
    {
        $register = $this->register->findOrFail($id);
        return response()->json($register, 200);
    }

    public function destroy($id)
    {
        $register = $this->register->findOrFail($id);
        $register->destroy($id);
        return response()->json(
            ['message' => 'Usuario deletado com sucesso'],
            204
        );
    }
}
