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
    $status_id, $number_of_clicks = 0, $url, $test_url,
    $lead_developer, $short_description, $long_description,
    $tutorial_url, $date_launched , $date_decommissioned ;


    public $image;
    public $preview_image;
    public $search;
    public $allData = [];
    protected function rules(){
        return[
            'name' => 'required|min:3|max:200',
            'icon_link' => 'required|url',
            'category_id' => '',
            'image' => 'nullable|image|max:5024',
            'status_id' => '',
            // 'number_of_clicks' => '',
            'url' => 'required|url',
            'test_url' => 'required|url',
            'lead_developer' => '',
            'short_description' => 'required|min:3|max:200',
            'long_description' => 'required|min:3|max:300',
            'tutorial_url' => 'required|url',
            'date_launched' => 'nullable',
            'date_decommissioned' => 'nullable',
        ];


        // $this->preview_image = $this->image->temporaryUrl();

    }


    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveProduct(){

        $loading = true;
        sleep(2);

        // $this->validate([
        //     'image' => 'image|max:2048',
        // ]);
        $validateData = $this ->validate();

        // dd($validateData);
        if ($this->category_id == "0" || $this->status_id == "0"
            || $this->lead_developer == "0") {
            $this->addError('selectedOption', 'Please select a valid option.');
            return;
            $loading = false;
        }else{
           $product = Product::create($validateData);
            $product->addMedia($this->image->getRealPath())->toMediaCollection('images');
        //    dd($product);

            session()->flash('savesuccessful','Your Product was successfully added');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
            $this->resetPage();
            $loading = false;
        }
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
        $this-> status_id ='';
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

        $validateData = $this ->validate();

        Product::where('product_id',$this->product_id)->update([

            'name' => $validateData['name'],
            // 'icon_link' => $validateData['icon_link'],
            'category_id' => $validateData['category_id'],
            'status_id' => $validateData['status_id'],
            'url' => $validateData['url'],
            'test_url' => $validateData['test_url'],
            'lead_developer' => $validateData['lead_developer'],
            'short_description' => $validateData['short_description'],
            'long_description' => $validateData['long_description'],
            'tutorial_url' => $validateData['tutorial_url'],
            'date_launched' => $validateData['date_launched'],
            'date_decommissioned' => $validateData['date_decommissioned']
        ]);

        session()->flash('updatesuccessful','Your product was updated successfully');
        $this->resetInput();

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

        $productsMedia = Product::with('media')->get();
        $productsMediaa = Product::all();
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
            'productsMedia' => $productsMedia,
            'categoriesfields'=>$categoriesfields,
            'statusfields'=>$statusfields,
            'groupedCategories'=>$groupedCategories,
            'leaddevs' => $leaddevs,
            'roles' => $roles,
        ]);
    }
}
