<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sarung extends Model
{
    use HasFactory;

    protected $table = 'sarung';
    protected $guarded = ['id'];
}
