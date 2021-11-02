<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Models\User;
use App\Models\Vaccine;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(Register $register, Vaccine $vaccine)
    {
        $this->register = $register;
        $this->vaccine = $vaccine;
    }

    public function index()
    {
        $register = $this->register->all();

        return response()->json(['data' => $register], 200);
    }

    public function register(Request $request)
    {
        try {
            $data = $request->only(['user_id', 'vaccine_id']);
            $vaccine = $this->vaccine->where('id', '=', $data['vaccine_id'])->first();

            if ($this->register->where('user_id', '=', $data['user_id'])->first() === null) {
                $data['next_dose'] = Carbon::now()->add($vaccine['interval_doses'], 'day');
                $data['dose_number'] = 1;
                $this->register->create($data);

            } else {
                $register = $this->register->where('user_id', '=', $data['user_id'])->latest('created_at')->first();
                $vaccineOld = $this->vaccine->where('id', '=', $register['vaccine_id'])->first();
                
                if($vaccineOld['manufacturer'] === $vaccine['manufacturer'] && $register['dose_number'] < $vaccine['doses'] && Carbon::now()->gt($register['next_dose'])){
                    $data['next_dose'] = Carbon::now()->add(($this->vaccine->where('id', '=', $data['vaccine_id'])->first())['interval_doses'], 'day');
                    $data['dose_number'] = 1 + $register['dose_number'];
                    $this->register->create($data);
                    return response()->json([],201);
                } else {
                    return response()->json(["Regras nao foram cumpridas"],404);
                }
            }
            return response()->json([],201);
        } catch (\Exception $e) {
            return response()->json([$e],422);
        }
    }

    public function show(Register $register, $id)
    {
        try {
            $register = $this->register->findOrFail($id);
            return response()->json(['data' => $register], 200);
        } catch (\Exception $e) {
            return response()->json([],404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->register->findOrFail($id);
            $this->register->destroy($id);
            return response()->json([],200);
        } catch (\Exception $e) {
            return response()->json([],404);
        }
    }
}
