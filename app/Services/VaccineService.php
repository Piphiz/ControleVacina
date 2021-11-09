<?php

namespace App\Services;

use App\Http\Requests\VaccineRequest;
use App\Models\Vaccine;
use Carbon\Carbon;

class VaccineService
{
    protected $vaccine;
    protected $vaccineRequest;

    public function __construct(Vaccine $vaccine, VaccineRequest $vaccineRequest)
    {
        $this->vaccine = $vaccine;
        $this->vaccineRequest = $vaccineRequest;
    }

    public function checkList(){
        $data = $this->vaccineRequest->all();

        if (Carbon::parse($data['expiration_date']) < Carbon::now()) {
            throw new \Exception('Data invalida', 422);
        }
    }

}
