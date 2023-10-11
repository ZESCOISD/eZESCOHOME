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

class ContactUs extends Component
{

    use WithPagination;

    public $search_term, $nav_search;
    public $search_results = [];
    public $searchQuery;
    public $product_id;
    public $loading = false;
    public $cost_savings;
    public $active_systems;
    public $in_production;
    public $total_categories;
    public $searchedProduct;
    public $getSelectedProducts = [];
    public $selected_category;
    protected $paginationTheme = 'bootstrap';


    public function incrementClicks($product_id)
    {
        $product = Product::find($product_id);
        $product->number_of_clicks++;
        $product->save();
        $product_clicks = ProductClicks::where('product_id', $product->product_id)
            ->where('product_url', $product->url)
            ->whereDate('created_at', Carbon::today())->first();
        if ($product_clicks) {
            $product_clicks->number_of_clicks++;
            $product_clicks->save();
        } else
        {
            $product_clicks = new ProductClicks();
            $product_clicks->product_url = $product->url;
            $product_clicks->product_name = $product->name;
            $product_clicks->product_id = $product->product_id;
            $product_clicks->number_of_clicks = 1;
            $product_clicks->save();
        }

    }


    public function showResult($category_id)
    {
        // dd($category_id);
        $this->loading = true;
        sleep(2);
        $categoryclick = DB::table('category')
            ->join('product', 'category.id', '=', 'product.category_id')
            ->join('status', 'product.status_id', '=', 'status.status_id')
            ->select('category.name as category_name', 'product.name as product_name',
                'product.url as product_url', 'product.id as product_id',
                'status.name as name', 'product.number_of_clicks as number_of_clicks')
            ->where('status.name', '=', 'active')
            ->where('category.id', '=', $category_id)
            ->orderBy('category.name')
            ->get();
        $this->getSelectedProducts = $categoryclick;
        $this->loading = false;

    }

    public function search()
    {
        $this->loading = true;
        sleep(3);

        $this->searchedProduct = Product::join('status', 'product.status_id', '=', 'status.status_id')
            ->select('product.name as product_name', 'status.name', 'product.url as product_url', 'product.id as product_id')
            ->where('status.name', '=', 'active')
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
        return Product::join('status', 'product.status_id', '=', 'status.status_id')
            ->select('product.name as product_name', 'status.name', 'product.id as product_id')
            ->where('status.name', '=', 'active')
            ->count('status.name');
    }

    public function getTotalSystemsInProduction()
    {
        return Product::join('status', 'product.status_id', '=', 'status.status_id')
            ->select('product.name as product_name', 'status.name', 'product.id as product_id')
            ->where('status.name', '=', 'production')
            ->orWhere('status.name', '=', 'in production')
            ->count('status.name');
    }

    public function getTotalSystemCategories()
    {
        return Category::count();
    }


    public function shouldRender()
    {
        return $this->searchedProduct !== null || $this->searchQuery !== null;
    }


    public function render()
    {

        $products = Product::join('status', 'product.status_id', '=', 'status.status_id')
            ->select('product.name as product_name', 'status.name', 'product.id as product_id')
            ->where('status.name', '=', 'production')
            ->orWhere('status.name', '=', 'in production')
            ->orderBy('number_of_clicks', 'desc')
            ->paginate(18) ;

        $categories = $products->pluck()->unique() ;

        dd( $products);


        return view('livewire.site.contact-us', [
            'products' => $products,
        ]);
    }


    public function navSearch(){
        $this->search_results = HomeController::searchResults($this->nav_search);
    }

    public function recordClick($product_id)
    {
        HomeController::recordClick($product_id);
    }

}
