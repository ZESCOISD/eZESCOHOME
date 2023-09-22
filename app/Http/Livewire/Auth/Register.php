<?php

namespace App\Http\Livewire\Auth;


use Exception;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class Register extends Component
{
    public $email;
    public $password;
    public $name;
    public $staff_number;
    public $confirm_password;
    public $loading = false;

    public function register()
    {

        $data = [
            'staff_number' => $this->staff_number,
            'email' => $this->email,
            'password' => $this->password,
            'confirm_password' => $this->confirm_password,
            'name' => $this->name,
        ];

        //validate
        Validator::make($data, [
            'staff_number' => ['required', 'string', 'min:5', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        //login
        $this->loading = true;

        //insert
        try {

            $user = User::create([
                'staff_number' => $data['staff_number'],
                'name' => $data['name'],
                'email' => $data['email'],
                'password_change' => 0,
                'total_login' => 0,
                'last_login' => now()->toDate(),
                'password' => Hash::make($data['password']),
                'api_token' => Str::random(60),
            ]);



            //login
            if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
                $user->total_login = $user->total_login + 1;
                $user->last_login = now()->toDate();
                $user->save();
                return redirect()->intended('/admin-menu');
                $this->password = "";
            } else {

                $this->addError('email', trans('auth.failed'));
                $this->password = "";
            }
        } catch (Exception $exception) {
            session('error', $exception->getMessage());
            return back();
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
