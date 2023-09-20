<?php

namespace App\Http\Livewire\Admin;

// use Spatie\MediaLibrary\MediaCollections\Models\Media;
// use Spatie\MediaLibrary\HasMedia;
// use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ListProducts extends Component
{

    // use InteractsWithMedia;
    use WithFileUploads;
    use WithPagination;

    public $categories;
    public $product = [];
    public $selected = '';
    public $developers = [] ;
    public $selectedReportType = false;
    public $loading = false;
    public $name, $product_id, $icon_link, $category_id,
        $status_id, $number_of_clicks = 0, $video, $user_manual,
        $system_cover_image, $cost_saving, $url, $test_url,
        $lead_developer, $short_description, $long_description,
        $tutorial_url, $date_launched, $date_decommissioned, $dev_launch_date, $market_value, $project_cost;
    public $image;
    public $preview_image;
    public $search;
    public $allData = [];
    protected $paginationTheme = 'bootstrap';

    public function saveProduct()
    {

        $loading = true;
        sleep(2);

        $this->validate([
            'name' => 'required|min:3|max:200',
            'icon_link' => 'nullable|image|max:5024',
            'category_id' => 'required',
            'status_id' => 'required',
            'user_manual' => 'nullable|mimes:pdf|max:10240',
            'video' => 'nullable|mimes:mp4|max:50000',
            'cost_saving' => 'required|numeric',
            'system_cover_image' => 'nullable|image|max:5024',
            'url' => 'required|url',
            'test_url' => 'required|url',
            'lead_developer' => 'required',
            'short_description' => 'required|min:3|max:1000',
            'long_description' => 'required|min:3|max:20000',
            'tutorial_url' => 'required|url',
            'date_launched' => 'nullable|date_format:Y-m-d',
            'date_decommissioned' => 'nullable|date_format:Y-m-d',
        ]);
        $product = new Product();

        $filename1 = "";
        $filename2 = "";
        $filename3 = "";
        $filename4 = "";


        if ($this->category_id == "0" || $this->status_id == "0"
            || $this->lead_developer == "0") {
            $this->addError('selectedOption', 'Please select a valid option.');
            return;
            $loading = false;

        } else {

            if ($this->icon_link) {
                $filename1 = $this->icon_link->storeAs('images', $this->icon_link->getClientOriginalName(), 'public');
            } else {
                $filename1 = null;
            }

            if ($this->user_manual) {
                $filename2 = $this->user_manual->storeAs('pdfs', $this->user_manual->getClientOriginalName(), 'public');

            } else {
                $filename2 = null;
            }

            if ($this->video) {
                $filename3 = $this->video->storeAs('videos', $this->video->getClientOriginalName(), 'public');
            } else {
                $filename3 = null;
            }

            if ($this->video) {
                $filename4 = $this->system_cover_image->storeAs('images', $this->system_cover_image->getClientOriginalName(), 'public');
            } else {
                $filename4 = null;
            }

            //save product
            $product->name = $this->name;
            $product->category_id = $this->category_id;
            $product->status_id = $this->status_id;
            $product->number_of_clicks = $this->number_of_clicks;
            $product->url = $this->url;
            $product->test_url = $this->test_url;
            $product->market_value = $this->market_value;
            $product->project_cost = $this->project_cost;
            $product->cost_saving = $this->cost_saving;
            $product->lead_developer = $this->lead_developer;
            $product->short_description = $this->short_description;
            $product->long_description = $this->long_description;
            $product->tutorial_url = $this->tutorial_url;
            $product->dev_launch_date = date('Y-m-d', strtotime($this->dev_launch_date));
            $product->date_launched = date('Y-m-d', strtotime($this->date_launched));
            $product->date_decommissioned = date('Y-m-d', strtotime($this->date_decommissioned));
            $product->icon_link = $filename1;
            $product->user_manual = $filename2;
            $product->video = $filename3;
            $product->system_cover_image = $filename4;
            $result = $product->save();

            //product to developers
            $product->developers()->syncWithoutDetaching($this->developers);

            if ($result) {
                session()->flash('savesuccessful', 'Your Product was successfully added');
                $this->resetInput();
                $this->dispatchBrowserEvent('close-modal');
                $this->resetPage();

            } else {
                session()->flash('error', 'Product Not Added Successfully');
            }

        }


        $loading = false;

    }

    public function resetInput()
    {
        $this->product_id = '';
        $this->name = '';
        $this->icon_link = '';
        $this->category_id = '';
        $this->video = '';
        $this->system_cover_image = '';
        $this->cost_saving = '';
        $this->user_manual = '';
        // $this-> number_of_clicks ='';
        $this->url = '';
        $this->test_url = '';
        $this->lead_developer = '';
        $this->short_description = '';
        $this->long_description = '';
        $this->tutorial_url = '';
        $this->date_launched = '';
        $this->date_decommissioned = '';
    }

    public function editProduct(int $product_id)
    {
        $this->product = Product::find($product_id);

        // dd($product);
        if ($this->product) {
            if ($this->category_id == "0" || $this->status_id == "0"
                || $this->lead_developer == "0") {
                $this->addError('selectedOption', 'Please select a valid option.');
                return;
            } else {

                // $this->searchResults = [];
                // if ($this->icon_link) {
                //     $this->product['icon_link'] = Storage::files('images');
                // }

                $this->icon_link = $this->product->icon_link;

                // dd($this->icon_link);

                if ($this->system_cover_image) {
                    $this->product['system_cover_image'] = Storage::files('images');
                }

                if ($this->video) {
                    $this->product['video'] = Storage::files('videos');
                }

                if ($this->user_manual) {
                    $this->product['user_manual'] = Storage::files('pdfs');
                }

                $this->product_id = $this->product->id;
                $this->name = $this->product->name;
                // $this->icon_link = $product->icon_link;
                $this->category_id = $this->product->category_id;
                $this->status_id = $this->product->status_id;
                $this->cost_saving = $this->product->cost_saving;
                // $this->system_cover_image = $product->system_cover_image;
                // $this->video = $product->video;
                // $this->user_manual = $product->user_manual;
                // $this->number_of_clicks = $product->number_of_clicks;
                $this->url = $this->product->url;
                $this->test_url = $this->product->test_url;
                $this->lead_developer = $this->product->lead_developer;
                $this->short_description = $this->product->short_description;
                $this->long_description = $this->product->long_description;
                $this->tutorial_url = $this->product->tutorial_url;
                $this->date_launched = $this->product->date_launched;
                $this->date_decommissioned = $this->product->date_decommissioned;
            }

            //   dd($this->icon_link->getClientOriginalName());
        } else {
            return redirect()->to('/product.manage');
        }


    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function updateProduct()
    {

        $loading = true;
        sleep(2);

        $files = Product::where('id', 'like', '%' . $this->product_id . '%')->first();

        // dd($files);

        $this->validate([
            'name' => 'required|min:3|max:200',
            'icon_link' => 'nullable|image|max:5024',
            'category_id' => '',
            'status_id' => '',
            'user_manual' => 'nullable|mimes:pdf|max:10240',
            'video' => 'nullable|mimes:mp4|max:50000',
            'cost_saving' => 'required|numeric',
            'system_cover_image' => 'nullable|image|max:5024',
            'url' => 'required|url',
            'test_url' => 'required|url',
            'lead_developer' => '',
            'short_description' => 'required|min:3|max:200',
            'long_description' => 'required|min:3|max:300',
            'tutorial_url' => 'required|url',
            'date_launched' => 'nullable|date_format:Y-m-d',
            'date_decommissioned' => 'nullable|date_format:Y-m-d',
        ]);

        //  $files = new Product();

        $filename1 = "";
        $filename2 = "";
        $filename3 = "";
        $filename4 = "";


        if ($this->category_id == "0" || $this->status_id == "0"
            || $this->lead_developer == "0") {
            $this->addError('selectedOption', 'Please select a valid option.');
            return;
            $loading = false;

        } else {

            if ($this->icon_link) {
                $filename1 = $this->icon_link->store('images', 'public');
            } else {
                $filename1 = null;
            }

            if ($this->user_manual) {
                $filename2 = $this->user_manual->store('pdfs', 'public');
            } else {
                $filename2 = null;
            }

            if ($this->video) {
                $filename3 = $this->video->store('videos', 'public');
            } else {
                $filename3 = null;
            }

            if ($this->video) {
                $filename4 = $this->system_cover_image->store('images', 'public');
            } else {
                $filename4 = null;
            }

            $files->name = $this->name;
            $files->category_id = $this->category_id;
            $files->status_id = $this->status_id;
            $files->number_of_clicks = $this->number_of_clicks;
            $files->url = $this->url;
            $files->test_url = $this->test_url;
            $files->cost_saving = $this->cost_saving;
            $files->lead_developer = $this->lead_developer;
            $files->short_description = $this->short_description;
            $files->long_description = $this->long_description;
            $files->tutorial_url = $this->tutorial_url;
            $files->date_launched = date('Y-m-d', strtotime($this->date_launched));
            $files->date_decommissioned = date('Y-m-d', strtotime($this->date_decommissioned));
            $files->icon_link = $filename1;
            $files->user_manual = $filename2;
            $files->video = $filename3;
            $files->system_cover_image = $filename4;
            $result = $files->update();

            if ($result) {
                session()->flash('updatesuccessful', 'Your Product was successfully added');
                $this->resetInput();
                $this->dispatchBrowserEvent('close-modal');
                $this->resetPage();

            } else {
                session()->flash('error', 'Product Not Added Successfully');
            }

        }

        $loading = false;
    }

    public function deleteProduct(int $product_id)
    {
        $this->product_id = $product_id;
    }

    public function destroyProduct()
    {

        $loading = true;
        sleep(2);

        Product::find($this->product_id)->delete();
        session()->flash('deletesuccessful', 'Your product was deleted successfully');
        $loading = false;
    }

    public function logout()
    {

        Auth::logout();
        return redirect('login');


    }

    public function render()
    {

        // $productsMedia = Product::with('media')->get();
        $ezesco_products = Product::all();
        // dd($productsMedia);
        // $students = Student::with('media')->get();

        $categories = DB::table('category')
            ->join('product', 'category.category_id', '=', 'product.category_id')
            ->select('category.name as category_name', 'product.name as product_name')
            ->orderBy('category.name')
            ->get();

        $groupedCategories = $categories->groupBy('category_name');

        $this->categories = $groupedCategories;

        $categoriesfields = Category::all();
        $statusfields = Status::all();
        $leaddevs = User::all();
        $roles = Role::all();
        $products = Product::where('name', 'like', '%' . $this->search . '%')->orderBy('id', 'ASC')->paginate(5);
        // $show
        return view('livewire.admin.list-products', [
            'products' => $products,
            'ezesco_products' => $ezesco_products,
            'categoriesfields' => $categoriesfields,
            'statusfields' => $statusfields,
            'groupedCategories' => $groupedCategories,
            'leaddevs' => $leaddevs,
            'roles' => $roles,
        ]);
    }


//    public function checkSystemStatus(){
//        //get a list of all systems
//        $products = Product::get();
//        //loop through
//        foreach ($products as $product){
//            $result = ProductService::heartBeatCheck($product->url) ;
//            //check the result
//            if($result == 1){
//                $product->status = 1 ;
//            }else{
//                $product->status = 0 ;
//            }
//            $product->save();
//        }
//    }

}
