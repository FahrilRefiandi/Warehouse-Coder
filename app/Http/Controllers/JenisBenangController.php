<?php

namespace App\Http\Controllers;

use App\Models\JenisBenang;
use Illuminate\Http\Request;

class JenisBenangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=JenisBenang::latest()->get();
        return view('backend.jenis-benang',compact('data'));
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
            'jenis_benang' => 'required|unique:jenis_benang|string',
        ]);

        JenisBenang::create($request->all());

        return redirect()->back()->with('tambah',"Data $request->jenis_benang Berhasil Ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $val=$request->validate([
            // 'id' => 'required',
            'edit_jenis_benang' => ['required','string','unique:jenis_benang,jenis_benang,'.$request->id],
        ]);


        JenisBenang::where('id',$request->id)->update([
            'jenis_benang' => $request->edit_jenis_benang,
        ]);

        return redirect()->back()->with('tambah',"Data $request->edit_jenis_benang Berhasil Diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JenisBenang::where('id',$id)->delete();
        return redirect()->back()->with('hapus',"Data Berhasil Dihapus");
    }
}
