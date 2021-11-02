<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VaccineController extends Controller
{
    public function __construct(Vaccine $vaccine)
    {
        $this->vaccine = $vaccine;
    }

    public function index()
    {
        $vaccine = $this->vaccine->all();

        return response()->json(['data' => $vaccine], 200);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->only(['manufacturer', 'lot', 'doses', 'interval_doses', 'expiration_date']);

            $data['expiration_date'] = Carbon::parse($data['expiration_date']);
            $this->vaccine->create($data);
            return response()->json([],201);
        } catch (\Exception $e) {
            return response()->json([],422);
        }
    }

    public function show(Vaccine $vaccine, $id)
    {
        try {
            $vaccine = $this->vaccine->findOrFail($id);
            return response()->json(['data' => $vaccine], 200);
        } catch (\Exception $e) {
            return response()->json([],404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->only(['manufacturer', 'lot', 'doses', 'interval_doses', 'expiration_date']);

            if($request->has('expiration_date')){
                $data['expiration_date'] = Carbon::parse($data['expiration_date']);
            }

            $vaccine = $this->vaccine->find($id);
            $vaccine->update($data);
            return response()->json([],200);
        } catch (\Exception $e) {
            return response()->json([],404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->vaccine->findOrFail($id);
            $this->vaccine->destroy($id);
            return response()->json([],200);
        } catch (\Exception $e) {
            return response()->json([],404);
        }
    }
}
