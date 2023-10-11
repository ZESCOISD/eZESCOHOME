<?php


namespace App\Http\Livewire\Site;

use App\Http\Controllers\HomeController;
use App\Models\Category;
use App\Models\FAQ;
use App\Models\Product;
use App\Models\ProductClicks;
use App\Models\Slide;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class HowTo extends Component
{

    use WithPagination;

    public $search_term, $nav_search;
    public $search_results = [];
    public $product_id;
    public $loading = false;
    protected $paginationTheme = 'bootstrap';



    public function render()
    {

        $products = Product::
            where('status_code', config('constants.status_codes.active'))
            ->orderBy('number_of_clicks', 'desc')
           ->paginate(18) ;

        $categories = $products->pluck('category')->unique() ;

        return view('livewire.site.learn-more', compact('categories', 'products'));
    }


    public function navSearch(){
        $this->search_results = HomeController::searchResults($this->nav_search);
    }

    public function recordClick($product_id)
    {
        HomeController::recordClick($product_id);
    }

}
