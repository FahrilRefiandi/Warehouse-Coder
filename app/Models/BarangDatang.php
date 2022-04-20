<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisBenang;

class BarangDatang extends Model
{
    use HasFactory;

    protected $table = 'barang_datang';
    // protected $fillable=['jenis_benang_id','warna_benang_id','jumlah_benang','satuan_id'];
    protected $guarded = ['id'];


    public function jenisBenang()
    {
        return $this->hasOne(JenisBenang::class,'id','jenis_benang_id');
    }

    public function warnaBenang()
    {
        return $this->hasOne(warnaBenang::class,'id','warna_benang_id');
    }

    public function satuanBenang()
    {
        return $this->hasOne(satuanBenang::class,'id','satuan_id');
    }

}
