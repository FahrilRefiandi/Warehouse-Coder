<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisBenang;

class BenangDatang extends Model
{
    use HasFactory;

    protected $table = 'benang_datang';
    protected $guarded = ['id'];


    // public function jenisBenang()
    // {
    //     return $this->hasOne(JenisBenang::class,'id','jenis_benang_id');
    // }

    // public function warnaBenang()
    // {
    //     return $this->hasOne(warnaBenang::class,'id','warna_benang_id');
    // }

    // public function satuanBenang()
    // {
    //     return $this->hasOne(satuanBenang::class,'id','satuan_id');
    // }

}
