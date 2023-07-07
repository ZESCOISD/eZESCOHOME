<?php

namespace App\Http\Livewire\Admin;

// use Spatie\MediaLibrary\MediaCollections\Models\Media;
// use Spatie\MediaLibrary\HasMedia;
// use Spatie\MediaLibrary\InteractsWithMedia;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Product;
use App\Models\Status;
use App\Models\Category;
use App\Models\User;
use App\Models\Role;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ListProducts extends Component
{

    // use InteractsWithMedia;
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $categories;
    public $loading = false;

    public $name, $product_id, $icon_link, $category_id,
    $status_id, $number_of_clicks = 0, $video, $user_manual,
     $system_cover_image, $cost_saving, $url, $test_url,
    $lead_developer, $short_description, $long_description,
    $tutorial_url, $date_launched , $date_decommissioned ;


    public $image;
    public $preview_image;
    public $search;
    public $allData = [];
    // protected function rules(){


    //     return[
    //         'name' => 'required|min:3|max:200',
    //         'icon_link' => 'nullable|image|max:15240',
    //         'category_id' => '',
    //         'status_id' => '',
    //         'user_manual' => 'nullable|mimes:pdf|max:10240',
    //          'video' => 'nullable|mimes:mp4|max:16240',
    //          'cost_saving' => 'required|numeric',
    //         'system_cover_image'=> 'nullable|image|max:5024',
    //         'url' => 'required|url',
    //         'test_url' => 'required|url',
    //         'lead_developer' => '',
    //         'short_description' => 'required|min:3|max:200',
    //         'long_description' => 'required|min:3|max:300',
    //         'tutorial_url' => 'required|url',
    //         'date_launched' => 'nullable|date',
    //         'date_decommissioned' => 'nullable|date',
    //     ];




    // }


    // public function updated($fields)
    // {
    //     $this->validateOnly($fields);
    // }

    public function saveProduct(){

        $loading = true;
        sleep(2);

        $this->validate([
            'name' => 'required|min:3|max:200',
            'icon_link' => 'nullable|image|max:5024',
            'category_id' => '',
            'status_id' => '',
            'user_manual' => 'nullable|mimes:pdf|max:10240',
             'video' => 'nullable|mimes:mp4|max:16240',
             'cost_saving' => 'required|numeric',
            'system_cover_image'=> 'nullable|image|max:5024',
            'url' => 'required|url',
            'test_url' => 'required|url',
            'lead_developer' => '',
            'short_description' => 'required|min:3|max:200',
            'long_description' => 'required|min:3|max:300',
            'tutorial_url' => 'required|url',
            'date_launched' => 'nullable|date_format:Y-m-d',
            'date_decommissioned' => 'nullable|date_format:Y-m-d',
        ]);
          $files = new Product();

           $filename1 = "";
           $filename2 = "";
           $filename3 = "";
           $filename4 = "";


           if ($this->category_id == "0" || $this->status_id == "0"
            || $this->lead_developer == "0") {
            $this->addError('selectedOption', 'Please select a valid option.');
            return;
            $loading = false;

           }elseif ($this->icon_link && $this->user_manual && $this->video && $this->system_cover_image) {
            $filename1 = $this->icon_link->store('images', 'public');
            $filename2 = $this->user_manual->store('pdfs', 'public');
            $filename3 = $this->video->store('videos', 'public');
            $filename4 = $this->system_cover_image->store('images', 'public');

        } else {
            $filename1 = Null;
            $filename2 = Null;
            $filename3 = Null;
            $filename4 = Null;
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
        if( $files->date_launched ||  $files->date_decommissioned){

        }
        $files->date_launched = date('Y-m-d', strtotime($this->date_launched));
        $files->date_decommissioned = date('Y-m-d', strtotime($this->date_decommissioned));



        $files->icon_link = $filename1;
        $files->user_manual = $filename2;
        $files->video = $filename3;
        $files->system_cover_image = $filename4;
        $result = $files->save();


        if($result){
             session()->flash('savesuccessful','Your Product was successfully added');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
            $this->resetPage();

        }else{
             session()->flash('error', 'Product Not Added Successfully');
        }

         $loading = false;

    }

    public function editProduct(int $product_id){
        $product = Product::find($product_id);
        if($product){
            if ($this->category_id == "0" || $this->status_id == "0"
            || $this->lead_developer == "0") {
            $this->addError('selectedOption', 'Please select a valid option.');
            return;
        }else{
            $this->product_id = $product->product_id;
            $this->name = $product->name;
            $this->icon_link = $product->icon_link;
            $this->category_id = $product->category_id;
            $this->status_id = $product->status_id;
            $this->cost_saving = $product->cost_saving;
            $this->system_cover_image = $product->system_cover_image;
            $this->video = $product->video;
            $this->user_manual = $product->user_manual;
            // $this->number_of_clicks = $product->number_of_clicks;
            $this->url = $product->url;
            $this->test_url = $product->test_url;
            $this->lead_developer = $product->lead_developer;
            $this->short_description = $product->short_description;
            $this->long_description = $product->long_description;
            $this->tutorial_url = $product->tutorial_url;
            $this->date_launched = $product->date_launched;
            $this->date_decommissioned = $product->date_decommissioned;
          }

        }else{
            return redirect()->to('/product.manage');
        }
    }

    public function closeModal(){
        $this->resetInput();
    }

    public function resetInput(){
        $this-> product_id ='';
        $this-> name ='';
        $this-> icon_link ='';
        $this-> category_id ='';
        $this-> video ='';
        $this-> system_cover_image ='';
        $this-> cost_saving ='';
        $this-> user_manual ='';
        // $this-> number_of_clicks ='';
        $this-> url ='';
        $this-> test_url ='';
        $this-> lead_developer ='';
        $this-> short_description ='';
        $this-> long_description ='';
        $this-> tutorial_url ='';
        $this-> date_launched ='';
        $this-> date_decommissioned ='';
    }

    public function updateProduct(){

        $loading = true;
        sleep(2);

        $product = Product::findOrFail($this->product_id);

        $this->validate([
            'name' => 'required|min:3|max:200',
            'icon_link' => 'nullable|image|max:5024',
            'category_id' => '',
            'status_id' => '',
            'user_manual' => 'nullable|mimes:pdf|max:10240',
             'video' => 'nullable|mimes:mp4|max:16240',
             'cost_saving' => 'required|numeric',
            'system_cover_image'=> 'nullable|image|max:5024',
            'url' => 'required|url',
            'test_url' => 'required|url',
            'lead_developer' => '',
            'short_description' => 'required|min:3|max:200',
            'long_description' => 'required|min:3|max:300',
            'tutorial_url' => 'required|url',
            'date_launched' => 'nullable|date_format:Y-m-d',
            'date_decommissioned' => 'nullable|date_format:Y-m-d',
        ]);

         $files = new Product();

           $filename1 = "";
           $filename2 = "";
           $filename3 = "";
           $filename4 = "";


           if ($this->category_id == "0" || $this->status_id == "0"
            || $this->lead_developer == "0") {
            $this->addError('selectedOption', 'Please select a valid option.');
            return;
            $loading = false;

           }elseif ($this->icon_link && $this->user_manual && $this->video && $this->system_cover_image) {
            $filename1 = $this->icon_link->store('images', 'public');
            $filename2 = $this->user_manual->store('pdfs', 'public');
            $filename3 = $this->video->store('videos', 'public');
            $filename4 = $this->system_cover_image->store('images', 'public');

        } else {
            $filename1 = Null;
            $filename2 = Null;
            $filename3 = Null;
            $filename4 = Null;
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
        if( $files->date_launched ||  $files->date_decommissioned){

        }
        $files->date_launched = date('Y-m-d', strtotime($this->date_launched));
        $files->date_decommissioned = date('Y-m-d', strtotime($this->date_decommissioned));



        $files->icon_link = $filename1;
        $files->user_manual = $filename2;
        $files->video = $filename3;
        $files->system_cover_image = $filename4;
        $result = $files->save();


        if($result){
             session()->flash('savesuccessful','Your Product was successfully added');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
            $this->resetPage();

        }else{
             session()->flash('error', 'Product Not Added Successfully');
        }

         $loading = false;

    }

    public function deleteProduct(int $product_id){
        $this->product_id = $product_id;
    }

    public function destroyProduct(){

        $loading = true;
        sleep(2);

      Product::find($this->product_id)->delete();
      session()->flash('deletesuccessful','Your product was deleted successfully');
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
        $products = Product::where('name', 'like', '%'.$this->search.'%')->orderBy('product_id','ASC')->paginate(5);
        // $show
        return view('livewire.admin.list-products',[
            'products' => $products,
            'ezesco_products' => $ezesco_products,
            'categoriesfields'=>$categoriesfields,
            'statusfields'=>$statusfields,
            'groupedCategories'=>$groupedCategories,
            'leaddevs' => $leaddevs,
            'roles' => $roles,
        ]);
    }
}
