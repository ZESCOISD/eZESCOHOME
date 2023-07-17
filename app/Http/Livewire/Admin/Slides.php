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
    public $edit_image;
    public $new_image;

    public $search_slide;
    public $loading = false;
    public $allData = [];

    public function saveSlide(){
        $this->loading = true;
        sleep(2);

         $images = new Slide();
        $this->validate([
            'name' => 'nullable|min:3|max:20',
            'image' => 'nullable|image|max:10024',
        ]);

        $filename = "";
        if ($this->image) {
            $filename = $this->image->store('images', 'public');
        } else {
            $filename = Null;
        }

         $images->name = $this->name;
        $images->image = $filename;
        $result = $images->save();

        if($result){
             session()->flash('savesuccessful','Your slide was successfully added');
              $this->resetInput();
        }else{
             session()->flash('error', 'Not Add Successfully');
        }

        $this->loading = false;
    }

    public function editSlide(int $slide_id){
        $slide = Slide::find($slide_id);
        // dd($slide);

        if($slide){
            $this->slide_id = $slide->id;
            $this->name = $slide->name;
            $this->edit_image = $slide->image;
        }else{
            return redirect()->to('/slides/manage');
        }
    }

    public function closeModal(){
        $this->resetInput();
    }

    public function resetInput(){
        $this-> name ='';
        $this-> image = "";
         $this-> edit_image = "";
    }

    public function updateSlide(){
        $this->loading = true;
        sleep(2);


        $slide = Slide::findOrFail($this->slide_id);
        // dd($images);
        $this->validate([
             'name' => 'nullable|min:3|max:20',
            'edit_image' => 'nullable|image|max:10024',
        ]);


         $filename = "";
        if ($this->edit_image) {
            $filename = $this->edit_image->store('images', 'public');
        } else {
            $filename = Null;
        }

        $slide->name = $this->name;
        $slide->image = $filename;
        $result = $slide->save();


         if ($result) {
            session()->flash('updatesuccessful','Your slide was updated successfully');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
        } else {
            session()->flash('error', 'Not Update Successfully');
        }

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
