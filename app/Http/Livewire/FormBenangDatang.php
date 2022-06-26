<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BenangDatang;
use App\Models\JenisBenang;
use App\Models\SatuanBenang;
use App\Models\WarnaBenang;

class FormBenangDatang extends Component
{
    public $tambahRayon=1;
    public $tambahTr=1;
    public function render()
    {
        $kategoriBenang=JenisBenang::orderBy('jenis_benang','asc')->get();
        $satuanBenang=SatuanBenang::orderBy('satuan','asc')->where('status','panjang')->get();
        $warnaBenang=WarnaBenang::orderBy('warna_benang','asc')->get();
        return view('livewire.form-benang-datang',compact('kategoriBenang', 'satuanBenang', 'warnaBenang'));
    }

    public function tambahRayon()
    {
        $this->tambahRayon++;
    }

    public function kurangRayon()
    {
        if($this->tambahRayon != 1){
            $this->tambahRayon--;
        }
    }

    public function tambahTr()
    {
        $this->tambahTr++;
    }

    public function kurangTr()
    {
        if($this->tambahTr != 1){
            $this->tambahTr--;
        }
    }
}
