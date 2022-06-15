<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduksiLembaran extends Model
{
    use HasFactory;

    protected $table = 'produksi_lembaran';
    protected $guarded = ['id'];
}
