<?php

namespace App\Http\Controllers;

use App\Models\ShiftKerja;
use Illuminate\Http\Request;

class ShiftKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=ShiftKerja::orderBy('shift','ASC')->get();
        return view('backend.napes.shift-kerja',compact('data'));
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
            'shift' => 'required',
            'mulai_kerja' => 'required',
            'akhir_kerja' => 'required',
        ]);

        ShiftKerja::create($request->all());

        return redirect()->back()->with('tambah',"Shift kerja $request->shift Berhasil Ditambahkan.");
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
            'shift' => 'required',
            'mulai_kerja' => 'required',
            'akhir_kerja' => 'required',
        ]);

        ShiftKerja::find($request->id)->update($request->all());
        return redirect()->back()->with('tambah',"Shift kerja $request->shift Berhasil Diubah.");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ShiftKerja::find($id)->delete();
        return redirect()->back()->with('hapus',"Shift kerja Berhasil Dihapus.");
    }
}
