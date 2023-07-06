<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use App\Models\SuggestionBox;

class SuggestionBoxs extends Component
{

        use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $suggestion_id, $subject, $system_name, $suggestion;

    public $search_suggestion;

    public $viewItem;
    public $loading = false;
    public $allData = [];


    protected function rules(){
        return[
        'subject' => 'required|min:2|max:100',
        'system_name' => 'required|min:3|max:200',
        'suggestion' => 'required|min:3|max:200',
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function viewItem(int $suggestion_id){


        $this->viewItem = SuggestionBox::find($suggestion_id);

        // $product = Product::find($product_id);

        if($this->viewItem){
             $this->subject = $this->viewItem->subject;
            $this->system_name = $this->viewItem->system_name;
            $this->suggestion = $this->viewItem->suggestion;

        }else{
              return redirect()->to('/suggestions/manage');
        }

    }



    public function closeModal(){
        $this->resetInput();
    }

    public function resetInput(){
        $this->subject ='';
        $this->system_name = '';
        $this->suggestion = '';

    }



    public function deleteSuggestion(int $suggestion_id){
        $this->suggestion_id = $suggestion_id;
    }

    public function destroySuggestion(){
        $this->loading = true;
        sleep(2);

      SuggestionBox::find($this->suggestion_id)->delete();
      session()->flash('deletesuccessful','suggestion was deleted successfully');
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
        $suggestions = SuggestionBox::where('subject', 'like', '%'.$this->search_suggestion.'%')
        ->orderBy('id','ASC')
        ->paginate(5);

        return view('livewire.admin.suggestion-box',[
            'suggestions' => $suggestions,
        ]);
    }
}
