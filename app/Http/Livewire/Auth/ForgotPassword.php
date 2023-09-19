<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email;
    public $successMessage;
    public $loading;

    protected $rules = [
        'email' => 'required|email',
    ];

    public function sendResetLinkEmail()
    {
        $this->validate();

        $status = Password::sendResetLink(['email' => $this->email]);
        $this->loading = true;
        sleep(5);
        if ($status === Password::RESET_LINK_SENT) {
            $this->successMessage = 'Password reset link has been sent to your email address!';
            $this->email = '';
        } else {
            $this->addError('email', trans($status));
        }
        $this->loading = false;
    }
    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
