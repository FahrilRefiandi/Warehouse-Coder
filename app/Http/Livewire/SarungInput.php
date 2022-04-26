<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SarungInput extends Component
{
    public $kode_sarung;

    public function render()
    {
        return view('livewire.sarung-input');
    }

    public function generateCode(){
        $this->kode_sarung="SAR-".rand(1000,9999).\Carbon\Carbon::now()->isoFormat('DDMMYY');
    }
}
