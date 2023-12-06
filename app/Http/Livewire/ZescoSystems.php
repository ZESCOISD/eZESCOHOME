<?php

namespace App\Http\Livewire;
use App\Models\SuggestionBox;
use Carbon\Carbon;
// use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\Status;
use App\Models\ProductClicks;
use App\Models\Slide;
use Livewire\WithPagination;


use Livewire\Component;

class ZescoSystems extends Component
{


     use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchQuery;

    public $product_id;
    public $name;
    public $video;

    public $icon_link;
    public $user_manual;
    public $short_description;
    public $long_description;
    public $date_launched;
    public $status_name;

    public $subject, $system_name, $suggestion;

    public $loading = false;

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

    public function learnMore(int $product_id){
       return redirect()->to('/how-to/learn-more/' . $product_id);
    }



    public function render()
    {
        $products  = DB::table('product')
                ->join('status','product.status_code','=','status.code')
                ->select('product.name','product.icon_link','product.user_manual','product.number_of_clicks as clicks',
                        'product.url as product_url','product.id',
                        'product.system_cover_image', 'product.video',
                        'status.name as status_name','product.short_description')
                ->where('status.code','=',config('constants.statuses.production'))
                ->where('product.name', 'like', '%'.$this->searchQuery.'%')
                ->orderBy('product.number_of_clicks', 'desc')
                ->paginate(6);


        return view('livewire.zesco-systems',[

            'products' => $products,
            'getProducts' => $products,
            ]);
    }
}
