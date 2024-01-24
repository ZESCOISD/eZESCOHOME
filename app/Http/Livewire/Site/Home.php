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

class Home extends Component
{

    use WithPagination;

    public $search_term, $nav_search;
    public $search_results = [];
    public $searchQuery;
    public $my_category;
    public $product_id;
    public $loading = false;
    public $cost_savings;
    public $active_systems;
    public $in_production;
    public $total_categories;
    public $searchedProduct;
    public $selected_category_id;
    public $frequent_products = [];
    public $ezesco_products_by_cat = [];
    protected $paginationTheme = 'bootstrap';

    public function search()
    {
        $this->loading = true;
        sleep(3);

        $this->searchedProduct = Product::
        select('product.name as product_name', 'product.name', 'product.url as product_url', 'product.id as product_id')
            ->where('product.status_code', config('constants.status_codes.active'))
            ->where('product.name', 'like', '%' . $this->searchQuery . '%')
            // ->where('product.id','>=','1B')
            ->first();

        $this->searchQuery = "";
        $this->loading = false;
        $dropdowns = true;
    }

    public function mount()
    {
        $this->searchedProduct = null;
        $this->cost_savings = $this->calculateTotalCostSavings();
        $this->active_systems = $this->calculateActiveSystems();
        $this->in_production = $this->getTotalSystemsInProduction();
        $this->total_categories = $this->getTotalSystemCategories();
    }

    public function calculateTotalCostSavings()
    {
        return Product::sum('cost_saving');
    }

    public function calculateActiveSystems()
    {
        return Product::select('product.name as product_name', 'product.id as product_id')
            ->where('status_code', config('constants.status_codes.active'))
            ->count('product.name');
    }

    public function getTotalSystemsInProduction()
    {
        return Product::select('product.name as product_name',  'product.id as product_id')
            ->where('status_code', config('constants.status_codes.production'))
            ->count('product.name');
    }

    public function getTotalSystemCategories()
    {
        return Category::count();
    }



    public function render()
    {
        $heartBeatCheck =  HomeController::checkSystemStateWithAGet() ;

    

        $more_notices = DB::table('notices')
            ->select('notice_name', 'description', 'staff_name', 'staff_title', 'department', 'start_date', 'end_date')
            ->whereDate('start_date', '<=', \Carbon\Carbon::today())
            ->whereDate('end_date', '>=', \Carbon\Carbon::today())
            ->paginate(2);

        $upcoming_events = DB::table('upcoming_events')
            ->select('event_name', 'event_description', 'fee', 'venue', 'time', 'date', 'start_date', 'end_date')
            ->whereDate('start_date', '<=', \Carbon\Carbon::today())
            ->whereDate('end_date', '>=', \Carbon\Carbon::today())
            ->paginate(2);

        $faqs = FAQ::all();
        $slides = Slide::all();
        $ezesco_products = Product::
            where('status_code', config('constants.status_codes.active'))
            ->orderBy('number_of_clicks', 'desc')
            ->get();

        $categories =$ezesco_products->pluck('category')->unique() ;
        $this->frequent_products = $ezesco_products->take(2);


        return view('livewire.site.home', [
            'categories' => $categories,
            'more_notices' => $more_notices,
            'ezesco_products' => $ezesco_products,
            'upcoming_events' => $upcoming_events,
            'faqs' => $faqs,
            'slides' => $slides,
        ]);
    }


    public function recordClick($product_id)
    {

      HomeController::recordClick($product_id);


    }


    public function searchByCategory($id)
    {
        $this->search_term = null;
        $this->selected_category_id = $id;
        $this->my_category = Category::find($this->selected_category_id);
        $this->ezesco_products_by_cat = Product::where('category_id', $this->selected_category_id)
            ->orderBy('number_of_clicks', 'desc')->get();

    }

    public function searchByTerm()
    {
        $this->ezesco_products_by_cat = [];
        $this->selected_category_id = null;
        $this->my_category = null;

        if ($this->search_term) {
            $categories = Category::WhereRaw("LOWER(name) LIKE LOWER('%{$this->search_term}%')")->get();
            if (!empty($categories)) {
                $this->ezesco_products_by_cat = Product::orWhereIn('category_id', $categories->pluck('id')->toArray() ?? 0)
                    ->orWhereRaw("LOWER(name) LIKE LOWER('%{$this->search_term}%')")
                    ->orWhereRaw("LOWER(url) LIKE LOWER('%{$this->search_term}%')")
                    ->orWhereRaw("LOWER(short_description) LIKE LOWER('%{$this->search_term}%')")
                    ->orderBy('name')->get();
            } else {
                $this->ezesco_products_by_cat = Product::WhereRaw("LOWER(name) LIKE LOWER('%{$this->search_term}%')")
                    ->orWhereRaw("LOWER(url) LIKE LOWER('%{$this->search_term}%')")
                    ->orWhereRaw("LOWER(short_description) LIKE LOWER('%{$this->search_term}%')")
                    ->orderBy('name')->get();
            }
        }
    }

    public function navSearch(){
        $this->search_results = HomeController::searchResults($this->nav_search);
    }
}
