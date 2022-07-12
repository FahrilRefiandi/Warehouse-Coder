<?php

namespace App\Http\Controllers;

use App\Models\ProduksiLembaran;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    // Pindahkan Sarung Ke WH2
    public function kirimKeNapes()
    {
        $data=ProduksiLembaran::latest()->get();
        return view('backend.napes.kirim-ke-napes',compact('data'));
    }

    public function kirimKeNapesPost(Request $request,$id)
    {
        ProduksiLembaran::where('id',$id)->update([
            'status_pengiriman'=>'Terkirim',
            'tanggal_pengiriman'=>date('Y-m-d'),
        ]);

        return redirect()->back()->with('tambah',"Data Sarung Berhasil Di Pindahkan");

    }

}
