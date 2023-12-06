<?php

namespace App\Http\Livewire\Admin;

use App\Models\ContactGroup;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;


class ContactGroupIndex extends Component
{

    use WithPagination;

    public $product_id,  $contact_group_id, $name,  $description, $location, $office_address, $email, $phone, $contact_group;
    public $search;
    public $loading = false;
    public $allData = [];
    public $products = [] ;
    public $myProducts = [] ;
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
        $this->description = '';
        $this->office_address = '';
        $this->location = '';
        $this->email = '';
        $this->phone = '';
    }

    public function editContactGroup(int $contact_group_id)
    {
        $this->contact_group_id = $contact_group_id;
        $contact_group = ContactGroup::find($contact_group_id);
        if ($contact_group) {
            $this->contact_group_id = $contact_group->id ;
            $this->name = $contact_group->name;
            $this->description = $contact_group->description;
            $this->office_address = $contact_group->office_address;
            $this->phone = $contact_group->phone;
            $this->location = $contact_group->location;
            $this->email = $contact_group->email;
        } else {
            return redirect()->to('/contact_group.manage');
        }
    }


    public function findContactGroup(int $contact_group_id)
    {
        $this->contact_group_id = $contact_group_id;
        $this->contact_group = ContactGroup::with('products')->find($contact_group_id);
        $this->myProducts =    $this->contact_group->products  ;
        $this->products = Product::whereNotIn('id', $this->contact_group->products->pluck('id')->toArray() )->get() ;
       
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
            'description' => $validateData['description'],
            'location' => $validateData['location'],
            'office_address' => $validateData['office_address'],
            'email' => $validateData['email'],
            'phone' => $validateData['phone'],
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
        return view('livewire.admin.contact-groups.index', ['contact_groups' => $contact_groups]);
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:50',
            'description' => 'required|min:3|max:50',
            'email' => 'required|min:3|max:50',
            'phone' => 'required|min:3|max:50',
            'location' => 'required|min:3|max:50',
            'office_address' => 'required|min:3|max:50',
        ];
    }


            
      public function attachContactGroup(){
        // $this->contact_group->products()->attach( $this->product_id ) ; 
            $this->contact_group->products()->syncWithoutDetaching( [ $this->product_id ] ) ; 
            $this->contact_group = ContactGroup::find( $this->contact_group->id );
            $this->myProducts =    $this->contact_group->products  ;
            session()->flash('save_successful', 'Product was attached to Contact Group successfully');
            $this->dispatchBrowserEvent('close-modal');
      }


     public function detachProduct( $id ){
        $this->contact_group->products()->detach( [ $id ] ) ; 
        $this->contact_group = ContactGroup::find( $this->contact_group->id );
        $this->myProducts =    $this->contact_group->products  ;
        session()->flash('save_successful', 'Product was detached from the Contact Group successfully');
        $this->dispatchBrowserEvent('close-modal');
      }





}
