<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MotifSarung;
use App\Models\SatuanBenang;
use App\Models\WarnaBenang;

class SarungInput extends Component
{
    public $kode_sarung;

    public function render()
    {
        $motifSarung=MotifSarung::latest()->get();
        $warnaSarung=WarnaBenang::latest()->get();
        $satuan=SatuanBenang::where('status','jumlah')->latest()->get();
        return view('livewire.sarung-input',compact('motifSarung','warnaSarung','satuan'));
    }

    public function generateCode(){
        $this->kode_sarung="SAR-".rand(1000,9999).\Carbon\Carbon::now()->isoFormat('DDMMYY');
    }
}
