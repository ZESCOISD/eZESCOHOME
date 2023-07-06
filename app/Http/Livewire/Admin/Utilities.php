<?php

namespace App\Http\Livewire\Admin;

use App\Models\Notices;
use App\Models\UpcomingEvents;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;



class Utilities extends Component
{

     use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $event_id, $event_name, $event_description, $venue, $time, $date;

    public $notice_id, $notice_name, $description, $staff_name, $staff_title, $department, $start_date ,$end_date;
    public $search, $search_event;
    public $loading = false;

    
    public $allData = [];
    protected function rules(){
        return[
            'notice_name' => 'required|min:3|max:50',
            'description' => 'required|min:3|max:200',
            'staff_name' => 'required|min:3|max:50',
            'staff_title' => 'required|min:3|max:50',
            'department' => 'required|min:3|max:50',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ];
    }




    public function updated($fields)
    {
        $this->validateOnly($fields);
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
            return redirect()->to('/utilities.manage');
        }
    }

    // public function closeModal(){
    //     $this->resetInput();
    // }

    // public function resetInput(){
    //     $this->notice_id ='';
    //     $this->notice_name = '';
    //     $this-> description ='';
    //     $this-> staff_name ='';
    //     $this-> staff_title ='';
    //     $this-> department ='';
    //     $this-> start_date ='';
    //     $this-> end_date ='';
    // }

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


    // Utitlities


     public function saveEvent(){
        $this->loading = true;
        sleep(2);

        $rules = [
        'event_name' => 'required|min:2|max:50',
        'event_event_description' => 'required|min:3|max:200',
        'venue' => 'required|min:3|max:50',
        'fee' => 'nullable|numeric',
        'time' => 'required|date_format:H:i',
        'date' => 'required|date',
    ];


    $validateData = $this->validate($rules);
        // $validateData = $this ->validate();
         dd($validateData);
        UpcomingEvents::create($validateData);
        $this->resetInput();
        session()->flash('savesuccessful','Your event was successfully added');

        $this->loading = false;
    }

    public function editEvent(int $event_id){
        $event = UpcomingEvents::find($event_id);
        if($event){
            $this->event_id = $event->id;
            $this->event_name = $event->event_name;
            $this->event_description = $event->event_description;
            $this->venue = $event->venue;
            $this->time = $event->time;
            $this->date = $event->date;

        }else{
            return redirect()->to('/utilities.manage');
        }
    }

    public function closeModal(){
        $this->resetInput();
    }

    public function resetInput(){
        $this->event_id ='';
        $this->event_name = '';
        $this-> event_description ='';
        $this-> venue ='';
        $this-> time ='';
        $this-> date ='';

        $this->notice_id ='';
        $this->notice_name = '';
        $this-> description ='';
        $this-> staff_name ='';
        $this-> staff_title ='';
        $this-> department ='';
        $this-> start_date ='';
        $this-> end_date ='';

    }

    public function updateEvent(){
        $this->loading = true;
        sleep(2);

        $rules = [
        'event_name' => 'required|min:2|max:50',
        'event_event_description' => 'required|min:3|max:200',
        'venue' => 'required|min:3|max:50',
        'fee' => 'nullable|numeric',
        'time' => 'required|date_format:H:i',
        'date' => 'required|date',

    ];

        $validatedData = $this->validate($rules);
        // $validateData = $this ->validate();
        // UpcomingEvents::create($validatedData);

        $validateData = $this ->validate();
        UpcomingEvents::where('id',$this->event_id)->update([
            'event_name' => $validateData['event_name'],
            'event_description' => $validateData['event_description'],
            'venue' => $validateData['venue'],
            'time' => $validateData['time'],
            'date' => $validateData['date'],
            'start_date' => $validateData['start_date'],
            'end_date' => $validateData['end_date'],
        ]);
        session()->flash('updatesuccessful','Your event was updated successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');

        $this->loading = false;

    }

    public function deleteEvent(int $event_id){
        $this->event_id = $event_id;
    }

    public function destroyEvent(){
        $this->loading = true;
        sleep(2);

      UpcomingEvents::find($this->event_id)->delete();
      session()->flash('deletesuccessful','Your event was deleted successfully');
        $this->dispatchBrowserEvent('close-modal');

        $this->loading = false;
    }



    // end of utilities

     public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function render()
    {
        $notices = Notices::where('notice_name', 'like', '%'.$this->search.'%')
        ->orderBy('id','ASC')
        ->paginate(5);

        $upcoming_events = UpcomingEvents::where('event_name', 'like', '%'.$this->search_event.'%')
        ->orderBy('id','ASC')
        ->paginate(5);

        return view('livewire.admin.utilities',[
            'notices' => $notices,
            'upcoming_events' => $upcoming_events,
        ]);
    }

}

