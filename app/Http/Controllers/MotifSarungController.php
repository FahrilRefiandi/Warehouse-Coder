<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MotifSarung;

class MotifSarungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=MotifSarung::latest()->get();
        return view('backend.napes.motif-sarung',compact('data'));
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
            'kode_motif'=>'required|unique:motif_sarung',
            'motif_sarung'=>'required|unique:motif_sarung',
        ]);

        MotifSarung::create($request->all());

        return redirect()->back()->with('tambah',"Data $request->motif_sarung berhasil ditambahkan");

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
            'edit_kode_motif'=> ['required','string','unique:motif_sarung,kode_motif,'.$request->id],
            'edit_motif_sarung'=> ['required','string','unique:motif_sarung,motif_sarung,'.$request->id],
        ]);

        MotifSarung::where('id',$request->id)->update([
            'kode_motif'=>$request->edit_kode_motif,
            'motif_sarung'=>$request->edit_motif_sarung,
        ]);

        return redirect()->back()->with('tambah',"Data $request->edit_motif_sarung berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MotifSarung::destroy($id);
        return redirect()->back()->with('hapus',"Data berhasil dihapus");
    }
}
