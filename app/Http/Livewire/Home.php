<?php


namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\Status;
use App\Models\ProductClicks;
use App\Models\Notices;
use App\Models\Slide;
use Livewire\WithPagination;
use PHPUnit\Framework\Error\Notice;
use App\Models\UpcomingEvents;

class Home extends Component
{


      use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $no_notices;

    public $searchQuery;
    public $product_id;
    public $loading = false;
    // public $dropdowns = false;
    public $searchedProduct;
    public $getSelectedProducts = [];
    public $selected_category;
    // public $categoryName;

    public $slides;

    public function incrementClicks($product_id)
    {
        //one - increment in system / products table
        $product = Product::find($product_id);
        $product->number_of_clicks++;
        $product->save();

        $product_clicks = ProductClicks::where('product_id',  $product->product_id )
        ->where('product_url',  $product->url )
        ->whereDate('created_at', Carbon::today())->first();

        //  dd($product_clicks);
        // sleep(30);

        if($product_clicks){   // if exits then update

            // dd(1111);

            $product_clicks->number_of_clicks++;
            $product_clicks->save();
        }else{
            $product_clicks = new ProductClicks();
            $product_clicks->product_url = $product->url;
            $product_clicks->product_name = $product->name;
            $product_clicks->product_id = $product->product_id;
            $product_clicks->number_of_clicks = 1;
            $product_clicks->save();
        }

    }


    public function showResult($category_id){
        // dd($category_id);
        $loading = true;
        sleep(2);
        $categoryclick = DB::table('category')
            ->join('product', 'category.category_id', '=', 'product.category_id')
            ->join('status', 'product.status_id', '=', 'status.status_id')
            ->select('category.name as category_name', 'product.name as product_name',
                     'product.url as product_url','product.product_id as product_id',
                     'status.name as name','product.number_of_clicks as number_of_clicks')
            ->where('status.name','=','active')
            ->where('category.category_id','=',$category_id)
            ->orderBy('category.name')
            ->get();
            $this->getSelectedProducts = $categoryclick;
            $loading = false;

    }

    public function search()
    {
        $loading = true;
        sleep(3);

        $this->searchedProduct = Product::join('status','product.status_id','=','status.status_id')
        ->select('product.name as product_name','status.name','product.url as product_url','product.product_id as product_id')
        ->where('status.name','=','active')
        ->where('product.name', 'like', '%' . $this->searchQuery . '%')
        ->where('product.product_id','>=','1B')
        ->first();

        $this->searchQuery ="";
        $loading = false;
        $dropdowns = true;
    }

    public function mount()
    {
        $this->searchedProduct = null;
        $this->slides = Slide::pluck('text');
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
        //          'product.url as product_url','product.product_id as product_id','product.url',
        //          'status.name as name','product.number_of_clicks as number_of_clicks')
        // ->where('status.name','=','active')
        ->orderBy('name')
        ->get();

        // $groupedClickedCategories = $showCategories->groupBy('category_name');

        $models = Product::all();
        $categories = DB::table('category')
            ->join('product', 'category.category_id', '=', 'product.category_id')
            ->join('status', 'product.status_id', '=', 'status.status_id')
            ->select('category.name as category_name', 'product.name as product_name',
                     'product.url as product_url','product.product_id as product_id',
                     'status.name as name','product.number_of_clicks as number_of_clicks')
            ->where('status.name','=','active')
            ->orderBy('category.name')
            ->get();


        $groupedCategories = $categories->groupBy('category_name');

        // dd($groupedCategories);
        $getProducts = DB::table('product')
                    ->join('status','product.status_id','=','status.status_id')
                    ->select('product.name','product.number_of_clicks as clicks',
                            'product.url as product_url','product.product_id',
                             'status.name as status_name')
                    ->where('status.name','=','active')
                    ->orderBy('product.number_of_clicks', 'desc')
                    ->take(18)
                    ->get();

        $frequentlyAccessedToday = DB::table('product_clicks')
        ->select('product_name', 'number_of_clicks','created_at')
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
            ->select('event_name', 'event_description', 'venue', 'time', 'date', 'start_date', 'end_date')
            ->whereDate('start_date', '<=', Carbon::today())
            ->whereDate('end_date', '>=', Carbon::today())
            ->paginate(1);


        return view('livewire.home',[
                'groupedCategories' => $groupedCategories,
                'more_notices' => $more_notices,
                'upcoming_events' => $upcoming_events,
                'getProducts' => $getProducts,
                'models' => $models,
                'showCategories' => $showCategories,
            ]);
    }



}
