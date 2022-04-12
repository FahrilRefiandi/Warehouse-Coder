<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserRegistration extends Component
{
    public $nama;
    public $username;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'nama' => 'required|min:6',
        'username' => 'required|unique:users|regex:/^\S*$/u',
        'password' => 'required|min:6',
        'password_confirmation' => 'required|min:6|same:password',
    ];
    
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.user-registration');
    }
}
