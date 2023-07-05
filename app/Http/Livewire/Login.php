<?php

namespace App\Http\Livewire;
// use Laravel\Fortify\Actions\AuthenticateSession;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;


class Login extends Component
{
    public $email;
    public $password;
    public $loading = false;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $this->loading = true;     
        sleep(5);
        
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->intended('/admin-menu');
        } else {
            $this->addError('email', trans('auth.failed'));
        }
        $this->loading = false;  
    }

    public function render()
    {
        return view('livewire.login');
    }
}
