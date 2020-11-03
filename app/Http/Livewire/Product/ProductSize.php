<?php

namespace App\Http\Livewire\Product;

use App\Models\ProductSizeModel;
use Livewire\Component;

class ProductSize extends Component
{
    public $size;
    public $name;
    public $isUpdate = false;

    public function create() {
        ProductSizeModel::create([
            'size' => $this->name,
        ]);
        $this->name = '';
        $this->isUpdate = false;
    }

    public function delete($id) {
        $size = ProductSizeModel::find($id);
        $size->delete();
    }

    public function edit($id) {
        $size = ProductSizeModel::find($id);
        $this->size = $size;
        $this->name = $size->size;
        $this->isUpdate = true;
    }

    public function update() {
        ProductSizeModel::where('id',$this->size->id)->update([
            'size' => $this->name,
        ]);
        $this->name = '';
        $this->isUpdate = false;
    }

    public function render()
    {
        $sizes = ProductSizeModel::all();
        return view('livewire.product-size',[
            'sizes' => $sizes,
        ]);;
    }
}
