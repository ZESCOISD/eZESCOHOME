<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use App\Models\FAQ;

class FAQS extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $faq_id, $question, $answer;

    public $search_faq;
    public $loading = false;
    public $allData = [];


    protected function rules(){
        return[
        'question' => 'required|min:2|max:100',
        'answer' => 'required|min:3|max:200',
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function saveFaq(){
        $this->loading = true;
        sleep(2);

        $validateData = $this ->validate();
        FAQ::create($validateData);
        $this->resetInput();
        session()->flash('savesuccessful','Your faq was successfully added');

        $this->loading = false;
    }

    public function editFaq(int $faq_id){
        $faq = FAQ::find($faq_id);
        if($faq){
            $this->faq_id = $faq->id;
            $this->question = $faq->question;
            $this->answer = $faq->answer;

        }else{
            return redirect()->to('/faqs.manage');
        }
    }

    public function closeModal(){
        $this->resetInput();
    }

    public function resetInput(){
        $this->faq_id ='';
        $this->question = '';
        $this->answer = '';

    }

    public function updateFaq(){
        $this->loading = true;
        sleep(2);

        $validateData = $this ->validate();

        // dd($validateData);
        FAQ::where('id',$this->faq_id)->update([
            'question' => $validateData['question'],
            'answer' => $validateData['answer'],
        ]);
        session()->flash('updatesuccessful','Your faq was updated successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');

        $this->loading = false;

    }

    public function deleteFaq(int $faq_id){
        $this->faq_id = $faq_id;
    }

    public function destroyFaq(){
        $this->loading = true;
        sleep(2);

      FAQ::find($this->faq_id)->delete();
      session()->flash('deletesuccessful','Your faq was deleted successfully');
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
         $faqs = FAQ::where('question', 'like', '%'.$this->search_faq.'%')
        ->orderBy('id','ASC')
        ->paginate(5);

        return view('livewire.admin.f-a-q-s',[
            'faqs' => $faqs,
        ]);
    }
}
