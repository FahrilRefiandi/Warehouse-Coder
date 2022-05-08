<?php

namespace App\Http\Controllers;

use App\Models\Sarung;
use Illuminate\Http\Request;

class PindahkanSarungController extends Controller
{
    // Pindahkan Sarung Ke WH2
    public function pindahkanSarungWh2()
    {
        $data=Sarung::latest()->get();
        return view('backend.pindahkan-ke-wh2',compact('data'));
    }

    public function pindahkanSarungWh2Post(Request $request,$id)
    {
        Sarung::where('id',$id)->update([
            'status' => 'terkirim'
        ]);

        return redirect()->back()->with('tambah',"Data Sarung Berhasil Di Pindahkan");

    }

}
