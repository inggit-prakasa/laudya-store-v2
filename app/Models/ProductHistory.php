<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{
    protected $table = 'history_product';
    protected $fillable = ['product_id', 'user_id', 'quantity', 'quantity_change', 'type'];
}
