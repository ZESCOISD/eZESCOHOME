<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Permission;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Permissions extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $permission_id, $name, $guard_name ="web";
    public $search;
    public $loading = false;

    public $allData = [];
    protected function rules(){
        return[
            'name' => 'required|min:3|max:50',
            'guard_name' => 'required|min:3|max:50',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function savePermission(){
        $loading = true;
        sleep(2);

        $validateData = $this ->validate();
        Permission::create($validateData);
        session()->flash('savesuccessful','A new permission was successfully added');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        $this->resetPage();

        $loading = false;
    }

    public function editPermission(int $permission_id){
        $permission = Permission::find($permission_id);
        if($permission){
            $this->permission_id = $permission->id;
            $this->name = $permission->name;
            $this->guard_name = $permission->guard_name;
        }else{
            return redirect()->to('/permissions.manage');
        }
    }

    public function closeModal(){
        $this->resetInput();
    }

    public function resetInput(){
        $this-> name ='';
    }

    public function updatePermission(){
        $loading = true;
        sleep(2);

        $validateData = $this ->validate();
        Permission::where('id',$this->permission_id)->update([
            'name' => $validateData['name'],
            'guard_name' => $validateData['guard_name'],
        ]);
        session()->flash('updatesuccessful','Permission details where successfully updated');
        $this->resetInput();
        $loading = false;

        $this->dispatchBrowserEvent('close-modal');

    }

    public function deletePermission(int $permission_id){
        $this->permission_id = $permission_id;
    }

    public function destroyPermission(){
        $loading = true;
        sleep(2);

      Permission::find($this->permission_id)->delete();
      session()->flash('deletesuccessful','Permission was successfully deleted');
        $this->dispatchBrowserEvent('close-modal');
        $loading = false;
        $this->dispatchBrowserEvent('close-modal');
    }

    public function logout()
    {
       
        Auth::logout();
        return redirect('login');

    }

    public function render()
    {
        $permissions = Permission::where('name', 'like', '%'.$this->search.'%')->orderBy('id','ASC')->paginate(5);
        return view('livewire.admin.list-permissions',['permissions'=>$permissions]);
    }

    
}
