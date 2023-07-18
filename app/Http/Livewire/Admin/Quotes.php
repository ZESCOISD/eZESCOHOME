<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Quote;
use League\CommonMark\Extension\SmartPunct\Quote as SmartPunctQuote;
use Livewire\WithPagination;


class Quotes extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // public $name;
    public $quote_id, $quote, $author;

    public $search_quote;
    public $loading = false;
    public $allData = [];

    public function saveQuote(){
        $this->loading = true;
        sleep(2);

         $quote = new Quote();
        $this->validate([
            'quote' => 'nullable|min:3|max:5000',
            'author' => 'nullable|min:3|max:200',
        ]);


         $quote->quote = $this->quote;
        $quote->author = $this->author;
        $result = $quote->save();

        if($result){
             session()->flash('savesuccessful','Your Quote was successfully added');
              $this->resetInput();
        }else{
             session()->flash('error', 'Failed to Save');
        }

        $this->loading = false;
    }

    public function editQuote(int $quote_id){
        $quote = Quote::find($quote_id);
        // dd($slide);

        if($quote){
            $this->quote_id = $quote->id;
            $this->quote = $quote->quote;
            $this->author = $quote->author;
        }else{
            return redirect()->to('/quotes/manage');
        }
    }

    public function closeModal(){
        $this->resetInput();
    }

    public function resetInput(){
        $this-> quote ='';
        $this-> author = "";
         $this-> quote_id = "";
    }

    public function updateQuote(){
        $this->loading = true;
        sleep(2);


        $quote = Quote::findOrFail($this->quote_id);
        // dd($images);
        $this->validate([
             'quote' => 'nullable|min:3|max:5000',
            'author' => 'nullable|min:3|max:200',
        ]);

        $quote->quote = $this->quote;
        $quote->author = $this->author;
        $result = $quote->update();


         if ($result) {
            session()->flash('updatesuccessful','Your quote was updated successfully');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
        } else {
            session()->flash('error', 'Failed to Update');
        }

        $this->loading = false;

    }

    public function deleteQuote(int $quote_id){
        $this->quote_id = $quote_id;
    }

    public function destroyQuote(){
        $this->loading = true;
        sleep(2);

      Quote::find($this->quote_id)->delete();
      session()->flash('deletesuccessful','Your quote was deleted successfully');
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
        $quotes = Quote::where('quote', 'like', '%'.$this->search_quote.'%')
        ->orderBy('id','ASC')
        ->paginate(5);
        return view('livewire.admin.quotes',[
              'quotes' => $quotes,
        ]);
    }
}
