<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Status;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;


class ListProductStatus extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $status_id, $name;
    public $search;
    public $loading = false;
    public $allData = [];
    protected function rules(){
        return[
            'name' => 'required|min:3|max:50',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveStatus(){

        $loading = true;
        sleep(2);

        $validateData = $this ->validate();
        Status::create($validateData);
        session()->flash('savesuccessful','A new status was successfully added');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        $this->resetPage();

        $loading = false;
    }

    public function editStatus(int $status_id){
        $status = Status::find($status_id);
        if($status){
            $this->status_id = $status->status_id;
            $this->name = $status->name;
        }else{
            return redirect()->to('/status.manage');
        }
    }

    public function closeModal(){
        $this->resetInput();
    }

    public function resetInput(){
        $this-> name ='';
    }

    public function updateStatus(){
        $loading = true;
        sleep(2);

        $validateData = $this ->validate();
        Status::where('status_id',$this->status_id)->update([
            'name' => $validateData['name'],
        ]);
        session()->flash('updatesuccessful','Status details where successfully updated');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');

        $loading = false;
    }

    public function deleteStatus(int $status_id){
        $this->status_id = $status_id;
    }

    public function destroyStatus(){
        $loading = true;
        sleep(2);

      Status::find($this->status_id)->delete();
      session()->flash('deletesuccessful','Status was successfully deleted');
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
        $statuses = Status::where('name', 'like', '%'.$this->search.'%')->orderBy('status_id','ASC')->paginate(5);
        return view('livewire.admin.list-product-status',[ 'statuses' => $statuses ]);
    }
}
