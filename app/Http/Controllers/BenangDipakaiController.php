<?php

namespace App\Http\Controllers;

use App\Models\BenangDipakai;
use App\Models\JenisBenang;
use App\Models\SatuanBenang;
use App\Models\WarnaBenang;
use App\Models\BarangDatang;

use Illuminate\Http\Request;

class BenangDipakaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=BenangDipakai::latest()->get();


        $benang=BarangDatang::join('jenis_benang','barang_datang.jenis_benang_id','=','jenis_benang.id')
        ->join('satuan_benang','barang_datang.satuan_id','=','satuan_benang.id')
        ->join('warna_benang','barang_datang.warna_benang_id','=','warna_benang.id')
        ->where('jumlah_benang','>',0)
        ->latest()
        ->get(['barang_datang.*','jenis_benang.jenis_benang','satuan_benang.satuan','satuan_benang.singkatan','warna_benang.warna_benang']);
        // dd($benang);

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
        $request->validate([
            'pilih_benang' => 'required',
            'jumlah_pakai' => 'required|numeric',
        ]);

        $benangDatang=BarangDatang::where('id',$request->pilih_benang)->first();
        // dd($benangDatang->satuanBenang->satuan);

        if($benangDatang->jumlah_benang < $request->jumlah_pakai){
            return redirect()->back()->with('kurang','Jumlah benang tidak mencukupi');
        }else{
            BenangDipakai::create([
                'jenis_benang' => $benangDatang->jenisBenang->jenis_benang,
                'warna_benang' => $benangDatang->warnaBenang->warna_benang,
                'jumlah_pakai' => $request->jumlah_pakai,
                'satuan' => $benangDatang->satuanBenang->singkatan,
                'barang_datang_id' => $request->pilih_benang,
            ]);

            BarangDatang::where('id',$request->pilih_benang)->update([
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
        $data=BenangDipakai::findOrFail($id);
        $sisa=BarangDatang::where('id',$data->barang_datang_id)->first();
        

        return view('backend.edit-benang-dipakai',compact('data','sisa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $benangDipakai=BenangDipakai::findOrFail($id);
        $benangDatang=BarangDatang::findOrFail($benangDipakai->barang_datang_id);

        $request->validate([
            'jumlah_pakai' => 'required|numeric',
            'jumlah_pakai_sebelum' => 'required|numeric',
        ]);

        if(($benangDatang->jumlah_benang + $request->jumlah_pakai_sebelum) < $request->jumlah_pakai){
            return redirect()->back()->with('kurang','Jumlah benang tidak mencukupi');
        }else{
            BenangDipakai::where('id',$id)->update([
                'jumlah_pakai' => $request->jumlah_pakai,
            ]);

            BarangDatang::where('id',$benangDatang->id)->update([
                'jumlah_benang' => ($benangDatang->jumlah_benang + $request->jumlah_pakai_sebelum) - $request->jumlah_pakai,
            ]);

            return redirect('/benang-dipakai')->with('tambah',"Benang $benangDipakai->jenis_benang Telah Diperbarui.");
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
