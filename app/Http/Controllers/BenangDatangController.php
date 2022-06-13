<?php

namespace App\Http\Controllers;

use App\Models\BenangDatang;
use App\Models\JenisBenang;
use App\Models\SatuanBenang;
use App\Models\WarnaBenang;
use Illuminate\Http\Request;

class BenangDatangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data=BenangDatang::join('jenis_benang','benang_datang.jenis_benang_id','=','jenis_benang.id')
        // ->join('satuan_benang','benang_datang.satuan_id','=','satuan_benang.id')
        // ->leftJoin('warna_benang','benang_datang.warna_benang_id','=','warna_benang.id')
        // ->latest()
        // ->get(['benang_datang.*','jenis_benang.jenis_benang','satuan_benang.satuan','satuan_benang.singkatan','warna_benang.warna_benang']);
        $data=BenangDatang::latest()->get();
        $kategoriBenang=JenisBenang::orderBy('jenis_benang','asc')->get();
        $satuanBenang=SatuanBenang::orderBy('satuan','asc')->where('status','panjang')->get();
        $warnaBenang=WarnaBenang::orderBy('warna_benang','asc')->get();
        return view('backend.benang-datang',compact('data','kategoriBenang','satuanBenang','warnaBenang'));

        // dd($data->satuanBenang->singkatan,
        // $data->warnaBenang->warna_benang,
        // $data->jenisBenang->jenis_benang);
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
            'jumlah_benang' => 'required',
            'warna_benang' => 'required',
        ]);

        if($request->created_at==null){
            $request->created_at=now();
        }

        BenangDatang::create([
            'jenis_benang' => $request->jenis_benang,
            'jumlah_benang' => $request->jumlah_benang,
            'satuan' => "KG",
            'warna_benang' => $request->warna_benang,
            'tgl_benang_datang' => $request->created_at,
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
        $data=BenangDatang::findOrFail($id);
        $kategoriBenang=JenisBenang::orderBy('jenis_benang','asc')->get();
        $satuanBenang=SatuanBenang::orderBy('satuan','asc')->where('status','panjang')->get();
        $warnaBenang=WarnaBenang::orderBy('warna_benang','asc')->get();
        return view('backend.edit-benang-datang',compact('data','kategoriBenang', 'satuanBenang', 'warnaBenang'));
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

            'jumlah_benang' => 'required',
            'warna_benang' => 'required',
            // 'created_at' => 'date',
        ]);

        BenangDatang::where('id',$id)->update([
            // 'jenis_benang' => $request->jenis_benang,
            'jumlah_benang' => $request->jumlah_benang,
            // 'satuan_id' => $request->satuan_benang,
            'warna_benang' => $request->warna_benang,
            'tgl_benang_datang' => $request->created_at,
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
        BenangDatang::find($id)->delete();
        return redirect()->back()->with('hapus',"Data berhasil dihapus");

    }
}
