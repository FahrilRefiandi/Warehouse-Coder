<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sarung;

class SarungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Sarung::latest()->get();
        return view('backend.sarung',compact('data'));
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
            'kode_sarung'=>'required|unique:sarung',
            'motif_sarung'=>'required',
            'warna_sarung'=>'required',
            'stok_sarung'=>'required|min:0',
            'satuan'=>'required',
        ]);

        Sarung::create([
            'kode_sarung'=>$request->kode_sarung,
            'motif_sarung'=>$request->motif_sarung,
            'warna_sarung'=>$request->warna_sarung,
            'stok_sarung'=>$request->stok_sarung,
            'satuan'=>$request->satuan,
        ]);

        return redirect()->back()->with('tambah',"Data $request->kode_sarung berhasil ditambahkan");
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
