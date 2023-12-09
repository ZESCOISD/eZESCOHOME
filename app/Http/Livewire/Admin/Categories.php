<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Categories extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name;
    public $category_id;
    public $html;
    public $search;
    public $loading = false;
    public $allData = [];
    protected function rules(){
        return[
            'name' => 'required|min:3|max:20',
            'description' => 'required|min:3|max:250',
            'html'=> 'required|min:3|max:250',
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveCategory(){
        $this->loading = true;
        sleep(2);

        $validateData = $this ->validate();
        Category::create($validateData);
        $this->resetInput();
        session()->flash('savesuccessful','Your category was successfully added');

        $this->loading = false;
    }

    public function editCategory(int $category_id){
        $category = Category::find($category_id);
        if($category){
            $this->category_id = $category->id;
            $this->name = $category->name;
            $this->description = $category->description;
            $this->html = $category->html;
        }else{
            return redirect()->to('/categories.manage');
        }
    }

    public function closeModal(){
        $this->resetInput();
    }

    public function resetInput(){
        $this-> name ='';
        $this-> description ='';
        $this-> html ='';
    }

    public function updateCategory(){
        $this->loading = true;
        sleep(2);

        $validateData = $this ->validate();
        Category::where('id',$this->category_id)->update([
            'name' => $validateData['name'],
            'description' => $validateData['description'],
            'html' => $validateData['html'],
        ]);
        session()->flash('updatesuccessful','Your category was updated successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');

        $this->loading = false;

    }

    public function deleteCategory(int $category_id){
        $this->category_id = $category_id;
    }

    public function destroyCategory(){
        $this->loading = true;
        sleep(2);

      Category::find($this->category_id)->delete();
      session()->flash('deletesuccessful','Your category was deleted successfully');
        $this->dispatchBrowserEvent('close-modal');

        $this->loading = false;
    }


    public function logout()
    {


        Auth::logout();
        return redirect('login');
    }

    public function render()
    {
        $categories = Category::where('name', 'like', '%'.$this->search.'%')->orderBy('id','ASC')->paginate(5);
        return view('livewire.admin.categories',['categories' => $categories]);
    }

}

