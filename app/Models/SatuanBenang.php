<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuanBenang extends Model
{
    use HasFactory;
    protected $table='satuan_benang';
    protected $fillable=['satuan','singkatan'];
}
