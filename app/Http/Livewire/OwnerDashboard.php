<?php

namespace App\Http\Livewire;

use App\Models\BenangDatang;
use App\Models\ProduksiLembaran;
use Livewire\Component;

class OwnerDashboard extends Component
{

    public $benangDatang;
    public $benangDipakai;

    public function mount(){
        $benangDatang=BenangDatang::where('jumlah_benang','!=',0)->orderBy('tanggal','asc')->limit(10)->get();
        foreach($benangDatang as $item){
            $data['label'][]=$item->tanggal->isoFormat('DD-MMMM-YYYY');
            $data['data'][]= (int) $item->jumlah_benang;
        }
        $benangDipakai=ProduksiLembaran::orderBy('tanggal_produksi','asc')->limit(10)->get();
        foreach($benangDipakai as $item){
            $dataPL['label'][]=$item->tanggal_produksi->isoFormat('DD-MMMM-YYYY');
            $dataPL['data'][]= (int) $item->grand_total;
        }
        
        $this->benangDatang=json_encode($data);
        $this->benangDipakai=json_encode($dataPL);
        // dd($this->benangDatang);
    }
    public function render()
    {
        return view('livewire.owner-dashboard');
    }
}
