<?php


namespace App\Http\Livewire\Site;

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

    public $no_notices;
    public $searchQuery;
    public $product_id;
    public $loading = false;
    public $cost_savings;
    public $active_systems;
    public $in_production;
    public $total_categories;
    public $searchedProduct;
    // public $dropdowns = false;
    public $getSelectedProducts = [];
    public $selected_category;
    protected $paginationTheme = 'bootstrap';
    // public $categoryName;

    // public $slides;

    public function incrementClicks($product_id)
    {
        //one - increment in system / products table
        $product = Product::find($product_id);
        $product->number_of_clicks++;
        $product->save();

        $product_clicks = ProductClicks::where('product_id', $product->product_id)
            ->where('product_url', $product->url)
            ->whereDate('created_at', Carbon::today())->first();

        //  dd($product_clicks);
        // sleep(30);

        if ($product_clicks) {   // if exits then update

            // dd(1111);

            $product_clicks->number_of_clicks++;
            $product_clicks->save();
        } else {
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
            ->join('product', 'category.category_id', '=', 'product.category_id')
            ->join('status', 'product.status_id', '=', 'status.status_id')
            ->select('category.name as category_name', 'product.name as product_name',
                'product.url as product_url', 'product.id as product_id',
                'status.name as name', 'product.number_of_clicks as number_of_clicks')
            ->where('status.name', '=', 'active')
            ->where('category.category_id', '=', $category_id)
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

        $showCategories = DB::table('category')
            // ->join('product', 'category.category_id', '=', 'product.category_id')
            // ->join('status', 'product.status_id', '=', 'status.status_id')
            // ->select('category.category_id','category.name as category_name', 'product.name as product_name',
            //          'product.url as product_url','product.id as product_id','product.url',
            //          'status.name as name','product.number_of_clicks as number_of_clicks')
            // ->where('status.name','=','active')
            ->orderBy('name')
            ->get();

        // $groupedClickedCategories = $showCategories->groupBy('category_name');

        $system_carousel = Product::all();
        $categories = DB::table('category')
            ->join('product', 'category.category_id', '=', 'product.category_id')
            ->join('status', 'product.status_id', '=', 'status.status_id')
            ->select('category.name as category_name', 'product.name as product_name',
                'product.url as product_url', 'product.id as product_id',
                'status.name as name', 'product.number_of_clicks as number_of_clicks')
            ->where('status.name', '=', 'active')
            ->orderBy('category.name')
            ->get();


        $groupedCategories = $categories->groupBy('category_name');

        // dd($groupedCategories);
        $getProducts = DB::table('product')
            ->join('status', 'product.status_id', '=', 'status.status_id')
            ->select('product.name', 'product.number_of_clicks as clicks',
                'product.url as product_url', 'product.id',
                'status.name as status_name')
            ->where('status.name', '=', 'active')
            ->orderBy('product.number_of_clicks', 'desc')
            ->take(18)
            ->get();

        $frequentlyAccessedToday = DB::table('product_clicks')
            ->select('product_name', 'number_of_clicks', 'created_at')
            ->whereDate('created_at', Carbon::today())
            ->orderByDesc('number_of_clicks')
            ->first();

        $categories = $groupedCategories;


        // $important_notice = DB::table('notices')
        //     ->select('notice_name', 'description', 'staff_name', 'staff_title', 'department', 'start_date', 'end_date')
        //     ->whereDate('start_date', '<=', Carbon::today())
        //     ->whereDate('end_date', '>=', Carbon::today())
        //     ->latest('created_at')
        //     ->limit(1)
        //     ->get();

        $more_notices = DB::table('notices')
            ->select('notice_name', 'description', 'staff_name', 'staff_title', 'department', 'start_date', 'end_date')
            ->whereDate('start_date', '<=', Carbon::today())
            ->whereDate('end_date', '>=', Carbon::today())
            ->paginate(1);

        $upcoming_events = DB::table('upcoming_events')
            ->select('event_name', 'event_description', 'fee', 'venue', 'time', 'date', 'start_date', 'end_date')
            ->whereDate('start_date', '<=', Carbon::today())
            ->whereDate('end_date', '>=', Carbon::today())
            ->paginate(1);

        $faqs = FAQ::all();
        $slides = Slide::all();

        $ezesco_products = Product::all();
        // dd($slides);

        return view('livewire.site.learn-more', [
            'groupedCategories' => $groupedCategories,
            'more_notices' => $more_notices,
            'upcoming_events' => $upcoming_events,
            'ezesco_products' => $ezesco_products,
            'getProducts' => $getProducts,
            'system_carousel' => $system_carousel,
            'showCategories' => $showCategories,
            'faqs' => $faqs,
            'slides' => $slides,
        ]);
    }


}