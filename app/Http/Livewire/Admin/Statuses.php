<?php

namespace App\Http\Livewire\Admin;

use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;


class Statuses extends Component
{

    use WithPagination;

    public $status_id, $name, $code;
    public $search;
    public $loading = false;
    public $allData = [];
    protected $paginationTheme = 'bootstrap';

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveStatus()
    {

        $loading = true;
        sleep(2);

        $validateData = $this->validate();
        Status::create($validateData);
        session()->flash('save_successful', 'A new status was successfully added');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        $this->resetPage();

        $loading = false;
    }

    public function resetInput()
    {
        $this->name = '';
        $this->code = '';
    }

    public function editStatus(int $status_id)
    {
        $status = Status::find($status_id);
        if ($status) {
            $this->status_id = $status->status_id;
            $this->name = $status->name;
            $this->code = $status->code;
        } else {
            return redirect()->to('/status.manage');
        }
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function updateStatus()
    {
        $loading = true;
        sleep(2);

        $validateData = $this->validate();
        Status::where('status_id', $this->status_id)->update([
            'name' => $validateData['name'],
            'code' => $validateData['code'],
        ]);
        session()->flash('update_successful', 'Status details where successfully updated');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');

        $loading = false;
    }

    public function deleteStatus(int $status_id)
    {
        $this->status_id = $status_id;
    }

    public function destroyStatus()
    {
        $loading = true;
        sleep(2);

        Status::find($this->status_id)->delete();
        session()->flash('delete_successful', 'Status was successfully deleted');
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
        $statuses = Status::where('name', 'like', '%' . $this->search . '%')->orderBy('status_id', 'ASC')->paginate(5);
        return view('livewire.admin.status.index', ['statuses' => $statuses]);
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:50',
            'code' => 'required|min:3|max:50',
        ];
    }
}
