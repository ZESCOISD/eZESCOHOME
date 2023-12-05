<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Livewire\WithPagination;


class ListUsers extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

     public $activeTab = 'tab1';
    public $current_role;
    public $user_id, $name, $phone, $email, $staff_number, $role_name, $password, $password_confirmation;
    public $update_staff_number, $update_password, $update_password_confirmation;

    public $search;
    public $loading = false;
    public $allData = [];


    public function mount(){
        $this->current_role;
    }
    protected function rules(){
        return[
            'name' => 'required|min:3|max:20',
            'phone' => 'required|min:3|max:20',
            'email' => 'required|email',
            'staff_number' => 'required|min:3|max:20',
            'password' => 'required|min:8|same:password_confirmation',
            'password_confirmation' => 'required',
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function register(){
        $validateData = $this->validate();

        $this->loading = true;
        sleep(2);

        $hashpassword = Hash::make($this->password);
        $validateData = User::create([
                        'name' => $this->name,
                        'phone' => $this->phone,
                        'email' => $this->email,
                        'staff_number' => $this->staff_number,
                        'password' => $hashpassword,
                        'password_confirmation' => $hashpassword
        ]);

            session()->flash('registeredsuccessful','User Was Added Successfully');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
            session()->flash('error', 'Failed to Assign');

        $this->loading = false;

    }

     public function showRole(int $user_id){

        $this->user_id = $user_id;
        $user = User::find($user_id);

        if($user){

            $this->current_role = $user->name;
            $this->role_name = $user->name;
        }else{
            return redirect()->to('/users.manage');
        }
    }

    public function assignUserRole(){

        $this->loading = true;
        sleep(2);

           $users = User::where('id','=', $this->user_id )->first();


           $this->validate([
            'role_name' => 'nullable|min:2|max:50',
        ]);


         $users->name = $this->role_name;
        $result = $users->assignRole($this->role_name)->update();

        // dd($result);

          if ($result) {
            session()->flash('updatesuccessful','Role Was Assigned to successfully');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
        } else {
            session()->flash('error', 'Failed to Assign');
        }

        $this->loading = false;
    }


    public function editUser(int $user_id){
        $user = User::find($user_id);
        if($user){
            $this->user_id = $user->id;
            $this->name = $user->name;
            $this->phone = $user->phone;
            $this->email = $user->email;
            $this->staff_number = $user->staff_number;
            // $this->role_name = $user->name;
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
        $this-> name ='';
        $this-> phone ='';
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
        User::where('id',$this->user_id)->update([
            'name' => $validateData['name']+' '+$validateData['phone'] ,
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

     public function updatePassword(){

        $this->activeTab = 'tab2';
        $loading = true;
        sleep(2);

       $getID = Auth::user();

       $ifAdmin = User::where('name', '=', 'admin')
                 ->first();

       if($ifAdmin){
        $updatepassword = User::where('staff_number', '=',$this->update_staff_number)->first();

       $this->validate([
            'update_password' => 'required|min:8|same:update_password_confirmation',
            'update_password_confirmation' => 'required',
        ]);

        $hashpassword = Hash::make($this->update_password);
          $updatepassword->password = $hashpassword;
        $updatepassword->password_confirmation = $hashpassword;
        $result = $updatepassword->update();

          if ($result) {
             session()->flash('passwordupdatesuccessful','User Password Was successfully updated');
            $this->update_staff_number ="";
            $this->update_password ="";
            $this->update_password_confirmation ="";
            $this->dispatchBrowserEvent('close-modal');
        } else {
            session()->flash('error', 'Failed To Updated Password');
        }

       }else{
         $user = Auth::user();
         $userId = $user->id;
        //  dd($userId);
           $updatepassword = User::where('staff_number', '=',$userId)->first();
       $this->validate([
            'update_password' => 'required|min:8|same:update_password_confirmation',
            'update_password_confirmation' => 'required',
        ]);

        // dd($this->update_password_confirmation);

        $hashpassword = Hash::make($this->update_password);

        // dd($user);

          $user->password = $hashpassword;
        $user->password_confirmation = $hashpassword;
        $result = $user->update();

          if ($result) {
             session()->flash('passwordupdatesuccessful','Your Password Was successfully updated');
            $this->update_password ="";
            $this->update_password_confirmation ="";
            $this->dispatchBrowserEvent('close-modal');
        } else {
            session()->flash('error', 'Failed To Updated Password');
        }
       }

        $this->loading = false;

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
        $users = User::where('id', 'like', '%'.$this->search.'%')->orderBy('id','ASC')->paginate(5);
        $roles = Role::all();
        return view('livewire.admin.list-users',[
            'users' => $users,
            'roles' => $roles
        ]);
    }
}
