<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProductService;
use Livewire\Component;

class ProductsLogs extends Component
{
    public function render()
    {
        $productsLogs = ProductService::paginate(10);
        return view('livewire.admin.products-logs',['productsLogs'=>$productsLogs]);
    }
}
