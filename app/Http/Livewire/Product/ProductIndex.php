<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use App\Models\Product as ModelProduct;
use App\Imports\ProductImport;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Response;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Excel;

class ProductIndex extends Component
{
    use WithFileUploads;

    public $products = '';
    public $excel;

    public function edit ($id) {
        $record = Product::findOrFail($id);
        return view('livewire.product.index',['product->'])
            ->layout('layouts.app')
            ->slot('content');
    }

    public function destroy ($id) {
        if ($id) {
            $record = Product::where('id',$id);
            $record->delete();
        }
    }

    public function download()
    {
        $file= public_path(). "/import/Template.xlsx";

        return Response::download($file, 'Template.xlsx');
    }

    public function render()
    {
        $this->products = ModelProduct::all();
        return view('livewire.product.index')
            ->layout('layouts.app')
            ->slot('content');
    }

    public function import()
    {
//        $path = $this->excel->store('temp','public');
//        dd($this->excel->file('file'));
        \Excel::import(new ProductImport,$this->excel);
    }
}
