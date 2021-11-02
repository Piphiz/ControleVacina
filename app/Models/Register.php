<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vaccine_id',
        'dose_number',
        'next_dose',
    ];

    protected $hidden = [];

    protected $casts = [];
}
