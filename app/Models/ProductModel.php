<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductModel;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'product_models'; // Specify the table name

    protected $fillable = [
        'name', 'quantity', 'price', 'description'
    ];
}
