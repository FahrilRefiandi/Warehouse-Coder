<?php

namespace App\Http\Controllers;

use App\Models\BarangDatang;
use App\Models\JenisBenang;
use App\Models\SatuanBenang;
use App\Models\WarnaBenang;
use Illuminate\Http\Request;

class BarangDatangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=BarangDatang::join('jenis_benang','barang_datang.jenis_benang_id','=','jenis_benang.id')
        ->join('satuan_benang','barang_datang.satuan_id','=','satuan_benang.id')
        ->leftJoin('warna_benang','barang_datang.warna_benang_id','=','warna_benang.id')
        ->latest()
        ->get(['barang_datang.*','jenis_benang.jenis_benang','satuan_benang.satuan','satuan_benang.singkatan','warna_benang.warna_benang']);

        $kategoriBenang=JenisBenang::orderBy('jenis_benang','asc')->get();
        $satuanBenang=SatuanBenang::orderBy('satuan','asc')->where('status','panjang')->get();
        $warnaBenang=WarnaBenang::orderBy('warna_benang','asc')->get();
        return view('backend.benang-datang',compact('data','kategoriBenang','satuanBenang','warnaBenang'));

        // dd($data->satuanBenang->singkatan,
        // $data->warnaBenang->warna_benang,
        // $data->jenisBenang->jenis_benang);
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
        // dd($request);
        $request->validate([
            'jenis_benang' => 'required',
            'jumlah_benang' => 'required|numeric',
            'satuan_benang' => 'required',
            'warna_benang' => 'required',
        ]);

        BarangDatang::create([
            'jenis_benang_id' => $request->jenis_benang,
            'jumlah_benang' => $request->jumlah_benang,
            'satuan_id' => $request->satuan_benang,
            'warna_benang_id' => $request->warna_benang,
        ]);

        return redirect()->back()->with('tambah',"Data berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=BarangDatang::findOrFail($id);
        $kategoriBenang=JenisBenang::orderBy('jenis_benang','asc')->get();
        $satuanBenang=SatuanBenang::orderBy('satuan','asc')->where('status','panjang')->get();
        $warnaBenang=WarnaBenang::orderBy('warna_benang','asc')->get();
        return view('backend.edit-benang-datang',compact('data','kategoriBenang', 'satuanBenang', 'warnaBenang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
            'jenis_benang' => 'required|numeric',
            'jumlah_benang' => 'required|numeric',
            'satuan_benang' => 'required|numeric',
            'warna_benang' => 'required|numeric',
        ]);

        BarangDatang::where('id',$id)->update([
            'jenis_benang_id' => $request->jenis_benang,
            'jumlah_benang' => $request->jumlah_benang,
            'satuan_id' => $request->satuan_benang,
            'warna_benang_id' => $request->warna_benang,
        ]);

        return redirect('/benang-datang')->with('tambah',"Data berhasil diubah");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BarangDatang::find($id)->delete();
        return redirect()->back()->with('hapus',"Data berhasil dihapus");

    }
}
