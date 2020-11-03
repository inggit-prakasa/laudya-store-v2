<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use App\Models\ProductHistory;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    use WithFileUploads;

    public $idProduct;
    public $name;
    public $price;
    public $size;
    public $color;
    public $category;
    public $description;
    public $image;
    public $imageNew;
    public $quantity;
    public $newQuantity;
    public $recordsHistory;

    public function mount($id)
    {
        $record = Product::find($id);
        $this->idProduct = $record->id;
        $this->name = $record->name;
        $this->price = $record->price;
        $this->size = $record->size;
        $this->color = $record->color;
        $this->category = $record->category;
        $this->description = $record->description;
        $this->image = $record->image;
        $this->quantity = $record->quantity;
        $this->recordsHistory = ProductHistory::where('product_id',$id)->orderBy('created_at','desc')->get();
    }


    public function update() {
        $this->validate([
            'name' => 'required',
            'price' => 'required',
            'size' => 'required',
            'color' => 'required',
            'category' => 'required',
        ]);

        $this->quantity = $this->quantity + $this->newQuantity;
        $imageName = '';

        if ($this->imageNew != null) {
            $imageName = $this->imageNew->storePublicly('images', 's3');
        }
//        $imageName = $this->imageNew->store('images','public');

        Product::where('id',$this->idProduct)->update([
            'name' => $this->name,
            'price' => $this->price,
            'size' => $this->size,
            'color' => $this->color,
            'category' => $this->category,
            'quantity' => $this->quantity,
            'image' => $imageName ? $imageName : $this->image,
            'description' => $this->description,
        ]);

        return redirect()->to('/product/index');
    }

    public function render()
    {
        return view('livewire.product.edit');
    }
}
