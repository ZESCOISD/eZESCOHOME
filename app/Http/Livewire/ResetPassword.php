<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Password;

use Livewire\Component;

class ResetPassword extends Component
{
    public $token;
    public $email;
    public $password;
    public $password_confirmation;
    public $loading = false; 
    public $successMessage;  

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ];

    public function mount($token)
    {
        $this->token = $token;
    }

    public function resetPassword()
    {
        $this->validate();

        $this->loading = true;     
        sleep(5);
        $status = Password::reset([
            'token' => $this->token,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ],
        function ($user, $password) {
            // Set the user's new password
            $user->password = Hash::make($password);
            $user->save();
        }
    );

        if ($status === Password::PASSWORD_RESET) {
            $this->successMessage = 'Password Reset Was Successful!';
            // $this->email = '';
            // return Redirect::to('login');
        } else {
            $this->addError('email', trans($status));
        }
        $this->loading = false;   
    }
    public function render()
    {
        return view('livewire.reset-password');
    }
}
