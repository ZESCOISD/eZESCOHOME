<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
// use App\Models\Role;
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
    public $permission_id;
    public $search;
    public $current_role;
    public $sync_role;
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
            return redirect()->to('/roles/manage');
        }
    }

    public function closeModal(){
        $this->resetInput();
    }

    public function resetInput(){
        $this-> name ='';
        $this-> permission_name ='';
        $this-> permission_id ='';
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

    //

     public function deletePermission($permission_id){
        $this->permission_id = $permission_id;
    }


     public function revokePermission( Role $role, Permission $permission){
        $this->loading = true;
        sleep(2);

        $permission_id = $this->permission_id;

        $role = Role::findById($this->role_id);
        $permission = Permission::findById($this->permission_id);

        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
             session()->flash('revoked','Permission Has Been Revoked.');
            // $this->resetInput();
            // $this->dispatchBrowserEvent('close-modal');
            $this->loading = false;
            $this->current_role;

        }
        return back()->with('nopermission','This Role has no "'.$permission->name.'" Permission.');
    }

    //


    public function viewRole(int $role_id){

        $role = Role::find($role_id);


        $this->current_role = Role::join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->select('Permissions.name','permissions.id')
            ->where('role_has_permissions.role_id','=',$role_id)
            ->get();
        // dd($this->current_role);

        // if($this->current_role == []){
        //     $this->current_role = 'No permissions attached to this Role';
        // }


        if($role){
            $this->role_id = $role->id;
            $this->name = $role->name;
            $this->guard_name = $role->guard_name;
        }else{
            return redirect()->to('/roles/manage');
        }
    }

     protected $listeners = [
        'viewUpdated' => 'viewRole',
    ];

    public function mount(){
        $this->current_role;
    }

    public function givePermission( Role $role){


         $this->validate([
            'permission_id' => 'required',
        ]);

        if($this->permission_id === '0'){
            session()->flash('empty','Selection Type Is Empty');
            // $this->resetInput();
                 $this-> name ='';
                $this-> permission_name ='';
                // $this-> permission_id ='';
            $this->dispatchBrowserEvent('close-modal');
        }else{


              $role = Role::findById($this->role_id);
            //   dd($this->role_id);
        $permission = Permission::findById($this->permission_id);

       if($role->hasPermissionTo($permission)){
          $this->loading = true;
             sleep(2);
             session()->flash('message','Permission Already Exists.');
              $this-> name ='';
                $this-> permission_name ='';
            $this->loading = false;
        }else{
            $role->givePermissionTo($permission);
              $this->loading = true;

            session()->flash('givepermissionsuccessful','Permission was successfully Added Wait For Page To Reload');
            sleep(4);
            // $this->
            //  $this->current_role;
             dd($this->viewRole());
            //  dd($this->current_role);
            $this->loading = false;
        }
        }

        // $permission_id = $this->permission_id;

    }

    public function sync_Permission(){



        // dd($current_role);
         $this->validate([
            'permission_id' => 'required',
        ]);

        if($this->permission_id === '0'){

            session()->flash('empty','Field is required');


            // $this->resetInput();
                 $this-> name ='';
                $this-> permission_name ='';
                // $this-> permission_id ='';
            $this->dispatchBrowserEvent('close-modal');
        }else{

             $this->loading = true;
            sleep(2);

             $role = Role::find($this->role_id);
             $permission = Permission::whereIn('id',$this->permission_id)->get();

             dd($permission);

        // if($role->hasPermissionTo($permission)){

        // }
        if($role->syncPermissions($permission)){
             session()->flash('syncsuccess','Permission(s) Synced Successfully');
              $this-> name ='';
            $this-> permission_name ='';

            $this->loading = false;
        }else{

            session()->flash('syncerror','Role might have no Permission(s). Refresh and try again.');

             $this->current_role;
            $this->loading = false;
        }
        }

    }

    public function close()
    {
        // $this->showModal = false;

        return redirect()->to('/roles/manage');
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

        $current_role = Role::join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->select('Permissions.name','permissions.id')
            ->where('role_has_permissions.role_id','=',$this->role_id)
            ->get();

        return view('livewire.admin.list-roles',[
            'current_role' => $current_role,
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

}
