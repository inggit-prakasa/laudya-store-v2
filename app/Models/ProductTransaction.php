<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTransaction extends Model
{
    protected $guarded = [];
    protected $table = 'product_transaction';

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
