<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use App\Models\Slide;
use Livewire\WithFileUploads;

class Slides extends Component
{
       use WithPagination;
       use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    // public $name;
    public $slide_id, $name , $image;
    public $search_slide;
    public $loading = false;
    public $allData = [];
    protected function rules(){
        return[
            'name' => 'nullable|min:3|max:20',
            'image' => 'required|image|max:5024',
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveSlide(){
        $this->loading = true;
        sleep(2);

        $validateData = $this ->validate();
        Slide::create($validateData);
        $this->resetInput();
        session()->flash('savesuccessful','Your slide was successfully added');

        $this->loading = false;
    }

    public function editSlide(int $slide_id){
        $slide = Slide::find($slide_id);
        if($slide){
            $this->name = $slide->name;
            $this->image = $slide->image;
        }else{
            return redirect()->to('/slides/manage');
        }
    }

    public function closeModal(){
        $this->resetInput();
    }

    public function resetInput(){
        $this-> name ='';
        $this-> image ='';
    }

    public function updateSlide(){
        $this->loading = true;
        sleep(2);

        $validateData = $this ->validate();
        Slide::where('slide_id',$this->slide_id)->update([
            'name' => $validateData['name'],
            'image' => $validateData['image'],
        ]);
        session()->flash('updatesuccessful','Your slide was updated successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');

        $this->loading = false;

    }

    public function deleteSlide(int $slide_id){
        $this->slide_id = $slide_id;
    }

    public function destroySlide(){
        $this->loading = true;
        sleep(2);

      Slide::find($this->slide_id)->delete();
      session()->flash('deletesuccessful','Your slide was deleted successfully');
        $this->dispatchBrowserEvent('close-modal');

        $this->loading = false;
    }


    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }    public function render()
    {
         $slides = Slide::where('name', 'like', '%'.$this->search_slide.'%')
        ->orderBy('id','ASC')
        ->paginate(5);
        return view('livewire.admin.slides',[
            'slides' => $slides,
        ]);
    }
}
