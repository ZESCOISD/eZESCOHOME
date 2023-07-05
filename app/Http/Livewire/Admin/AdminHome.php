<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Category;
use App\Models\Status;

class AdminHome extends Component
{
    public $laoding = false;

    public function logout()
    {
     
        Auth::logout();
        return redirect('login');

    }


    public function render()
    {
        $categoriesfields = Category::all();
        $statusfields = Status::all();
        return view('livewire.admin.admin-home', [
            'categoriesfields'=>$categoriesfields,
            'statusfields'=>$statusfields
          ]);

    }

}
