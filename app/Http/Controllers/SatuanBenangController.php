<?php

namespace App\Http\Controllers;

use App\Models\SatuanBenang;
use Illuminate\Http\Request;

class SatuanBenangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=SatuanBenang::latest()->get();
        return view('backend.satuan-benang',compact('data'));
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
            'satuan_benang' => 'required|unique:satuan_benang,satuan',
            'singkatan' => 'required|unique:satuan_benang,singkatan',
            'satuan' => 'required',
        ]);

        SatuanBenang::create([
            'satuan' => $request->satuan_benang,
            'singkatan' => $request->singkatan,
            'status' => $request->satuan,
        ]);

        return redirect()->back()->with('tambah',"Data $request->satuan_benang Berhasil Ditambahkan.!");
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
            'edit_satuan_benang' => ['required','string','unique:satuan_benang,satuan,'.$request->id],
            'edit_singkatan' => ['required','string','unique:satuan_benang,singkatan,'.$request->id],
        ]);

        SatuanBenang::where('id',$request->id)->update([
            'satuan' => $request->edit_satuan_benang,
            'singkatan' => $request->edit_singkatan,
        ]);

        return redirect()->back()->with('tambah',"Data $request->edit_satuan_benang Berhasil Diubah.!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SatuanBenang::where('id',$id)->delete();
        return redirect()->back()->with('hapus',"Data Berhasil Dihapus.!");
    }
}
