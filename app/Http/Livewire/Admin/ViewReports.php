<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Product;
use App\Models\Status;
use App\Models\Category;
use App\Models\SuggestionBox;

use Illuminate\Support\Facades\Schema;
use Livewire\WithPagination;

class ViewReports extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

   public $suggest;

    public $selectedReportType;
    public $search;
    public $from;
    public $to;

    public $viewProduct;
    public $products;
    public $suggestions;
    public $overallCategories;
    public $totalActiveSystems;

    public $suggestion_id, $subject, $system_name, $suggestion;

    public $name, $product_id, $icon_link, $category_id, $category_name,
    $status_code, $status_name,  $number_of_clicks, $url, $test_url,
    $lead_developer, $short_description, $long_description,
    $tutorial_url, $date_launched, $date_decommissioned;


    public function mount(){
        $this->selectedReportType = [];
        $this->products = [];
        $this->suggestions;
        $this->suggest;


        $this->totalActiveSystems = DB::table('product')
        ->join('status', 'product.status_code', '=', 'status.code')
        ->select('product.* ','status.name as status_name')
        ->where('status.code','like','%'.config('constants.status_codes.active').'%')
        ->count();


    

        $this->overallCategories = DB::table('category')
        ->count();
    }

    public function viewItem(int $product_id){

        // ->join('status as s', 'product.status_code', '=', 's.code')
        // ->join('category as c', 'product.category_id', '=', 'c.id')
        // ->select('product.*','s.name as status_name','c.name as category_name');

        $this->viewProduct = Product::join('status', 'product.status_code', '=', 'status.code')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->where('product.product_id', $product_id)
        ->select('product.*', 'status.name as status_name', 'category.name as category_name')
        ->first();

        // $product = Product::find($product_id);
        if($this->viewProduct){
            if ($this->category_id == "0" || $this->status_code == "0"
            || $this->lead_developer == "0") {
            $this->addError('selectedOption', 'Please select a valid option.');
            return;
        }else{
            $this->product_id = $this->viewProduct->product_id;
            $this->name = $this->viewProduct->name;
            $this->icon_link = $this->viewProduct->icon_link;
            $this->category_name = $this->viewProduct->category_name;
            $this->status_name = $this->viewProduct->status_name;
            // $this->number_of_clicks = $this->viewProduct->number_of_clicks;
            $this->url = $this->viewProduct->url;
            $this->test_url = $this->viewProduct->test_url;
            $this->lead_developer = $this->viewProduct->lead_developer;
            $this->short_description = $this->viewProduct->short_description;
            $this->long_description = $this->viewProduct->long_description;
            $this->tutorial_url = $this->viewProduct->tutorial_url;
            $this->date_launched = $this->viewProduct->date_launched;
            $this->date_decommissioned = $this->viewProduct->date_decommissioned;
          }
        }else{
            return redirect()->to('/product.manage');
        }
    }


    public function render()
    {


        $frequentlyAccessed = DB::table('product')
            ->select('name', 'number_of_clicks')
            ->orderByDesc('number_of_clicks')
            ->first();

        $frequentlyAccessedToday = DB::table('product_clicks')
        ->select('product_name', 'number_of_clicks','created_at')
        ->whereDate('created_at', \Carbon\Carbon::today())
        ->orderByDesc('number_of_clicks')
        ->first();

        // dd($frequentlyAccessedToday);

        $leastAccessed = DB::table('product')
        ->select('name', 'number_of_clicks')
        ->orderBy('number_of_clicks')
        ->first();

        return view('livewire.admin.view-reports',[
          'frequentlyAccessed' =>  $frequentlyAccessed,
          'leastAccessed' =>  $leastAccessed,
          'frequentlyAccessedToday' =>  $frequentlyAccessedToday,
        ]);
    }


    public function searching(){

        $reportType = $this->selectedReportType;
        if(!empty($reportType)){
          
            $productQuery = Product::join('status', 'product.status_code', '=', 'status.code')
            ->join('category', 'product.category_id', '=', 'category.id')
            ->select('product.*', 'status.name as status_name', 'category.name as category_name');
        
        if ($reportType === "1") {
            if (!empty($this->search)) {
                $productQuery->where('product.name', 'like', '%' . $this->search . '%');
            }
        
            if (!empty($this->from)) {
                $productQuery->whereDate('product.created_at', '>=', $this->from);
            }
        
            if (!empty($this->to)) {
                $productQuery->whereDate('product.created_at', '<=', $this->to);
            }
        
            $this->selectedReportType = $reportType;
            $this->products = $productQuery->get();
        }
        


            // Frequently Accessed System's Report
        
        if ($reportType === "2") {
            if (!empty($this->search)) {
                $productQuery->where('product.name', 'like', '%' . $this->search . '%')->orderBy('number_of_clicks', 'desc')->take(1);
            } else {
                $productQuery->orderBy('number_of_clicks', 'desc')->take(10);
            }
        
            if (!empty($this->from)) {
                $productQuery->whereDate('product.created_at', '>=', $this->from);
            }
        
            if (!empty($this->to)) {
                $productQuery->whereDate('product.created_at', '<=', $this->to);
            }
        
            $this->selectedReportType = $reportType;
            $this->products = $productQuery->get();
        }


             // Active System's

            //  $productQuery = Product::join('status', 'product.status_code', '=', 'status.code')
            //  ->join('category', 'product.category_id', '=', 'category.id')
            //  ->select('product.*', 'status.name as status_name', 'category.name as category_name');
         
         if ($reportType === "3") {
             if (!empty($this->search)) {
                 $productQuery->where('product.name', 'like', '%' . $this->search . '%')
                     ->where('status.code', 'like', '%' . config('constants.status_codes.active') . '%')
                     ->take(1);
             } else {
                 $productQuery->where('status.code', 'like', '%' . config('constants.status_codes.active') . '%');
             }
         
             if (!empty($this->from)) {
                 $productQuery->whereDate('product.created_at', '>=', $this->from);
             }
         
             if (!empty($this->to)) {
                 $productQuery->whereDate('product.created_at', '<=', $this->to);
             }
         
             $this->selectedReportType = $reportType;
             $this->products = $productQuery->get();
         }
         
              // Deactivated System's

            //   $productQuery = Product::join('status', 'product.status_code', '=', 'status.code')
            //   ->join('category', 'product.category_id', '=', 'category.id')
            //   ->select('product.*', 'status.name as status_name', 'category.name as category_name');
          
          if ($reportType === "4") {
              if (!empty($this->search)) {
                  $productQuery->where('product.name', 'like', '%' . $this->search . '%')
                      ->where('status.code', 'like', '%' . config('constants.status_codes.deactivated') . '%')
                      ->take(1);
              } else {
                  $productQuery->where('status.code', 'like', '%' . config('constants.status_codes.deactivated') . '%');
              }
          
              if (!empty($this->from)) {
                  $productQuery->whereDate('product.created_at', '>=', $this->from);
              }
          
              if (!empty($this->to)) {
                  $productQuery->whereDate('product.created_at', '<=', $this->to);
              }
          
              $this->selectedReportType = $reportType;
              $this->products = $productQuery->get();
          }
          

             // System's in production report

            //  $productQuery = Product::join('status', 'product.status_code', '=', 'status.code')
            //  ->join('category', 'product.category_id', '=', 'category.id')
            //  ->select('product.*', 'status.name as status_name', 'category.name as category_name');
         
         if ($reportType === "5") {
             if (!empty($this->search)) {
                 $productQuery->where('product.name', 'like', '%' . $this->search . '%')
                     ->where('status.code', 'like', '%' . config('constants.status_codes.production') . '%')
                     ->take(1);
             } else {
                 $productQuery->where('status.code', 'like', '%' . config('constants.status_codes.production') . '%');
             }
         
             if (!empty($this->from)) {
                 $productQuery->whereDate('product.created_at', '>=', $this->from);
             }
         
             if (!empty($this->to)) {
                 $productQuery->whereDate('product.created_at', '<=', $this->to);
             }
         
             $this->selectedReportType = $reportType;
             $this->products = $productQuery->get();
         }
         

             //  System's in development report

            //  $productQuery = Product::join('status', 'product.status_code', '=', 'status.code')
            //  ->join('category', 'product.category_id', '=', 'category.id')
            //  ->select('product.*', 'status.name as status_name', 'category.name as category_name');
         
         if ($reportType === "6") {
             if (!empty($this->search)) {
                 $productQuery->where('product.name', 'like', '%' . $this->search . '%')
                     ->where('status.code', 'like', '%' . config('constants.status_codes.development') . '%')
                     ->take(1);
             } else {
                 $productQuery->where('status.code', 'like', '%' . config('constants.status_codes.development') . '%');
             }
         } elseif ($reportType === "7") {
             if (!empty($this->search)) {
                 $productQuery->where('product.name', 'like', '%' . $this->search . '%')
                     ->where('status.code', 'like', '%' . config('constants.status_codes.decommissioned') . '%')
                     ->take(1);
             } else {
                 $productQuery->where('status.code', 'like', '%' . config('constants.status_codes.decommissioned') . '%');
             }
         } elseif ($reportType === "8") {
             if (!empty($this->search)) {
                 $productQuery->where('product.lead_developer', 'like', '%' . $this->search . '%')
                     ->take(1);
             } else {
                 $productQuery->where('product.lead_developer', 'like', '%' . $this->search . '%');
             }
         }
         
         if (!empty($this->from)) {
             $productQuery->whereDate('product.created_at', '>=', $this->from);
         }
         
         if (!empty($this->to)) {
             $productQuery->whereDate('product.created_at', '<=', $this->to);
         }
         
         $this->selectedReportType = $reportType;
         $this->products = $productQuery->get();
         
         $suggestionQuery = SuggestionBox::query();

         if ($reportType === "9") {
             if (!empty($this->search)) {
                 $suggestionQuery->where('system_name', 'like', '%' . $this->search . '%');
             }
         
             if (!empty($this->from)) {
                 $suggestionQuery->whereDate('created_at', '>=', $this->from);
             }
         
             if (!empty($this->to)) {
                 $suggestionQuery->whereDate('created_at', '<=', $this->to);
             }
         
             $this->selectedReportType = $reportType;
         
             $this->suggestions = $suggestionQuery->paginate(5);
         }
         
        }
    }

    public function viewRow(int $product_id){
        $product = Product::find($product_id);
        
        if($product){
            // $product = Product::find($product_id);
            $this->name = $product->product_id;
            $this->name = $product->name;
            $this->icon_link = $product->icon_link;
            $this->category_id = $product->category_id;
            $this->status_code = $product->status_code;
            $this->number_of_clicks = $product->number_of_clicks;
            $this->url = $product->url;
            $this->test_url = $product->test_url;
            $this->lead_developer = $product->lead_developer;
            $this->short_description = $product->short_description;
            $this->long_description = $product->long_description;
            $this->tutorial_url = $product->tutorial_url;
            $this->date_launched = $product->date_launched;
            $this->date_decommissioned = $product->date_decommissioned;
        }else{
            return redirect()->to('/reports.manage');
        }
    }


    public function viewSuggestion(int $suggestion_id){
        $suggestions= SuggestionBox::find($suggestion_id);
        
        if($suggestions){
            
            $this->suggestion_id = $suggestions->suggestion_id;
            $this->subject = $suggestions->subject;
            $this->system_name = $suggestions->system_name;
            $this->suggestion = $suggestions->suggestion;
        
        }else{
            return redirect()->to('/reports.manage');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

}
