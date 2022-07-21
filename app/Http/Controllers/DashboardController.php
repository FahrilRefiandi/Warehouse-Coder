<?php

namespace App\Http\Controllers;

use App\Models\BenangDatang;
use App\Models\ProduksiLembaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {

        if (Auth::user()->role == 'owner') {

            $jumlah=0;
            $bulanIni=Carbon::parse(now())->isoFormat('YYYY-MM');
            $data['totalBenang']=BenangDatang::where('tanggal','like',"$bulanIni%")->sum('jumlah_benang');
            $data['jumlahPakai']=ProduksiLembaran::where('tanggal_produksi','like',"$bulanIni%")->sum('grand_total');

            return view('backend.owner.dashboard', $data);


        }elseif(Auth::user()->role == 'wh1'){
            return view('backend.napes.dashboard');
        }elseif(Auth::user()->role == 'wh2'){
            return view('backend.dashboard');
        }elseif(Auth::user()->role == 'kantor'){
            return view('backend.kantor.dashboard');
        }else {
            return view('backend.components.akses-ditolak');
        }
    }
}
