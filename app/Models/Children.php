<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    public $table = 'children';
    public $timestamps = false;
    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'strawberry_church',
        'academy_year',
        'parents',
        'phone_number',
        'gender',
        'parish',
        'mid_semester_1',
        'semester_1',
        'mid_semester_2',
        'semester_2',
    ];
}
