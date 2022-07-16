<?php

namespace App\Http\Controllers;

use App\Models\Kardus;
use Illuminate\Http\Request;

class KardusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Kardus::latest()->get();
        $jumlah['limaKodi']=Kardus::where('jenis_kardus','5 kodi')->sum('jumlah_kardus');
        $jumlah['sepuluhPotong']=Kardus::where('jenis_kardus','10 potong')->sum('jumlah_kardus');
        $jumlah['satuan']=Kardus::where('jenis_kardus','satuan')->sum('jumlah_kardus');
        
        return view('backend.kantor.kardus',$jumlah,compact('data'));
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
            'jenis_kardus'=>'required',
            'jumlah_kardus'=>'required|numeric',
        ]);
        Kardus::create($request->all());
        return redirect()->back()->with('tambah',"Data Kardus $request->jenis_kardus berhasil ditambahkan");
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
        $request->validate([
            'id' => 'required',
            'jenis_kardus'=>'required',
            'jumlah_kardus'=>'required|numeric',
        ]);
        Kardus::find($request->id)->update($request->all());
        return redirect()->back()->with('tambah',"Data Kardus $request->jenis_kardus berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kardus::find($id)->delete();
        return redirect()->back()->with('hapus',"Data Kardus berhasil dihapus");
    }
}
