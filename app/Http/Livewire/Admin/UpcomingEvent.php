<?php

namespace App\Http\Livewire\Admin;


use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use App\Models\UpcomingEvents;

class UpcomingEvent extends Component
{
     use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $event_id, $event_name, $event_description, $venue, $fee, $time, $date ,$start_date, $end_date;

    public $search_event;
    public $loading = false;
    public $allData = [];


    protected function rules(){
        return[
        'event_name' => 'required|min:2|max:50',
        'event_description' => 'required|min:3|max:500',
        'venue' => 'required|min:3|max:50',
        'fee' => 'nullable|numeric',
        'time' => 'required|date_format:H:i',
        'date' => 'required|date',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function saveEvent(){
        $this->loading = true;
        sleep(2);

        $validateData = $this ->validate();
        UpcomingEvents::create($validateData);
        $this->resetInput();
        session()->flash('savesuccessful','Your event was successfully added');

        $this->loading = false;
    }

    public function editEvent(int $event_id){
        $event = UpcomingEvents::find($event_id);

        // dd($event);s
        if($event){
            $this->event_id = $event->id;
            $this->event_name = $event->event_name;
            $this->event_description = $event->event_description;
            $this->venue = $event->venue;
            $this->fee = $event->fee;
            $this->time = $event->time;
            $this->date = $event->date;
            $this->start_date = $event->start_date;
            $this->end_date = $event->end_date;
        }else{
            return redirect()->to('/events.manage');
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
        $this-> fee ='';
        $this-> time ='';
        $this-> date ='';
         $this-> start_date ='';
          $this-> end_date ='';

    }

    public function updateEvent(){
        $this->loading = true;
        sleep(2);

         dd(111);
        $validateData = $this ->validate();
        dd(222);
        dd($validateData);
        // dd($validateData);
        UpcomingEvents::where('id',$this->event_id)->update([
            'event_name' => $validateData['event_name'],
            'event_description' => $validateData['event_description'],
            'venue' => $validateData['venue'],
            'fee' => $validateData['fee'],
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

       public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function render()
    {
        $upcoming_events = UpcomingEvents::where('event_name', 'like', '%'.$this->search_event.'%')
        ->orderBy('id','ASC')
        ->paginate(5);

        return view('livewire.admin.events',[
            'upcoming_events' => $upcoming_events,
    ]);
    }

}
