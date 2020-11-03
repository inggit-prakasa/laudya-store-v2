<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColorlModel extends Model
{
    protected $table = 'color';
    protected $fillable = ['name', 'code'];
}
