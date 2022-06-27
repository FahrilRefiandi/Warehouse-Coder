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
    public function index(Request $req)
    {
        $data=BenangDatang::where('jumlah_benang','!=',0)->latest()->get();
        $rayon=BenangDatang::where('jenis_benang','RAYON')->sum('jumlah_benang');
        $tr=BenangDatang::where('jenis_benang','TR')->sum('jumlah_benang');
        $value=NULL;
        return view('backend.benang-datang',compact('data','rayon','tr','value'));
    }

    public function sortDate(Request $req){
        $value=$req->tgl;
        $data=BenangDatang::where('jumlah_benang','!=',0)->whereDate('tgl_benang_datang',$req->tgl)->latest()->get();
        $rayon=BenangDatang::where('jenis_benang','RAYON')->whereDate('tgl_benang_datang',$req->tgl)->sum('jumlah_benang');
        $tr=BenangDatang::where('jenis_benang','TR')->whereDate('tgl_benang_datang',$req->tgl)->sum('jumlah_benang');
        return view('backend.benang-datang',compact('data','rayon','tr','value'));
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
            'jumlah_benang_rayon.*' => 'required',
            'warna_benang_rayon.*' => 'required',
            'jumlah_benang_tr.*' => 'required',
            'warna_benang_tr.*' => 'required',
        ]);
        // dd($request->warna_benang_rayon);

        if($request->created_at==null){
            $request->created_at=now();
        }

        // cek rayon
        if($request->warna_benang_rayon!=null){
            for($i=0;$i<count($request->warna_benang_rayon);$i++){
                BenangDatang::create([
                    'jenis_benang' => 'RAYON',
                    'jumlah_benang' => $request->jumlah_benang_rayon[$i],
                    'satuan' => "KG",
                    'warna_benang' => $request->warna_benang_rayon[$i],
                    'tgl_benang_datang' => $request->created_at,
                ]);
            }
        }

        // cek TR
        if($request->warna_benang_tr!=null){
            for($i=0;$i<count($request->warna_benang_tr);$i++){
                BenangDatang::create([
                    'jenis_benang' => 'TR',
                    'jumlah_benang' => $request->jumlah_benang_tr[$i],
                    'satuan' => "KG",
                    'warna_benang' => $request->warna_benang_tr[$i],
                    'tgl_benang_datang' => $request->created_at,
                ]);
            }
        }

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
