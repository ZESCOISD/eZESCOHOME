<?php

namespace App\Http\Livewire;
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
    public $icon_link;
    public $short_description;
    public $long_description;
    public $date_launched;
    public $status_name;

     public function showMore(int $product_id){
        // dd($product_id);
        $product = Product::find($product_id);
                // ->join('status','product.status_id','=','status.status_id')
                // ->select('product.name as product_name','product.product_id as product_id','status.name as status_name')
                // ->where('product.product_id','=','active');

        // dd($product);


        if($product){
            $this->product_id = $product->product_id;
            $this->name = $product->name;
            $this->icon_link = $product->icon_link;
            $this->short_description = $product->short_description;
            $this->long_description = $product->long_description;
            $this->date_launched = $product->date_launched;
            // $this->status_name = $product->status_name;
        }else{
            return redirect()->to('/ezesco-systems');
        }
    }

    public function render()
    {
        $getProducts = DB::table('product')
                ->join('status','product.status_id','=','status.status_id')
                ->select('product.name','product.number_of_clicks as clicks',
                        'product.url as product_url','product.product_id',
                            'status.name as status_name','product.short_description')
                ->where('status.name','=','active')
                ->where('product.name', 'like', '%'.$this->searchQuery.'%')
                ->orderBy('product.number_of_clicks', 'desc')
                ->paginate(6);


                // ->get();

        // $products = Product::where('name', 'like', '%'.$this->searchQuery.'%')->orderBy('product_id','ASC')->paginate(6);


        return view('livewire.zesco-systems',[
                // 'products' =>  $products,
                'getProducts' => $getProducts,
            ]);
    }
}
