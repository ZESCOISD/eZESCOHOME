<?php

namespace App\Http\Livewire\Admin;

use App\Models\ContactGroup;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;


class ContactGroupIndex extends Component
{

    use WithPagination;

    public $contact_group_id, $name, $code;
    public $search;
    public $loading = false;
    public $allData = [];
    protected $paginationTheme = 'bootstrap';

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveContactGroup()
    {

        $loading = true;
        sleep(2);

        $validateData = $this->validate();
        ContactGroup::create($validateData);
        session()->flash('save_successful', 'A new contact group was successfully added');
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

    public function editContactGroup(int $contact_group_id)
    {
        $contact_group = ContactGroup::find($contact_group_id);
        if ($contact_group) {
            $this->contact_group_id = $contact_group->contact_group_id;
            $this->name = $contact_group->name;
            $this->code = $contact_group->code;
        } else {
            return redirect()->to('/contact_group.manage');
        }
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function updateContactGroup()
    {
        $loading = true;
        sleep(2);

        $validateData = $this->validate();
        ContactGroup::where('id', $this->contact_group_id)->update([
            'name' => $validateData['name'],
            'code' => $validateData['code'],
        ]);
        session()->flash('update_successful', 'ContactGroup details where successfully updated');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');

        $loading = false;
    }

    public function deleteContactGroup(int $contact_group_id)
    {
        $this->contact_group_id = $contact_group_id;
    }

    public function destroyContactGroup()
    {
        $loading = true;
        sleep(2);

        ContactGroup::find($this->contact_group_id)->delete();
        session()->flash('delete_successful', 'Contact Group was successfully deleted');
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
        $contact_groups = ContactGroup::where('name', 'like', '%' . $this->search . '%')->orderBy('name', 'ASC')->paginate(10);
        return view('livewire.admin.contact-group.index', ['contact_groups' => $contact_groups]);
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:50',
            'code' => 'required|min:3|max:50',
        ];
    }
}
