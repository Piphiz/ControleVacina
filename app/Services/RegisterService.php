<?php

namespace App\Services;

use App\Http\Requests\RegisterRequest;
use App\Models\Register;
use App\Models\Vaccine;
use Carbon\Carbon;

class RegisterService
{
    protected $register;
    protected $registerRequest;
    protected $vaccine;

    public function __construct(Register $register, RegisterRequest $registerRequest, Vaccine $vaccine)
    {
        $this->register = $register;
        $this->registerRequest = $registerRequest;
        $this->vaccine = $vaccine;
    }

    public function createARegister()
    {
        $data = $this->registerRequest->all();
        $vaccine = $this->vaccine->where('id', '=', $data['vaccine_id'])->first();

        if ($this->register->where('user_id', '=', $data['user_id'])->first() === null) {
            $data['next_dose'] = Carbon::now()->add($vaccine['interval_doses'], 'day');
            $data['dose_number'] = 1;
            return $data;

        } else {
            $register = $this->register->where('user_id', '=', $data['user_id'])->latest('created_at')->first();
            $vaccineOld = $this->vaccine->where('id', '=', $register['vaccine_id'])->first();

            if (
                $this->validateManufacturer($vaccineOld, $vaccine) &&
                $this->validateDoses($register, $vaccine) &&
                $this->validateDate($register)
            ) {
                $data['next_dose'] = Carbon::now()
                    ->add(
                        ($this->vaccine->where('id', '=', $data['vaccine_id'])->first())['interval_doses'],
                        'day'
                    );
                $data['dose_number'] = 1 + $register['dose_number'];
                return $data;
            }
        }
    }

    public function validateManufacturer($vaccineOld, $vaccine)
    {
      if ($vaccineOld['manufacturer'] === $vaccine['manufacturer']) {
        return true;
      } else {
        throw new \Exception('Fabricantes diferentes', 422);
      }
    }

    public function validateDoses($register, $vaccine)
    {
      if ($register['dose_number'] < $vaccine['doses']) {
        return true;
      } else {
        throw new \Exception('Todas as Doses ja foram aplicadas', 422);
      }
    }

    public function validateDate($register)
    {
      if (Carbon::now()->gt($register['next_dose'])) {
        return true;
      } else {
        throw new \Exception(
            'Ainda nao deu o prazo, aguarde mais ' . Carbon::now()->diffInDays($register['next_dose']) . ' dias',
            422
        );
      }
    }
}
