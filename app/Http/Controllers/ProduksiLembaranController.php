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
        return view('backend.benang-dipakai',compact('data'));
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
            'shift' => 'required',
            'mesin' => 'required',
            'motif' => 'required',
            'varian_benang.*' => 'required',
            'jumlah_pakai_varian.*' => 'required',
        ]);
        // dd($request->all());
        $benangDatang=BenangDatang::where('id',$request->pilih_benang)->first();
        $loop=1;
        // cek inputan looping jumlah pakai
        foreach($request->jumlah_pakai_varian as $cek){
            $benangDatang=BenangDatang::where('id',$request->varian_benang[$loop])->first();
            if($cek <= 0){
                return redirect()->back()->with('kurang','Jumlah pakai harus lebih dari 0');
            }elseif($benangDatang->jumlah_benang < $cek){
                return redirect()->back()->with('kurang','Jumlah pakai melebihi jumlah benang');
            }
            $loop++;
        }

        // cek jumlah inputan benang dasar
        if($request->jumlah_pakai <= 0){
            return redirect()->back()->with('kurang','Jumlah pakai tidak boleh kurang dari 1 (satu).');
        }elseif($benangDatang->jumlah_benang < $request->jumlah_pakai){
            return redirect()->back()->with('kurang','Jumlah benang tidak mencukupi');
        }


        $jenisBenang=[];
        $jumlahPakai=[];
        $index=1;
        array_push($jenisBenang,"$request->pilih_benang");
        array_push($jumlahPakai,$request->jumlah_pakai);
        foreach($request->varian_benang as $jumlah){
            array_push($jenisBenang,$request->varian_benang[$index]);
            array_push($jumlahPakai,$request->jumlah_pakai_varian[$index]);
            $index++;
        }


            ProduksiLembaran::create([
                'jumlah_pakai' => implode(",",$jumlahPakai),
                'satuan' => "KG",
                'benang_datang_id' => implode(",",$jenisBenang),
                'mesin_id' => $request->mesin,
                'motif' => $request->motif,
                'shift_kerja_id' => $request->shift,

            ]);
            // pengurangan jumlah benang
            $loop=0;
            foreach($jenisBenang as $value){
                $benangDatang=BenangDatang::where('id',$jenisBenang[$loop])->first();
                BenangDatang::where('id',$jenisBenang[$loop])->update([
                    'jumlah_benang' => $benangDatang->jumlah_benang - $jumlahPakai[$loop],
                ]);
                $loop++;
            }

            return redirect()->back()->with('tambah',"Benang $benangDatang->jenis_benang Telah Digunakan.");

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
        }elseif($request->jumlah_pakai <= 0){
            ProduksiLembaran::where('id',$id)->delete();

            BenangDatang::where('id',$benangDatang->id)->update([
                'jumlah_benang' => ($benangDatang->jumlah_benang + $request->jumlah_pakai_sebelum) - $request->jumlah_pakai,
            ]);
            return redirect('/produksi-lembaran')->with('hapus',"Benang $benangDipakai->jenis_benang Telah Dihapus.");
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
}
