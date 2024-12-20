<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'specialization',
        'start_date',
        'status',
    ];
        protected $casts = [
            'start_date' => 'date'
        ];

}
