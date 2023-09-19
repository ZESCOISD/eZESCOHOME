<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\FAQ;
use App\Models\Notices;
use App\Models\Product;
use App\Models\ProductClicks;
use App\Models\Quote;
use App\Models\Slide;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ZescoHome extends Component
{
    use WithPagination;

    public $notice_id, $notice_name, $description, $staff_name, $staff_title, $department, $start_date, $end_date;
    public $no_notices;
    public $searchQuery;
    public $product_id;
    public $loading = false;
    public $cost_savings;
    public $in_development;
    public $in_production;
    public $total_categories;
    public $searchedProduct;
    // public $dropdowns = false;
    public $getSelectedProducts = [];
    public $products = [] ;
    public $getSelectedCategory;
    public $selected_category;
    protected $paginationTheme = 'bootstrap';


    public function incrementClicks($product_id)
    {
        //one - increment in system / products table
        $product = Product::find($product_id);
        // dd($product);
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
        $this->getSelectedProducts = DB::table('category')
            ->join('product', 'category.category_id', '=', 'product.category_id')
            ->join('status', 'product.status_id', '=', 'status.status_id')
            ->select('category.name as category_name', 'product.name as product_name', 'category.html',
                'product.url as product_url', 'product.id as product_id',
                'status.name as name', 'product.number_of_clicks as number_of_clicks')
            ->where('status.slug', '=', config('constants.statuses.production'))
            ->where('category.category_id', '=', $category_id)
            ->orderBy('category.name')
            ->get();



        if (empty($this->getSelectedProducts)) {
            $this->getSelectedCategory = "No Applications are available for this Category";
        }

        $this->getSelectedCategory = Category::find($category_id);

        $this->loading = false;

    }

    public function search()
    {
        $this->loading = true;
        sleep(3);

        $this->searchedProduct = Product::with('category')->join('status', 'product.status_id', '=', 'status.status_id')
            ->select('product.name as product_name', 'status.name', 'product.url as product_url', 'product.id as product_id',  'product.category_id')
            ->where('status.slug', '=', config('constants.statuses.production'))
            ->where('product.name', 'like', '%' . $this->searchQuery . '%')
            // ->where('product.id','>=','1B')
            ->first();

        // dd($this->searchedProduct);

        $this->searchQuery = "";
        $this->loading = false;
        $dropdowns = true;
        // $this->showModal = true;

    }

    public function mount()
    {
        $this->searchedProduct = null;
        $this->cost_savings = $this->calculateTotalCostSavings();
        $this->in_development = $this->calculateDevelopmentSystems();
        $this->in_production = $this->getTotalSystemsInProduction();
        $this->total_categories = $this->getTotalSystemCategories();
        $this->getSelectedCategory;
    }

//     public function closeModal()
// {
//     $this->showModal = false;
// }

    public function calculateTotalCostSavings()
    {
        return Product::sum('cost_saving');
    }

    public function calculateDevelopmentSystems()
    {
        return Product::join('status', 'product.status_id', '=', 'status.status_id')
            ->select('product.name as product_name', 'status.name', 'product.id as product_id')
            ->where('status.slug', '=', config('constants.statuses.development'))
            ->count('status.name');
    }

    public function getTotalSystemsInProduction()
    {
        return Product::join('status', 'product.status_id', '=', 'status.status_id')
            ->select('product.name as product_name', 'status.name', 'product.id as product_id')
            ->where('status.slug', '=', config('constants.statuses.production'))
            ->count('status.name');
    }

    public function getTotalSystemCategories()
    {
        return Category::count();
    }

    public function readMore(int $notice_id)
    {
        $notice = Notices::find($notice_id);
        // dd($notice_id);
        if ($notice) {
            $this->notice_id = $notice->id;
            $this->notice_name = $notice->notice_name;
            $this->description = $notice->description;
            $this->staff_name = $notice->staff_name;
            $this->staff_title = $notice->staff_title;
            $this->department = $notice->department;
            $this->start_date = $notice->start_date;
            $this->end_date = $notice->end_date;
            // dd(1);
        } else {
            return redirect()->to('/notices.manage');
        }
    }

    public function render()
    {
        $showCategories = DB::table('category')
            ->orderBy('name')
            ->get();

        $system_carousel = Product::all();
        $categories = DB::table('category')
            ->join('product', 'category.category_id', '=', 'product.category_id')
            ->join('status', 'product.status_id', '=', 'status.status_id')
            ->select('category.name as category_name', 'product.name as product_name',
                'product.url as product_url', 'product.id as product_id',
                'status.name as name', 'product.number_of_clicks as number_of_clicks')
            ->where('status.slug', '=', config('constants.statuses.production'))
            // ->where('category')
            ->orderBy('category.name')
            ->get();


        $groupedCategories = $categories->groupBy('category_name');

        $getProducts = DB::table('product')
            ->join('status', 'product.status_id', '=', 'status.status_id')
            ->select('product.name', 'product.number_of_clicks as clicks',
                'product.url as product_url', 'product.id',
                'status.name as status_name')
            ->where('status.slug', '=', config('constants.statuses.production'))
            ->orderBy('product.number_of_clicks', 'desc')
            ->take(12)
            ->get();

        $frequentlyAccessedToday = DB::table('product_clicks')
            ->select('product_name', 'number_of_clicks', 'created_at')
            ->whereDate('created_at', Carbon::today())
            ->orderByDesc('number_of_clicks')
            ->first();

        $categories = $groupedCategories;


        $more_notices = DB::table('notices')
            ->select('id', 'notice_name', 'description', 'staff_name', 'staff_title', 'department', 'start_date', 'end_date')
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
        $quotes = Quote::all();
        $ezesco_products = Product::all();

        return view('livewire.zesco-home', [
            'groupedCategories' => $groupedCategories,
            'more_notices' => $more_notices,
            'upcoming_events' => $upcoming_events,
            'ezesco_products' => $ezesco_products,
            'getProducts' => $getProducts,
            'system_carousel' => $system_carousel,
            'showCategories' => $showCategories,
            'faqs' => $faqs,
            'slides' => $slides,
            'quotes' => $quotes,
        ]);
    }
}
