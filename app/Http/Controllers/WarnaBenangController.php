<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WarnaBenang;

class WarnaBenangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=WarnaBenang::latest()->get();
        return view('backend.napes.warna-benang',compact('data'));
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
            'kode_warna'=>'required|unique:warna_benang',
            'warna_benang'=>'required|unique:warna_benang'
        ]);

        WarnaBenang::create($request->all());

        return redirect()->back()->with('tambah',"Warna $request->warna_benang berhasil ditambahkan");
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
            'edit_kode_warna' => ['required','string','unique:warna_benang,kode_warna,'.$request->id],
            'edit_warna_benang' => ['required','string','unique:warna_benang,warna_benang,'.$request->id],
        ]);

        WarnaBenang::where('id',$request->id)->update([
            'kode_warna'  =>$request->edit_kode_warna,
            'warna_benang'=>$request->edit_warna_benang,
        ]);

        return redirect()->back()->with('tambah',"Warna $request->edit_warna_benang berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        WarnaBenang::where('id',$id)->delete();
        return redirect()->back()->with('hapus',"Warna berhasil dihapus");
    }
}
