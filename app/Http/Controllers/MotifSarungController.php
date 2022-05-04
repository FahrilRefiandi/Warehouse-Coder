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
        return view('backend.motif-sarung',compact('data'));
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
            'motif_sarung'=>'required|unique:motif_sarung',
        ]);

        MotifSarung::create([
            'motif_sarung'=>$request->motif_sarung,
        ]);

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
            'edit_motif_sarung'=> ['required','string','unique:motif_sarung,motif_sarung,'.$request->id],
        ]);

        MotifSarung::where('id',$request->id)->update([
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
