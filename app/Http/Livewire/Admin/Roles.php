<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
// use App\Models\Roles;
// use App\Models\Permissions;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Roles extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $role_id, $name, $guard_name = "web";
    public $permission_name;
    public $search;
    public $loading = false;
    public $allData = [];
    protected function rules(){
        return[
            'name' => 'required|min:3|max:30',
            'guard_name' => 'required|min:3|max:30',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveRole(){
        $this->loading = true;     
        sleep(2);
        $validateData = $this ->validate();
        
            Role::create($validateData);
            session()->flash('savesuccessful','A new role was successfully added');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
            $this->resetPage();
        $this->loading = false;
        
    }

    public function editRole(int $role_id){
        $role = Role::find($role_id);
        if($role){
            $this->role_id = $role->id;
            $this->name = $role->name;
            $this->guard_name = $role->guard_name;
        }else{
            return redirect()->to('/roles.manage');
        }
    }

    public function closeModal(){
        $this->resetInput();
    }

    public function resetInput(){
        $this-> name ='';
        $this-> permission_name ='';
    }

    public function updateRole(){
        $this->loading = true;     
        sleep(2);
        $validateData = $this ->validate();
        Role::where('id',$this->role_id)->update([
            'name' => $validateData['name'],
        ]);
        session()->flash('updatesuccessful','Role details where successfully updated');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        $this->loading = false;   
    }

    public function deleteRole(int $role_id){
        $this->role_id = $role_id;
    }

    public function destroyRole(){
        $this->loading = true;     
        sleep(2);

        Role::find($this->role_id)->delete();
        session()->flash('deletesuccessful','Role was successfully deleted');
        $this->dispatchBrowserEvent('close-modal');

        $this->loading = false;  
    }

    public function viewRole(int $role_id){
        $role = Role::find($role_id);
        if($role){
            $this->role_id = $role->id;
            $this->name = $role->name;
            $this->guard_name = $role->guard_name;
        }else{
            return redirect()->to('/roles.manage');
        }
    }

    public function givePermission( Role $role){
        $this->loading = true; 
        sleep(2);

        // $role_id = Role::where('id',$this->role_id);
        $permission_name = $this->permission_name; 

        // $role = Role::findByName();
        $permission = Permission::findByName($permission_name);

        if($role->hasPermissionTo($permission_name)){
            return back()->with('message','Permission Already Exists.');
            $this->loading = false; 
        }else{
            $role->givePermissionTo($permission_name);
            session()->flash('givepermissionsuccessful','Permission was successfully Added');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
            $this->loading = false;   
        }
           
        // dd($this->permission_name);
    }


    public function logout()
    {
   

        Auth::logout();
        return redirect('login');
       
    }


    public function render()
    {
        $permissions = Permission::all();
        $roles = Role::whereNotIn('name', ['admin'])
             ->where('name', 'like', '%'.$this->search.'%')->orderBy('id','ASC')->paginate(5);

        // $roles = Roles::
        return view('livewire.admin.list-roles',[
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

        public function permissions() {

            return $this->belongsToMany(Permission::class,'roles_permissions');
                
        }
        
        public function users() {
        
            return $this->belongsToMany(User::class,'users_roles');
                
        }
}
