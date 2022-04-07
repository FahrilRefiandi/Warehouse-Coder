<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserLogin extends Component
{

    public $username;
    public $password;

    protected $rules = [
        'username' => 'required|regex:/^\S*$/u',
        'password' => 'required|min:6',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.user-login');
    }
}
