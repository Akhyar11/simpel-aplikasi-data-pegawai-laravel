<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'position',
        'join_date',
        'salary',
        'photo',
        'address',
        'phone'
    ];

    protected $casts = [
        'join_date' => 'date',
        'salary' => 'decimal:2'
    ];
}