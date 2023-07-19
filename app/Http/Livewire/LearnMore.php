<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\SuggestionBox;

class LearnMore extends Component
{

    
    public $product_id;
    public $name;
    public $video;
    public $icon_link;
    public $short_description;
    public $long_description;
    public $date_launched;


       public $subject, $system_name, $suggestion;

    public $loading = false;

     protected function rules(){
        return[
        'subject' => 'required|min:2|max:100',
        'system_name' => 'required|min:3|max:200',
        'suggestion' => 'required|min:3|max:200',
        ];

    }

    public function mount($product_id){
        $this->product_id = $product_id;
    }

      public function saveSuggestion(){
        $this->loading = true;
        sleep(2);

        $validateData = $this ->validate();
        SuggestionBox::create($validateData);
        $this->resetInput();
        session()->flash('saveSuggestion','Your suggestion was successfully sent');

        $this->loading = false;
    }

       public function resetInput(){
        $this->subject ='';
        $this->system_name = '';
        $this->suggestion = '';

    }

    public function closeModal(){
        $this->resetInput();
    }

    public function render()
    {
          $product = Product::find($this->product_id);

        if($product){
            $this->product_id = $product->product_id;
            $this->name = $product->name;
            $this->video = $product->video;
            $this->icon_link = $product->icon_link;
            $this->short_description = $product->short_description;
            $this->long_description = $product->long_description;
            $this->date_launched = $product->date_launched;
           
        }else{
            return redirect()->to('/ezesco-systems');
        }

        // dd($product->video);

        return view('livewire.learn-more',[
            'product' => $product,
        ]);
    }
}
