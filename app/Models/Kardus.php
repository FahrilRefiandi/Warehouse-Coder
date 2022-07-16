<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kardus extends Model
{
    use HasFactory;

    protected $table='kardus';
    protected $guarded=['id'];
}
