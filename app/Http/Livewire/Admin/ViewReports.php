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
    $status_id, $status_name,  $number_of_clicks, $url, $test_url,
    $lead_developer, $short_description, $long_description,
    $tutorial_url, $date_launched, $date_decommissioned;


    public function mount(){
        $this->selectedReportType = [];
        $this->products = [];
        $this->suggestions;
        $this->suggest;


        $this->totalActiveSystems = DB::table('product')
        ->join('status', 'product.status_id', '=', 'status.status_id')
        ->select('product.* ','status.name as status_name')
        ->where('status.name','like','%'.'active'.'%')
        ->count();

        $this->overallCategories = DB::table('category')
        ->count();
    }

    public function viewItem(int $product_id){

        // ->join('status as s', 'product.status_id', '=', 's.status_id')
        // ->join('category as c', 'product.category_id', '=', 'c.category_id')
        // ->select('product.*','s.name as status_name','c.name as category_name');

        $this->viewProduct = Product::join('status', 'product.status_id', '=', 'status.status_id')
        ->join('category', 'product.category_id', '=', 'product.category_id')
        ->where('product.product_id', $product_id)
        ->select('product.*', 'status.name as status_name', 'category.name as category_name')
        ->first();

        // $product = Product::find($product_id);
        if($this->viewProduct){
            if ($this->category_id == "0" || $this->status_id == "0"
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
            $product = Product::join('status as s', 'product.status_id', '=', 's.status_id')
            ->join('category as c', 'product.category_id', '=', 'c.category_id')
            ->select('product.*','s.name as status_name','c.name as category_name');


            if ( $reportType === "1" && !empty($this->search)) {
                $product = $product->join('status', 'product.status_id', '=', 'status.status_id')
                ->join('category', 'product.category_id', '=', 'category.category_id')
                ->select('product.*', 'status.name as status_name','category.name as category_name')
                ->where('product.name','like','%'. $this->search.'%');

                // if date is inputed
                if(!empty($this->from) && !empty($this->to)){
                    $product = $product->join('status as s1', 'product.status_id', '=', 's1.status_id')
                    ->join('category as c1', 'product.category_id', '=', 'c1.category_id')
                    ->select('product.*','s1.name as status_name','c1.name as category_name')
                    ->whereDate('product.created_at', '>=', $this->from)
                    ->whereDate('product.created_at', '<=', $this->to);

                }elseif(!empty($this->from)){
                    $product = $product->join('status as s2', 'product.status_id', '=', 's2.status_id')
                    ->join('category as c2', 'product.category_id', '=', 'c2.category_id')
                    ->select('product.*','s2.name as status_name','c2.name as category_name')
                    ->whereDate('product.created_at','>=',$this->from);


                }elseif(!empty($this->to)){
                    $product = $product->join('status as s3', 'product.status_id', '=', 's3.status_id')
                    ->join('category as c3', 'product.category_id', '=', 'c3.category_id')
                    ->select('product.*','s3.name as status_name','c3.name as category_name')
                    ->whereDate('product.created_at','<=',$this->to);

                }

                $this->selectedReportType = $reportType;
                $this->products = $product->get();


            }elseif( $reportType === "1" ){
                $product = $product->join('status', 'product.status_id', '=', 'status.status_id')
                ->join('category', 'product.category_id', '=', 'category.category_id')
                ->select('product.*', 'status.name as status_name','category.name as category_name');

                // if date is inputed
                if(!empty($this->from) && !empty($this->to)){
                    $product = $product->join('status as s1', 'product.status_id', '=', 's1.status_id')
                    ->join('category as c1', 'product.category_id', '=', 'c1.category_id')
                    ->select('product.*','status.name as status_name','category.name as category_name')
                    ->whereDate('product.created_at', '>=', $this->from)
                    ->whereDate('product.created_at', '<=', $this->to);

                }elseif(!empty($this->from)){
                    $product = $product->join('status as s2', 'product.status_id', '=', 's2.status_id')
                    ->join('category as c2', 'product.category_id', '=', 'c2.category_id')
                    ->select('product.*','s2.name as status_name','c2.name as category_name')
                    ->whereDate('product.created_at','>=',$this->from);

                }elseif(!empty($this->to)){
                    $product = $product->join('status as s3', 'product.status_id', '=', 's3.status_id')
                    ->join('category as c3', 'product.category_id', '=', 'c3.category_id')
                    ->select('product.*','s3.name as status_name','c3.name as category_name')
                    ->whereDate('product.created_at','<=',$this->to);

                }

                $this->selectedReportType = $reportType;
                $this->products = $product->get();
            }



            // Frequently Accessed System's Report

            if( $reportType === "2" && !empty($this->search)){
                $product = $product->join('status', 'product.status_id', '=', 'status.status_id')
                ->join('category', 'product.category_id', '=', 'category.category_id')
                ->select('product.*', 'status.name as status_name','category.name as category_name')
                ->where('product.name','like','%'. $this->search.'%')
                ->orderBy('number_of_clicks', 'desc')
                ->take(1);

                // If date is inputed

                if(!empty($this->from) && !empty($this->to)){
                    $product = $product->join('status as s1', 'product.status_id', '=', 's1.status_id')
                    ->join('category as c1', 'product.category_id', '=', 'c1.category_id')
                    ->select('product.*','status.name as status_name','category.name as category_name')
                    ->whereDate('product.created_at', '>=', $this->from)
                    ->whereDate('product.created_at', '<=', $this->to);

                }elseif(!empty($this->from)){
                    $product = $product->join('status as s2', 'product.status_id', '=', 's2.status_id')
                    ->join('category as c2', 'product.category_id', '=', 'c2.category_id')
                    ->select('product.*','s2.name as status_name','c2.name as category_name')
                    ->whereDate('product.created_at','>=',$this->from);

                }elseif(!empty($this->to)){
                    $product = $product->join('status as s3', 'product.status_id', '=', 's3.status_id')
                    ->join('category as c3', 'product.category_id', '=', 'c3.category_id')
                    ->select('product.*','s3.name as status_name','c3.name as category_name')
                    ->whereDate('product.created_at','<=',$this->to);

                }

                $this->selectedReportType = $reportType;
                $this->products = $product->get();
            }elseif ( $reportType === "2") {
                $product = $product->join('status', 'product.status_id', '=', 'status.status_id')
                ->join('category', 'product.category_id', '=', 'category.category_id')
                ->select('product.*', 'status.name as status_name','category.name as category_name')
                ->orderBy('number_of_clicks', 'desc')
                ->take(10);

                //   if date is inputed
                if(!empty($this->from) && !empty($this->to)){
                    $product = $product->join('status as s1', 'product.status_id', '=', 's1.status_id')
                    ->join('category as c1', 'product.category_id', '=', 'c1.category_id')
                    ->select('product.*','status.name as status_name','category.name as category_name')
                    ->whereDate('product.created_at', '>=', $this->from)
                    ->whereDate('product.created_at', '<=', $this->to);

                }elseif(!empty($this->from)){
                    $product = $product->join('status as s2', 'product.status_id', '=', 's2.status_id')
                    ->join('category as c2', 'product.category_id', '=', 'c2.category_id')
                    ->select('product.*','s2.name as status_name','c2.name as category_name')
                    ->whereDate('product.created_at','>=',$this->from);

                }elseif(!empty($this->to)){
                    $product = $product->join('status as s3', 'product.status_id', '=', 's3.status_id')
                    ->join('category as c3', 'product.category_id', '=', 'c3.category_id')
                    ->select('product.*','s3.name as status_name','c3.name as category_name')
                    ->whereDate('product.created_at','<=',$this->to);

                }
                $this->selectedReportType = $reportType;
                $this->products = $product->get();
            }



             // Active System's

             if( $reportType === "3" && !empty($this->search)){
                $product = $product->join('status', 'product.status_id', '=', 'status.status_id')
                ->join('category', 'product.category_id', '=', 'category.category_id')
                ->select('product.*', 'status.name as status_name','category.name as category_name')
                ->where('product.name','like','%'. $this->search.'%')
                ->where('status.name','like','%'.'active'.'%')
                ->take(1);

                    // if date is inputed
                    if(!empty($this->from) && !empty($this->to)){
                        $product = $product->join('status as s1', 'product.status_id', '=', 's1.status_id')
                        ->join('category as c1', 'product.category_id', '=', 'c1.category_id')
                        ->select('product.*','status.name as status_name','category.name as category_name')
                        ->whereDate('product.created_at', '>=', $this->from)
                        ->whereDate('product.created_at', '<=', $this->to);

                    }elseif(!empty($this->from)){
                        $product = $product->join('status as s2', 'product.status_id', '=', 's2.status_id')
                        ->join('category as c2', 'product.category_id', '=', 'c2.category_id')
                        ->select('product.*','s2.name as status_name','c2.name as category_name')
                        ->whereDate('product.created_at','>=',$this->from);

                    }elseif(!empty($this->to)){
                        $product = $product->join('status as s3', 'product.status_id', '=', 's3.status_id')
                        ->join('category as c3', 'product.category_id', '=', 'c3.category_id')
                        ->select('product.*','s3.name as status_name','c3.name as category_name')
                        ->whereDate('product.created_at','<=',$this->to);

                    }

                    $this->selectedReportType = $reportType;
                    $this->products = $product->get();

            }elseif ( $reportType === "3") {
                $product = $product->join('status', 'product.status_id', '=', 'status.status_id')
                ->join('category', 'product.category_id', '=', 'category.category_id')
                ->select('product.*', 'status.name as status_name','category.name as category_name')
                ->where('status.name','like','%'.'active'.'%');

                 // if date is inputed
                 if(!empty($this->from) && !empty($this->to)){
                    $product = $product->join('status as s1', 'product.status_id', '=', 's1.status_id')
                    ->join('category as c1', 'product.category_id', '=', 'c1.category_id')
                    ->select('product.*','status.name as status_name','category.name as category_name')
                    ->whereDate('product.created_at', '>=', $this->from)
                    ->whereDate('product.created_at', '<=', $this->to);

                }elseif(!empty($this->from)){
                    $product = $product->join('status as s2', 'product.status_id', '=', 's2.status_id')
                    ->join('category as c2', 'product.category_id', '=', 'c2.category_id')
                    ->select('product.*','s2.name as status_name','c2.name as category_name')
                    ->whereDate('product.created_at','>=',$this->from);

                }elseif(!empty($this->to)){
                    $product = $product->join('status as s3', 'product.status_id', '=', 's3.status_id')
                    ->join('category as c3', 'product.category_id', '=', 'c3.category_id')
                    ->select('product.*','s3.name as status_name','c3.name as category_name')
                    ->whereDate('product.created_at','<=',$this->to);

                }
                $this->selectedReportType = $reportType;
                $this->products = $product->get();
            }

              // Deactivated System's

              if( $reportType === "4" && !empty($this->search)){
                $product = $product->join('status', 'product.status_id', '=', 'status.status_id')
                ->join('category', 'product.category_id', '=', 'category.category_id')
                ->select('product.*', 'status.name as status_name','category.name as category_name')
                ->where('product.name','like','%'. $this->search.'%')
                ->where('status.name','like','%'.'deactivated'.'%')
                ->take(1);

                    // if date is inputed
                    if(!empty($this->from) && !empty($this->to)){
                        $product = $product->join('status as s1', 'product.status_id', '=', 's1.status_id')
                        ->join('category as c1', 'product.category_id', '=', 'c1.category_id')
                        ->select('product.*','status.name as status_name','category.name as category_name')
                        ->whereDate('product.created_at', '>=', $this->from)
                        ->whereDate('product.created_at', '<=', $this->to);

                    }elseif(!empty($this->from)){
                        $product = $product->join('status as s2', 'product.status_id', '=', 's2.status_id')
                        ->join('category as c2', 'product.category_id', '=', 'c2.category_id')
                        ->select('product.*','s2.name as status_name','c2.name as category_name')
                        ->whereDate('product.created_at','>=',$this->from);

                    }elseif(!empty($this->to)){
                        $product = $product->join('status as s3', 'product.status_id', '=', 's3.status_id')
                        ->join('category as c3', 'product.category_id', '=', 'c3.category_id')
                        ->select('product.*','s3.name as status_name','c3.name as category_name')
                        ->whereDate('product.created_at','<=',$this->to);

                    }
                    $this->selectedReportType = $reportType;
                    $this->products = $product->get();

            }elseif ( $reportType === "4") {
                $product = $product->join('status', 'product.status_id', '=', 'status.status_id')
                ->join('category', 'product.category_id', '=', 'category.category_id')
                ->select('product.*', 'status.name as status_name','category.name as category_name')
                ->where('status.name','like','%'.'deactivated'.'%');

                 // if date is inputed
                 if(!empty($this->from) && !empty($this->to)){
                    $product = $product->join('status as s1', 'product.status_id', '=', 's1.status_id')
                    ->join('category as c1', 'product.category_id', '=', 'c1.category_id')
                    ->select('product.*','status.name as status_name','category.name as category_name')
                    ->whereDate('product.created_at', '>=', $this->from)
                    ->whereDate('product.created_at', '<=', $this->to);

                }elseif(!empty($this->from)){
                    $product = $product->join('status as s2', 'product.status_id', '=', 's2.status_id')
                    ->join('category as c2', 'product.category_id', '=', 'c2.category_id')
                    ->select('product.*','s2.name as status_name','c2.name as category_name')
                    ->whereDate('product.created_at','>=',$this->from);

                }elseif(!empty($this->to)){
                    $product = $product->join('status as s3', 'product.status_id', '=', 's3.status_id')
                    ->join('category as c3', 'product.category_id', '=', 'c3.category_id')
                    ->select('product.*','s3.name as status_name','c3.name as category_name')
                    ->whereDate('product.created_at','<=',$this->to);

                }
                $this->selectedReportType = $reportType;
                $this->products = $product->get();
            }

             // System's in production report

             if( $reportType === "5" && !empty($this->search)){
                $product = $product->join('status', 'product.status_id', '=', 'status.status_id')
                ->join('category', 'product.category_id', '=', 'category.category_id')
                ->select('product.*', 'status.name as status_name','category.name as category_name')
                ->where('product.name','like','%'. $this->search.'%')
                ->where('status.name','like','%'.'production'.'%')
                ->take(1);

                    // if date is inputed
                    if(!empty($this->from) && !empty($this->to)){
                        $product = $product->join('status as s1', 'product.status_id', '=', 's1.status_id')
                        ->join('category as c1', 'product.category_id', '=', 'c1.category_id')
                        ->select('product.*','status.name as status_name','category.name as category_name')
                        ->whereDate('product.created_at', '>=', $this->from)
                        ->whereDate('product.created_at', '<=', $this->to);

                    }elseif(!empty($this->from)){
                        $product = $product->join('status as s2', 'product.status_id', '=', 's2.status_id')
                        ->join('category as c2', 'product.category_id', '=', 'c2.category_id')
                        ->select('product.*','s2.name as status_name','c2.name as category_name')
                        ->whereDate('product.created_at','>=',$this->from);

                    }elseif(!empty($this->to)){
                        $product = $product->join('status as s3', 'product.status_id', '=', 's3.status_id')
                        ->join('category as c3', 'product.category_id', '=', 'c3.category_id')
                        ->select('product.*','s3.name as status_name','c3.name as category_name')
                        ->whereDate('product.created_at','<=',$this->to);

                    }
                    $this->selectedReportType = $reportType;
                    $this->products = $product->get();

            }elseif ( $reportType === "5") {
                $product = $product->join('status', 'product.status_id', '=', 'status.status_id')
                ->join('category', 'product.category_id', '=', 'category.category_id')
                ->select('product.*', 'status.name as status_name','category.name as category_name')
                ->where('status.name','like','%'.'production'.'%');

                 // if date is inputed
                 if(!empty($this->from) && !empty($this->to)){
                    $product = $product->join('status as s1', 'product.status_id', '=', 's1.status_id')
                    ->join('category as c1', 'product.category_id', '=', 'c1.category_id')
                    ->select('product.*','status.name as status_name','category.name as category_name')
                    ->whereDate('product.created_at', '>=', $this->from)
                    ->whereDate('product.created_at', '<=', $this->to);

                }elseif(!empty($this->from)){
                    $product = $product->join('status as s2', 'product.status_id', '=', 's2.status_id')
                    ->join('category as c2', 'product.category_id', '=', 'c2.category_id')
                    ->select('product.*','s2.name as status_name','c2.name as category_name')
                    ->whereDate('product.created_at','>=',$this->from);

                }elseif(!empty($this->to)){
                    $product = $product->join('status as s3', 'product.status_id', '=', 's3.status_id')
                    ->join('category as c3', 'product.category_id', '=', 'c3.category_id')
                    ->select('product.*','s3.name as status_name','c3.name as category_name')
                    ->whereDate('product.created_at','<=',$this->to);

                }
                $this->selectedReportType = $reportType;
                $this->products = $product->get();
            }


             //  System's in development report

             if( $reportType === "6" && !empty($this->search)){
                $product = $product->join('status', 'product.status_id', '=', 'status.status_id')
                ->join('category', 'product.category_id', '=', 'category.category_id')
                ->select('product.*', 'status.name as status_name','category.name as category_name')
                ->where('product.name','like','%'. $this->search.'%')
                ->where('status.name','like','%'.'development'.'%')
                ->take(1);

                    // if date is inputed
                    if(!empty($this->from) && !empty($this->to)){
                        $product = $product->join('status as s1', 'product.status_id', '=', 's1.status_id')
                        ->join('category as c1', 'product.category_id', '=', 'c1.category_id')
                        ->select('product.*','status.name as status_name','category.name as category_name')
                        ->whereDate('product.created_at', '>=', $this->from)
                        ->whereDate('product.created_at', '<=', $this->to);

                    }elseif(!empty($this->from)){
                        $product = $product->join('status as s2', 'product.status_id', '=', 's2.status_id')
                        ->join('category as c2', 'product.category_id', '=', 'c2.category_id')
                        ->select('product.*','s2.name as status_name','c2.name as category_name')
                        ->whereDate('product.created_at','>=',$this->from);

                    }elseif(!empty($this->to)){
                        $product = $product->join('status as s3', 'product.status_id', '=', 's3.status_id')
                        ->join('category as c3', 'product.category_id', '=', 'c3.category_id')
                        ->select('product.*','s3.name as status_name','c3.name as category_name')
                        ->whereDate('product.created_at','<=',$this->to);

                    }

                    $this->selectedReportType = $reportType;
                    $this->products = $product->get();

            }elseif ( $reportType === "6") {
                $product = $product->join('status', 'product.status_id', '=', 'status.status_id')
                ->join('category', 'product.category_id', '=', 'category.category_id')
                ->select('product.*', 'status.name as status_name','category.name as category_name')
                ->where('status.name','like','%'.'development'.'%');

                 // if date is inputed
                 if(!empty($this->from) && !empty($this->to)){
                    $product = $product->join('status as s1', 'product.status_id', '=', 's1.status_id')
                    ->join('category as c1', 'product.category_id', '=', 'c1.category_id')
                    ->select('product.*','status.name as status_name','category.name as category_name')
                    ->whereDate('product.created_at', '>=', $this->from)
                    ->whereDate('product.created_at', '<=', $this->to);

                }elseif(!empty($this->from)){
                    $product = $product->join('status as s2', 'product.status_id', '=', 's2.status_id')
                    ->join('category as c2', 'product.category_id', '=', 'c2.category_id')
                    ->select('product.*','s2.name as status_name','c2.name as category_name')
                    ->whereDate('product.created_at','>=',$this->from);

                }elseif(!empty($this->to)){
                    $product = $product->join('status as s3', 'product.status_id', '=', 's3.status_id')
                    ->join('category as c3', 'product.category_id', '=', 'c3.category_id')
                    ->select('product.*','s3.name as status_name','c3.name as category_name')
                    ->whereDate('product.created_at','<=',$this->to);

                }

                $this->selectedReportType = $reportType;
                $this->products = $product->get();
            }

             // Decommissioned System's

             if( $reportType === "7" && !empty($this->search)){
                $product = $product->join('status', 'product.status_id', '=', 'status.status_id')
                ->join('category', 'product.category_id', '=', 'category.category_id')
                ->select('product.*', 'status.name as status_name','category.name as category_name')
                ->where('product.name','like','%'. $this->search.'%')
                ->where('status.name','like','%'.'decommissioned'.'%')
                ->take(1);

                    // if date is inputed
                    if(!empty($this->from) && !empty($this->to)){
                        $product = $product->join('status as s1', 'product.status_id', '=', 's1.status_id')
                        ->join('category as c1', 'product.category_id', '=', 'c1.category_id')
                        ->select('product.*','status.name as status_name','category.name as category_name')
                        ->whereDate('product.created_at', '>=', $this->from)
                        ->whereDate('product.created_at', '<=', $this->to);

                    }elseif(!empty($this->from)){
                        $product = $product->join('status as s2', 'product.status_id', '=', 's2.status_id')
                        ->join('category as c2', 'product.category_id', '=', 'c2.category_id')
                        ->select('product.*','s2.name as status_name','c2.name as category_name')
                        ->whereDate('product.created_at','>=',$this->from);

                    }elseif(!empty($this->to)){
                        $product = $product->join('status as s3', 'product.status_id', '=', 's3.status_id')
                        ->join('category as c3', 'product.category_id', '=', 'c3.category_id')
                        ->select('product.*','s3.name as status_name','c3.name as category_name')
                        ->whereDate('product.created_at','<=',$this->to);

                    }

                    $this->selectedReportType = $reportType;
                    $this->products = $product->get();

            }elseif ( $reportType === "7") {
                $product = $product->join('status', 'product.status_id', '=', 'status.status_id')
                ->join('category', 'product.category_id', '=', 'category.category_id')
                ->select('product.*', 'status.name as status_name','category.name as category_name')
                ->where('status.name','like','%'.'decommissioned'.'%');

                 // if date is inputed
                 if(!empty($this->from) && !empty($this->to)){
                    $product = $product->join('status as s1', 'product.status_id', '=', 's1.status_id')
                    ->join('category as c1', 'product.category_id', '=', 'c1.category_id')
                    ->select('product.*','status.name as status_name','category.name as category_name')
                    ->whereDate('product.created_at', '>=', $this->from)
                    ->whereDate('product.created_at', '<=', $this->to);

                }elseif(!empty($this->from)){
                    $product = $product->join('status as s2', 'product.status_id', '=', 's2.status_id')
                    ->join('category as c2', 'product.category_id', '=', 'c2.category_id')
                    ->select('product.*','s2.name as status_name','c2.name as category_name')
                    ->whereDate('product.created_at','>=',$this->from);

                }elseif(!empty($this->to)){
                    $product = $product->join('status as s3', 'product.status_id', '=', 's3.status_id')
                    ->join('category as c3', 'product.category_id', '=', 'c3.category_id')
                    ->select('product.*','s3.name as status_name','c3.name as category_name')
                    ->whereDate('product.created_at','<=',$this->to);

                }

                $this->selectedReportType = $reportType;
                $this->products = $product->get();
            }


              // System Developer Report

              if( $reportType === "8" && !empty($this->search)){
                $product = $product->join('status', 'product.status_id', '=', 'status.status_id')
                ->join('category', 'product.category_id', '=', 'category.category_id')
                ->select('product.*', 'status.name as status_name','category.name as category_name')
                ->where('product.lead_developer','like','%'. $this->search.'%')
                ->take(1);

                    // if date is inputed
                    if(!empty($this->from) && !empty($this->to)){
                        $product = $product->join('status as s1', 'product.status_id', '=', 's1.status_id')
                        ->join('category as c1', 'product.category_id', '=', 'c1.category_id')
                        ->select('product.*','status.name as status_name','category.name as category_name')
                        ->whereDate('product.created_at', '>=', $this->from)
                        ->whereDate('product.created_at', '<=', $this->to);

                    }elseif(!empty($this->from)){
                        $product = $product->join('status as s2', 'product.status_id', '=', 's2.status_id')
                        ->join('category as c2', 'product.category_id', '=', 'c2.category_id')
                        ->select('product.*','s2.name as status_name','c2.name as category_name')
                        ->whereDate('product.created_at','>=',$this->from);

                    }elseif(!empty($this->to)){
                        $product = $product->join('status as s3', 'product.status_id', '=', 's3.status_id')
                        ->join('category as c3', 'product.category_id', '=', 'c3.category_id')
                        ->select('product.*','s3.name as status_name','c3.name as category_name')
                        ->whereDate('product.created_at','<=',$this->to);

                    }

                    $this->selectedReportType = $reportType;
                    $this->products = $product->get();

            }elseif ( $reportType === "8") {
                $product = $product->join('status', 'product.status_id', '=', 'status.status_id')
                ->join('category', 'product.category_id', '=', 'category.category_id')
                ->select('product.*', 'status.name as status_name','category.name as category_name')
                ->where('product.lead_developer','like','%'. $this->search.'%');

                 // if date is inputed
                 if(!empty($this->from) && !empty($this->to)){
                    $product = $product->join('status as s1', 'product.status_id', '=', 's1.status_id')
                    ->join('category as c1', 'product.category_id', '=', 'c1.category_id')
                    ->select('product.*','status.name as status_name','category.name as category_name')
                    ->whereDate('product.created_at', '>=', $this->from)
                    ->whereDate('product.created_at', '<=', $this->to);

                }elseif(!empty($this->from)){
                    $product = $product->join('status as s2', 'product.status_id', '=', 's2.status_id')
                    ->join('category as c2', 'product.category_id', '=', 'c2.category_id')
                    ->select('product.*','s2.name as status_name','c2.name as category_name')
                    ->whereDate('product.created_at','>=',$this->from);

                }elseif(!empty($this->to)){
                    $product = $product->join('status as s3', 'product.status_id', '=', 's3.status_id')
                    ->join('category as c3', 'product.category_id', '=', 'c3.category_id')
                    ->select('product.*','s3.name as status_name','c3.name as category_name')
                    ->whereDate('product.created_at','<=',$this->to);

                }
                $this->selectedReportType = $reportType;
                $this->products = $product->get();
                // dd($product);
            }

            if( $reportType === "9" && !empty($this->search)){
                $suggestions = SuggestionBox::all();

                    // if date is inputed
                    if(!empty($this->from) && !empty($this->to)){
                        $suggestion = $suggestion->whereDate('created_at', '>=', $this->from)
                        ->whereDate('created_at', '<=', $this->to);

                    }elseif(!empty($this->from)){
                        $suggestion = $suggestion->whereDate('created_at','>=',$this->from);

                    }elseif(!empty($this->to)){
                        $suggestion = $suggestion->whereDate('product.created_at','<=',$this->to);

                    }

                    $this->selectedReportType = $reportType;
                    $this->suggestion = $suggestion->get();

            }elseif ( $reportType === "9") {

                $paginate = SuggestionBox::all();

                // dd($suggestion);

                $suggestion = SuggestionBox::where('system_name','like','%'. $this->search.'%');

                // dd($suggestion);

                 // if date is inputed
                 if(!empty($this->from) && !empty($this->to)){
                    $suggestion = $suggestion->whereDate('created_at', '>=', $this->from)
                    ->whereDate('created_at', '<=', $this->to);

                }elseif(!empty($this->from)){
                    $suggestion = $suggestion->whereDate('created_at','>=',$this->from);

                }elseif(!empty($this->to)){
                    $suggestion = $suggestion->whereDate('created_at','<=',$this->to);

                }
                $this->selectedReportType = $reportType;

                // dd($this->selectedReportType);

                $suggest = $suggestion->paginate(5);
                // $this->suggestions = collect($suggest->items());

                // dd($this->suggestions);

    //              $users = $usersQuery->paginate(10);
    // $usersCollection = collect($users->items());
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
            $this->status_id = $product->status_id;
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
