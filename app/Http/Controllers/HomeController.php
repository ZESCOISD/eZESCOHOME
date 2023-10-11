<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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

        if ($search_term) {
            $categories = Category::WhereRaw("LOWER(name) LIKE LOWER('%{$search_term}%')")->get();
            if (!empty($categories)) {
                $search_results= Product::orWhereIn('category_id', $categories->pluck('id')->toArray() ?? 0)
                    ->orWhereRaw("LOWER(name) LIKE LOWER('%{$search_term}%')")
                    ->orWhereRaw("LOWER(url) LIKE LOWER('%{$search_term}%')")
                    ->orWhereRaw("LOWER(short_description) LIKE LOWER('%{$search_term}%')")
                    ->orderBy('name')->get();
            } else {
                $search_results = Product::WhereRaw("LOWER(name) LIKE LOWER('%{$search_term}%')")
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


        $products =
        $client = new Client();

        foreach ($urls as $url) {
            try {
                $response = $client->request('GET', $product->url);
                $status = $response->getStatusCode();

                // Assuming you have a column named 'status' in your 'urls' table
                $url->update(['status' => $status == 200 ? 'on' : 'off']);
            } catch (\Exception $e) {
                // Handle exception (e.g., timeout, unreachable, etc.)
                $url->update(['status' => 'off']);
            }
        }

        return 'URLs checked and status updated.';
    }




}
