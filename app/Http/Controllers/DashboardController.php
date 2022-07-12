<?php

namespace App\Http\Controllers;

use App\Models\BenangDatang;
use App\Models\ProduksiLembaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        if (Auth::user()->role == 'owner') {

            $jumlah=0;
            $data['totalBenang']=BenangDatang::whereDate('tanggal', now())->sum('jumlah_benang');
            $produksiLembaran=ProduksiLembaran::whereDate('tanggal_produksi', now())->get();

            for($i=0; $i<count($produksiLembaran); $i++){
                for($j=0; $j<count(explode(',', $produksiLembaran[$i]->jumlah_pakai)); $j++){
                    $jumlah+=explode(',', $produksiLembaran[$i]->jumlah_pakai)[$j];
                }
            }
            $data['jumlahPakai']=$jumlah;

            

            return view('backend.owner.dashboard', $data);


        }elseif(Auth::user()->role == 'wh1'){
            return view('backend.dashboard');
        }elseif(Auth::user()->role == 'wh2'){
            return view('backend.dashboard');
        } else {
            echo '<h1>Access Denied</h1>';
        }
    }
}
