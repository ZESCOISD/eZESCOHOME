<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// use Laravel\Fortify\Actions\CreateNewUser;
use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Livewire\WithPagination;


class ListUsers extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $user_id, $fname, $sname, $email, $staff_number, $role_name, $password, $password_confirmation;
    public $search;
    public $loading = false;
    public $allData = [];

    protected function rules(){
        return[
            'fname' => 'required|min:3|max:20',
            'sname' => 'required|min:3|max:20',
            'email' => 'required|email',
            'staff_number' => 'required|min:3|max:20',
            'role_name' => '',
            'password' => 'required|min:8|same:password_confirmation',
            'password_confirmation' => 'required',
        ];
        
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function register(){
        $validateData = $this ->validate();

        $loading = true;
        sleep(2);

        if ($this->role_name == "0") {
            $this->addError('selectedOption', 'Please select a valid option.');
            return;
            $loading = false;
        }else{

            $hashpassword = Hash::make($this->password);
            $user = User::create([
                        'fname' => $this->fname,
                        'sname' => $this->sname,
                       'email' => $this->email,
                        'staff_number' => $this->staff_number,
                        'name' => $this->role_name,
                        'password' => $hashpassword,
                        'password_confirmation' => $hashpassword
            ]);
          
                session()->flash('registeredsuccessful','A new user was successfully added');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
            $this->resetPage();
            $loading = false;
           
        }
       
    }

    public function editUser(int $user_id){
        $user = User::find($user_id);
        if($user){
            $this->user_id = $user->user_id;
            $this->fname = $user->fname;
            $this->sname = $user->sname;
            $this->email = $user->email;
            $this->staff_number = $user->staff_number;
            $this->role_name = $user->name;
            $this->password = $user->password;
            $this->password_confirmation = $user->password_confirmation;
        }else{
            return redirect()->to('/users.manage');
        }
    }

    public function closeModal(){
        $this->resetInput();
    }

    public function resetInput(){
        $this-> fname ='';
        $this-> sname ='';
        $this-> email ='';
        $this-> staff_number ='';
        $this-> role_name ='';
        $this-> password ='';
        $this-> password_confirmation ='';
    }

    public function updateUser(){

        $loading = true;
        sleep(2);

        $validateData = $this ->validate();
        User::where('user_id',$this->user_id)->update([
            'fname' => $validateData['fname'],
            'sname' => $validateData['sname'],
            'email' => $validateData['email'],
            'staff_number' => $validateData['staff_number'],
            'name' => $validateData['role_name'],
            'password' => $validateData['password'],
            'password_confirmation' => $validateData['password_confirmation']
        ]);
        session()->flash('updatesuccessful','User details where successfully updated');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');

        $loading = false;
    }

    public function deleteUser(int $user_id){
        $this->user_id = $user_id;
    }

    public function destroyUser(){
        $loading = true;
        sleep(2);

      User::find($this->user_id)->delete();
      session()->flash('deletesuccessful','User was successfully deleted');
        $this->dispatchBrowserEvent('close-modal');

        $loading = false;
    }

    public function logout()
    {
       
        Auth::logout();
        return redirect('login');

    }

    
    public function render()
    {
        $users = User::where('user_id', 'like', '%'.$this->search.'%')->orderBy('user_id','ASC')->paginate(5);
        $roles = Role::all();
        return view('livewire.admin.list-users',[
            'users' => $users,
            'roles' => $roles
        ]);
    }
}
