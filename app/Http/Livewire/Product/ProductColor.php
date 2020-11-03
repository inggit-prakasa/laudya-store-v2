<?php

namespace App\Http\Livewire\Product;

use App\Models\ProductColorlModel;
use Livewire\Component;

class ProductColor extends Component
{
    public $color;
    public $name;
    public $isUpdate = false;

    public function create() {
        ProductColorlModel::create([
            'name' => $this->name,
        ]);
        $this->name = '';
        $this->isUpdate = false;
    }

    public function delete($id) {
        $color = ProductColorlModel::find($id);
        $color->delete();
    }

    public function edit($id) {
        $color = ProductColorlModel::find($id);
        $this->color = $color;
        $this->name = $color->name;
        $this->isUpdate = true;
    }

    public function update() {
        ProductColorlModel::where('id',$this->color->id)->update([
            'name' => $this->name,
        ]);
        $this->name = '';
        $this->isUpdate = false;
    }

    public function render()
    {
        $colors = ProductColorlModel::all();
        return view('livewire.product-color',[
            'colors' => $colors,
        ]);
    }
}
