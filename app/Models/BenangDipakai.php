<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BenangDipakai extends Model
{
    use HasFactory;

    protected $table = 'benang_dipakai';
    protected $guarded = ['id'];
}
