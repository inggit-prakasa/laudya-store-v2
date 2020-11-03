<?php

namespace App\Http\Livewire\Product;

use App\Models\ProductCategoryModel;
use Livewire\Component;

class ProductCategory extends Component
{
    public $category;
    public $name;
    public $isUpdate = false;

    public function create() {
        ProductCategoryModel::create([
            'name' => $this->name,
        ]);
        $this->name = '';
        $this->isUpdate = false;
    }

    public function delete($id) {
        $category = ProductCategoryModel::find($id);
        $category->delete();
    }

    public function edit($id) {
        $category = ProductCategoryModel::find($id);
        $this->category = $category;
        $this->name = $category->name;
        $this->isUpdate = true;
    }

    public function update() {
        ProductCategoryModel::where('id',$this->category->id)->update([
           'name' => $this->name,
        ]);
        $this->name = '';
        $this->isUpdate = false;
    }

    public function render()
    {
        $categories = ProductCategoryModel::all();
        return view('livewire.product.product-category',[
            'categories' => $categories,
        ]);
    }
}
