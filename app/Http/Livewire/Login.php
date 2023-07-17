<?php

namespace App\Http\Livewire;


use Illuminate\Support\Facades\Auth;

use Livewire\Component;


class Login extends Component
{
    public $email;
    public $password;
    public $loading = false;

    public function login()
    {

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

         $this->loading = true;     
        sleep(5);

        if (is_numeric($this->email)) {
            $field = 'staff_number';
        } else {
            $field = 'email';
        }

        if (Auth::attempt([$field => $this->email, 'password' => $this->password])) {
            return redirect()->intended('/admin-menu');
             $this->password = "";
        } else {
           
            $this->addError('email', trans('auth.failed'));
            $this->password ="";
        }

        $this->loading = false;  
    }

    public function render()
    {
        return view('livewire.login');
    }
}
