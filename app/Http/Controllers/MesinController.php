<?php

namespace App\Http\Controllers;

use App\Models\Mesin;
use Illuminate\Http\Request;

class MesinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Mesin::latest()->get();
        return view('backend.mesin',compact('data'));
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_mesin'=>'required|unique:mesin,kode_mesin',
            'nomor_mesin'=>'required|unique:mesin,nomor_mesin|numeric',
        ]);
        Mesin::create($request->all());
        return redirect()->back()->with('tambah',"Data mesin $request->kode_mesin berhasil ditambahkan");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_mesin'=>'required|unique:mesin,kode_mesin,'.$request->id,
            'nomor_mesin'=>'required|unique:mesin,nomor_mesin,'.$request->id.'|numeric'
        ]);
        Mesin::find($request->id)->update($request->all());
        return redirect()->back()->with('tambah',"Data mesin $request->kode_mesin berhasil diubah");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Mesin::find($id)->delete();
        return redirect()->back()->with('hapus',"Data mesin berhasil dihapus");
    }
}
