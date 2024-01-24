<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductService;
use App\Models\ProductClicks;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }



    public static function searchResults( $search_term )
    {
        $search_results = [];
        $code = config('constants.status_codes.production') ;

        if ($search_term) {
            $categories = Category::WhereRaw("LOWER(name) LIKE LOWER('%{$search_term}%')")->get();
            if (!empty($categories)) {
                $search_results= Product::orWhereIn('category_id', $categories->pluck('id')->toArray() ?? 0)
                ->WhereRaw( "LOWER(status_code) = LOWER('{$code}')" )
                    ->orWhereRaw("LOWER(name) LIKE LOWER('%{$search_term}%')")
                    ->orWhereRaw("LOWER(url) LIKE LOWER('%{$search_term}%')")
                    ->orWhereRaw("LOWER(short_description) LIKE LOWER('%{$search_term}%')")
                    ->orderBy('name')->get();
            } else {
                $search_results = Product::WhereRaw("LOWER(name) LIKE LOWER('%{$search_term}%')")
                ->WhereRaw("LOWER(status_code) = LOWER('{$code}')" )
                    ->orWhereRaw("LOWER(url) LIKE LOWER('%{$search_term}%')")
                    ->orWhereRaw("LOWER(short_description) LIKE LOWER('%{$search_term}%')")
                    ->orderBy('name')->get();
            }
        }


        return $search_results ;
    }



    public static function recordClick($product_id)
    {

        DB::transaction(function () use ($product_id) {
            //one - increment in system / products table
            $product = Product::find($product_id);
            $product->number_of_clicks++;
            $product->save();

            $product_clicks = ProductClicks::where('product_id', $product->id)
                ->where('product_url', $product->url)
                ->whereDate('created_at', Carbon::today())->first();

            if ($product_clicks) {
                $product_clicks->number_of_clicks++;
                $product_clicks->save();
            } else {
                $product_clicks = new ProductClicks();
                $product_clicks->product_url = $product->url;
                $product_clicks->product_name = $product->name;
                $product_clicks->product_id = $product->id;
                $product_clicks->number_of_clicks = 1;
                $product_clicks->save();
            }

            return redirect()->to($product->url);
        });


    }


    public static function checkSystemStateWithAGet(){


        $products = Product::where('status_code', config('constants.status_codes.active'))->get();
        $client = new Client();

        //loop through each product
        foreach ($products as $product ) {
            try {
                //check 
                $response = $client->request('GET', $product->url);
                $status = $response->getStatusCode();
               
            
                $product->update(['heart_beat' => $status == 200 ? 'on' : 'off']);
            } catch (\Exception $e) {
               // Handle exception (e.g., timeout, unreachable, etc.)

                if($product->heart_beat == "off"){
                    $updatedAt = $product->updated_at;
                    // Compare updated_at with current time
                    if (\Carbon\Carbon::parse($updatedAt)->addMinutes(5)->isPast()) {
                        // updated_at is more than 5 minutes ago
                             //check if there is a record of the error in product service
                        $errorRecord = ProductService::where('product_id', $product->id )
                        ->where('url', $product->url )
                        ->whereNull('heart_beat')
                        ->first();

                        //if found - update else create
                        if( ($errorRecord->product_id ?? "nothing")  == "nothing") {
                            ProductService::updateOrCreate(
                                [
                                
                                    'url'=> $product->url,
                                    'product_id'=> $product->id,                               
                                ],
                                [
                                    'product_name' => $product->name,
                                    'url'=> $product->url,
                                    'status'=> "off",
                                    'reason'=>  $e->getMessage() ?? "-",
                                    'product_id'=> $product->id, 
                                    'heart_beat' => 'off',
                                ]
                            );
                        }else{
                             if (\Carbon\Carbon::parse($errorRecord->updated_at)->addMinutes(30)->isPast()){
                                // updated_at is more than 30 minutes ago
                                //send mail to the group

                                $this->recipientEmails[] = 'nshubart@zesco.co.zm';
                                $this->recipientEmails[] = 'pmudenda@zesco.co.zm';
                                // $this->recipientEmails[] = 'isd@zesco.co.zm';

                                $createdAt = $errorRecord->created_at;
                                // Calculate the difference and display in human-readable format
                                $timeDifference = $createdAt->diffForHumans();

                                Mail::send([], [], function ($message) use ($e, $product, $timeDifference ) {
                                    $message->setTo($this->recipientEmails)
                                        ->setSubject( 'System Access Failure : '.$e->getMessage() ?? "-"   )
                                        ->setBody( $product->name .' has been down on '.$product->url . ' ,  '.$timeDifference . ". Please investgate and resolve.")
                                        ->setFrom('ezescohome@zesco.co.zm');
                                });

                            }else{

                                $this->recipientEmails[] = 'nshubart@zesco.co.zm';
                                // $this->recipientEmails[] = 'isd@zesco.co.zm';

                                $createdAt = $errorRecord->created_at;
                                // Calculate the difference and display in human-readable format
                                $timeDifference = $createdAt->diffForHumans();

                                Mail::send([], [], function ($message) use ($e, $product, $timeDifference ) {
                                    $message->setTo($this->recipientEmails)
                                        ->setSubject( 'System Access Failure : '.$e->getMessage() ?? "-"   )
                                        ->setBody( 'Dear devs, </br> '. $product->name .' has been down on '.$product->url . ' ,  '.$timeDifference . ". Please investgate and resolve.")
                                        ->setFrom('ezescohome@zesco.co.zm');
                                });
                            }

                            //update
                            ProductService::updateOrCreate(
                                [                                  
                                    'url'=> $product->url,
                                    'product_id'=> $product->id,                               
                                ],
                                [
                                    'product_name' => $product->name ?? "-",
                                    'url'=> $product->url ?? "-",
                                    'status'=> "off",
                                    'heart_beat' => "off",
                                    'reason'=>  $e->getMessage() ?? "-",
                                    'product_id'=> $product->id, 
                                ]
                            ); 
                        }
                       
                    } else {
                        // updated_at is within the last 5 minutes
                        // no updates
                    }
                }
                $product->update(
                    ['heart_beat' => 'off',
                    'status' => 'off',
                    ]
                );

                //WRITE THE LOGS
            }
        }

        return 'URLs checked and status updated.';
    }




}
