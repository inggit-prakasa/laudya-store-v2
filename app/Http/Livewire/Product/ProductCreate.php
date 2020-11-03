<?php

namespace App\Http\Livewire\Product;

//use App\HistoryProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{
    use WithFileUploads;

    public $name;
    public $price;
    public $size;
    public $color;
    public $category;
    public $description;
    public $image;
    public $quantity;

    public function submit()
    {
        Product::create([
            'name' => $this->name,
            'price' => $this->price,
            'size' => $this->size,
            'color' => $this->color,
            'category' => $this->category,
            'quantity' => $this->quantity,
            'image' => $this->image,
            'description' => $this->description,
        ]);
    }

    public function create()
    {
        $this->validate([
           'name' => 'required',
           'price' => 'required',
           'size' => 'required',
           'color' => 'required',
           'category' => 'required',
           'quantity' => 'required',
            'image' => 'image|max:1024',
        ]);

        $imageName = $this->image->storePublicly('images', 's3');
//        $imageName = $this->image->store('images','public');

        Product::create([
            'name' => $this->name,
            'price' => $this->price,
            'size' => $this->size,
            'color' => $this->color,
            'category' => $this->category,
            'quantity' => $this->quantity,
            'image' => $imageName,
            'description' => $this->description,
        ]);

        return redirect()->to('/product/index');
    }

    public function render()
    {
        return view('livewire.product.create')
            ->layout('layouts.app')
            ->slot('content');
    }
}
