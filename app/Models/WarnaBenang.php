<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarnaBenang extends Model
{
    use HasFactory;
    protected $table = 'warna_benang';
    protected $fillable=['warna_benang','kode_warna'];
}
