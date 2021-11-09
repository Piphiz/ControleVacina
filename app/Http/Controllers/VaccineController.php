<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateVaccineRequest;
use App\Http\Requests\VaccineRequest;
use App\Models\Vaccine;
use App\Services\VaccineService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VaccineController extends Controller
{
    protected $vaccine;
    protected $vaccineService;

    public function __construct(Vaccine $vaccine, VaccineService $vaccineService)
    {
        $this->vaccine = $vaccine;
        $this->vaccineService = $vaccineService;
    }

    public function index()
    {
        $vaccine = $this->vaccine->paginate(10);

        return response()->json($vaccine, 200);
    }

    public function store(VaccineRequest $request)
    {
        try {
            $this->vaccineService->checkList();

            $data = $request->all();
            $this->vaccine->create($data);
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

    public function show(Vaccine $vaccine, $id)
    {
        $vaccine = $this->vaccine->findOrFail($id);
        return response()->json($vaccine, 200);
    }

    public function update(UpdateVaccineRequest $request, $id)
    {
        $vaccine = $this->vaccine->findOrFail($id);
        try {
            $data = $request->all();
            $vaccine->update($data);
            return response()->json([],200);
        } catch (\Exception $e) {
            return response()->json([],404);
        }
    }

    public function destroy($id)
    {
        $vaccine = $this->vaccine->findOrFail($id);
        $vaccine->destroy();
        return response()->json(['message' => 'Usuario deletado com sucesso'],204);
    }
}
