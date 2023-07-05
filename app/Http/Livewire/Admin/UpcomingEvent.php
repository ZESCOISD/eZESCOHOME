<?php

namespace App\Http\Livewire\Admin;

use App\Models\Notices;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use App\Models\UpcomingEvents;

class UpcomingEvent extends Component
{
     use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $event_id, $event_name, $event_description, $venue, $time, $date;

    public $search_event;
    public $loading = false;
    public $allData = [];


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

    $validatedData = $this->validate($rules);
        // $validateData = $this ->validate();
        UpcomingEvents::create($validatedData);
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


    public function render()
    {
        $upcoming_events = UpcomingEvents::where('event_name', 'like', '%'.$this->search_event.'%')
        ->orderBy('id','ASC')
        ->paginate(5);

         $notices = Notices::where('notice_name', 'like', '%'.$this->search.'%')
        ->orderBy('id','ASC')
        ->paginate(5);

        return view('livewire.admin.utilities',[
            'upcoming_events' => $upcoming_events,
            'notices' => $notices
    ]);
    }

}
