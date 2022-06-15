<?php

namespace App\Http\Controllers;

use App\Models\ProduksiLembaran;
use App\Models\BenangDatang;

use Illuminate\Http\Request;

class ProduksiLembaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=ProduksiLembaran::latest()->get();

        $benang=BenangDatang::latest()->get();

        return view('backend.benang-dipakai',compact('data','benang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'pilih_benang' => 'required',
            'jumlah_pakai' => 'required|numeric',
        ]);

        $benangDatang=BenangDatang::where('id',$request->pilih_benang)->first();
        // dd($benangDatang->satuanBenang->satuan);

        if($benangDatang->jumlah_benang < $request->jumlah_pakai){
            return redirect()->back()->with('kurang','Jumlah benang tidak mencukupi');
        }else{
            ProduksiLembaran::create([
                'jenis_benang' => $benangDatang->jenis_benang,
                'warna_benang' => $benangDatang->warna_benang,
                'jumlah_pakai' => $request->jumlah_pakai,
                'satuan' => $benangDatang->satuan,
                'benang_datang_id' => $request->pilih_benang,
            ]);

            BenangDatang::where('id',$request->pilih_benang)->update([
                'jumlah_benang' => $benangDatang->jumlah_benang - $request->jumlah_pakai,
            ]);
            return redirect()->back()->with('tambah',"Benang $benangDatang->jenis_benang Telah Digunakan.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=ProduksiLembaran::findOrFail($id);
        $sisa=BenangDatang::where('id',$data->benang_datang_id)->first();


        return view('backend.edit-benang-dipakai',compact('data','sisa'));
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
        $benangDipakai=ProduksiLembaran::findOrFail($id);
        $benangDatang=BenangDatang::findOrFail($benangDipakai->benang_datang_id);

        $request->validate([
            'jumlah_pakai' => 'required|numeric',
            'jumlah_pakai_sebelum' => 'required|numeric',
        ]);

        if(($benangDatang->jumlah_benang + $request->jumlah_pakai_sebelum) < $request->jumlah_pakai){
            return redirect()->back()->with('kurang','Jumlah benang tidak mencukupi');
        }else{
            ProduksiLembaran::where('id',$id)->update([
                'jumlah_pakai' => $request->jumlah_pakai,
            ]);

            BenangDatang::where('id',$benangDatang->id)->update([
                'jumlah_benang' => ($benangDatang->jumlah_benang + $request->jumlah_pakai_sebelum) - $request->jumlah_pakai,
            ]);

            return redirect('/produksi-lembaran')->with('tambah',"Benang $benangDipakai->jenis_benang Telah Diperbarui.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
