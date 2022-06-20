<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BenangDatang;
use App\Models\MotifSarung;
use App\Models\Mesin;
use App\Models\ShiftKerja;

class FormBenangDipakai extends Component
{



    public $jumlahInput=3;
    public $pilihBenang=[];

    public $hiddenAdd=false;


    public function render()
    {
        // $filter=[];
        // foreach($this->pilihBenang as $id){
        //     array_push($filter,['id','!=',$id] );
        // }
        // $benang=BenangDatang::where($filter)->latest()->get();
        $benangNoFilter=BenangDatang::where('jumlah_benang','!=',0)->latest()->get();
        $motif=MotifSarung::latest()->get();
        $mesin=Mesin::orderBy('kode_mesin','ASC')->get();
        $shift=ShiftKerja::orderBy('shift','ASC')->get();
        return view('livewire.form-benang-dipakai',compact('motif','mesin','shift','benangNoFilter'));
    }

    public function tambahInput()
    {
        $this->jumlahInput++;
        $this->maxInput();
    }

    public function deleteInput($i)
    {
        $this->jumlahInput--;
        $this->pilihBenang[$i]=NULL;
        $this->hiddenAdd=false;
        $this->cekNegatif();
    }

    public function cekNegatif()
    {
        if($this->jumlahInput <= 0){
            return $this->jumlahInput =0;
        }
    }

    public function maxInput()
    {
        if($this->jumlahInput >= 6){
            $this->hiddenAdd=true;
            return $this->jumlahInput =6;
        }
    }
}
