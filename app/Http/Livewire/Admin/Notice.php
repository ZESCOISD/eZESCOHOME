<?php

namespace App\Http\Livewire\Admin;

use App\Models\Notices;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;


class Notice extends Component
{
     use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search_notice;

    public $notice_id, $notice_name, $description, $staff_name, $staff_title, $department, $start_date, $end_date;

    public $loading = false;
    public $allData = [];


     protected function rules(){
        return[
        'notice_name' => 'required|min:2|max:100',
        'description' => 'required|min:3|max:5000',
        'staff_name' => 'required|min:3|max:50',
        'staff_title' => 'required|min:3|max:50',
        'department' => 'required|min:3|max:50',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        ];

    }

    public function saveNotice(){
        $this->loading = true;
        sleep(2);

        $validateData = $this ->validate();
        Notices::create($validateData);
        $this->resetInput();
        session()->flash('savesuccessful','Your notice was successfully added');

        $this->loading = false;
    }

    public function editNotice(int $notice_id){
        $notice = Notices::find($notice_id);
        if($notice){
            $this->notice_id = $notice->id;
            $this->notice_name = $notice->notice_name;
            $this->description = $notice->description;
            $this->staff_name = $notice->staff_name;
            $this->staff_title = $notice->staff_title;
            $this->department = $notice->department;
            $this->start_date = $notice->start_date;
            $this->end_date = $notice->end_date;

        }else{
            return redirect()->to('/notices.manage');
        }
    }

    public function closeModal(){
        $this->resetInput();
    }

    public function resetInput(){
        $this->notice_id ='';
        $this->notice_name = '';
        $this->description='';
        $this->staff_name ='';
        $this->staff_title ='';
        $this->department ='';
        $this->start_date = '';
        $this->end_date ='';

    }

    public function updateNotice(){
        $this->loading = true;
        sleep(2);

        $validateData = $this ->validate();
        Notices::where('id',$this->notice_id)->update([
            'notice_name' => $validateData['notice_name'],
            'description' => $validateData['description'],
            'staff_name' => $validateData['staff_name'],
            'staff_title' => $validateData['staff_title'],
            'department' => $validateData['department'],
            'start_date' => $validateData['start_date'],
            'end_date' => $validateData['end_date'],
        ]);
        session()->flash('updatesuccessful','Your notice was updated successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');

        $this->loading = false;

    }

    public function deleteNotice(int $notice_id){
        $this->notice_id = $notice_id;
    }

    public function destroyNotice(){
        $this->loading = true;
        sleep(2);

      Notices::find($this->notice_id)->delete();
      session()->flash('deletesuccessful','Your notice was deleted successfully');
        $this->dispatchBrowserEvent('close-modal');

        $this->loading = false;
    }

       public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
    public function render()
    {
         $notices = Notices::where('notice_name', 'like', '%'.$this->search_notice.'%')
        ->orderBy('id','ASC')
        ->paginate(5);

        return view('livewire.admin.notices',[
            'notices' => $notices,
    ]);
    }
}
